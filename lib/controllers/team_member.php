<?php

namespace Controllers\Team\Bio;

function bio_info($id=false) {

	$bio = [];

	if ( ! $id) {
		global $post;
		$id = $post->ID;
	}

	if (has_post_thumbnail($id)) {
		$bio['photo_url'] = get_the_post_thumbnail_url($id);
		$thumbnail_id     = get_post_thumbnail_id($id);
		$thumbnail_height = wp_get_attachment_metadata($thumbnail_id)['height'];
		$thumbnail_width = wp_get_attachment_metadata($thumbnail_id)['width'];

		$bio['photo_aspectratio'] = $thumbnail_height > $thumbnail_width ? 'p' : 'l';
		$bio['photo_alt'] = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);

	} else {
		$bio['photo_url'] = false;
		$bio['col_width'] = 'p';
	}

	$bio['title'] = get_field('team_title') ? get_field('team_title')  : false;
	$bio['email'] = get_field('team_contact')['team_email'] ? get_field('team_contact')['team_email'] : false;
	$bio['phone'] = get_field('team_contact')['team_phone']  ? get_field('team_contact')['team_phone']  : false;
	$bio['linkedin'] = get_field('team_contact')['team_linkedin']  ? get_field('team_contact')['team_linkedin']  : false;

	$bio['vcard'] = utf8_encode('BEGIN:VCARD
	    VERSION:4.0
	    N:;'.get_the_title().';;;
	    FN:'.get_the_title().'
	    ORG: ZLC Group CPAs LLC
	    TITLE:'.$bio['title'].'
	    EMAIL;TYPE=WORK:'.$bio['email'].'
	    TEL;TYPE=WORK:716-839-9001
	    TEL;TYPE=CELL:'.$bio['phone'].'
	    TEL;type=FAX:716-839-9002
	    URL;type=WORK:'.get_site_url().'
	    ADR;TYPE=WORK:;Suite 201;4529 Main Street;Amherst;NY;14226;USA
	    END:VCARD');

	return $bio;
}