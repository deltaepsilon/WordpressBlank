<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			<h2 class="title"><?php the_title(); ?></h2>
			
			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

			<div class="entry">
				
				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

			</div>
			
			<?php edit_post_link('Edit this entry','','.'); ?>

			<div class="postmetadata">
				<div class="posted-in">
					posted in:
					<div class="posted-in-links">
						<?php the_category(', ', 'single') ?>
						<br />
						<?php the_tags('Tags: ', ', ', '<br />'); ?>
					</div>
				</div>
			</div>
		</div>


	<?php comments_template(); ?>

	<div class="navigation">
		<div class="next-posts"><?php next_post_link('%link', 'older post', false) ?></div>
		<div class="prev-posts"><?php previous_post_link('%link', 'next post', false) ?></div>
	</div>


	<?php endwhile; endif; ?>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>