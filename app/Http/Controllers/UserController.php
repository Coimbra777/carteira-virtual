<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Services\UserService;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(StoreUserRequest $request)
    {
        $result = $this->userService->register($request->validated());

        return ApiResponse::success([
            'user' => new UserResource($result['user']),
            'token' => $result['token']
        ], 'User registered successfully', 201);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userService->update($id, $request->validated());

        return ApiResponse::success(new UserResource($user), 'User updated successfully');
    }
}
