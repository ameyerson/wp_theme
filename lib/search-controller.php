<?php

function ameye_search_join( $join ) {
  global $wpdb;
  //* if main query and search...
  if( is_main_query() && is_search() )
  {
      //* join term_relationships, term_taxonomy, and terms into the current SQL where clause


      // $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';

    $join .=" LEFT JOIN {$wpdb->postmeta} ON {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id ";

    $join .= "
      LEFT JOIN
      (
          {$wpdb->term_relationships}
          INNER JOIN
              {$wpdb->term_taxonomy} ON {$wpdb->term_taxonomy}.term_taxonomy_id = {$wpdb->term_relationships}.term_taxonomy_id
          INNER JOIN
              {$wpdb->terms} ON {$wpdb->terms}.term_id = {$wpdb->term_taxonomy}.term_id

      )
      ON {$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id ";
  }


  $join .=" LEFT JOIN {$wpdb->users} ON {$wpdb->posts}.post_author = {$wpdb->users}.ID ";

  // var_dump($join); die();

  return $join;
}
add_filter('posts_join', 'ameye_search_join' );

function ameye_search_where( $where ) {
    global $wpdb;

    if ( is_search() ) {

      // var_dump($where); die();


     $where .= " OR (
                     {$wpdb->term_taxonomy}.taxonomy IN( 'category', 'post_tag')
                       AND
                        {$wpdb->terms}.name LIKE '%" . esc_sql( get_query_var( 's' ) ) . "%'
                          AND ({$wpdb->posts}.post_status = 'publish'
                            OR {$wpdb->posts}.post_author = " . absint( get_current_user_id()) . " AND {$wpdb->posts}.post_status = 'private')
                 )";

      // var_dump($where); die();

      $where .= " OR (
                  {$wpdb->posts}.post_type IN( 'post')
                   AND 
                   {$wpdb->users}.display_name LIKE '%" . esc_sql( get_query_var( 's' ) ) . "%'
                     AND ({$wpdb->posts}.post_status = 'publish'
                       OR {$wpdb->posts}.post_author = " . absint( get_current_user_id()) . " AND {$wpdb->posts}.post_status = 'private')
            )";

      $where = preg_replace(
          "/\(\s*".$wpdb->posts.".post_content\s+LIKE\s*(\'[^\']+\')\s*\)/",
          "(".$wpdb->posts.".post_content LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'ameye_search_where' );

function ameye_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}

add_filter( 'posts_distinct', 'ameye_search_distinct' );