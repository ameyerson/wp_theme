<?php

use Roots\BB\Assets;

/**
* Theme setup
*/
function theme_setup() {

// Enable plugins to manage the document title
// http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support( 'title-tag' );

// Register wp_nav_menu() menus
// http://codex.wordpress.org/Function_Reference/register_nav_menus
  add_theme_support( 'menus' );
  register_nav_menu( 'primary', 'Primary Navigiation' );
  register_nav_menu( 'secondary', 'Secondary Navbar' );
  register_nav_menu( 'footer-1', 'Footer' );

// Enable post thumbnails
// http://codex.wordpress.org/Post_Thumbnails
// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
// http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support( 'post-thumbnails' );

// custom logo support
// https://codex.wordpress.org/Theme_Logo
  add_theme_support( 'custom-logo' );

// Enable post formats
// http://codex.wordpress.org/Post_Formats
  add_theme_support( 'post-formats', [ 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ] );

// Enable HTML5 markup support
// http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support( 'html5', [ 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ] );

// Use main stylesheet for visual editor
// To add custom styles edit /assets/styles/layouts/_tinymce.scss
// add_editor_style( Assets\asset_path( 'styles/main.css' ) );
}

add_action( 'after_setup_theme', 'theme_setup');

    
/**
* Theme assets
*/
function bb_scripts_styles() {

    wp_deregister_script('jquery');   
    wp_register_script('jquery', 'http://code.jquery.com/jquery-3.3.1.slim.min.js', false, '3.3.1'); 
    wp_enqueue_script('jquery');

    //modernizer
    wp_enqueue_script( 'modernizer', Assets\bb_asset_path( 'scripts/vendor/modernizr.js' ), [ 'jquery' ], null, true );

    // enqueue fonts from google
    wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700', false, null);

    //theme styles
    wp_enqueue_style( 'theme_css', Assets\bb_asset_path( 'styles/main.css' ), false, null );

    //theme js
    wp_enqueue_script( 'theme_js', Assets\bb_asset_path( 'scripts/lib.js' ), [ 'jquery' ], null, true );

}

if (!is_admin()) add_action("wp_enqueue_scripts", "bb_scripts_styles", 11);

//remove Contact Form 7 wrappers
add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

    return $content;
});

// ******************* Login Screen ****************** //
// Change login logo
add_action( 'login_enqueue_scripts', 'ameye_login_styles' );
function ameye_login_styles() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_theme_mod('theme_customizer_logo') ?>);
            background-size: 200px;
            height: 200px;
            width: 200px;
        }
    </style>
<?php }
// Change login logo url
function ameye_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'ameye_logo_url' );

// Change login logo title
function ameye_logo_url_title() {
    return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'ameye_logo_url_title' );

function ameye_widgets_init() {
  register_sidebar( array(
    'name'          => 'Blog Sidebar',
    'id'            => 'sidebar-widgets',
    'description'   => 'Add widgets here to appear in your sidebar.',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ) );
}


/**
* Add the SVG Mime type to the uploader
* @author Alain Schlesser (alain.schlesser@gmail.com)
* @link https://gist.github.com/schlessera/1eed8503110fb3076e73
*
* @param  array $mimes list of mime types that are allowed by the
* WordPress uploader
*
* @return array modified version of the $mimes array
*
* @see https://codex.wordpress.org/Plugin_API/Filter_Reference/upload_mimes
* @see http://www.w3.org/TR/SVG/mimereg.html
*/
// function add_svg_mime_type( $mimes ) {
//   // add official SVG mime type definition to the array of allowed mime types
//   $mimes['svg'] = 'image/svg+xml';

//   // return the modified array
//   return $mimes;
// }

// add_filter( 'upload_mimes', __NAMESPACE__ . '\\add_svg_mime_type' );


/**
* Admin Styles
*
* Add styles to the admin area. Helps with visual clutter on ACF fields,
* viewing SVG in media loader, etc.
*/
// function admin_styles() {
//   ob_start();
//   include( locate_template( 'templates/modules/admin-styles.php' ) );
//   $output = ob_get_clean();
//   echo $output;
// }

// add_action( 'admin_head', __NAMESPACE__ . '\\admin_styles' );
// add_action( 'customize_controls_print_styles', __NAMESPACE__ . '\\admin_styles' );

// /**
//  * ACF Admin Access Control
//  *
//  * Hide / Show the ACF menu.
//  *
//  * Hides the ACF menu via a radio button tucked away in customizer.
//  * Out of sight, out of mind.
//  *
//  * @return bool
//  */
// function acf_admin_control() {
//   get_theme_mod( 'acf_visibility' ) === 'show' ? $return = true : $return = false;

//   return $return;
// }

// add_filter( 'acf/settings/show_admin', __NAMESPACE__ . '\\acf_admin_control' );

/**
* Add google tag manager to head
*/
// function tag_manager_head() {
//   if ( get_theme_mod( 'gtm_id' ) && get_theme_mod( 'tracking_type' ) === 'gtm' ) {
//     get_template_part( 'templates/modules/tag-manager', 'head' );
//   }
// }

// add_action( 'wp_head', __NAMESPACE__ . '\\tag_manager_head' );
/**
* Add google tag manager to body
*/
// function tag_manager_body() {
//   if ( get_theme_mod( 'gtm_id' ) && get_theme_mod( 'tracking_type' ) === 'gtm' ) {
//     get_template_part( 'templates/modules/tag-manager', 'body' );
//   }
// }

// add_action( 'get_header', __NAMESPACE__ . '\\tag_manager_body' );
/**
* Add google Analytics to body
*/
// function google_analytics_head() {
//   if ( get_theme_mod( 'ga_id' ) && get_theme_mod( 'tracking_type' ) === 'ga' ) {
//     get_template_part( 'templates/modules/google-analytics' );
//   }
// }

// add_action( 'wp_head', __NAMESPACE__ . '\\google_analytics_head' );

/**
* Google Maps API Key
*
* Set up Google API key to use with ACF maps
*/
// function acf_google_api_key() {

//   $api_key = "";

//   if ( get_theme_mod( 'google_api_key' ) ) {
//     $api_key = get_theme_mod( 'google_api_key' );
//   }

//   acf_update_setting( 'google_api_key', $api_key );

// }

// add_action( 'acf/init', __NAMESPACE__ . '\\acf_google_api_key' );
