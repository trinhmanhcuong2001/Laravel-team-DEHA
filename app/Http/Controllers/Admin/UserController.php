<?php


// app/Http/Controllers/Admin/UserController.php
namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\UserRequest\CreateUserRequest;
use App\Http\Requests\UserRequest\UpdateUserRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' ', $arr);
        View::share('title', $title);
        $this->middleware('auth');
        $this->middleware('checkPermission:create-user')->only(['create', 'store']);
        $this->middleware('checkPermission:edit-user')->only(['edit', 'update']);
        $this->middleware('checkPermission:delete-user')->only(['destroy']);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $roles = Role::all();

        if ($search) {
            $users = $this->userService->searchUsers($search);
        } else {
            $users = $this->userService->getAllUsers();
        }

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create',[
            'roles' => $roles
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $validated = $request->validated();

        try {
            $user = $this->userService->createUser($validated);
            $this->userService->addRoles($user->id, $request->roles);

            return redirect()->route('users.index')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['email' => 'This email is already taken.'])->withInput();
        }
        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function edit($userId)
    {
        $user = $this->userService->getUserById($userId);
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray(); // Get current user roles
        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(UpdateUserRequest $request, $userId)
    {
        $validated = $request->validated();
        $this->userService->updateUser($userId, $validated);
        $this->userService->updateRoles($userId, $request->roles);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($userId)
    {
        $this->userService->deleteUser($userId);
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
