<?php
// includes/function.php

// Start session once
if (session_status() === PHP_SESSION_NONE) session_start();

// Toggle pretty URLs (true needs .htaccess; false uses ?page=)
const USE_PRETTY_URLS = true;

// Base URL of /includes relative to web root
function base_url(): string {
    return rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
}

// Build route links that work with or without pretty URLs
function url(string $route, array $query = []): string {
    $path = USE_PRETTY_URLS ? $route : 'index.php?page=' . $route;
    if ($query) $path .= (USE_PRETTY_URLS ? '?' : '&') . http_build_query($query);
    return base_url() . $path;
}

// Escape helper
function e(string $v): string {
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
}
?>