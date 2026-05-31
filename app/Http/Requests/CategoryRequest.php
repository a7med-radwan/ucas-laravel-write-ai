<?php

namespace App\Http\Requests;

use App\Rules\Restricted;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class CategoryRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', new Restricted(['god', 'admin'])],
        ];
    }

#[Override]
    public function attributes(): array
    {
        return [
            'name' => 'Category name',
            'description' => 'Category description',
        ];
    }
}