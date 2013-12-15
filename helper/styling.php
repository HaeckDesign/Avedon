
<style>

<?php $typography = of_get_option('header_font'); if ($typography) {
echo 'h1, h2, h3, h4, h5, h6, .home .tiptop div b, h1.panel-title, h3.panel-title { font-family: ' . $typography['face']. '; font-size:'.$typography['size'] . '; line-height: '.$typography['size'] . '; font-style: ' . $typography['style'] . '; color:'.$typography['color'].'; } .home .post .btn .btn-default a, .archive .post .btn .btn-default a, .socialcount > li > a { font-family: ' . $typography['face']. '; } .circled.avedonicon-chevron-left, .circled.avedonicon-chevron-right, .dropdown-menu .glyphicon {color:'.$typography['color'].';} .sticky .badge, .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus {background-color:'.$typography['color'].';background:'.$typography['color'].';}' ; } ?>

<?php $typography = of_get_option('menu_font'); if ($typography) {
echo '#main-menu .dropdown-toggle, #main-menu > .menu-item, #main-menu .dropdown-toggle a, .navbar-brand, .navbar-nav > li > a { font-family: ' . $typography['face']. '; font-size:'.$typography['size'] . '; line-height: '.$typography['size'] . '; font-style: ' . $typography['style'] . '; color:'.$typography['color'].'; } #controls-wrapper, .navbar-inverse .navbar-brand, .navbar-inverse .nav > li > a, .socialbox a:hover, .dropdown-menu > li > a:hover {color:'. $typography['color'].'; }  '; } ?>

<?php $color = of_get_option('header_color');
if ($color) { echo 'nav.navbar, #foot, #wrap #controls-wrapper, #wrap .circled.glyphicon-chevron-left, #wrap .circled.glyphicon-chevron-right { background: ' . of_get_option('header_color') . ' ;}' ; } ?>

<?php $select = of_get_option('navbar_padding'); if ($select) { echo '.navbar-fixed-top + #primary:before, .navbar-fixed-top + #feature, .navbar-fixed-top + #fullfeature + #feature { margin-top: ' . of_get_option('navbar_padding') . ';} .navbar-fixed-bottom + #primary + #pitch + #mid + #bottom + #foot { padding-bottom: ' . of_get_option('navbar_padding') . ';}' ;} ?>

<?php $color = of_get_option('middle_color');
if ($color) { echo '#middle, .dropdown-menu > li > a:hover, .archive .tiptop, .dropdown-menu > li > a:focus, .carousel-caption, .carousel-indicators li.active { background: ' . of_get_option('middle_color') . ' ;}' ; } ?>

<?php $color = of_get_option('middle_text_color');
if ($color) { echo '#middle { color: ' . of_get_option('middle_text_color') . ' ;}' ; } ?>

<?php $color = of_get_option('bottom_color');
if ($color) { echo '#wrap #footer, .archive .tiptop, .dropdown-menu > li > a:focus { background: ' . of_get_option('bottom_color') . ' ;}' ; } ?>

<?php $color = of_get_option('bottom_text_color');
if ($color) { echo '#footer, #footer a { color: ' . of_get_option('bottom_text_color') . ' ;}' ; } ?>

<?php $color = of_get_option('link_color');
if ($color) { echo 'a, a:hover, a:focus { color: ' . of_get_option('link_color') . ' ;}' ; } ?>

<?php $color = of_get_option('button_text_color');
if ($color) { echo '.navbar .navbar-btn, .navbar .navbar-toggle, .socialcount > li, .btn-default, .btn-default:hover, .btn-default:focus, .btn-default a, .socialbox a, .pager li a { color: ' . of_get_option('button_text_color') . ' ;} .socialbox a:hover { background: ' . of_get_option('button_text_color') . ' ;}' ; } ?>

<?php $color = of_get_option('footer_text_color');
if ($color) { echo '#foot, #foot a, #foot ul li a { color: ' . of_get_option('footer_text_color') . ' ;}' ; } ?>

</style>
