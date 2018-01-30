<?php get_header(); ?>

	<?php if ( have_posts() ) : ?>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				get_template_part('content', 'entry');

			endwhile;

			// Previous/next page navigation.
			// ameye_pagination( );
	?>
		<p>icon<i class="fa fa-heart" aria-hidden="true"></i></p>
		<nav>
			<div class="container">
				<ul class="pagination">
				<?php 
					// $pager = paginate_links( array('type' => 'array'));
					// foreach ( $pager as $pgl ) {
					//     echo "<li>$pgl</li>";
					// }
				?>
				</ul>
			</div>
		</nav>
	<?php
		else :

			get_template_part( 'content', 'none' );

		endif;
	?>

<?php get_footer('sticky'); ?>



