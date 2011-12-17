<?php get_header(); ?>
	<div id="top-links">
		<ul>
			<li id="about-me"><a href="#">about me</a></li>
			<li id="contact"><a href="#">contact</a></li>
			<li id="my-work" style="padding-right: 150px;"><a href="#">my work</a></li>
			<li id="freebies"><a href="#">freebies</a></li>
			<li id="tutorial"><a href="#">tutorials</a></li>
			<li id="books"><a href="#">books</a></li>
			<li id="shop"><a href="#">shop</a></li>
		</ul>
	</div>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
			
			<div class="post-banner"><h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2></div>

			

			<div class="entry">
				<?php the_content(); ?>
			</div>

			<div class="postmetadata">
				<ul>
					<li class="share-popup"><a href="#">share</a></li>
					<li class="comment-count"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></li>
					<li class="read-more-image"><a href="<?php the_permalink() ?>"><div class="read-more"></div></a></li>
				</ul>
				<span></span>
				<!-- <?php the_tags('Tags: ', ', ', '<br />'); ?> -->
				<div class="posted-in">
					Posted in: <?php the_category(', ') ?>
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
