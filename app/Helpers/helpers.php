<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    function setting(string $key, mixed $default = null): mixed
    {
        return once(fn() => Setting::getValue($key, $default));
    }
}

if (!function_exists('formatPrice')) {
    function formatPrice(float $amount, int $decimals = 2): string
    {
        $formatted = number_format($amount, $decimals);
        $currency = setting('currency');

        if (!$currency) return $formatted;

        return match ($currency) {
            'BDT' => '৳' . $formatted,
            default => '$' . $formatted,
        };
    }
}
