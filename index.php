<?php
/**
 * @subpackage Avedon
 * @since Avedon 1.16
 */

get_header(); ?>

<div id="primary" class="container">
<div <?php post_class('col-md-8'); ?>>
<div class="container-fluid panel panel-default">

<?php get_posts(); while (have_posts()) : the_post(); ?>

<div <?php post_class('panel panel-default'); ?>>
<div class="panel-heading container-fluid">

<a href="<?php the_permalink(); ?>" title="<?php the_title();?>" class="col-xs-11"><h3 class="panel-title"><?php the_title();?></h3></a>
<span class="badge col-xs-1"><?php comments_number('0','1','%'); ?></span></div>

<?php if ( has_post_thumbnail() ) ?>
<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
<?php the_post_thumbnail( 'primary-post-thumbnail', array('class' => 'thumbnail col-xs-12 col-md-3 img-responsive'));?></a>
<div class="panel-body">
<span class="meta"><?php echo avedon_posted_on();?></span>
<?php the_excerpt();?>

</div></div>

<?php endwhile; ?>
<?php avedon_content_nav('nav-below');?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>