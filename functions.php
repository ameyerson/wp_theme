
<?php


// * Please note that missing files will produce a fatal error. * //
$theme_includes = [
    'lib/assets.php', //creates asset paths
    'lib/setup.php', //wordpress setup
    'lib/customizer.php', //theme customizer
    'lib/wp_bootstrap_navwalker.php', //nav walker
    'lib/template-tags.php', //
    // 'lib/options-social.php', //
    // 'lib/options-business-info.php', //address, phone, fax, email
    'lib/wysiwyg.php', //custom wysiwyg formats
    'lib/acf_embed.php', //advanced custom fields
    'lib/search-controller.php', //advanced custom fields
    'lib/remove-emojii.php', // ', //advanced custom fields
    'lib/controllers.php', //advanced custom fields
];

foreach ($theme_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'ameyerson'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


// ******************* Add Custom Menus ****************** //

add_theme_support( 'menus' );
register_nav_menu( 'primary', 'Primary Navigiation' );


// ******************* Add Post Thumbnails ****************** //

add_theme_support( 'post-thumbnails' );

if ( function_exists( 'add_image_size' ) ) {

  // add_image_size( 'grid-box-bkg', 380, 240, true);

}

add_theme_support( 'html5', array(
  'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
) );


// add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) );

register_post_type('custom-posts', array(
   'label' => __('Custom Posts'),
   'labels' => array ('name' => 'Custom Posts', 
                      'singular_name' => 'Custom Post',
                      'add_new_item' => 'Add New Custom Post',
                      'edit_item' => 'Edit Custom Post',
                      'new_item' => 'New Custom Post',
                      'view_item' => 'View Custom Post'),
   'public' => true,
   'menu_position' => 5,
   'rewrite' => array('slug' => 'custom-post'),
   'has_archive' => true,
   'menu_icon' => 'dashicons-carrot',
   'supports' => array('title', 'editor', 'author', 'thumbnail', 'revisions', 'comments', 'page-attributes', 'excerpt' )

));