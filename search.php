<?php get_header(); ?>

	<?php if (have_posts()) : ?>

		<h2 id="search-results-title">Search Results</h2>

		<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

				<div class="post-banner"><h2><h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2></div>

				<div class="entry">

					<?php the_excerpt(); ?>
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
								 }
							?>
							<li><?php edit_post_link('Edit this entry','','');?></li>
							<li class="read-more-image"><a href="<?php the_permalink() ?>"><div class="read-more"></div></a></li>
						</ul>
						<span></span>
						<div class="posted-in">
							Posted in: <?php the_category(', ') ?>
						</div>
					</div>
				</div>
			</div>

		<?php endwhile; ?>

		<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

	<?php else : ?>
	<div class="post">
			<h2>No posts found.</h2>
	</div>
	<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
