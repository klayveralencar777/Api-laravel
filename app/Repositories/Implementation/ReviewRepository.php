<?php
namespace App\Repositories\Implementation;
use App\Models\Review;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ReviewRepository implements ReviewRepositoryInterface {
   
    public function findAll(): Collection
    {
        return Review::all();
    }

    
    public function findById(int $id): ?Review
    {
        return Review::find($id);
    }

    public function save(Review $review) : Review {
        $review->save();
        return $review;
    }

    public function destroy(int $id) : void {
        Review::destroy($id);
    }

}
