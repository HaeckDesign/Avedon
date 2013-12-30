<?php
/**
 * @subpackage Avedon
 * @since Avedon 1.14
 */

get_header(); ?>

<div id="primary" class="container">
<div class="col-md-8">
<div class="container panel panel-default">
<?php $text = of_get_option('headertext'); if ($text) { echo '<h1 class="text-large">' . of_get_option('headertext') . '</h1>'; }; ?>
</div>
<?php $header_image = get_header_image(); if ( ! empty( $header_image ) ) : ?>
<div class="hometop"><img src="<?php echo esc_url( $header_image ); ?>" alt="headerimg" /></div>
<?php endif; ?>

<?php get_posts(); while (have_posts()) : the_post(); ?>

<div <?php post_class('container panel panel-default'); ?>>
<div class="row panel-heading">

<a href="<?php the_permalink(); ?>" title="<?php the_title();?>" class="col-xs-11"><h3 class="panel-title"><?php the_title();?></h3></a>
<span class="badge col-xs-1"><?php comments_number('0','1','%'); ?></span></div>
<span class="meta"><?php echo avedon_posted_on();?></span>

<?php if ( has_post_thumbnail() ) ?>
<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
<?php the_post_thumbnail( 'primary-post-thumbnail', array('class' => 'thumbnail col-xs-12 col-md-3 img-responsive'));?></a>
<div class="panel-body">

<?php if ( 'posts' == get_option( 'show_on_front' ) ) { echo the_excerpt(); } else { echo the_content(); } ?>

</div></div>

<?php endwhile; ?>
<?php avedon_content_nav('nav-below');?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>