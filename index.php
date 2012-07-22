<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<a class="title-link" href="<?php the_permalink() ?>"><h2 class="title"><span><?php the_title(); ?></span></h2></a>

			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

			<div class="entry">
				<?php the_content(); ?>
			</div>

			<div class="postmetadata">
				<div class="add-a-comment">
					<?php comments_popup_link('add a comment', 'add a comment', 'add a comment'); ?>
				</div>
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

	<?php endwhile; ?>

	<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

	<?php else : ?>

		<h2>Not Found</h2>

	<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
