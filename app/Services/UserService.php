<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService {
    public function __construct( 
        private UserRepositoryInterface $repository
    ){}

    public function findAllUsers() : Collection{
        return $this->repository->findAll();
        
    }

    public function findUserById(int $id) : ?User {
        $user = $this->repository->findById($id);
        if(!$user) {
            throw ValidationException::withMessages(['user_id' => ['User not found']]);
        }
        return $user;

    }

    public function saveUser(User $user) : ?User {
        $userFound = $this->checkByEmail($user->email);
        if($userFound) {
            throw ValidationException::withMessages(['user_email' => ['Email already exists']]);
        }
        $hashPassword = Hash::make($user->password);
        $user->password = $hashPassword;
        return $this->repository->save($user);
    }


    public function updateUser(int $id, User $user) : ?User {
        
        $userFound = $this->findUserById($id);
        $userEmail = $this->checkByEmail($user->email);
        if($userEmail && $userEmail->id != $userFound->id ) {
            throw ValidationException::withMessages(['user_email' => ['Email already exists']]);
        }
        $userFound->name = $user->name;
        $userFound->email = $user->email;
        $hashPassword = Hash::make($user->password);
        $userFound->password = $hashPassword;

        return $this->repository->save($userFound);
        
    }

    public function deleteUser(int $id) : void {
        $this->findUserById($id);
        $this->repository->destroy($id);
    }

    private function checkByEmail(string $email) : ?User {
        $user = $this->repository->findByEmail($email);
        return $user;

    }
}