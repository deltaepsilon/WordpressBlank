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

	<?php wp_footer(); ?>
	<!-- Don't forget analytics -->
	
</body>

</html>
