<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' : '; } ?><?php bloginfo('name'); ?></title>

	<link href="//www.google-analytics.com" rel="dns-prefetch">
	<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.png" rel="shortcut icon">
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo('description'); ?>">

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
	<div class="social-networks header__widget clear">
		<div class="wrapper">
			<div class="mobile-nav">
				<a class="mobile-nav__button">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</a>
				<?php html5blank_nav(); ?>
			</div>
			<ul class="social-networks__list reset-box">
				<li class="social-networks__item social-networks__item--facebook">
					<a href="#" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> <span>Facebook</span></a>
				</li>
				<li class="social-networks__item social-networks__item--twitter">
					<a href="#" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> <span>Twitter</span></a>
				</li>
				<li class="social-networks__item social-networks__item--instagram">
					<a href="#" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i> <span>Instagram</span></a>
				</li>
				<li class="social-networks__item social-networks__item--pinterest">
					<a href="#" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i> <span>Pinterest</span></a>
				</li>
			</ul>
		</div>
	</div>
	<header class="header clear" role="banner">
		<div class="logo">
			<a href="<?php echo home_url(); ?>">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Logo" class="logo-img">
			</a>
		</div>
		<nav class="nav font--raleway" role="navigation">
			<?php html5blank_nav(); ?>
		</nav>
	</header>