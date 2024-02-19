<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required',
            'content' => 'sometimes|required',
            'image' => 'nullable|array|image|mimes:jpeg,png,jpg|max:2048',
            'type' => 'sometimes|required|in:Project,Blog,Event',
            'statistics' => 'nullable|array', // Add specific validation rules for Project statistics
            'event_date' => 'nullable|date', // Add specific validation rules for Event date
            'event_time' => 'nullable|date_format:H:i', // Add specific validation rules for Event time
        ];
    }
}
