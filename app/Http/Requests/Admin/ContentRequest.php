<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sections' => ['required', 'array'],
            'sections.*.eyebrow' => ['nullable', 'string', 'max:120'],
            'sections.*.heading' => ['required', 'string', 'max:255'],
            'sections.*.sub_heading' => ['nullable', 'string', 'max:500'],
            'sections.*.content' => ['nullable', 'string', 'max:10000'],
            'sections.*.image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
        ];
    }

    public function attributes(): array
    {
        return [
            'sections.*.heading' => 'section heading',
            'sections.*.content' => 'section content',
            'sections.*.image' => 'section image',
        ];
    }
}
