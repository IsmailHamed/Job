<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function UserProfile(Request $request)
    {
        $user = Auth::user();
        if ($request->isMethod("GET")) {
            $arr = Array('user' => $user);
            return view("auth.UserProfile", $arr);
        } else {
            $request->validate([
                'user-image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $user->name = $request->input('UserName');
            $user->email = $request->input('email');
            $user->type = $request->input('user-type');
            if ($request->hasFile('user-image')) {
                $tempPath = $request->file('user-image')->getRealPath();
                $extension = $request->file('user-image')->getClientOriginalExtension();
                $hashFile = md5_file($tempPath);
                $fullName=$hashFile . "." . $extension;
                if(!Storage::exists('public/'. $fullName)){
                $request->file('user-image')->storeAs('public', $fullName);
                }
                $user->userImage = $fullName;
            }

            $user->save();

        }
        return back()
            ->with('success','You have successfully upload image.');
    }
}
