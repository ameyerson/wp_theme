<?php
// Callback function to insert 'styleselect' into the $buttons array
function ameye_mce_buttons_2( $buttons ) {
  array_unshift( $buttons, 'styleselect' );
  return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'ameye_mce_buttons_2');

// Callback function to filter the MCE settings
function ameye_before_init_insert_formats( $init_array ) {  
  // Define the style_formats array
  $style_formats = array(  
    // Each array child is a format with it's own settings
    array(  
      'title' => 'Bootstrap Basic Table',  
      'selector' => 'table',  
      'classes' => 'table'
    ),
    array(  
      'title' => 'Bootstrap Striped Table',  
      'selector' => 'table',  
      'classes' => 'table-striped'
    ),
    array(  
      'title' => 'Bootstrap Bordered Table',  
      'selector' => 'table',  
      'classes' => 'table-bordered'
    ),
    array(  
      'title' => 'Bootstrap Hover Table',  
      'selector' => 'table',  
      'classes' => 'table-hover'
    ),
    array(  
      'title' => 'Bootstrap Condensed Table',  
      'selector' => 'table',  
      'classes' => 'table-condensed'
    ),

    array(  
      'title' => 'Blockquote Reverse',  
      'selector' => 'blockquote',  
      'classes' => 'blockquote-reverse'
    ),

    array(  
      'title' => 'Unstyled List',  
      'selector' => 'ul',  
      'classes' => 'list-unstyled'
    ),
    array(  
      'title' => 'Inline List',  
      'selector' => 'ul',  
      'classes' => 'list-inline'
    ),
    array(  
      'title' => 'Link Icon List Item',  
      'selector' => 'li',  
      'classes' => 'list-item-link'
    ),
    array(  
      'title' => 'Button Link',  
      'selector' => 'a',  
      'classes' => 'btn btn-default'
    ),

  );  

  // Insert the array, JSON ENCODED, into 'style_formats'
  $init_array['style_formats'] = json_encode( $style_formats );  
 
  return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'ameye_before_init_insert_formats' ); 

function ameye_excerpt( $length ) {
    if (is_search() ) {
        return 15;
    } else {
        return 50;
    }
}