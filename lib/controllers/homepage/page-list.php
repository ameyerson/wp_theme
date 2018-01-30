<?php

namespace Controllers\Home\PageList;

function page_list_section($id=false) { 

	$page_list = [];

	if ( ! $id) {
		global $post;
		$id = $post->ID;
	}

	$page_list = get_field('link_group');
	// $home_content['content'] = get_field('home_content');

	return $page_list;

}