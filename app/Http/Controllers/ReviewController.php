<?php

namespace App\Http\Controllers;

use App\Services\ReviewService;
use Illuminate\Http\JsonResponse;

class ReviewController {
    public function __construct(private ReviewService $service)
    {
       
    }

    public function index() : JsonResponse {
        $reviews = $this->service->findAllReviews();
        return response()->json($reviews);

    }

    public function showById(int $id) : JsonResponse {
        $review = $this->service->findReviewById($id);
        return response()->json($review);
    }
    

}