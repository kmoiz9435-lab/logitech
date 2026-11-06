<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $slug = trim((string) $this->input('slug'));
        $name = trim((string) $this->input('name'));

        $this->merge([
            'slug' => $slug !== '' ? Str::slug($slug) : Str::slug($name),
            'is_active' => $this->boolean('is_active'),
            'is_featured' => $this->boolean('is_featured'),
            'sort_order' => $this->input('sort_order') === '' ? 0 : (int) $this->input('sort_order'),
            'product_category_id' => $this->input('product_category_id') ?: null,
            'spec_labels' => array_values(array_filter((array) $this->input('spec_labels', []), fn ($v) => filled($v))),
            'spec_values' => array_values(array_filter((array) $this->input('spec_values', []), fn ($v) => filled($v))),
            'features' => array_values(array_filter(array_map('trim', (array) $this->input('features', [])), fn ($v) => $v !== '')),
            'applications' => array_values(array_filter(array_map('trim', (array) $this->input('applications', [])), fn ($v) => $v !== '')),
        ]);
    }

    public function rules(): array
    {
        $product = $this->route('product');

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('products', 'slug')->ignore($product?->id)],
            'product_category_id' => ['required', 'integer', 'exists:product_categories,id'],
            'short_description' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string', 'max:20000'],
            'main_image' => [$product ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:6144'],
            'additional_images' => ['nullable', 'array', 'max:10'],
            'additional_images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:6144'],
            'spec_labels' => ['nullable', 'array', 'max:40'],
            'spec_labels.*' => ['nullable', 'string', 'max:120'],
            'spec_values' => ['nullable', 'array', 'max:40'],
            'spec_values.*' => ['nullable', 'string', 'max:255'],
            'features' => ['nullable', 'array', 'max:40'],
            'features.*' => ['string', 'max:500'],
            'applications' => ['nullable', 'array', 'max:40'],
            'applications.*' => ['string', 'max:500'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
            'seo_meta_title' => ['nullable', 'string', 'max:255'],
            'seo_meta_description' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:99999'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $labels = (array) $this->input('spec_labels', []);
            $values = (array) $this->input('spec_values', []);

            if (count($labels) !== count($values)) {
                $validator->errors()->add('specifications', 'Each specification needs both a label and a value.');
            }
        });
    }

    public function attributes(): array
    {
        return [
            'product_category_id' => 'category',
            'short_description' => 'short description',
            'main_image' => 'main product image',
            'additional_images.*' => 'additional image',
            'seo_meta_title' => 'SEO meta title',
            'seo_meta_description' => 'SEO meta description',
        ];
    }
}
