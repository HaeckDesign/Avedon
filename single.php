<?php
/**
 * @subpackage Avedon
 * @since Avedon 1.15
 */

get_header(); ?>

<div id="primary" class="container">
<div class="col-md-8">
<?php avedon_breadcrumbs();?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class('panel panel-default single-entry'); ?>>
<div class="panel-heading">

<h1 class="panel-title"><?php the_title(); ?></h1>

<?php if ( has_post_format( 'aside' )) { echo '<i class="cattag glyphicon glyphicon-adjust"></i>'; }
if ( has_post_format( 'image' )) { echo '<i class="cattag glyphicon glyphicon-camera"></i>'; }
if ( has_post_format( 'link' )) { echo '<i class="cattag glyphicon glyphicon-link"></i>'; }
if ( has_post_format( 'quote' )) { echo '<i class="cattag glyphicon glyphicon-comment"></i>'; }
if ( has_post_format( 'status' )) { echo '<i class="cattag glyphicon glyphicon-time"></i>'; }
if ( has_post_format( 'video' )) { echo '<i class="cattag glyphicon glyphicon-film"></i>'; }
if ( has_post_format( 'audio' )) { echo '<i class="cattag glyphicon glyphicon-music"></i>'; }
if ( has_post_format( 'chat' )) { echo '<i class="cattag glyphicon glyphicon-bullhorn"></i>'; }
if ( has_post_format( 'gallery' )) { echo '<i class="cattag glyphicon glyphicon-picture"></i>'; } ?>

<div class="post-meta">
<div class="post-date">

<span class="post-date">Posted: </span><span class="post-date-link"><?php the_time('M jS, Y') ?> <?php edit_post_link('(Edit)', '', ''); ?> | </span>
<span class="post-author">Author: </span><span class="post-author-link"><?php the_author_posts_link(); ?></span>
<span class="post-comment"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span>
</div></div></div>

<div class="panel-body">
<?php the_content(); ?>
<?php wp_link_pages(array('before' => '<p class="paginate-post"><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
</div>

<?php if (has_tag()) { ?>

<div class="post-tag panel-footer">

<span>Category: <?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'avedon' ) ); ?></span>
<span>Tag: <?php the_tags('') ?></span>

</div>


<?php } ?>

</div>

<?php comments_template(); ?>

<?php endwhile; else : ?>

<div class="single-entry group"><h2>Nothing Found</h2><p>Oh Snap!  It looks like you're trying to reach a page that's gone. Please check the link and try again.</p></div>

<?php endif; ?>
<?php avedon_content_nav('nav-below');?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>