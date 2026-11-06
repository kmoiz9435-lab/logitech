<?php

use App\Models\WebsiteSection;
use App\Models\WebsiteSetting;
use Illuminate\Support\Str;

if (! function_exists('setting')) {
    function setting(string $key, mixed $default = null): mixed
    {
        $value = WebsiteSetting::get($key);

        if ($value !== null) {
            return $value;
        }

        return config('website.defaults.'.$key, $default);
    }
}

if (! function_exists('section_value')) {
    function section_value(string $key, string $field, mixed $default = null): mixed
    {
        $fallback = $default ?? config("website.sections.{$key}.{$field}");

        return WebsiteSection::getValue($key, $field, $fallback);
    }
}

if (! function_exists('media_url')) {
    function media_url(?string $path, string $fallback = 'assets/images/placeholder.svg'): string
    {
        if (blank($path)) {
            return asset($fallback);
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if (Str::startsWith($path, '/')) {
            return asset(ltrim($path, '/'));
        }

        return asset('uploads/'.ltrim($path, '/'));
    }
}

if (! function_exists('whatsapp_link')) {
    function whatsapp_link(?string $number = null, string $message = ''): string
    {
        $number = preg_replace('/\D+/', '', $number ?: (string) setting('whatsapp_number'));
        $url = 'https://wa.me/'.$number;

        if ($message !== '') {
            $url .= '?text='.rawurlencode($message);
        }

        return $url;
    }
}

if (! function_exists('tel_link')) {
    function tel_link(?string $phone): string
    {
        return 'tel:'.preg_replace('/[^0-9+]/', '', (string) $phone);
    }
}

if (! function_exists('mail_link')) {
    function mail_link(?string $email): string
    {
        return 'mailto:'.($email ?: '');
    }
}
