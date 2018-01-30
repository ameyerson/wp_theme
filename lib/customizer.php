<?php
 
add_filter( 'customize_register', 'theme_customizer_register' );

function theme_customizer_register($wp_customize) {

	//Remove certain useless functions for this theme
    $wp_customize->remove_section('static_front_page');
    $wp_customize->remove_section( 'title_tagline' );
    $wp_customize->remove_section( 'custom_css' );



	//Header
	$wp_customize->add_section( 'theme_customizer_header', array(
		'title' => __( 'Global Header', 'section' ),
		'priority' => 10
	) );
	$wp_customize->add_setting( 'theme_customizer_logo', array(
		
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control ( $wp_customize, 'theme_customizer_logo', array(
		'label' => 'Header logo',
		'section' => 'theme_customizer_header',
		'settings' => 'theme_customizer_logo'
	) ) );
	$wp_customize->add_setting( 'theme_customizer_alt_logo', array(
		
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control ( $wp_customize, 'theme_customizer_alt_logo', array(
		'label' => 'Footer Stacked logo',
		'section' => 'theme_customizer_header',
		'settings' => 'theme_customizer_alt_logo'
	) ) );


	function sanitize_integer( $input ) {
	    if( is_numeric( $input ) ) {
	        return intval( $input );
	    }
	}
	
}