<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>" data-id="<?php the_ID(); ?>">
			
			<h2 class="post-title"><?php the_title(); ?></h2>
			
			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

			<div class="entry">
				
				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
				
				<?php the_tags( 'Tags: ', ', ', ''); ?>

			</div>
			
			<?php edit_post_link('Edit this entry','','.'); ?>

			<?php comments_template(); ?>
		</div>

	<?php endwhile; endif; ?>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>