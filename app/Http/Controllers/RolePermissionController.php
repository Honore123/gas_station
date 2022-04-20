<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index()
    {
        return view('role-permission.index', [
            'roles' => Role::all()
        ]);
    }

    public function permissionRole(Role $role)
    {
        return view('role-permission.manage_permission', [
            'roles' => Role::all(),
            'role_permission' => $role,
            'permissions' => Permission::all()->groupBy('category')
        ]);
    }

    public function givePermission(Role $role)
    {
        $permissions = \request()->input('perms');
        $role->syncPermissions($permissions);

        return redirect()->back()->with('success', 'Permissions given');
    }

   public function store()
   {
       $data = request()->validate([
           'name' => ['required', 'string']
       ]);
       Role::create([
           'name' => $data['name']
       ]);

       return redirect()->back()->with('success', 'Role created');
   }
}
