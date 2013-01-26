<div class="meta">
	<span class="post-date"><?php the_time('F jS, Y') ?></span>
	<?php if (!$GLOBALS['mobile']) { ?>
		<div class="post-interaction-pill">
			<div class="pill-top">
				<a class="pill-link-overlay" href="#comments-<?php the_ID(); ?>"></a>
				<?php comments_popup_link('<span class="first-line">0</span> Comments', '<span class="first-line">0</span> Comment', '<span class="first-line">%</span> Comments'); ?>
				<div class="pill-share pill-toggle">Share</div>
			</div>
			<div class="pill-bottom">
				<a target="_blank" class="facebook-white" href="http://www.facebook.com/sharer.php?u=<?php echo the_permalink(); ?>&t=<?php echo the_title(); ?>"></a>
				<a target="_blank" class="twitter-white" href="https://twitter.com/share?url=<?php echo the_permalink(); ?>"></a>
				<div class="pill-bottom-triangle pill-toggle"></div>
			</div>
		</div>
	<?php } ?>
</div>

<?php edit_post_link('Edit this entry','',''); ?>