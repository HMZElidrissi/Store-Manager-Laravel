<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Models\Role;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function __construct(protected PermissionRepository $permissionRepository, protected RoleRepository $roleRepository)
    {
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $this->authorize('viewAny', Permission::class);
        $permissions = $this->permissionRepository->getAll();
        return view('backOffice.permissions.index', compact('permissions'));
    }

    public function add()
    {
        $this->authorize('assign', Permission::class);
        $roles = $this->roleRepository->getAll();
        $permissions = $this->permissionRepository->getAll();
        return view('backOffice.permissions.assign', compact('roles', 'permissions'));
    }

    public function assign(Request $request)
    {
        $this->authorize('assign', Permission::class);
        $role = $this->roleRepository->getById($request->role);
        $permission = $this->permissionRepository->getById($request->permission);
        $role->permissions()->attach($permission);
        return redirect()->route('permissions.index')->with('success', 'Permission assigned successfully!');
    }

    public function revoke(Role $role, Permission $permission)
    {
        $this->authorize('revoke', Permission::class);
        $role->permissions()->detach($permission);
        return redirect()->route('permissions.index')->with('success', 'Permission revoked successfully!');
    }
}
