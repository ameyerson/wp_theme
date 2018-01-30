<?php

namespace Controllers\Home\Title;

function hero_title($id=false) {
	
	$hero_title = [];

	if ( ! $id) {
		global $post;
		$id = $post->ID;
	}

	$hero_title['title'] = get_field('hero_title');
	$hero_title['subtitle'] = get_field('hero_subtitle');
	$hero_title['text'] = get_field('hero_text');

	return $hero_title;

}