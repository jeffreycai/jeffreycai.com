
    <div class="clear"></div>

<footer>
    <a href="<?php echo get_page_link(get_page_by_title('About me')->ID) ?>">Jeffrey Cai</a> - &copy; 2011 All Rights Reserved. <a href="<?php echo get_page_link(get_page_by_title('About site')->ID) ?>">This site</a> is powered by <a href="http://wordpress.org/" target="_blank">Wordpress</a>.
    <br />
    <span style="font-size: 0.9em;">Page optimized by <a style="color: #444444;;" title="WP Minify WordPress Plugin" href="http://omninoggin.com/wordpress-plugins/wp-minify-wordpress-plugin/">WP Minify</a></span>
</footer>

    </section>
    <!-- end of #body -->


</section>


<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

<?php if (strpos($_SERVER['SERVER_NAME'], 'jeffreycai.com')): ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-11630792-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php endif ?>
</body>
</html>
