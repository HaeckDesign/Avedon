<?php
/**
 * @subpackage Avedon
 * @since Avedon 1.16
 */

get_header(); ?>

<div id="primary" class="container">
<div class="col-md-8">
<div class="container-fluid panel panel-default">
<h1 class="text-large">
<?php
if ( is_day() ) {
printf( __( 'Daily Archives: %s', 'avedon' ), '<span>' . get_the_date() . '</span>' );
} elseif ( is_month() ) {
printf( __( 'Monthly Archives: %s', 'avedon' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'avedon' ) ) . '</span>' );
} elseif ( is_year() ) {
printf( __( 'Yearly Archives: %s', 'avedon' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'avedon' ) ) . '</span>' );
} elseif ( is_tag() ) {
printf( __( 'Tag Archives: %s', 'avedon' ), '<span>' . single_tag_title( '', false ) . '</span>' );

/* OPTIONAL TAG DESCRIPTION */
$tag_description = tag_description();
if ( $tag_description )
echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
} elseif ( is_category() ) {
printf( __( 'Category Archives: %s', 'avedon' ), '' . single_cat_title( '', false ) . '' );

/* OPTIONAL CATEGORY DESCRIPTION */
$category_description = category_description();
if ( $category_description )
echo '</h1>';
echo apply_filters( 'category_archive_meta', '<span class="category-archive-meta">' . $category_description . '</span>' );
} else {
echo '</h1>';
_e( 'Blog Archives', 'avedon' );
}
?>

</div>

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