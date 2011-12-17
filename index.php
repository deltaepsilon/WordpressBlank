<?php 
	get_header(); 
	$counter = 0;
	$featuredPostCount = 2;
	$truncateLength = 450;
?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php $counter ++; ?>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
			
			<div class="post-banner"><h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2></div>

			

			<div class="entry">
				<?php
				 if ($counter <= $featuredPostCount) {
				 	the_content();
				 }
				 else {
				 	$contents =	$post->post_content;
					preg_match('/<img.+?>/', $contents, $images);
					preg_match('/http:.+?\.(jpg|jpeg|gif|png)/', $images[0], $link);
					// echo print_r($link);
					$firstImagePath = $link[0];
					$truncatedText = substr(preg_replace('/<.+?>/', '', $contents), 0, $truncateLength);
					if(!empty($firstImagePath)) {
						echo "<div class=\"first-image\" style=\"background-image: url($firstImagePath);\"></div>";
					}
					if(!empty($truncatedText)) {
						echo $truncatedText.'...';
					}
					 
				 }
				 
				 ?>
			</div>

			<div class="postmetadata">
				<ul>
					<?php
						if ($counter <= $featuredPostCount) {
						 	echo "<li class=\"share-popup\"><a href=\"#\">share</a></li>";
							echo '<li class="comment-count">';
							comments_popup_link('No Comments', '1 Comment', '% Comments');
							echo '</li>';
						 }
					?>
					<li class="read-more-image"><a href="<?php the_permalink() ?>"><div class="read-more"></div></a></li>
				</ul>
				<span></span>
				<!-- <?php the_tags('Tags: ', ', ', '<br />'); ?> -->
				<div class="posted-in">
					Posted in: <?php the_category(', ') ?>
				</div>
			</div>
			<?php
				if ($counter == $featuredPostCount) {
				 	echo '<div id="archives-title"><a href="'.get_month_link(2012, 12).'">archives: ';
				 	the_time('F');
				 	echo '</a></div>';
				 }
			?>
		</div>

	<?php endwhile; ?>

	<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

	<?php else : ?>

		<h2>Not Found</h2>

	<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
