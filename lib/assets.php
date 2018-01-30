<?php

namespace Roots\BB\Assets;


//GET HOSTNAME INFO
$hostname = $_SERVER['SERVER_NAME']; 

//VERIFY WHICH ENVIRONMENT THE APP IS RUNNING
switch ($hostname) {
    case 'wp.local':
        define('WP_ENV', 'development');
        define('WP_DEBUG', true);
        break;
    // case 'staging.mywebsite.com':
    //     define('WP_ENV', 'staging');
    //     define('WP_DEBUG', true);
    //     break;
    // case 'www.mywebsite.com':
    //     define('WP_ENV', 'production');
    //     define('WP_DEBUG', false);
    //     break;
    default:
        define('WP_ENV', 'production');
        define('WP_DEBUG', false);
}

function bb_asset_path($filename) {

    $dist_path = WP_ENV == 'development' ? get_template_directory_uri() . '/app/' : get_template_directory_uri() . '/dist/';
    $directory = dirname($filename) . '/';
    $file = basename($filename);

    return $dist_path . $directory . $file;  
}
