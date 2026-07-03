<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReviewRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            "title" => ['sometimes', 'string' , 'max:255'],
            "category" => ['sometimes' , 'string', 'max:255'],
            "content" => ['sometimes', 'string', 'max:255']
        ];
    }
}