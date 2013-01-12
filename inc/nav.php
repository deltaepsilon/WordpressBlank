<div id="navigation">
	<div id="next-posts"><?php next_posts_link('Older') ?></div>
<?php
	foreach (get_posts('orderby=rand&numberposts=1') as $post) {
		echo '<a id="shuffle" title="';
		the_title();
		echo '" href="';
		the_permalink();
		echo '">shuffle</a>"';
	}
?>
    <div id="prev-posts"><?php previous_posts_link('Newer') ?></div>
</div>

