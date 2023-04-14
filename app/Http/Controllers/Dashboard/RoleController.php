<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // Permission Controller
    public function permissionIndex()
    {
        $permissions = QueryBuilder::for(Permission::class)->paginate();

        return view('role.permission-index', [
            'user' => auth()->user(),
            'permissions' => $permissions,
        ]);
    }

    public function permissionCreate()
    {
        return view('role.permission-create', [
            'user' => auth()->user(),
        ]);
    }

    public function permissionStore(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'group_name' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        Permission::create($validatedData);

        return Redirect::route('permission.index')->with('success', 'Permission has been created!');
    }

    public function permissionEdit(Int $id)
    {
        $permission = Permission::findById($id);

        return view('role.permission-edit', [
            'user' => auth()->user(),
            'permission' => $permission,
        ]);
    }

    public function permissionUpdate(Request $request, Int $id)
    {
        $rules = [
            'name' => 'required|string',
            'group_name' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        Permission::findOrFail($id)->update($validatedData);

        return Redirect::route('permission.index')->with('success', 'Permission has been updated!');
    }

    public function permissionDestroy(Int $id)
    {
        Permission::destroy($id);

        return Redirect::route('permission.index')->with('success', 'Permission has been deleted!');
    }

    // Role Controller
    public function roleIndex()
    {
        $roles = QueryBuilder::for(Role::class)->paginate();

        return view('role.role-index', [
            'user' => auth()->user(),
            'roles' => $roles,
        ]);
    }

    public function roleCreate()
    {
        return view('role.role-create', [
            'user' => auth()->user(),
        ]);
    }

    public function roleStore(Request $request)
    {
        $rules = [
            'name' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        Role::create($validatedData);

        return Redirect::route('role.index')->with('success', 'Role has been created!');
    }

    public function roleEdit(Int $id)
    {
        $role = Role::findById($id);

        return view('role.role-edit', [
            'user' => auth()->user(),
            'role' => $role,
        ]);
    }

    public function roleUpdate(Request $request, Int $id)
    {
        $rules = [
            'name' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        Role::findOrFail($id)->update($validatedData);

        return Redirect::route('role.index')->with('success', 'Role has been updated!');
    }

    public function roleDestroy(Int $id)
    {
        Role::destroy($id);

        return Redirect::route('role.index')->with('success', 'Role has been deleted!');
    }


    // Role has Permissions
    public function rolePermissionCreate()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();

        return view('role.role-permission-create', [
            'user' => auth()->user(),
            'roles' => $roles,
            'permissions' => $permissions,
            'permission_groups' => $permission_groups
        ]);
    }

    public function rolePermissionStore(Request $request)
    {
        $rules = [
            'name' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        Role::create($validatedData);

        return Redirect::route('role.index')->with('success', 'Role has been created!');
    }
}
