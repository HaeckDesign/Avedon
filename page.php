<?php
/**
 * @subpackage Avedon
 * @since Avedon 1.16
 */

get_header(); ?>

<div id="primary" class="container">
<div class="col-md-8">
<?php avedon_breadcrumbs();?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class('panel panel-default single-entry'); ?>>
<div class="panel-heading">

<h1 class="panel-title"><?php the_title(); ?></h1>

<div class="post-meta"><div class="post-date">
<span class="post-date">Posted: </span><span class="post-date-link"><?php the_time('M jS, Y') ?> <?php edit_post_link('(Edit)', '', ''); ?> | </span>
<span class="post-author">Author: </span><span class="post-author-link"><?php the_author_posts_link(); ?></span>
</div></div></div>

<div class="panel-body">
<?php the_content(); ?>
<?php wp_link_pages(array('before' => '<p class="paginate-post"><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
</div></div>

<?php comments_template(); ?>

<?php endwhile; else : ?>

<div class="single-entry group"><h2>Nothing Found</h2><p>Oh Snap!  It looks like you're trying to reach a page that's gone. Please check the link and try again.</p></div>

<?php endif; ?>
<?php avedon_content_nav('nav-below');?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>