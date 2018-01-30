<?php

namespace Controllers\Home\Hero;

function home_hero($id=false) {

	$hero_data = [];

	if ( ! $id) {
		global $post;
		$id = $post->ID;
	}

	if (get_field('hero_image')) {
		$image_id = get_field('hero_image');
		$image_array = wp_get_attachment_image_src($image_id, 'hero');
		$hero_data['image_url'] = $image_array[0];
	} else if ( has_post_thumbnail() ) {
	    $image_id = get_post_thumbnail_id();
	    $image_array = wp_get_attachment_image_src($image_id, 'hero');
	    $hero_data['image_url'] = $image_array[0];
	} else {
	   $hero_data['image_url'] = get_stylesheet_directory_uri() . '/assets/img/header-default.jpg';
	}

	$hero_data['alt_text'] = get_bloginfo();
	$hero_data['video'] = get_field('hero_video'); 

	if (get_field('hero_overlay')) {
		$overlay = get_field('hero_overlay');
		$color = $overlay['hero_overlay_color'];
		$opacity = $overlay['hero_overlay_opacity'];
		$hero_data['css'] = hex2rgb($color, $opacity);

	}

	if ( get_field('hero_type') == 'video' && $video ) {

	    $filetype = $video["mime_type"]; 
	    $video_datastring == '';


	    if ($filetype == 'video/mp4') {
	        $video_datastring .= " data-mp4 = ". $video["url"];
	    } else if ($filetype == 'video/webm') {
	        $video_datastring .= " data-webm = ". $video["url"];
	    } else if ($filetype == 'video/ogg') {
	        $video_datastring .= " data-ogg = ". $video["url"];
	    }

	    $video_datastring   .= " data-poster = " . $image_url;

	    $hero_data['video_datastring'] = $video_datastring;
	}

	return $hero_data;

}

function hex2rgb( $colour, $opacity ) {
        if ( $colour[0] == '#' ) {
                $colour = substr( $colour, 1 );
        }
        if ( strlen( $colour ) == 6 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        return 'rgba('.$r.','.$g.','.$b.','.$opacity.')';
}