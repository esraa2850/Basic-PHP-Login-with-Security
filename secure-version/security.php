<?php
// security.php

// Only define these if they haven't been defined already
if (!defined('PROJECT_ROOT')) {
    define('PROJECT_ROOT', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
    
    // Disable dangerous PHP features
    ini_set('allow_url_fopen', '0');
    ini_set('allow_url_include', '0');
}

if (!function_exists('safe_require')) {
    function safe_require($relative_path) {
        $allowed_dirs = [
            PROJECT_ROOT,
            PROJECT_ROOT . 'includes/',
            PROJECT_ROOT . 'libs/'
        ];
        
        $absolute_path = realpath(PROJECT_ROOT . $relative_path);
        
        if ($absolute_path === false) {
            throw new Exception("Invalid file path: " . $relative_path);
        }
        
        foreach ($allowed_dirs as $dir) {
            if (strpos($absolute_path, realpath($dir)) === 0) {
                if (file_exists($absolute_path)) {
                    return require $absolute_path;
                }
            }
        }
        
        throw new Exception("Security violation: Attempt to access restricted file");
    }
}

if (!function_exists('safe_include')) {
    function safe_include($relative_path) {
        // Same implementation as safe_require but with include
        return safe_require($relative_path);
    }
}
?>