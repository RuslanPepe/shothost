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

    protected function prepareForValidation() {
        $this->merge([
            'data' => json_decode($this->input('settingsLink'), 1, 512, JSON_THROW_ON_ERROR),
        ]);
        $this->request->remove('settingsLink');
    }

    public function rules(): array
    {
        return [
            'data.lifetime' => 'required|integer|between:1,365',
            'data.access' => 'required|in:link,password,private',
            'data.deleteAfter' => 'between:1,365|nullable',
            'data.typeAccess' => 'required|string|in:all,onlyView',
            'data.Title' => 'nullable|string|max:255',
            'data.Description' => 'nullable|string|max:1024',
            'data.CustomLink' => 'nullable|string|max:255',
            'data.password' => 'nullable|string|min:4',
            'image' => 'required|array',
            'image.*' => 'file|mimes:jpeg,png,jpg,gif,svg|max:65536',
        ];
    }
}
