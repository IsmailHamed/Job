<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\DB;
use \stdClass;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Index()
    {
        $role = Role::all();
        $arr = Array('Roles' => $role);
        return view('Role.Index', $arr);
    }

    // GET: Role/Create
    public function Create(Request $request)
    {
        if ($request->isMethod('GET')) {
            $permissions = Permission::all();
            $arr = Array('Permissions' => $permissions);
            return view('Role.Create',$arr);
        } else {
            $request->validate([
                'name' => 'unique:roles|required|max:255',
                'description' => 'required|max:255',
            ]);
            $permissions = $request->input('permissions');
            $role = new Role();
            $role->name = $request->input('name');
            $role->description = $request->input('description');
            $role->save();
            $role->permissions()->attach($permissions);
            return redirect()->route('Role.Index')->with('success', 'You have successfully add new Role.');
        }
    }

    public function Delete($id)
    {
        $role = Role::find($id);
        if (!is_null($role)) {
            $role->delete();
        }
        return redirect()->route('Role.Index')->with('success', 'You have successfully delete Role.');
    }

    public function Edit(Request $request, $id)
    {
        $Role = Role::find($id);
        if (!is_null($Role)) {
            if ($request->isMethod("GET")) {
                $permissions = Permission::all();
                $arr = Array('Role' => $Role, 'Permissions' => $permissions);
                return view('Role.Edit', $arr);
            } else {
                $request->validate([
                    'Name' => 'required|max:255',
                    'description' => 'required|max:255',
                ]);
                $permissions = $request->input('permissions');
                $Role->permissions()->sync($permissions);
                return redirect()->route('Role.Index')->with('success', 'You have successfully edit Role.');
            }
        }
    }

    public function Details($id)
    {
        $Role = Role::find($id);
        $RolePermissions = DB::table('permissions')
            ->join('permission_role', 'permissions.id', '=', 'permission_role.permission_id')
            ->where('permission_role.role_id', '=', $Role->id)
            ->select('permissions.*')
            ->get();

        if (!is_null($Role)) {
            $permissions = Permission::all();
            $arr = Array('Role' => $Role, 'RolePermissions' => $RolePermissions, 'Permissions' => $permissions);
            return view('Role.Details', $arr);
        } else {

            return redirect()->route('Role.Index');
        }
    }

}
