<?php
/**
 * Mental Wellness Support - Configuration File
 */

define('APP_NAME', 'Mental Wellness Support');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'http://localhost/mental-wellness-support');

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'mental_wellness_support');
define('DB_CHARSET', 'utf8mb4');

// Security Keys
define('CSRF_TOKEN_LENGTH', 32);
define('SESSION_TIMEOUT', 3600); // 1 hour in seconds

// Upload Paths
define('UPLOADS_DIR', __DIR__ . '/../uploads/');
define('MAX_UPLOAD_SIZE', 5242880); // 5MB

// Color Palette
define('COLOR_PRIMARY', '#003249');
define('COLOR_SECONDARY', '#007ea7');
define('COLOR_ACCENT1', '#80ced7');
define('COLOR_ACCENT2', '#9ad1d4');
define('COLOR_NEUTRAL', '#ccdbdc');

// Email Configuration
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'your-email@gmail.com');
define('SMTP_PASS', 'your-app-password');
define('SUPPORT_EMAIL', 'support@mentalwellnesssupport.com');

// Enable/Disable Features
define('ENABLE_CHATBOT', true);
define('ENABLE_BOOKINGS', true);
define('ENABLE_REGISTRATION', true);

// Error Reporting (set to 0 in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../logs/error.log');

// Session Configuration
ini_set('session.cookie_secure', false); // Set to true in production with HTTPS
ini_set('session.cookie_httponly', true);
ini_set('session.cookie_samesite', 'Strict');

// Timezone
date_default_timezone_set('UTC');
