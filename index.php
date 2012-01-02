<?php get_header(); ?>

	<div id="post-wrapper">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

			<div class="entry">
				<?php the_content(); ?>
			</div>

			<div class="postmetadata">
				<!-- <?php the_tags('Tags: ', ', ', '<br />'); ?> -->
				<!-- Posted in <?php the_category(', ') ?> | --> 
				<div class="comment-brackets">{<span><?php comments_popup_link('0', '1', '%'); ?></span>}</div><div class="comments"></div>
				<div class="share"><?php if( function_exists('ADDTOANY_SHARE_SAVE_KIT') ) { ADDTOANY_SHARE_SAVE_KIT(); } ?></div>
			</div>

		</div>

	<?php endwhile; ?>

	<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

	<?php else : ?>

		<h2>Not Found</h2>

	<?php endif; ?>
	
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>
