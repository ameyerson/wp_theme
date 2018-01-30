<?php
/**
 * Load controllers
 *
 * Please note that missing files will produce a fatal error.
 */
$controllers = [
	'lib/controllers/homepage/hero.php', // home hero data
	'lib/controllers/homepage/title.php', // home hero title
	'lib/controllers/homepage/content.php', // home content
	'lib/controllers/homepage/page-list.php', // home sections of links
	'lib/controllers/homepage/contact.php', // team members in lower section
  	'lib/controllers/get-address.php', // format address display
  	'lib/controllers/team_member.php', // team contact and meta
];

foreach ( $controllers as $controller ) {
  if ( ! $filepath = locate_template( $controller ) ) {
    trigger_error( sprintf( __( 'Error locating controller %s for inclusion', 'ameyerson' ), $controller ), E_USER_ERROR );
  }

  require_once $filepath;
}
unset( $controller, $filepath );
