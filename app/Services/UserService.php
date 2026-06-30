<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class UserService {
    public function __construct( 
        private UserRepositoryInterface $repository
    ){}

    public function findAllUsers() : Collection{
        return $this->repository->findAll();
        
    }

    public function findUserById(int $id) : ?User {
        $user = $this->repository->findById($id);
        if( !$user) {
            throw ValidationException::withMessages(['user_id' => ['User not found']]);
        }
        return $user;

    }

    public function findUserByEmail(string $email) : ?User {
        $user = $this->repository->findByEmail($email);
        if (!$user) {
            throw ValidationException::withMessages(['user_email' => ['User not found']]);
            
        }
        return $user;
    }

    public function saveUser(User $user) : User {
        $userFound = $this->repository->findByEmail($user->email);
        if($userFound) {
            throw ValidationException::withMessages(['user_email' => ['Email already exists']]);
        }
         return $this->repository->save($user);
    }


    public function updateUser(int $id, User $user) : ?User {
        $user = $this->findUserById($id);
        return $this->repository->update($id, $user);
    }

    public function deleteUser(int $id) : void {
        $this->findUserById($id);
        $this->repository->destroy($id);
    }
}