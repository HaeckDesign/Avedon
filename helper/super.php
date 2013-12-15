<?php if ( of_get_option('show_supersize') ) { ?>
<?php $multicheck = of_get_option('super_array'); if ($multicheck) {
if (!empty($multicheck['scrollarrows'])) { echo '<a id="prevslide" class="circled avedonadvicon-chevron-left"></a><a id="nextslide" class="circled avedonadvicon-chevron-right"></a>'; } else {};
if (!empty($multicheck['progbar'])) { echo '<div id="progress-back" class="load-item"><div id="progress-bar"></div></div>'; } else {};
echo '<div id="controls-wrapper" class="load-item row"><div id="controls" class="span10 offset1">';
if (!empty($multicheck['slidecount'])) { echo '<div id="slidecounter"><span class="slidenumber"></span> / <span class="totalslides"></span></div>'; } else {};
if (!empty($multicheck['slidecaption'])) { echo '<div id="slidecaption"></div>'; } else {};
if (!empty($multicheck['slidelist'])) { echo '<ul id="slide-list"></ul>'; } else {};
echo '</div></div>';
} ?>

<?php } ?>
<script type="text/javascript">
jQuery(function($){
$.supersized({

<?php
$multicheck = of_get_option('super_array');
if (!empty($multicheck['autoplay'])) { echo 'autoplay: 1, '; };
if (!empty($multicheck['progbar'])) { echo 'progress_bar: 1, '; };
if (!empty($multicheck['randomimgs'])) { echo 'random: 1, '; };
?>

slide_interval : <?php echo of_get_option('super_translideint', '3000'); ?>,
transition : <?php echo of_get_option('super_effects', '0'); ?>,
transition_speed : <?php echo of_get_option('super_transpeed', '3000'); ?>,
slides : [

<?php if ( of_get_option('radio_images') == "two") { ?>
{image : '<?php echo of_get_option('radio_image_one'); ?>', title : '<?php echo of_get_option('radio_image_one_credit'); ?>'},
{image : '<?php echo of_get_option('radio_image_two'); ?>', title : '<?php echo of_get_option('radio_image_two_credit'); ?>'}
<?php } ?>
<?php if ( of_get_option('radio_images') == "three") { ?>
{image : '<?php echo of_get_option('radio_image_one'); ?>', title : '<?php echo of_get_option('radio_image_one_credit'); ?>'},
{image : '<?php echo of_get_option('radio_image_two'); ?>', title : '<?php echo of_get_option('radio_image_two_credit'); ?>'},
{image : '<?php echo of_get_option('radio_image_three'); ?>', title : '<?php echo of_get_option('radio_image_three_credit'); ?>'}
<?php } ?>
<?php if ( of_get_option('radio_images') == "four") { ?>
{image : '<?php echo of_get_option('radio_image_one'); ?>', title : '<?php echo of_get_option('radio_image_one_credit'); ?>'},
{image : '<?php echo of_get_option('radio_image_two'); ?>', title : '<?php echo of_get_option('radio_image_two_credit'); ?>'},
{image : '<?php echo of_get_option('radio_image_three'); ?>', title : '<?php echo of_get_option('radio_image_three_credit'); ?>'},
{image : '<?php echo of_get_option('radio_image_four'); ?>', title : '<?php echo of_get_option('radio_image_four_credit'); ?>'}
<?php } ?>
<?php if ( of_get_option('radio_images') == "five") { ?>
{image : '<?php echo of_get_option('radio_image_one'); ?>', title : '<?php echo of_get_option('radio_image_one_credit'); ?>'},
{image : '<?php echo of_get_option('radio_image_two'); ?>', title : '<?php echo of_get_option('radio_image_two_credit'); ?>'},
{image : '<?php echo of_get_option('radio_image_three'); ?>', title : '<?php echo of_get_option('radio_image_three_credit'); ?>'},
{image : '<?php echo of_get_option('radio_image_four'); ?>', title : '<?php echo of_get_option('radio_image_four_credit'); ?>'},
{image : '<?php echo of_get_option('radio_image_five'); ?>', title : '<?php echo of_get_option('radio_image_five_credit'); ?>'}
<?php } ?>

],});});

</script>