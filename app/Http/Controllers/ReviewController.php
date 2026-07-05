<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use App\Services\ReviewService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReviewController {
    public function __construct(private ReviewService $service)
    {
       
    }

    public function index() : JsonResponse {
        $reviews = $this->service->findAllReviews();
        return response()->json($reviews);

    }

    public function indexMyReviews(Request $request) : JsonResponse {  
        $reviews = $this->service->myReviews($request->user()->id);
        return response()->json($reviews);
    }

    public function showById(int $id) : JsonResponse {
        $review = $this->service->findReviewById($id);
        return response()->json($review);
    }

    public function store(StoreReviewRequest $request) : JsonResponse {
        $review = new Review([
             ...$request->validated(),
             'user_id' => auth('api')->id(),
        ]);
        $newReview = $this->service->saveReview($review);
        return response()->json($newReview);
    }

    public function update(int $id, UpdateReviewRequest $request) : JsonResponse {
        $review = new Review([
             ...$request->validated(),
             'user_id' => auth('api')->id(),
        ]);
        $updateReview = $this->service->updateReview($id, $review);
        return response()->json($updateReview);
    }

    public function destroy(int $id) : JsonResponse {
        $this->service->deleteReview($id);
        return response()->json("Review removida com sucesso!", 204);
    }

    

}