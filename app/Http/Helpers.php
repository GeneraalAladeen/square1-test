<?php

use Illuminate\Support\Str;

if (!function_exists('makeSlug')) {
    /**
     * @param string $text
     *
     * @return string
     */
    function makeSlug(string $text): string
    {
        $slug = $text .' '. uniqid();
        return Str::slug($slug);
    }
}