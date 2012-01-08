<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

			<div class="entry">
				<?php the_content(); ?>
			</div>

			<div class="postmetadata">
				<div class="comment-count"><?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></div>
				<div class="post-category">Posted in <?php the_category(', ') ?></div>
				<div class="tags"><?php the_tags('Tags: ', ', ', '<br />'); ?></div>
				<div class="twitter-share">
					<a href="https://twitter.com/intent/tweet?button_hashtag=thebridalrecipe&text=<?php the_title(); ?>">TWITTER</a>
					<!-- <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink() ?>" data-via="thebridalrecipe" data-count="none">Twitter</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> -->
				</div>
				<div class="facebook-share">
					<a name="fb_share" type="icon_link" share_url="<?php the_permalink() ?>"></a> 
					<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
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
