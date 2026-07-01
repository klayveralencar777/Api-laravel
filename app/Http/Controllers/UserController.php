<?php

namespace App\Http\Controllers;
use App\Services\UserService;

use App\Models\User;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


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
        return response()->json($user, 200);
    }

    public function store(Request $request) : JsonResponse {
        $user = new User($request->only([
            "name", 
            'email',
            'password',
        
        ]));

        $userResponse = $this->userService->saveUser($user);
        return response()->json($userResponse, 201);

    }

    public function update(int $id, Request $request) : JsonResponse{
        $user = new User($request->only([
            "name", 
            'email',
            'password',
            
        ]));

        $userResponse = $this->userService->updateUser($id, $user);
        return response()->json($userResponse, 200);
    

    }


    public function delete(int $id) : JsonResponse {
        $this->userService->deleteUser($id);
        return response()->json(null, 204);
    }

}
