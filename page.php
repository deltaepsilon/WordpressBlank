<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<div class="post" id="post-<?php the_ID(); ?>">

			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

			<div class="post-banner"><h2><?php the_title(); ?></h2></div>

			<div class="entry">

				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

			</div>
			<div class="postmetadata">
				<ul>
					<?php
						if ($counter <= $featuredPostCount) {
						 	if( function_exists('ADDTOANY_SHARE_SAVE_KIT') ) {
						    	echo '<li>';	
						    	ADDTOANY_SHARE_SAVE_KIT();
								echo '</li>'; 
							}
						 }
					?>
					<li><?php edit_post_link('Edit this page','','');?></li>
				</ul>
				<span></span>
			</div>
		</div>
		
		<?php comments_template(); ?>

		<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
