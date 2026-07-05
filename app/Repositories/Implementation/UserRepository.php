<?php

namespace App\Repositories\Implementation;

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

<<<<<<< HEAD:app/Repositories/UserRepository.php
    public function update(int $id, User $user) : ?User {
        $user->save();
        return $user;
 
        
    }
=======
>>>>>>> develop:app/Repositories/Implementation/UserRepository.php

    public function destroy(int $id) : void {
        User::destroy($id);
        
    }

    
}
