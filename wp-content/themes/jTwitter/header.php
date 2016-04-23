<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php





    /***
     * include js/css
     */
    // wp_enqueue_script('Name of the script, lowercase string', 'path to the file .js','array of scripts it depends on','version of  the script','boolean value to select whether you want to print the script in the footer or in the header');
    wp_enqueue_script('jquery');
//    wp_enqueue_script('modernizr', get_bloginfo('template_url').'/js/modernizr-1.6.min.js', array(), '1.6');
    wp_enqueue_script('html5', get_bloginfo('template_url').'/js/html5.js'); // http://jdbartlett.github.com/innershiv/
    wp_enqueue_script('innershiv', get_bloginfo('template_url').'/js/innershiv.min.js'); // http://jdbartlett.github.com/innershiv/
    wp_enqueue_script('nivoslider', get_bloginfo('template_url').'/nivo-slider/jquery.nivo.slider.js');
    wp_enqueue_script('innerfade', get_bloginfo('template_url').'/jquery.innerfade/js/jquery.innerfade.js', array('jquery'));
    wp_enqueue_script('global', get_bloginfo( 'template_url' ).'/js/global.js', array('jquery'));


    wp_enqueue_style ('nivoslider', get_bloginfo('template_url').'/nivo-slider/nivo-slider.css');






	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '::', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " :: $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' :: ' . sprintf( __( 'Page %s', THEME_NAME ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link href="<?php bloginfo('template_url') ?>/favicon.png" rel="shortcut icon" type="image/x-icon" />

<!--[if lte IE 7]>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/ie7.css" />
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
//	if ( is_singular() && get_option( 'thread_comments' ) )
//		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?> id="<?php echo get_body_id() ?>">

<?php include_theme_file('header.php'); ?>