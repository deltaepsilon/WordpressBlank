<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>" data-id="<?php the_ID(); ?>">
			<?php $withcomments=true;?>

			<h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

			<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

			<div class="entry">
				<?php
//					the_content();
					$content = get_the_content();
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);
					$hasMoreLink = preg_match("/class=\"more-link\"/", $content);
					$isFrontPage = get_query_var('paged');

					if ($isFrontPage == 0 && $wp_query->current_post < 10) {
						echo $content;
					} else { //Deal with truncated posts
						$title = get_the_title();
						$permalink = get_permalink();
						$thumbnail = get_the_post_thumbnail($post->ID, 'medium');
						$excerptWords = explode(' ', get_the_excerpt());
						$remainder = array_splice($excerptWords, 35);
						if (count($remainder) > 0) {
							$excerptWords[] = '...';
						}
						$excerpt = implode(' ', $excerptWords);
						echo "<div class='truncated-post'><div class='truncated-excerpt'><p class='excerpt'>$excerpt</p></div><div class='thumbnail-wrapper'>$thumbnail</div><a class='read-more' href='$permalink'></a></div>";
					}


				?>
			</div>

			<?php
				if (!$GLOBALS['mobile']) {
					comments_template();
				}
			?>

            <div class="postmetadata"><span class="isly-tags"><?php the_tags('TAGS: <span class="italic">', ', ', '</span>'); ?></span></div>

		</div>

	<?php endwhile; ?>

	<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

	<?php else : ?>

		<h2>Not Found</h2>

	<?php endif; ?>

<?php get_footer(); ?>

