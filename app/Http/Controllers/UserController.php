<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest as RequestsStoreUserRequest;
use App\Http\Requests\UpdateUserRequest as RequestsUpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

use App\Models\User;

use Illuminate\Http\JsonResponse;


class UserController extends Controller {

    public function __construct(
        private UserService $userService
    ) {}

    public function index() : JsonResponse{
        $users = $this->userService->findAllUsers();
        return response()->json($users, 200);
    }

    public function showById(int $id) : JsonResponse {
        $user =  $this->userService->findUserById($id);
        $userResource = new UserResource($user);
        return response()->json($userResource, 200);
    }

    public function store(RequestsStoreUserRequest $request) : JsonResponse {
        $user = new User($request->validated());
        $savedUser = $this->userService->saveUser($user);
        return response()->json($savedUser, 201);

    }

    public function update(int $id, RequestsUpdateUserRequest $request) : JsonResponse {
        $user = new User($request->validated());
        $updatedUser = $this->userService->updateUser($id, $user);
        return response()->json($updatedUser, 200);

    }



    public function delete(int $id) : JsonResponse {
        $this->userService->deleteUser($id);
        return response()->json(null, 204);
    }

}
