<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'lifetime' => 'required|integer|between:1,365',
            'access' => 'required|in:link,password,private',
            'deleteAfter' => 'required|between:1,365',
            'typeAccess' => 'required|string|in:all,onlyView',
            'Title' => 'nullable|string|max:255',
            'Description' => 'nullable|string|max:1024',
            'CustomLink' => 'nullable|string|max:255',
            'image' => 'required|array',
            'image.*' => 'file|mimes:jpeg,png,jpg,gif,svg|max:65536',
        ];
    }
}
