<?php
/*
Template Name: Landing
*/ 
	get_header(); 
	$counter = 0;
	$featuredPostCount = 6;
	$truncateLength = 400;
?>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/landing.css" type="text/css" />

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
	<div class="post portfolio-post" id="post-<?php the_ID(); ?>">

		<div class="entry portfolio-entry">

			<?php the_content(); ?>

		</div>
	</div>
	
	<?php endwhile; endif; ?>


<?php get_footer(); ?>
