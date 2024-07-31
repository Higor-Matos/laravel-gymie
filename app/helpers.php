if (!function_exists('asset_protocol')) {
    function asset_protocol($path)
    {
        $url = env('APP_URL') . '/' . ltrim($path, '/');
        return app()->environment('production') ? secure_asset($path) : asset($path);
    }
}
