<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface 
{
    public function findAll() : Collection{
        return User::all();

    }

    public function findById(int $id) : ?User {
        return User::find($id);

    }

    public function findByEmail(string $email) : ?User {
        return User::where('email', $email)->first();

    }

    public function save(User $user) : User{
       $user->save();
       return $user;
    }

    public function update(int $id, User $user) : ?User {
        $user->save();
        return $user;
 
        
    }

    public function destroy(int $id) : void {
        $userDeleted = $this->findById($id);
        $userDeleted->destroy($id);
        
    }

    
}
