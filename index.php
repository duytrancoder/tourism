<?php
if (php_sapi_name() === 'cli-server') {
    // Determine the requested path
    $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    
    // Serve static files directly
    if (is_file(__DIR__ . $path)) {
        return false;
    }
    
    // Rewrite all other requests to public/index.php with the url parameter
    $_GET['url'] = ltrim($path, '/');
    $_SERVER['SCRIPT_NAME'] = '/public/index.php'; // Mock SCRIPT_NAME for BASE_URL calculation
    require __DIR__ . '/public/index.php';
    exit;
}

// Redirect to public directory for normal Apache/Nginx usage
header('Location: public/index.php');
exit;
