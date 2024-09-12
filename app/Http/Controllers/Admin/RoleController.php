<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\RoleRequest\CreateRoleRequest;
use App\Http\Requests\RoleRequest\UpdateRoleRequest;


class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' ', $arr);
        View::share('title', $title);
        $this->middleware('auth');
        $this->middleware('checkPermission:create-role')->only(['create', 'store']);
        $this->middleware('checkPermission:edit-role')->only(['edit', 'update']);
        $this->middleware('checkPermission:delete-role')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->roleService->getAllRole(['permissions']);
        return view('admin.roles.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create',[
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRoleRequest $request)
    {
        //dd($request->permissions);
        $role = $this->roleService->createRole($request->all());
        $this->roleService->addPermissions($role->id, $request->permissions);
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permissions = Permission::all();
        $role = $this->roleService->findRole($id);
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, string $id)
    {
        $role = $this->roleService->updateRole($id, $request->all());
        $this->roleService->updatePermissions($role->id, $request->permissions);
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->roleService->deleteRole($id);
        return redirect()->route('roles.index');
    }

    public function search(Request $request)
    {
        $roles = $this->roleService->searchRole($request->keyword);
        $html = view('admin.roles.result-search', ['roles' => $roles])->render();
        return response()->json([
            'html' => $html
        ]);
    }
}
