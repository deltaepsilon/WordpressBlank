	</div>

    <div id="footer">
        <div id="you-might-like">
            you might like
        </div>
        <div class="right-triangle-green"></div>
        <ul id="teaser">
			<?php
			$posts = get_posts( array(
				'orderby' => 'rand',
				'numberposts' => 6,
				'category' => '13',
				'meta_query' => array(
					array('key' => '_thumbnail_id'),
				),
			));
			foreach ($posts as $post) {
				echo "<li class=\"teaser-item\"><a href=\"";
				the_permalink();
				echo "\" title=\"";
				the_title();
				echo "\">";
				the_post_thumbnail('thumbnail');
				echo "<span class=\"teaser-title\">";
				the_title();
				echo "</span></a></li>";
			}
			?>
        </ul>
    </div>
	<?php
		$host = $_SERVER['HTTP_HOST'];
		if ($GLOBALS['mobile']) {
			$link = preg_replace("/m\./", '', $host);
			echo "<a  class='site-switch-link' href='http://$link'>full site</a>";
		} else {
			echo "<a  class='site-switch-link' href='http://m.$host'>mobile site</a>";
		}
	?>


	<?php wp_footer(); ?>

    <?php
        if($GLOBALS['mobile']) {
            add_filter('home_url', 'mobilizeSiteUrl');
            echo "<script>window.CDE = window.CDE || {};window.CDE.mobile = true;</script>";
            echo "<script type='text/javascript' data-main='/wp-content/themes/isly-2013/scripts/mobile.js' src='/wp-content/themes/isly-2013/scripts/require.js'></script>";
        } else {
            echo "<script type='text/javascript' data-main='/wp-content/themes/isly-2013/scripts/main.js' src='/wp-content/themes/isly-2013/scripts/require.js'></script>";
        }
    ?>
    <script type="text/javascript">
        require.config({
            baseUrl: "/wp-content/themes/isly-2013/scripts"
        });
    </script>
	<!-- Don't forget analytics -->
    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-6859272-4']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
	
</body>

</html>
