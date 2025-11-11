<?php
/**
 * Language Configuration for TravelAngola
 * Multi-language support system
 */

// Configure custom session path with fallback
$sessionPath = '/tmp/ta_session';
$sessionConfigured = false;

// Try to create and use custom session directory
if (!is_dir($sessionPath)) {
    @mkdir($sessionPath, 0755, true);
}
if (is_dir($sessionPath) && is_writable($sessionPath)) {
    ini_set('session.save_path', $sessionPath);
    $sessionConfigured = true;
}

// Fallback: try system temp directory
if (!$sessionConfigured) {
    $systemTemp = sys_get_temp_dir() . '/ta_session';
    if (!is_dir($systemTemp)) {
        @mkdir($systemTemp, 0755, true);
    }
    if (is_dir($systemTemp) && is_writable($systemTemp)) {
        ini_set('session.save_path', $systemTemp);
        $sessionConfigured = true;
    }
}

// Start session for language persistence
if (session_status() == PHP_SESSION_NONE) {
    try {
        session_start();
    } catch (Exception $e) {
        // If session fails, we'll use cookies as fallback
        error_log("Session start failed: " . $e->getMessage());
    }
}

// Get language from URL parameter, session, or cookie, default to English
$lang = $_GET['lang'] ?? ($_SESSION['lang'] ?? ($_COOKIE['ta_lang'] ?? 'en'));

// Available languages with their display names and flags
$valid_langs = ['pt', 'en', 'fr', 'es'];
$langs = [
    'pt' => 'Português', 
    'en' => 'English', 
    'fr' => 'Français', 
    'es' => 'Español'
];

// Flag icons using flag-icons CSS library format
$lang_flags = [
    'pt' => 'pt', // Portugal flag for Portuguese
    'en' => 'gb', // Great Britain flag for English  
    'fr' => 'fr', // France flag for French
    'es' => 'es'  // Spain flag for Spanish
];

// Flag emoji fallbacks
$lang_flag_emojis = [
    'pt' => '🇵🇹', 
    'en' => '🇬🇧', 
    'fr' => '🇫🇷', 
    'es' => '🇪🇸'
];

// Flag images (if you want to use actual images instead of icons)
$lang_flag_images = [
    'pt' => 'assets/flags/pt.png', 
    'en' => 'assets/flags/en.png', 
    'fr' => 'assets/flags/fr.png', 
    'es' => 'assets/flags/es.png'
];

// Validate language code to prevent directory traversal and security issues
if (!in_array($lang, $valid_langs)) {
    $lang = 'en'; // Default to English
}

// Store in session and cookie (fallback)
if (session_status() === PHP_SESSION_ACTIVE) {
    $_SESSION['lang'] = $lang;
}
// Always set cookie as backup
setcookie('ta_lang', $lang, time() + (30 * 24 * 60 * 60), '/'); // 30 days

// Path to language file
$lang_file = __DIR__ . "/../lang/$lang.php";

// Safely include language file with error handling
if (file_exists($lang_file)) {
    $translations = include $lang_file;
    // Ensure we got an array
    if (!is_array($translations)) {
        $translations = [];
    }
} else {
    // Fallback to English if language file doesn't exist
    $lang = 'en';
    $_SESSION['lang'] = $lang;
    $lang_file = __DIR__ . "/../lang/en.php";
    $translations = file_exists($lang_file) ? include $lang_file : [];
    if (!is_array($translations)) {
        $translations = [];
    }
}

// Helper function to get translation
function translate($key, $default = null) {
    global $translations;
    return $translations[$key] ?? ($default ?? $key);
}

// Short helper function (existing format)
function __($key, $default = null) {
    return translate($key, $default);
}

// Alternative helper function (matches your church system)
function t($key, $default = null) {
    return translate($key, $default);
}

// Get current language code
function getCurrentLanguage() {
    global $lang;
    return $lang;
}

// Get current language info (detailed)
function getCurrentLanguageInfo() {
    global $lang, $langs, $lang_flags, $lang_flag_emojis;
    return [
        'code' => $lang,
        'name' => $langs[$lang] ?? 'Unknown',
        'flag' => $lang_flags[$lang] ?? 'xx',
        'flag_emoji' => $lang_flag_emojis[$lang] ?? '🏳️'
    ];
}

// Get all available languages
function getAvailableLanguages() {
    global $langs, $lang_flags, $lang_flag_emojis;
    $languages = [];
    foreach ($langs as $code => $name) {
        $languages[$code] = [
            'name' => $name,
            'flag' => $lang_flags[$code] ?? 'xx',
            'flag_emoji' => $lang_flag_emojis[$code] ?? '🏳️'
        ];
    }
    return $languages;
}

// Generate language switcher URL
function getLanguageUrl($language_code, $current_url = null) {
    if (!$current_url) {
        $current_url = $_SERVER['REQUEST_URI'];
    }
    
    // Parse URL and add/update lang parameter
    $url_parts = parse_url($current_url);
    $query = [];
    
    if (isset($url_parts['query'])) {
        parse_str($url_parts['query'], $query);
    }
    
    $query['lang'] = $language_code;
    
    $new_url = $url_parts['path'] ?? '/';
    if (!empty($query)) {
        $new_url .= '?' . http_build_query($query);
    }
    
    return $new_url;
}

// Set page language attribute for HTML
function getPageLanguage() {
    global $lang;
    return $lang;
}

// Get text direction (useful for RTL languages if you add Arabic later)
function getTextDirection() {
    global $lang;
    $rtl_languages = ['ar', 'he', 'fa']; // Arabic, Hebrew, Persian
    return in_array($lang, $rtl_languages) ? 'rtl' : 'ltr';
}
?>