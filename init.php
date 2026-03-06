<?php
// init.php - shared security bootstrap
$usingHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');

// Secure session cookies before session_start
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => $usingHttps,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

// Security headers (tightened to avoid phishing/malware injection)
header("Content-Security-Policy: default-src 'self'; script-src 'self' https://cdn.tailwindcss.com; style-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https://i.pravatar.cc https://picsum.photos https://ui-avatars.com; connect-src 'self'; frame-ancestors 'self'; form-action 'self'; base-uri 'self';");
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
if ($usingHttps) {
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
}

// HTML escape helper
if (!function_exists('e')) {
    function e($value)
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
