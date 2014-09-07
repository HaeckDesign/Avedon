<?php
/**
 * @subpackage Avedon
 * @since Avedon 1.17
 */
?>

<div id="side" class="col-md-4">
<div class="sidebar-nav">

<?php
if ( is_home()) { if ( ! dynamic_sidebar( 'home-right' ) ); }
if ( is_page()) { if ( ! dynamic_sidebar( 'sidebar-page' ) ); }
elseif ( is_search()) { if ( ! dynamic_sidebar( 'sidebar-page' ) ); }
elseif ( is_archive()) { if ( ! dynamic_sidebar( 'sidebar-page' ) ); }
elseif ( is_singular()) { if ( ! dynamic_sidebar( 'sidebar-posts' ) ); }
?>

</div>
<?php if ( of_get_option('social_icons') ) { get_template_part('helper/sociallinks'); } ?>
</div>
</div>