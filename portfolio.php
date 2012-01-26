<?php
/*
Template Name: Portfolio
*/
?>
<?php get_header(); ?>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/portfolio.css" type="text/css" />
	<div class="top-links portfolio-template">
			<?php
			/*
			 * Pauline, this is where you can edit your page names. This is a PHP array... but it's not 
			 * complicated, I swear.  Each entry in the array has two parts, a "key" and a "value".  The
			 * key is the actual link that you want to link to.  The value is what you want to show on the
			 * page.  For example, sweetmuffinsuite.com/all-work will bring you to the "All Work" page.  
			 * I want it to show as "all work" on the page.  I don't wan't the hyphen, so I didn't include
			 * it in the second part.  All entries have a comma after them.  If you add or subtract a lot of
			 * pages from the nav bar, you may need to change the css file.  The setting is in portfolio.css.
			 * The line is ".top-links.portfolio-template {padding: 10px 90px;}".  Change the 90px up or 
			 * down to add or subtract space.
			 */
				$pageNames = array(
									'all-work' => 'all work',
									'new' => 'new',
									'calendars' => 'calendars',
									'patterns' => 'patterns',
									'cards-2' => 'cards',
									'illustrations' => 'illustrations',
									'packaging' => 'packaging',
								);
				$currentPage = $post->post_name;
				echo "<table><tr>";
				foreach ($pageNames as $link => $name) {
					if ($currentPage == $link) {
						echo "<td id=\"$link\" class=\"portfolio-nav current-page\">$name</td>";
					} else {
						echo "<td id=\"$link\" class=\"portfolio-nav\"><a href=\"/$link\">$name</a></td>";
					}
				}
				echo "</tr></table>";
			?>
	</div>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<div class="post portfolio-post" id="post-<?php the_ID(); ?>">

			<div class="entry portfolio-entry">

				<?php the_content(); ?>

			</div>
		</div>
		
		<?php endwhile; endif; ?>



<?php get_footer(); ?>
