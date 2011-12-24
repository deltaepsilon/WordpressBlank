<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
			
			<div class="post-banner"><h2><?php the_title(); ?></h2></div>
			
			<div class="entry">
				
				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
				
				<?php the_tags( 'Tags: ', ', ', ''); ?>

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
						 }
					?>
					<li><?php edit_post_link('Edit this entry','','');?></li>
				</ul>
				<span></span>
				<!-- <?php the_tags('Tags: ', ', ', '<br />'); ?> -->
				<div class="posted-in">
					Posted in: <?php the_category(', ') ?>
				</div>
			</div>
		</div>

	<?php comments_template(); ?>

	<?php endwhile; endif; ?>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>