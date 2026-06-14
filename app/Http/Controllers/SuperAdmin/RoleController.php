<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SuperAdmin\StoreRoleRequest;
use App\Http\Requests\SuperAdmin\UpdateRoleRequest;
use App\Models\RolePermission\Role;
use App\Services\RoleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class RoleController extends BaseController
{
    /**
     * @var RoleService
     */
    protected RoleService $roleService;

    /**
     * @var string
     */
    protected string $title = 'Role Management';

    /**
     * RoleController constructor.
     *
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of roles.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $roles = $this->roleService->getAllRoles();
        return view('super-admin.role.index', compact('roles'), $this->pageData($this->title, 'Home|Roles'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return View
     */
    public function create(): View
    {
        $groupedPermissions = $this->roleService->getGroupedPermissions();
        return view('super-admin.role.create', compact('groupedPermissions'), $this->pageData('Create Role', 'Home|Roles|Create'));
    }

    /**
     * Store a newly created role in storage.
     *
     * @param StoreRoleRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        try {
            $this->roleService->createRole($request->validated());

            return redirect()->route('role.index')->with('success', 'Role created successfully.');
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to create role: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified role.
     *
     * @param Role $role
     * @return View
     */
    public function show(Role $role): View
    {
        $role->load('permissions');
        return view('super-admin.role.show', compact('role'), $this->pageData('Role Details', 'Home|Roles|View'));
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param Role $role
     * @return View
     */
    public function edit(Role $role): View
    {
        $role->load('permissions');
        $groupedPermissions = $this->roleService->getGroupedPermissions();
        return view('super-admin.role.edit', compact('role', 'groupedPermissions'), $this->pageData('Edit Role', 'Home|Roles|Edit'));
    }

    /**
     * Update the specified role in storage.
     *
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        try {
            $this->roleService->updateRole($role->id, $request->validated());

            return redirect()->route('role.index')->with('success', 'Role updated successfully.');
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to update role: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified role from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     */
    public function destroy(Role $role): RedirectResponse
    {
        return redirect()->route('role.index')->with('error', 'Delete functionality is handled globally.');
    }
}
