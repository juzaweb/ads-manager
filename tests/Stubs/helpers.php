<?php

if (!function_exists('title_from_key')) {
    function title_from_key($key)
    {
        return ucwords(str_replace(['-', '_'], ' ', $key));
    }
}

if (!function_exists('upload_url')) {
    function upload_url($path)
    {
        return 'http://localhost/storage/' . $path;
    }
}
