

    <?php wp_footer(); ?>

    <script>
    	if (($('html')).hasClass('no-backgroundsize')) {
    		$('.backstretch').each(function() {
    			img = $(this).attr('data-fullscreenBackground');
            //    alert($(this).attr('data-fullscreenBackground'));
				$(this).backstretch(img);
    		});
    	}
	</script>

</body>
</html>