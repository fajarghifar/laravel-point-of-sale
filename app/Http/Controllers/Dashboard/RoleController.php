<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        return view('roles.permission-index', [
            'permissions' => $permissions,
        ]);
    }

    public function permissionCreate()
    {
        return view('roles.permission-create');
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

        return view('roles.permission-edit', [
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

        return view('roles.role-index', [
            'roles' => $roles,
        ]);
    }

    public function roleCreate()
    {
        return view('roles.role-create');
    }

    public function roleStore(\App\Http\Requests\Role\StoreRoleRequest $request)
    {
        Role::create($request->validated());

        return Redirect::route('role.index')->with('success', 'Role has been created!');
    }

    public function roleEdit(Int $id)
    {
        $role = Role::findById($id);

        return view('roles.role-edit', [
            'role' => $role,
        ]);
    }

    public function roleUpdate(\App\Http\Requests\Role\UpdateRoleRequest $request, int $id)
    {
        Role::findOrFail($id)->update($request->validated());

        return Redirect::route('roles.index')->with('success', 'Role has been updated!');
    }

    public function roleDestroy(Int $id)
    {
        Role::destroy($id);

        return Redirect::route('roles.index')->with('success', 'Role has been deleted!');
    }

    public function rolePermissionIndex()
    {
        $roles = QueryBuilder::for(Role::class)->paginate();

        return view('roles.role-permission-index', [
            'roles' => $roles,
        ]);
    }


    // Role has Permissions
    public function rolePermissionCreate()
    {
        $roles = Role::all();
        $permission_groups = User::getPermissionGroups();

        // Fetch ALL permissions and group them by 'group_name' to avoid N+1 in view
        $permissions_by_group = Permission::all()->groupBy('group_name');

        return view('roles.role-permission-create', [
            'roles' => $roles,
            'permission_groups' => $permission_groups,
            'permissions_by_group' => $permissions_by_group,
        ]);
    }

    public function rolePermissionStore(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|array',
        ]);

        $role = Role::findOrFail($request->role_id);
        $role->syncPermissions($request->permission_id);

        return Redirect::route('rolePermission.index')->with('success', 'Role Permission has been created!');
    }

    public function rolePermissionEdit(Int $id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();

        return view('roles.role-permission-edit', [
            'role' => $role,
            'permissions' => $permissions,
            'permission_groups' => $permission_groups
        ]);
    }

    public function rolePermissionUpdate(Request $request, Int $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission_id;

        if(!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        return Redirect::route('rolePermission.index')->with('success', 'Role Permission has been updated!');
    }

    public function rolePermissionDestroy(Int $id)
    {
        $role = Role::findOrFail($id);

        if(!is_null($role)) {
            $role->delete();
        }

        return Redirect::route('rolePermission.index')->with('success', 'Role Permission has been deleted!');
    }
}
