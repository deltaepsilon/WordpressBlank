<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<div class="post" id="post-<?php the_ID(); ?>">

			<h2 class="title"><span><?php the_title(); ?></span></h2>

			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

			<div class="entry">

				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

			</div>

			<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

			<div class="postmetadata">
				<div class="posted-in">
					posted in:
					<div class="posted-in-links">
						<?php the_category(', ', 'single') ?>
						<br />
						<span class="tags">
							<?php the_tags('Tags: ', ', ', '<br />'); ?>
						</span>

					</div>
				</div>
			</div>

		</div>
		
		<?php comments_template(); ?>

		<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
