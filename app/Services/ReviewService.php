<?php

namespace App\Services;

use App\Models\Review;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException as ValidationValidationException;

use function Laravel\Prompts\title;

class ReviewService {
    public function __construct(private ReviewRepositoryInterface $repository){}

    public function findAllReviews(): Collection {
        return $this->repository->findAll();
    }

    public function findReviewById(int $id) : ?Review {
        $review = $this->repository->findById($id);
        if(! $review) {
            throw ValidationValidationException::withMessages(['review_id' => ['Review not found']]);
         }
         return $review;

    }

    public function saveReview(Review $review) : Review {
        return $this->repository->save($review);

    }

    public function updateReview(int $id, Review $review) : ?Review {
        $updatedReview = $this->findReviewById($id);
        $updatedReview->title = $review->title;
        $updatedReview->category = $review->category;
        $updatedReview->content = $review->content;
        return $this->repository->save($updatedReview);
        
    }

    public function deleteReview(int $id) : void {
        $this->findReviewById($id);
        $this->repository->destroy($id);
    }


}