<?php
/*
Template Name: Portfolio
*/
?>
<?php get_header(); ?>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/portfolio.css" type="text/css" />
	<div class="top-links portfolio-template">
		<ul>
			<?php
				$pageNames = array(
									'all-work' => 'all work',
									'new' => 'new',
									'calendars' => 'calendars',
									'patterns' => 'patterns',
									'cards' => 'cards',
									'illustrations' => 'illustrations',
									'packaging' => 'packaging',
								);
				$currentPage = $post->post_name;
				foreach ($pageNames as $link => $name) {
					if ($currentPage == $link) {
						echo "<li id=\"$link\" class=\"portfolio-nav current-page\">$name</li>";
					} else {
						echo "<li id=\"$link\" class=\"portfolio-nav\"><a href=\"/$link\">$name</a></li>";
					}
				}
			?>
		</ul>
	</div>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<div class="post portfolio-post" id="post-<?php the_ID(); ?>">

			<div class="entry portfolio-entry">

				<?php the_content(); ?>

			</div>
		</div>
		
		<?php endwhile; endif; ?>



<?php get_footer(); ?>
