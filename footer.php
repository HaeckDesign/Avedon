<?php
/**
 * @subpackage Avedon
 * @since Avedon 1.16
 */
?>

<?php if ( ! dynamic_sidebar( 'pitch-content' ) ); ?>
<?php if ( ! dynamic_sidebar( 'middle-content' ) ); ?>

<footer id="footer"><div class="container">

<div class="col-xs-12 col-md-4">
<?php if ( ! dynamic_sidebar( 'bottom-left' ) ): ?>
<div class="widget widget_text"><div class="textwidget"><h4 class="widget-title">About Us...</h4><i class="subicon glyphicon glyphicon-flag"></i><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud labore et dolore magna exercitation.</p></div></div>
<?php endif; ?>
</div>

<div class="col-xs-12 col-md-4">
<?php if ( ! dynamic_sidebar( 'bottom-middle' ) ): ?>
<div class="widget widget_text"><div class="textwidget"><h4 class="widget-title">Our Location</h4><i class="subicon glyphicon glyphicon-map-marker"></i><ul><li><b>Address: </b> 25 Lorem Lis, Raleigh, NC USA</li><li><b>Phone: </b> 800 123 3456</li><li><b>Fax: </b> 800 123 3456</li><li><b>Email: </b> info@anybiz.com</li></ul></div></div>
<?php endif; ?>
</div>

<div class="col-xs-12 col-md-4">
<?php if ( ! dynamic_sidebar( 'bottom-right' ) ): ?>
<div class="widget widget_text"><div class="textwidget"><h4 class="widget-title">Subscribe</h4><i class="subicon glyphicon glyphicon-envelope"></i><p class="margin-bottom-10">Subscribe to our newsletter and stay up to date!</p>

    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search" value="" name="s" id="s">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" id="searchsubmit">Signup</button>
      </span></div>


</div></div>
<?php endif; ?>
</div>

<div class="foot col-xs-12"><?php if ( ! dynamic_sidebar( 'footer-content' ) ); ?></div>

<div class="row">
<span class="col-xs-11"><?php echo of_get_option('footer_text', 'no entry'); ?></span><span class="col-xs-1 text-right totop hidden-xs"><a href="#"><i class="glyphicon glyphicon-chevron-up"></i></a></span>
</div>
</div>
</footer>

<?php if ( of_get_option('show_supersize') ) { get_template_part('helper/super'); } ?>
<?php wp_footer(); ?>
</body>
</html>