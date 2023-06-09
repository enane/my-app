<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        return $this->userService->index($request);
    }

    public function store(Request $request)
    {
        return $this->userService->store($request);
    }

    public function update(Request $request, User $user)
    {
        return $this->userService->update($request, $user);
    }

    public function destroy(User $user)
    {
        return $this->userService->destroy($user);
    }
}

