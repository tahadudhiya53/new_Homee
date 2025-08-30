<?php
session_start();

// Include database connection
require_once __DIR__ . '/includes/db.php';

// Default page if no query param is set
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Whitelist of allowed pages (security)
$routes = [
    "home"              => "home.php",

    // User Auth
    "login"             => "user_auth/login.php",
    "register"          => "user_auth/register.php",
    "logout"            => "user_auth/logout.php",
    "forgot_pass"       => "user_auth/forgot_pass.php",
    "reset"             => "user_auth/reset.php",

    // Properties
    "properties"        => "properties_f/properties.php",
    "property_details"  => "properties_f/properties_details.php",
    "fetch_properties"  => "properties_f/fetch_properties.php",
    "list_property"     => "properties_f/list_property.php",

    // Home page sections
    "hero"              => "home_page/hero.php",
    "property"          => "home_page/property.php",
    "testimonial"       => "home_page/testimonial.php",
    "contact"           => "home_page/contact.php",
];


// Include header (common for all pages)
include __DIR__ . '/includes/header.php';

// Routing logic
if (array_key_exists($page, $routes)) {
    $filePath = __DIR__ . '/' . $routes[$page];

    // Check for protected pages
    $protectedPages = ['add_property', 'my_properties'];
    if (in_array($page, $protectedPages)) {
        require_once __DIR__ . '/includes/auth_check.php'; // will redirect if not logged in
    }

    if (file_exists($filePath)) {
        include $filePath;
    } else {
        include __DIR__ . '/includes/404.php';
    }
} else {
    include __DIR__ . '/includes/404.php';
}

// Include footer (common for all pages)
include __DIR__ . '/includes/footer.php';
