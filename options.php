<?php

function avedontheme_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$avedontheme_settings = get_option( 'avedontheme' );
	$avedontheme_settings['id'] = $themename;
	update_option( 'avedontheme', $avedontheme_settings );
}

function avedontheme_options() {


	$supereffects = array(
		'1' => __('Fade', 'avedon_theme_options'),
		'2' => __('Slide Top', 'avedon_theme_options'),
		'3' => __('Slide Right', 'avedon_theme_options'),
		'4' => __('Slide Bottom', 'avedon_theme_options'),
		'5' => __('Slide Left', 'avedon_theme_options'),
		'6' => __('Carousel Right', 'avedon_theme_options'),
		'7' => __('Carousel Left', 'avedon_theme_options')
	);

	$navbar_attachments = array(
		'navbar-fixed-top' => __('Fixed Top', 'avedon_theme_options'),
		'navbar-fixed-bottom' => __('Fixed Bottom', 'avedon_theme_options'),
		'navbar-static-top' => __('Static', 'avedon_theme_options')
	);

	$navbar_body_padding = array(
		'20px' => __('20px', 'avedon_theme_options'),
		'40px' => __('40px', 'avedon_theme_options'),
		'60px' => __('60px', 'avedon_theme_options'),
		'80px' => __('80px', 'avedon_theme_options'),
		'100px' => __('100px', 'avedon_theme_options'),
		'120px' => __('120px', 'avedon_theme_options'),
		'140px' => __('140px', 'avedon_theme_options')
	);

	$images_number = array(
		'two' => __('Two', 'avedon_theme_options'),
		'three' => __('Three', 'avedon_theme_options'),
		'four' => __('Four', 'avedon_theme_options'),
		'five' => __('Five', 'avedon_theme_options'),
		'none' => __('None', 'avedon_theme_options')
	);

	$superopts_array = array(
		'autoplay' => __('Autoplay Images', 'avedon_theme_options'),
		'randomimgs' => __('Random Order', 'avedon_theme_options'),
		'scrollarrows' => __('Scrolling Arrows', 'avedon_theme_options'),
		'slidecount' => __('Slide Counter', 'avedon_theme_options'),
		'slidecaption' => __('Slide Caption', 'avedon_theme_options'),
		'slidelist' => __('Nav Dots', 'avedon_theme_options')
	);

	$superopts_defaults = array(
		'autoplay' => '1',
		'randomimgs'  => '0',
		'scrollarrows' => '0',
		'slidecount' => '0',
		'slidecaption' => '0',
		'slidelist' => '1'
	);

	// Typography Defaults
	$typography_defaults = array(
		'size' => '18px',
		'face' => 'arial',
		'style' => 'bold',
		'color' => '#0088CC' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	$typography_mixed_fonts = array_merge( options_typography_get_os_fonts() , options_typography_get_google_fonts() );
	asort($typography_mixed_fonts);


	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/inc/images/';

	$options = array();

	$options[] = array(
		'name' => __('Basic Settings', 'avedon_theme_options'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Primary Logo', 'avedon_theme_options'),
		'desc' => __('Logo goes in the top left and is cropped to 30px tall (transparent .png is preferred). ', 'avedon_theme_options'),
		'id' => 'primary_logo',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Navbar Attachment', 'avedon_theme_options'),
		'desc' => __('Select the placement of your primary menu.', 'avedon_theme_options'),
		'id' => 'navbar_attachment',
		'std' => 'navbar-static-top',
		'type' => 'select',
		'options' => $navbar_attachments);

	$options[] = array(
		'name' => __('Fixed Navbar Padding', 'avedon_theme_options'),
		'desc' => __('Select the fixed menu padding - to allow for larger menus (applies to fixed menus on large width screensize).', 'avedon_theme_options'),
		'id' => 'navbar_padding',
		'std' => '140px',
		'type' => 'select',
		'options' => $navbar_body_padding);

	$options[] = array(
		'name' => __('Header / Footer Background Color', 'avedon_theme_options'),
		'desc' => __('Select the background color for the top menu, call to action, and footer.', 'avedon_theme_options'),
		'id' => 'header_color',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Homepage Header Text', 'avedon_theme_options'),
		'desc' => __('Greet your visitors (Homepage H1 text).', 'avedon_theme_options'),
		'id' => 'headertext',
		'std' => 'Greetings and welcome to our website...',
		'type' => 'text');

	$options[] = array( 'name' => 'Menu Text',
		'desc' => 'Google fonts mixed with system fonts.',
		'id' => 'menu_font',
		'std' => array( 'size' => '16px', 'face' => 'Arial, serif', 'color' => '#757575'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts,
		'styles' => false )
	);

	$options[] = array( 'name' => 'Header Text',
		'desc' => 'Set the primary header font.',
		'id' => 'header_font',
		'std' => array( 'size' => '18px', 'face' => 'Arial, serif', 'color' => '#4BAAD3'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts,
		'styles' => false )
	);

	$options[] = array(
		'name' => __('General Link Color', 'avedon_theme_options'),
		'desc' => __('Set the color of your content links.', 'avedon_theme_options'),
		'id' => 'link_color',
		'std' => '#666666',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Button Text Color', 'avedon_theme_options'),
		'desc' => __('Set the color of text on your buttons.', 'avedon_theme_options'),
		'id' => 'button_text_color',
		'std' => '#4BAAD3',
		'type' => 'color' );


	$options[] = array(
		'name' => "Invert Colors",
		'desc' => "Invert the white and black portions of the site layout. (Light to dark).",
		'id' => "invert_color",
		'std' => "color-light",
		'type' => "images",
		'options' => array(
			'color-light' => $imagepath . 'avedon-light.jpg',
			'color-dark' => $imagepath . 'avedon-dark.jpg')
	);

	$options[] = array(
		'name' => __('Middle Background Color', 'avedon_theme_options'),
		'desc' => __('Select the background color for your middle widget content.', 'avedon_theme_options'),
		'id' => 'middle_color',
		'std' => '#4BAAD3',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Middle Text Color', 'avedon_theme_options'),
		'desc' => __('Set the color of your middle text.', 'avedon_theme_options'),
		'id' => 'middle_text_color',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Bottom Background Color', 'avedon_theme_options'),
		'desc' => __('Select the background color for your bottom content.', 'avedon_theme_options'),
		'id' => 'bottom_color',
		'std' => '#F5F5F5',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Bottom Text Color', 'avedon_theme_options'),
		'desc' => __('Set the color of your middle text.', 'avedon_theme_options'),
		'id' => 'bottom_text_color',
		'std' => '#333333',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Footer Text', 'avedon_theme_options'),
		'desc' => __('Include your footer text.', 'avedon_theme_options'),
		'id' => 'footer_text',
		'std' => 'WordPress.com',
		'type' => 'text');

	$options[] = array(
		'name' => __('Footer Text Color', 'avedon_theme_options'),
		'desc' => __('Set the color of your footer text.', 'avedon_theme_options'),
		'id' => 'footer_text_color',
		'type' => 'color' );

	$options[] = array(
		'name' => __('404 Text', 'avedon_theme_options'),
		'desc' => __('H1 Header for your 404 page.', 'avedon_theme_options'),
		'id' => 'fourofour_text',
		'std' => 'Oops. Sorry about that...',
		'type' => 'text');

	$options[] = array(
		'name' => __('Social', 'avedon_theme_options'),
		'type' => 'heading');


	$options[] = array(
		'name' => __('Enable Social Icons', 'avedon_theme_options'),
		'desc' => __('Click here to enable links to your social profiles.', 'avedon_theme_options'),
		'id' => 'social_icons',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Twitter Link', 'avedon_theme_options'),
		'desc' => __('Twitter Link', 'avedon_theme_options'),
		'id' => 'twitter_uid',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Google+ Link', 'avedon_theme_options'),
		'desc' => __('Google+ Link', 'avedon_theme_options'),
		'id' => 'googleplus_uid',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Facebook Link', 'avedon_theme_options'),
		'desc' => __('Facebook Link', 'avedon_theme_options'),
		'id' => 'facebook_uid',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('StumbleUpon Link', 'avedon_theme_options'),
		'desc' => __('StumbleUpon Link', 'avedon_theme_options'),
		'id' => 'stumble_uid',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Pinterest Link', 'avedon_theme_options'),
		'desc' => __('Pinterest Link', 'avedon_theme_options'),
		'id' => 'pinterest_uid',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Flickr Link', 'avedon_theme_options'),
		'desc' => __('Flickr Link', 'avedon_theme_options'),
		'id' => 'flickr_uid',
		'class' => 'hidden',
		'type' => 'text');


	$options[] = array(
		'name' => __('Instagram Link', 'avedon_theme_options'),
		'desc' => __('Instagram Link', 'avedon_theme_options'),
		'id' => 'instagram_uid',
		'class' => 'hidden',
		'type' => 'text');


	$options[] = array(
		'name' => __('Foursquare Link', 'avedon_theme_options'),
		'desc' => __('Foursquare Link', 'avedon_theme_options'),
		'id' => 'foursquare_uid',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Youtube Link', 'avedon_theme_options'),
		'desc' => __('Youtube Link', 'avedon_theme_options'),
		'id' => 'youtube_uid',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Vimeo Link', 'avedon_theme_options'),
		'desc' => __('Vimeo Link', 'avedon_theme_options'),
		'id' => 'vimeo_uid',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('LinkedIn Link', 'avedon_theme_options'),
		'desc' => __('LinkedIn Link', 'avedon_theme_options'),
		'id' => 'linkedin_uid',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Dribbble Link', 'avedon_theme_options'),
		'desc' => __('Dribbble Link', 'avedon_theme_options'),
		'id' => 'dribbble_uid',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Forrst Link', 'avedon_theme_options'),
		'desc' => __('Forrst Link', 'avedon_theme_options'),
		'id' => 'forrst_uid',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Wordpress Link', 'avedon_theme_options'),
		'desc' => __('Wordpress Link', 'avedon_theme_options'),
		'id' => 'wordpress_uid',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Soundcloud Link', 'avedon_theme_options'),
		'desc' => __('Soundcloud Link', 'avedon_theme_options'),
		'id' => 'soundcloud_uid',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('LastFM Link', 'avedon_theme_options'),
		'desc' => __('LastFM Link', 'avedon_theme_options'),
		'id' => 'lastfm_uid',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('RSS Link', 'avedon_theme_options'),
		'desc' => __('RSS Link', 'avedon_theme_options'),
		'id' => 'rss_uid',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Email Icon', 'avedon_theme_options'),
		'desc' => __('Email address for the mobile menubar and metadata. (ex: noreply@email.com)', 'avedon_theme_options'),
		'id' => 'emailicon',
		'type' => 'text');

	$options[] = array(
		'name' => __('Map Icon', 'avedon_theme_options'),
		'desc' => __('Map link for the mobile menubar and metadata. (ex: http://shortmaplink.com)', 'avedon_theme_options'),
		'id' => 'mapicon',
		'type' => 'text');

	$options[] = array(
		'name' => __('Phone Icon', 'avedon_theme_options'),
		'desc' => __('Phone number link for the mobile menubar (w/ dashes). (ex: 1-555-867-5309)', 'avedon_theme_options'),
		'id' => 'phoneicon',
		'type' => 'text');

	$options[] = array(
		'name' => __('Background', 'avedon_theme_options'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('', 'avedon_theme_options'),
		'desc' => __('If using a single image or color please use the <a href="../wp-admin/themes.php?page=custom-background">built in background editor</a>. If you prefer using multiple images be sure to enable SuperSize below.', 'avedon_theme_options'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Enable Supersize', 'avedon_theme_options'),
		'desc' => __('Click here to enable Supersize.', 'avedon_theme_options'),
		'id' => 'show_supersize',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Transition Effect', 'avedon_theme_options'),
		'desc' => __('Select your image transition.', 'avedon_theme_options'),
		'id' => 'super_effects',
		'std' => '1',
		'type' => 'select',
		'class' => 'hidden',
		'options' => $supereffects);

	$options[] = array(
		'name' => __('Transition Slide Interval', 'avedon_theme_options'),
		'desc' => __('Slide transition time (in ms).', 'avedon_theme_options'),
		'id' => 'super_translideint',
		'class' => 'hidden',
		'std' => '6000',
		'type' => 'text');

	$options[] = array(
		'name' => __('Transition Speed', 'avedon_theme_options'),
		'desc' => __('Slide time (in ms).', 'avedon_theme_options'),
		'id' => 'super_transpeed',
		'class' => 'hidden',
		'std' => '3000',
		'type' => 'text');

	$options[] = array(
		'name' => __('Supersize Options', 'avedon_theme_options'),
		'desc' => __('Select your Supersize additions.', 'avedon_theme_options'),
		'id' => 'super_array',
		'class' => 'hidden',
		'std' => $superopts_defaults,
		'type' => 'multicheck',
		'options' => $superopts_array);

	$options[] = array(
		'name' => __('Supersize Images', 'avedon_theme_options'),
		'desc' => __('Select the number of rotating background images. Save options to populate images below and ensure Supersize is enabled to display.', 'avedon_theme_options'),
		'id' => 'radio_images',
		'std' => 'none',
		'type' => 'radio',
		'options' => $images_number);

	$options[] = array(
		'name' => __('Supersize Image One', 'avedon_theme_options'),
		'desc' => __('First Supersize image.', 'avedon_theme_options'),
		'id' => 'radio_image_one',
		'class' => 'hidden',
		'type' => 'upload');

	$options[] = array(
		'name' => __('', 'avedon_theme_options'),
		'desc' => __('Supersize Image One - Credit', 'avedon_theme_options'),
		'id' => 'radio_image_one_credit',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Supersize Image Two', 'avedon_theme_options'),
		'desc' => __('Second Supersize image.', 'avedon_theme_options'),
		'id' => 'radio_image_two',
		'class' => 'hidden',
		'type' => 'upload');

	$options[] = array(
		'name' => __('', 'avedon_theme_options'),
		'desc' => __('Supersize Image Two - Credit', 'avedon_theme_options'),
		'id' => 'radio_image_two_credit',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Supersize Image - Three', 'avedon_theme_options'),
		'desc' => __('Third Supersize image.', 'avedon_theme_options'),
		'id' => 'radio_image_three',
		'class' => 'hidden',
		'type' => 'upload');

	$options[] = array(
		'name' => __('', 'avedon_theme_options'),
		'desc' => __('Supersize Image Three - Credit', 'avedon_theme_options'),
		'id' => 'radio_image_three_credit',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Supersize Image - Four', 'avedon_theme_options'),
		'desc' => __('Fourth Supersize image.', 'avedon_theme_options'),
		'id' => 'radio_image_four',
		'class' => 'hidden',
		'type' => 'upload');

	$options[] = array(
		'name' => __('', 'avedon_theme_options'),
		'desc' => __('Supersize Image Four - Credit', 'avedon_theme_options'),
		'id' => 'radio_image_four_credit',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('Supersize Image - Five', 'avedon_theme_options'),
		'desc' => __('Fifth Supersize image.', 'avedon_theme_options'),
		'id' => 'radio_image_five',
		'class' => 'hidden',
		'type' => 'upload');

	$options[] = array(
		'name' => __('', 'avedon_theme_options'),
		'desc' => __('Supersize Image Five - Credit', 'avedon_theme_options'),
		'id' => 'radio_image_five_credit',
		'class' => 'hidden',
		'type' => 'text');

	$options[] = array(
		'name' => __('', 'avedon_theme_options'),
		'desc' => __('Supersize is a fullsize background rotator. Be sure that no other backgrounds are set and include your images in sequential order as you would like them to appear. The theme will check to ensure Supersize scripts are enabled, read the number of images, then pull them and rotate as your settings determine.', 'avedon_theme_options'),
		'type' => 'info');

	$options[] = array(
		'name' => __('About', 'avedon_theme_options'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Avedon Wordpress Theme', 'avedon_theme_options'),
		'desc' => __('<p>Avedon is a Wordpress Theme designed to utilize a lot of technologies that much brighter folks have built (see below). Any and all respect should be given to them. Haeck Design is always available for projects, but since it is a theme - support cant be guaranteed. That said, we will always do our best to respond to functional issues in a timely manner.<hr /><h4>Demo</h4><p>http://demo.haeckdesign.com/avedon/</p><hr /><h4>Support</h4><p>http://code.google.com/p/avedon/</p><hr /><h4>Purchase Advanced Version</h4><p>Buy an advanced version of the Avedon theme by visiting our demo page and clicking the "buy" button.</p><hr /><h4>Credits</h4><ul class="line"><li>For more information regarding Bootstrap, please refer to http://getbootstrap.com</li><li>For more information regarding Supersize, please refer to BuildInternet.com</li><li>For more information regarding Wordpress, please refer to the Wordpress Codex</li></ul>', 'avedon_theme_options'),
		'type' => 'info');

	return $options;
}