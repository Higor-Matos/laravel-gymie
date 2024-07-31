if (!function_exists('asset_secure')) {
    function asset_secure($path)
    {
        $protocol = env('APP_PROTOCOL', 'http');
        return $protocol . '://' . $_SERVER['HTTP_HOST'] . '/' . ltrim($path, '/');
    }
}
