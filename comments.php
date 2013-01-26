<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		This post is password protected. Enter the password to view comments.
	<?php
		return;
	}
?>

<?php //if ( have_comments() ) : ?>
	
	<div id="comments-<?php the_ID(); ?>" class="comments-header" data-id="<?php the_ID(); ?>">
		<span class="comment-view-button">view or add a comment</span>
		<div class="categories-list">
			<li class="categories">
				Categories
				<?php the_category(); ?>
			</li>
		</div>

	</div>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>

	<div class="comment-list-wrapper <?php if (!have_comments()) { echo "no-comments"; } ?>">
        <ol class="commentlist">
			<?php wp_list_comments(); ?>
        </ol>

        <div class="slider">
            <div class="slider-bar"></div>
        </div>
	</div>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>

<?php if ( comments_open() ) : ?>

<div id="respond-<?php the_ID(); ?>" class="respond">
	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="commentform">

		<?php if ( is_user_logged_in() ) : ?>

			<p class="logged-in-as">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out</a></p>

		<?php else : ?>


		<div class="comment-form-left">
			<input type="text" name="author" class="author isly-input" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> placeholder="NAME" <?php if ($req) echo "required"; ?> />


			<input type="text" name="email" class="email isly-input" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> placeholder="EMAIL*" <?php if ($req) echo "required"; ?> />



			<input type="text" name="url" class="url isly-input" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" placeholder="URL (OPTIONAL)"/>


			<span class="email-will-not-be-published">*Your email will not be published.</span>
        </div>

		<?php endif; ?>

		<!--<p>You can use these tags: <code><?php echo allowed_tags(); ?></code></p>-->

		<div class="comment-form-right">
			<textarea name="comment" class="comment isly-input" tabindex="4" placeholder="TYPE YOUR MESSAGE HERE..."></textarea>


			<input name="submit" type="submit" class="submit  isly-submit" tabindex="5" value="Submit Comment" />
			<span class="cancel-comment-reply">
				<?php cancel_comment_reply_link('cancel'); ?>
            </span>
			<?php comment_id_fields(); ?>
		</div>
		
		<?php do_action('comment_form', $post->ID); ?>

	</form>

	<?php endif; // If registration required and not logged in ?>
	
</div>

<?php endif; ?>
