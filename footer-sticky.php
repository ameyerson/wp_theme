<?php
    use Roots\BB\Assets;
?>

	</main><!-- #main-container -->

    <footer class="sticky-footer">
      <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
      </div>
    </footer>


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?= Assets\bb_asset_path( 'scripts/vendor/ie10-viewport-bug-workaround.js' ) ?>"></script>

    <?php get_template_part( 'footer', 'bottom' ); ?> 