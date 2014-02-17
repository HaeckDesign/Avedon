<?php
/**
 * @subpackage Avedon
 * @since Avedon 1.16
*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php get_template_part('helper/styling'); ?>

<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>/js/lte-ie7.js" /><![endif]-->

<?php wp_head(); ?>

</head>

<body id="wrap" <?php body_class(); ?>>

<nav class="navbar navbar-inverse <?php echo of_get_option('navbar_attachment'); ?>" role="navigation">
<div class="container">
<div class="navbar-header">

<a class="navbar-brand" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
<?php if ( of_get_option('primary_logo') ) { echo '<img src=' . of_get_option('primary_logo') . ' alt="home" />'; } else { echo bloginfo( 'name' ); } ?></a>

<button type="button" class="navbar-toggle text-right" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
</button>

<?php if ( of_get_option('emailicon') ) { ?>
<a href='mailto:<?php echo of_get_option('emailicon'); ?>' class="visible-xs navbar-toggle navbar-btn glyphicon glyphicon-envelope" title="Email"><span class="visuallyhidden">Email</span></a><?php } ?>
<?php if ( of_get_option('mapicon') ) { ?>
<a href='<?php echo of_get_option('mapicon'); ?>' class="visible-xs navbar-toggle navbar-btn glyphicon glyphicon-map-marker" title="Map"><span class="visuallyhidden">Map</span></a><?php } ?>
<?php if ( of_get_option('phoneicon') ) { ?>
<a href='tel:<?php echo of_get_option('phoneicon'); ?>' class="visible-xs navbar-toggle navbar-btn glyphicon glyphicon-phone-alt" title="Call Now."><span class="visuallyhidden">Phone</span></a><?php } ?>

</div>

<?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 2, 'container_class' => 'navbar-collapse collapse', 'menu_class' => 'nav navbar-nav', 'fallback_cb' => '', 'menu_id' => 'main-menu', 'walker' => new avedon_walker_nav_menu() ) ); ?>
</div>
</nav>
