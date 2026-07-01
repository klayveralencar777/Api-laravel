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

    public function saveUser(User $newUser) : User {
        $user = $this->repository->findByEmail($newUser->email);
        if($user) {
            throw ValidationException::withMessages(['user_email' => ['Email already exists']]);
        }
         return $this->repository->save($newUser);
    }


    public function updateUser(int $id, User $newUser) : ?User {
        $user = $this->findUserById($id);
        $user->name = $newUser->name;
        $user->email = $newUser->email;
        $user->password = $newUser->password;
        return $this->repository->update($id, $user);

    }

    public function deleteUser(int $id) : void {
        $this->findUserById($id);
        $this->repository->destroy($id);
    }
}