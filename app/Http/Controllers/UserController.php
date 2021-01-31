<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user-type' => ['required', 'string'],
        ]);
    }

    public function Index()
    {
        $user = User::all();
        $arr = Array('Users' => $user);
        return view('User.Index', $arr);
    }

    // GET: User/Create
    public function Create(Request $request)
    {
        if ($request->isMethod('GET')) {
            $roles = Role::all();
            $arr = Array('Roles' => $roles);
            return view('User.Create', $arr);
        } else {
            $this->validator($request);
            $roles = $request->input('roles');
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->type = $request->input('user-type');
            $user->save();
            if (!is_null($roles)) {
                $user->roles()->attach($roles);
            }
            return redirect()->route('User.Index')->with('success', 'You have successfully add new User.');
        }
    }

    public function Delete($id)
    {
        $user = User::find($id);
        if (!is_null($user)) {
            $user->delete();
        }
        return redirect()->route('User.Index')->with('success', 'You have successfully delete User.');
    }

    public function Edit(Request $request, $id)
    {
        $user = User::find($id);
        if (!is_null($user)) {
            if ($request->isMethod("GET")) {
                $roles = Role::all();
                $arr = Array('User' => $user, 'Roles' => $roles);
                return view('User.Edit', $arr);
            } else {
                $roles = $request->input('roles');
                $user->roles()->sync($roles);
                return redirect()->route('User.Index')->with('success', 'You have successfully edit User.');
            }
        }
    }
}
