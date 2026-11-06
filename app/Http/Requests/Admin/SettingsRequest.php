<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'remove_logo' => $this->boolean('remove_logo'),
            'remove_favicon' => $this->boolean('remove_favicon'),
        ]);
    }

    public function rules(): array
    {
        $labelKeys = [
            'nav_home_label', 'nav_about_label', 'nav_industries_label', 'nav_products_label',
            'nav_why_label', 'nav_contact_label', 'nav_gallery_label', 'nav_cta_label',
            'hero_primary_btn', 'hero_secondary_btn', 'about_learn_more', 'about_stat_value', 'about_stat_label',
            'products_all_label', 'products_view_all_label', 'products_view_details_label', 'products_featured_label',
            'products_empty_label', 'products_page_empty_label', 'products_search_placeholder', 'products_search_btn',
            'products_no_categories', 'industries_empty_label', 'why_empty_label', 'gallery_empty_label', 'cta_btn_label',
            'contact_form_heading', 'contact_name_label', 'contact_company_label', 'contact_email_label',
            'contact_phone_label', 'contact_product_label', 'contact_message_label', 'contact_submit_label',
            'contact_info_heading', 'contact_address_label', 'contact_phone_info_label', 'contact_email_info_label',
            'contact_whatsapp_info_label', 'contact_map_title',
            'footer_about_heading', 'footer_quick_links_heading', 'footer_products_heading',
            'footer_contact_heading', 'footer_social_heading',
            'product_overview_heading', 'product_specs_heading', 'product_features_heading', 'product_applications_heading',
            'product_no_images_label', 'product_custom_heading', 'product_custom_text', 'product_quote_btn',
            'product_whatsapp_btn', 'product_related_heading', 'product_related_empty', 'product_breadcrumb_label',
        ];

        $rules = [
            'company_name' => ['required', 'string', 'max:150'],
            'company_tagline' => ['nullable', 'string', 'max:255'],
            'company_short_description' => ['nullable', 'string', 'max:1000'],
            'phone' => ['required', 'string', 'max:60'],
            'phone_secondary' => ['nullable', 'string', 'max:60'],
            'email' => ['required', 'email:rfc', 'max:190'],
            'email_secondary' => ['nullable', 'email:rfc', 'max:190'],
            'whatsapp_number' => ['nullable', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:500'],
            'business_hours' => ['nullable', 'string', 'max:255'],
            'map_embed_url' => ['nullable', 'string', 'max:2000'],
            'social_facebook' => ['nullable', 'url', 'max:255'],
            'social_linkedin' => ['nullable', 'url', 'max:255'],
            'social_youtube' => ['nullable', 'url', 'max:255'],
            'social_instagram' => ['nullable', 'url', 'max:255'],
            'social_x' => ['nullable', 'url', 'max:255'],
            'footer_about' => ['nullable', 'string', 'max:1000'],
            'footer_copyright' => ['nullable', 'string', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'seo_keywords' => ['nullable', 'string', 'max:500'],
            'about_points' => ['nullable', 'string', 'max:2000'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'favicon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_logo' => ['boolean'],
            'remove_favicon' => ['boolean'],
        ];

        foreach ($labelKeys as $key) {
            $rules[$key] = ['nullable', 'string', 'max:255'];
        }

        $rules['product_custom_text'] = ['nullable', 'string', 'max:1000'];
        $rules['contact_message_label'] = ['nullable', 'string', 'max:255'];

        return $rules;
    }
}
