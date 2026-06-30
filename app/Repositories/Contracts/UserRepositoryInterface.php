<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Models\User;


interface UserRepositoryInterface {

    public function findAll(): Collection;

    public function findById(int $id) : ?User;

    public function findByEmail(string $email) : ?User;

    public function save(User $user) : User;

    public function update(int $id, User $user) : ?User;

    public function destroy(int $id) : void;
    



    

}


