<?php
/**
 * @subpackage Avedon
 * @since Avedon 1.14
 */

get_header(); ?>

<div id="primary" class="container">
<div <?php post_class('col-md-8'); ?>>
<div class="container panel panel-default">

<?php if ( have_posts() ) : ?>

<h1 id="text-large"><?php printf( __( 'Search Results for: %s', 'avedon' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

</div>

<?php get_posts(); while (have_posts()) : the_post(); ?>

<div class="container panel panel-default">
<div class="row panel-heading">
<a href="<?php the_permalink(); ?>" title="<?php the_title();?>" class="col-xs-11"><h3 class="panel-title"><?php the_title();?></h3></a>
<span class="badge col-xs-1"><?php comments_number('0','1','%'); ?></span></div>
<span class="meta"><?php echo avedon_posted_on();?></span>

<?php if ( has_post_thumbnail() ) ?>
<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
<?php the_post_thumbnail( 'primary-post-thumbnail', array('class' => 'thumbnail col-md-3 img-responsive'));?></a>
<div class="panel-body"><?php the_excerpt();?></div>
</div>

<?php endwhile; ?>
<?php else : ?>


<div class="single-entry group">
<h1 id="overview"><?php _e( 'No Results Found', 'avedon' ); ?></h1><hr />
<p class="lead"><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps you should try again with a different search term.', 'avedon' ); ?></p><hr />
<?php get_search_form(); ?>
</div>

<?php endif ;?>

<?php avedon_content_nav( 'nav-below' ); ?>

</div>

<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>