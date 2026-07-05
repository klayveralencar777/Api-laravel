<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            "title" => ['required', 'string' , 'max:255'],
            "category" => ['required', 'string' , 'max:255'],       
            "content" => ['required', 'string' , 'max:255'],
            
            
        ];
    }
}