<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class InquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim((string) $this->input('name')),
            'company_name' => filled($this->input('company_name')) ? trim((string) $this->input('company_name')) : null,
            'email' => Str::lower(trim((string) $this->input('email'))),
            'phone' => trim((string) $this->input('phone')),
            'message' => filled($this->input('message')) ? trim((string) $this->input('message')) : null,
            'product_id' => $this->input('product_id') ?: null,
            'source' => in_array($this->input('source'), ['contact', 'quote'], true) ? $this->input('source') : 'contact',
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'company_name' => ['nullable', 'string', 'max:150'],
            'email' => ['required', 'email:rfc', 'max:190'],
            'phone' => ['required', 'string', 'max:40'],
            'product_id' => ['nullable', 'integer', Rule::exists('products', 'id')->where('is_active', true)],
            'message' => ['nullable', 'string', 'max:5000'],
            'source' => ['nullable', 'string', 'in:contact,quote'],
            'website' => ['nullable', 'max:0'],
            'form_time' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'website.max' => 'Your submission could not be processed.',
            'form_time.required' => 'Your submission could not be processed. Please refresh the page and try again.',
        ];
    }

    public function attributes(): array
    {
        return [
            'product_id' => 'interested product',
            'company_name' => 'company name',
        ];
    }
}
