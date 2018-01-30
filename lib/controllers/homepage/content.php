<?php

namespace Controllers\Home\Content;

function home_content($id=false) {

	$home_content = [];

	if ( ! $id) {
		global $post;
		$id = $post->ID;
	}

	$home_content['title'] = get_field('home_content_title');
	$home_content['content'] = get_field('home_content');

	return $home_content;

}