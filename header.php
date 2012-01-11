<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>
	
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
	
	<div id="page-wrap" class="clearfix">
		<div class="stripe-left"></div>
		<div class="stripe-right"></div>		
		<div id="header">
			<!-- <h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1> -->
			<!-- <div class="description"><?php bloginfo('description'); ?></div> -->
			<a href="/"><div id="header-image" class="sweet-muffin-large"></div></a>
			<div id="social-buttons">
				<div class="find-me-here"></div>
				<ul>
					<li><a href="http://www.facebook.com/pages/Sweet-Muffin-Suite/333375883357936"><div class="facebook"></div></a></li>
					<li><a href="http://twitter.com/muffingrayson"><div class="twitter"></div></a></li>
					<li><a href="http://pinterest.com/sweetmuffin/"><div class="pinterest"></div></a></li>
<!-- 					Activate the next line if you'd prefer the native wordpress feed	-->
<!-- 					<li><a href="<?php bloginfo('rss2_url'); ?>"><div class="rss"></div></a></li> -->
<!-- 					Edit the next line to change your feed linke	-->
					<li><a href="http://feeds.feedburner.com/SweetMuffinSuite-test"><div class="rss"></div></a></li>
					<li><a href="mailto:sweetmuffinsuite@gmail.com?subject=Hello Muffin."><div class="email"></div></a></li>
					<li><a href="http://www.etsy.com/shop/mufninc"><div class="shopping-cart"></div></a></li>
				</ul> 
			</div>
			<a href="/all-work/"><div class="see-my-work primary-template"></div></a>
			<a href="/posts"><div class="see-my-work portfolio-template"></div></a>
			<a href="http://www.etsy.com/shop/mufninc"><div class="shop-badge"></div></a>
		</div>
		<table class="top-links primary-template">
			<tr>
				<td id="about-me"><a href="/about-me">about me</a></td>
				<td id="contact"><a href="/contact">contact</a></td>
				<td id="my-work"><a href="/my-work">my work</a></td>
				<td id="freebies"><a href="/freebies">freebies</a></td>
				<td id="tutorial"><a href="tutorial">tutorials</a></td>
				<td id="books"><a href="/books">books</a></td>
				<td id="shop"><a href="/shop">shop</a></td>
			</tr>
		</table>
