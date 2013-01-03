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
		         echo 'Search for &quot;'.esc_html($s).'&quot; - '; }
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

    <script type="text/javascript" src="<?php bloginfo("template_url");?>/scripts/modernizr.custom.36318.js"></script>
    <script type="text/javascript" data-main="<?php bloginfo("template_url");?>/scripts/main.js" src="<?php bloginfo("template_url");?>/scripts/require.js"></script>
</head>

<body <?php body_class(); ?>>

	<form id="isly-contact" action="<?php bloginfo("template_url");?>/contactForm.php">
		<ul id="notifications">
			<li class="notification"></li>
		</ul>
		<div id="isly-contact-left-wrapper">
			<input type="text" id="isly-contact-name" class="isly-contact-input isly-contact-left" placeholder="NAME" name="name" required/>
			<input type="text" id="isly-contact-email" class="isly-contact-input isly-contact-left" placeholder="EMAIL" name="email" required/>
			<input type="text" id="isly-contact-subject" class="isly-contact-input isly-contact-left" placeholder="SUBJECT" name="subject"/>
		</div>
		<div id="isly-contact-message-wrapper">
			<textarea id="isly-contact-message" class="isly-contact-input" placeholder="TYPE YOUR MESSAGE HERE ..." name="body" required></textarea>
		</div>
		<button id="isly-contact-submit" class="isly-contact-input">SUBMIT</button>
	</form>
	<div id="page-wrap">

		<div id="left-panel">
			<?php get_sidebar(); ?>
		</div>

		<div id="right-panel">
            <div id="header">
				<?php wp_nav_menu( array( 'sort_column' => 'menu_order','container_class' => 'header-links' ) ); ?>
            </div>