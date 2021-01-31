<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Index()
    {
        $permission = Permission::all();
        $arr = Array('Permissions' => $permission);
        return view('Permission.Index',$arr);
    }

    // GET: Permission/Create
    public function Create(Request $request)
    {
        if($request->isMethod('GET')){
            return view('Permission.Create');
        }else{
            $request->validate([
                'name' => 'required|max:255',
                'description' => 'required|max:255',
            ]);
            $permission = new Permission();
            $permission->name = $request->input('name');
            $permission->description = $request->input('description');
            $permission->save();
            return redirect()->route('Permission.Index')->with('success','You have successfully add new Permission.');
        }
    }
    public function Delete($id){
        $permission=Permission::find($id);
        if(!is_null($permission)){
            $permission->delete();
        }
        return redirect()->route('Permission.Index')->with('success','You have successfully delete Permission.');
    }
    public function Edit(Request $request,$id){
        $permission=Permission::find($id);
        if(!is_null($permission)){
            if($request->isMethod("GET")){
                $arr = Array('Permission' => $permission);
                return view('Permission.Edit',$arr);
            }else{
                $request->validate([
                    'name' => 'unique:Permission|required|max:255',
                    'description' => 'required|max:255',
                ]);
                $permission->name = $request->input('name');
                $permission->description = $request->input('description');
                $permission->save();
            }
        }
        return redirect()->route('Permission.Index')->with('success','You have successfully edit Permission.');
    }
    public function Details($id){
        $permission=Permission::find($id);
        if(!is_null($permission)){
            $arr = Array('Permission' => $permission);
            return view('Permission.Details',$arr);
        }else{

            return redirect()->route('Permission.Index');
        }
    }

}
