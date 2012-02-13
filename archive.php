<?php get_header(); ?>

		<?php if (have_posts()) : ?>

 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

			<?php /* If this is a category archive */ if (is_category()) { ?>
				<div id="archive-title"><h2>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2></div>

			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<div id="archive-title"><h2>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2></div>

			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<div id="archive-title"><h2>Archive for <?php the_time('F jS, Y'); ?></h2></div>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<div id="archive-title"><h2>Archive for <?php the_time('F, Y'); ?></h2></div>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<div id="archive-title"><h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2></div>

			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<div id="archive-title"><h2 class="pagetitle">Author Archive</h2></div>

			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<div id="archive-title"><h2 class="pagetitle">Blog Archives</h2></div>
			
			<?php } ?>

			<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

			<?php while (have_posts()) : the_post(); ?>
			
				<div <?php post_class() ?>>
				
						<div class="post-banner"><h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2></div>
					
						<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

						<div class="entry">
							<?php 
								//the_content();
								$contents =	$post->post_content;
					preg_match('/<img.+?>/', $contents, $images);
					preg_match('/http:.+?\.(jpg|jpeg|gif|png)/', $images[0], $link);
					$firstImagePath = $link[0];
					$truncatedText = substr(preg_replace('/<.+?>/', '', $contents), 0, $truncateLength);
					if(!empty($firstImagePath)) {
						echo "<div class=\"first-image\" style=\"background-image: url($firstImagePath);\"></div>";
					}
								the_excerpt();
                echo  '<a href="';
              the_permalink();
              echo '"><div class="read-more"></div></a>'; 
							?>
						</div>
						

				</div>

			<?php endwhile; ?>

			<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>
			
	<?php else : ?>

		<h2>Nothing found</h2>

	<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
