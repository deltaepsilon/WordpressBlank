<?php 
	get_header(); 
	$counter = 0;
	$featuredPostCount = 6;
	$truncateLength = 400;
?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php $counter ++; ?>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
			
			<div class="post-banner"><h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2></div>
			<div class="entry">
				<?php
  				// Show full post until featuredPostCount
				 if ($counter <= $featuredPostCount) {
				 	the_content();				
				 }
				 else {
				 	if ($counter == $featuredPostCount) {
					 	echo '<div id="month-archives-title"><a href="'.get_month_link('', '').'">archives: ';
					 	the_time('F');
					 	echo '</a></div>';
					 }
					
				 	$contents =	$post->post_content;
					preg_match('/<img.+?>/', $contents, $images);
					preg_match('/http:.+?\.(jpg|jpeg|gif|png)/', $images[0], $link);
					$firstImagePath = $link[0];
					$truncatedText = substr(preg_replace('/<.+?>/', '', $contents), 0, $truncateLength);
					if(!empty($firstImagePath)) {
						echo "<div class=\"first-image\" style=\"background-image: url($firstImagePath);\"></div>";
					}
					if(!empty($truncatedText)) {
						echo $truncatedText.'...';
					}
					 
				 }
				 /* 
					 * 	Gallery Begin
					 * 	Tweak maxImages and image tags to control output
					 */
					$contents =	$post->post_content;
					// var_dump($contents);
					preg_match_all('/<img.+?>/', $contents, $images);
					$maxImages = 12;
					$gallery = array();
					$imageCounter = 0;
					foreach ($images[0] as $imageTag) {
						$imageCounter ++;
						if ($imageCounter <= $maxImages) {
							preg_match_all('/http:.+?\.(jpg|jpeg|gif|png)/', $imageTag, $imageLink);
							$gallery[] = $imageLink[0][0];
						}
					}
					echo '<div class="index-gallery">';
					foreach ($gallery as $imageLink) {
						echo "<div class=\"clipwrapper\"><div class=\"clip\"><img class=\"index-thumbnails\" src=\"$imageLink\" /></div></div>";
					}
					echo '</div>';
					
					/*
					 * Gallery End
					 */
				 ?>
			</div>

			<div class="postmetadata">
				<ul>
					<?php
						if ($counter <= $featuredPostCount) {
						 	// echo "<li class=\"share-popup\"><a href=\"#\">share</a></li>";
						 	
						 	if( function_exists('ADDTOANY_SHARE_SAVE_KIT') ) {
						    	echo '<li>';	
						    	ADDTOANY_SHARE_SAVE_KIT();
								echo '</li>'; 
							}
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
				// if ($counter == $featuredPostCount) {
				 	// echo '<div id="month-archives-title"><a href="'.get_month_link('', '').'">archives: ';
				 	// the_time('F');
				 	// echo '</a></div>';
				 // }
			?>
		</div>

	<?php endwhile; ?>

	<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

	<?php else : ?>

		<h2>Not Found</h2>

	<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
