<?php

namespace App\Http\Requests;

use App\Rules\Restricted;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class PostRequest extends FormRequest
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
            'title' => ['required', 'min:3', 'max:255'],
            'content' => [
                'required',
                'string',
                'max:999999',
                new Restricted(['god', 'admin'])
                // function (string $attribute, string $value, callable $fail) {
                //     if (str_contains($value, 'god')) {
                //         $fail('This is not allowed');
                //     }
                // }
            ],
            'cover' => [
                'nullable',
                'image',
                'mimetypes:image/png,image/jpeg',
                // 'dimensions:min_width=600,min_height=400,max_width=2000,max_height=2000',
                'max:1024'
            ],
            'category_id' => ['required', 'exists:categories,id'],
            'tags' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'meta' => ['nullable', 'array'],
            'meta.title' => ['nullable', 'string', 'max:255'],
            'meta.keywords' => ['nullable', 'string', 'max:255'],
            'meta.url' => ['nullable', 'url'],
            'meta.description' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [];
        // return [
        //     'required' => ':attribute is required!',
        //     'title.min' => ':attribute :min is mandatory',
        // ];
    }

    #[Override]
    public function attributes(): array
    {
        return [
            'title' => 'post title',
            'content' => 'post body',
            'cover' => 'cover image',
        ];
    }
}