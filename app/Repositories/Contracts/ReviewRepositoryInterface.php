<?php

namespace App\Repositories\Contracts;
use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;

interface ReviewRepositoryInterface {

    public function findAll(): Collection;
    public function findById(int $id) : ?Review;
    public function save(Review $review) : Review;
    public function destroy(int $id): void;


}