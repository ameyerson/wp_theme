<?php

namespace Controllers\Home\Contact;

function team_members($id=false) { 

	$team_members = [];

	if ( ! $id) {
		global $post;
		$id = $post->ID;
	}

	$team_members = get_field('home_team_members');
	// $home_content['content'] = get_field('home_content');

	return $team_members;

}