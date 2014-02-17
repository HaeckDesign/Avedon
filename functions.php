<?php

/* Options Panel */

if ( !function_exists( 'avedontheme_init' ) ) {
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}

function avedon_setup() {
if ( ! isset( $content_width ) )
$content_width = 770;
add_theme_support('post-thumbnails');
add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery', 'link', 'quote', 'status', 'video', 'audio', 'chat' ) );
add_theme_support('automatic-feed-links');
add_theme_support( 'custom-header' );
add_theme_support( 'custom-background' );
add_editor_style();
set_post_thumbnail_size( 300, 300, true );
add_image_size( 'primary-post-thumbnail', 500, 9999 );
register_nav_menu( 'primary', __( 'Navigation Menu', 'avedon' ) );
}
add_action( 'after_setup_theme', 'avedon_setup' );


/* Fallback Home Link */

function avedon_page_menu_args( $args ) {
$args['show_home'] = true;
return $args;
}
add_filter( 'wp_page_menu_args', 'avedon_page_menu_args' );


/* Include Walker Menu */

include 'helper/walker-menu.php';


/* Posted On */

if ( ! function_exists( 'avedon_posted_on' ) ) :

function avedon_posted_on() {
printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="byline"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'avedon' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'avedon' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

if ( ! function_exists( 'avedon_content_nav' ) ):

/* Next / Previous */

function avedon_content_nav( $nav_id ) {
global $wp_query;

?>

<?php if ( is_single() ) : ?>
<ul class="well pager btn-group btn-group-justified">
<?php previous_post_link( '<li class="previous col-md-6">%link</li>', '<i class="glyphicon glyphicon-chevron-left"></i> %title' ); ?>
<?php next_post_link( '<li class="next col-md-6">%link</li>', '%title <i class="glyphicon glyphicon-chevron-right"></i>' ); ?>
</ul>
<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : ?>
<ul class="btn-group btn-group-justified">
<?php if ( get_next_posts_link() ) : ?>
<li class="btn btn-default next col-md-6"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'avedon' ) ); ?></li>
<?php endif; ?>

<?php if ( get_previous_posts_link() ) : ?>
<li class="btn btn-default previous col-md-6"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'avedon' ) ); ?></li>
<?php endif; ?>
</ul>
<?php endif; ?>

<?php
}
endif;


/* Trim Excerpt */

function custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/* Register Widgets */

function avedon_widgets_init() {

    register_sidebar(array(
    'name' => 'Home Sidebar',
    'id'   => 'home-right',
    'description'   => 'Right sidebar on homepage',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ));

  register_sidebar( array(
    'name' => 'Page Sidebar',
    'id' => 'sidebar-page',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ) );

  register_sidebar( array(
    'name' => 'Posts Sidebar',
    'id' => 'sidebar-posts',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ) );

    register_sidebar(array(
    'name' => 'Call to Action',
    'id'   => 'pitch-content',
    'description'   => 'Under content, over middle - Best used for call to action.',
    'before_widget' => '<div class="pitch container"><div id="%1$s" class="container-fluid widget %2$s">',
    'after_widget'  => '</div></div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
  ));

    register_sidebar(array(
    'name' => 'Middle Content',
    'id'   => 'middle-content',
    'description'   => 'Below content, above the footer.',
    'before_widget' => '<div class="middle"><div id="%1$s" class="container"><div class="container-fluid col-xs-12 widget %2$s">',
    'after_widget'  => '</div></div></div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
  ));

    register_sidebar(array(
    'name' => 'Bottom Left',
    'id'   => 'bottom-left',
    'description'   => 'Bottom left widget box.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
  ));

    register_sidebar(array(
    'name' => 'Bottom Middle',
    'id'   => 'bottom-middle',
    'description'   => 'Bottom middle widget box.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
  ));

    register_sidebar(array(
    'name' => 'Bottom Right',
    'id'   => 'bottom-right',
    'description'   => 'Bottom right widget box.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
  ));

    register_sidebar(array(
    'name' => 'Footer Content',
    'id'   => 'footer-content',
    'description'   => 'Footer text or acknowledgements',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
  ));

}
add_action( 'widgets_init', 'avedon_widgets_init' );


if ( ! function_exists( 'avedon_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function avedon_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'avedon' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'avedon' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'avedon' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;


/* Continue Link */

function avedon_excerpt($more) {
       global $post;
  return '&#8230;<a href="'. get_permalink($post->ID) . '" class="btn btn-default btn-sm pull-right">Continue Reading</a>';
}
add_filter('excerpt_more', 'avedon_excerpt');


/* Body Classes */

function avedon_body_classes( $classes ) {
	// Adds a class of single-author to blogs with only 1 published author
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	return $classes;
}
add_filter( 'body_class', 'avedon_body_classes' );


/* Multi Category - via http://bootstrapwp.rachelbaker.me */

function avedon_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so bootstrap_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so bootstrap_categorized_blog should return false
		return false;
	}
}


/* Flush Transients - via http://bootstrapwp.rachelbaker.me */

function avedon_category_transient_flusher() {
  // Like, beat it. Dig?
  delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'avedon_category_transient_flusher' );
add_action( 'save_post', 'avedon_category_transient_flusher' );

function avedon_enhanced_image_navigation( $url ) {
	global $post;

	if ( wp_attachment_is_image( $post->ID ) )
		$url = $url . '#main';

	return $url;
}
add_filter( 'attachment_link', 'avedon_enhanced_image_navigation' );

/* Check for Post Thumb */

function avedon_post_thumbnail_check() {
    global $post;
    if (get_the_post_thumbnail()) {
          return true; }
          else { return false; }
}

/* Add Breadcrumbs */

function avedon_breadcrumbs() {

  $home = 'Home'; // text for the 'Home' link
  $before = '<li class="active">'; // tag before the current crumb
  $after = '</li>'; // tag after the current crumb

  if ( !is_home() && !is_front_page() || is_paged() ) {

    echo '<ul class="breadcrumb">';

    global $post;
    $homeLink = home_url();
    echo '<li><a href="' . $homeLink . '">' . $home . '</a></li>';

    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ''));
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;

    } elseif ( is_day() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li>';
      echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
      echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo $before . get_category_parents($cat, TRUE, $after);
        echo $before . get_the_title() . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE);
      echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
      echo $before . get_the_title() . $after;

    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . '';
      echo $before . get_the_title() . $after;

    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;

    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;

    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page', 'avedon') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</ul>';

  }
}


add_action( 'wp_enqueue_scripts', 'avedon_load_js_files' );

function avedon_load_js_files() {

wp_enqueue_script( 'bootstrap', get_template_directory_uri() .'/js/bootstrap.min.js', array('jquery'), '1.0', true );

if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
wp_enqueue_script( 'comment-reply' );

if (of_get_option('show_supersize') ) {
wp_enqueue_script( 'jqueryeasing', get_template_directory_uri() .'/js/jquery.easing.min.js', array('jquery'), '1.0', true );
wp_enqueue_script( 'supersized', get_template_directory_uri() .'/js/supersized.3.2.7.js', '1.0', true  );
wp_enqueue_script( 'supersizedshutter', get_template_directory_uri() .'/js/supersized.shutter.js', '1.0', true );
wp_enqueue_style( 'supercss', get_template_directory_uri() .'/css/supersized.css', '1.0', true  );
}

if (of_get_option('invert_color') == "color-dark") {
wp_enqueue_style( 'invert_dark', get_template_directory_uri() .'/css/dark.css', '1.0', true );
}
}

function avedon_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	$title .= get_bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'avedon' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'avedon_wp_title', 10, 2 );
