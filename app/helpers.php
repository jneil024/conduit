<?php

use App\Models\Setting;

if (! function_exists('setting')) {
    /**
     * Global helper to retrieve a system setting.
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }
}
