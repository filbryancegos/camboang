<?php
// Add Custom Controls
require_once PARENT_DIR . '/admin/customizer/layout/pattern-picker-custom-control.php';
require_once PARENT_DIR . '/admin/customizer/text/textarea-custom-control.php';
require_once PARENT_DIR . '/admin/customizer/text/separator-custom-control.php';
require_once PARENT_DIR . '/admin/customizer/select/google-font-dropdown-custom-control.php';
require_once PARENT_DIR . '/admin/customizer/google-fonts.php';
require_once PARENT_DIR . '/admin/customizer/system-fonts.php';
require_once PARENT_DIR . '/admin/customizer/patterns.php';
require_once PARENT_DIR . '/admin/customizer/font-weights.php';
require_once PARENT_DIR . '/admin/customizer/import-export.php';

add_action( 'customize_register', 'options_theme_customizer_register' );
function options_theme_customizer_register($wp_customize) {

	/**
	 * Layout section
	 */
    $wp_customize->add_section(
        'layout_section',
        array(
            'title' => 'General &amp; Layout',
            'description' => 'Various layout options.',
            'priority' => 1,
        )
    );

    	/* layout style */
    	$wp_customize->add_setting(
		    'layout_style',
		    array(
		        'default' => 'horizontal',
		    )
		);
		$wp_customize->add_control(
		    'layout_style',
		    array(
		        'type' => 'select',
		        'label' => 'Select the layout style',
		        'section' => 'layout_section',
		        'choices' => array(
		            'horizontal' => 'Horizontal (menu on top)',
					'vertical' => 'Vertical (menu on the right)'
		        ),
		        'priority' => 2,
		    )
		);

		/* Site preloader */
    	$wp_customize->add_setting(
		    'site_preloader',
		    array(
		        'default' => '1',
		    )
		);
		$wp_customize->add_control(
		    'site_preloader',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Enable/disable the site preloader?',
		        'section' => 'layout_section',
		        'priority' => 3,
		        'settings'   => 'site_preloader',
		    )
		);

		/* Retina */
    	$wp_customize->add_setting(
		    'retina',
		    array(
		        'default' => '1',
		    )
		);
		$wp_customize->add_control(
		    'retina',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Enable/disable retina images support?',
		        'section' => 'layout_section',
		        'priority' => 4,
		        'settings'   => 'retina',
		    )
		);

		/* LazyLoad */
    	$wp_customize->add_setting(
		    'lazyload',
		    array(
		        'default' => '1',
		    )
		);
		$wp_customize->add_control(
		    'lazyload',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Enable/disable lazyload on images',
		        'section' => 'layout_section',
		        'priority' => 5,
		        'settings'   => 'lazyload',
		    )
		);

	/**
	 * Logo section
	 */
    $wp_customize->add_section(
        'logos_section',
        array(
            'title' => 'Logos',
            'description' => 'Upload theme logos',
            'priority' => 2,
        )
    );
    	/* Tagline check */
    	$wp_customize->add_setting(
		    'tagline_check',
		    array(
		        'default' => true,
		    )
		);
		$wp_customize->add_control(
		    'tagline_check',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Display site tagline?',
		        'section' => 'title_tagline',
		        'settings'   => 'tagline_check',
		    )
		);

		/* Separator */
    	$wp_customize->add_setting('logo_separator');
		$wp_customize->add_control(
		    new Separator_Custom_Control(
		        $wp_customize,
		        'logo_separator',
		        array(
			        'section' => 'logos_section',
			        'priority' => 1,
		        )
		    )
		);
    	/* Main logo check */
    	$wp_customize->add_setting(
		    'logo_check',
		    array(
		        'default' => false,
		    )
		);
		$wp_customize->add_control(
		    'logo_check',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Display a custom image/logo image in place of title header. For retina display please upload the logo at twice the normal size.',
		        'section' => 'logos_section',
		        'priority' => 1,
		        'settings'   => 'logo_check',
		    )
		);
		
    	/* Main logo */
    	$wp_customize->add_setting(
		    'main_logo',
		    array(
		        'default'      => ''
		    )
		);
		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'main_logo',
		        array(
		            'label'    => 'Logo',
		            'settings' => 'main_logo',
		            'section'  => 'logos_section',
		            'priority' => 2,
		        )
		    )
		);
		
		/* Logo width */
		$wp_customize->add_setting(
		    'logo_width',
		    array(
		        'default' => '',
		    )
		);
		$wp_customize->add_control(
		    'logo_width',
		    array(
		        'label' => 'Logo width',
		        'section' => 'logos_section',
		        'type' => 'text',
		        'priority' => 3,
		    )
		);

		/* Logo height */
		$wp_customize->add_setting(
		    'logo_height',
		    array(
		        'default' => '',
		    )
		);
		$wp_customize->add_control(
		    'logo_height',
		    array(
		        'label' => 'Logo height',
		        'section' => 'logos_section',
		        'type' => 'text',
		        'priority' => 4,
		    )
		);

		/* Logo margin-top */
		$wp_customize->add_setting(
		    'logo_margin_top',
		    array(
		        'default' => '0',
		    )
		);
		$wp_customize->add_control(
		    'logo_margin_top',
		    array(
		        'label' => 'Logo margin top (in px)',
		        'section' => 'logos_section',
		        'type' => 'text',
		        'priority' => 5,
		    )
		);

		/* Main logo retina */
    	$wp_customize->add_setting(
		    'main_logo_retina',
		    array(
		        'default'      => ''
		    )
		);
		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'main_logo_retina',
		        array(
		            'label'    => 'Retina Logo (@2x)',
		            'settings' => 'main_logo_retina',
		            'section'  => 'logos_section',
		            'priority' => 6,
		        )
		    )
		);

		/* Separator */
    	$wp_customize->add_setting('admin_logo_separator');
		$wp_customize->add_control(
		    new Separator_Custom_Control(
		        $wp_customize,
		        'admin_logo_separator',
		        array(
			        'section' => 'logos_section',
			        'priority' => 7,
		        )
		    )
		);

		/* WP admin logo check */
    	$wp_customize->add_setting(
		    'admin_logo_check',
		    array(
		        'default' => false,
		    )
		);
		$wp_customize->add_control(
		    'admin_logo_check',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Display a custom image/logo on the wp admin login area.',
		        'section' => 'logos_section',
		        'priority' => 8,
		    )
		);
		/* WP admin logo */
    	$wp_customize->add_setting(
		    'admin_logo',
		    array(
		        'default'      => ''
		    )
		);
		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'admin_logo',
		        array(
		            'label'    => 'WP Admin Logo',
		            'settings' => 'admin_logo',
		            'section'  => 'logos_section',
		            'priority' => 9,
		        )
		    )
		);
		
		/* WP Admin Logo width */
		$wp_customize->add_setting(
		    'admin_logo_width',
		    array(
		        'default' => '',
		    )
		);
		$wp_customize->add_control(
		    'admin_logo_width',
		    array(
		        'label' => 'WP Admin Logo width',
		        'section' => 'logos_section',
		        'type' => 'text',
		        'priority' => 10,
		    )
		);

		/* WP Admin Logo height */
		$wp_customize->add_setting(
		    'admin_logo_height',
		    array(
		        'default' => '',
		    )
		);
		$wp_customize->add_control(
		    'admin_logo_height',
		    array(
		        'label' => 'WP Admin Logo height',
		        'section' => 'logos_section',
		        'type' => 'text',
		        'priority' => 11,
		    )
		);

		/* Separator */
    	$wp_customize->add_setting('favicon_separator');
		$wp_customize->add_control(
		    new Separator_Custom_Control(
		        $wp_customize,
		        'favicon_separator',
		        array(
			        'section' => 'logos_section',
			        'priority' => 12,
		        )
		    )
		);

		/* Favicon logo */
    	$wp_customize->add_setting(
		    'favicon_logo',
		    array(
		        'default'      => ''
		    )
		);
		$wp_customize->add_control(
		    new WP_Customize_Image_Control (
		        $wp_customize,
		        'favicon_logo',
		        array(
		            'label'    => 'Favicon Logo (16x16px)',
		            'settings' => 'favicon_logo',
		            'section'  => 'logos_section',
		            'priority' => 13,
		        )
		    )
		);

	/**
	 * Header section
	 */
    $wp_customize->add_section(
        'header_section',
        array(
            'title' => 'Header',
            'description' => 'Various header options.',
            'priority' => 3,
        )
    );

    	/* Header style */
    	$wp_customize->add_setting(
		    'header_style',
		    array(
		        'default' => 'style1',
		    )
		);
		$wp_customize->add_control(
		    'header_style',
		    array(
		        'type' => 'select',
		        'label' => 'Select the header style',
		        'section' => 'header_section',
		        'choices' => array(
		            'style1' => 'Style 1',
					'style2' => 'Style 2'
		        ),
		        'priority' => 1,
		    )
		);

		/* Menu width */
    	$wp_customize->add_setting(
		    'menu_width',
		    array(
		        'default' => 'col-md-4',
		    )
		);
		$wp_customize->add_control(
		    'menu_width',
		    array(
		        'type' => 'select',
		        'label' => 'Select the menu width',
		        'section' => 'header_section',
		        'choices' => array(
		            'col-md-2' => '16%',
		            'col-md-3' => '25%',
		            'col-md-4' => '33%',
		            'col-md-5' => '41%',
		            'col-md-6' => '50%',
		            'col-md-7' => '58%',
		            'col-md-8' => '66%',
		            'col-md-9' => '75%',
		            'col-md-10' => '83%'
		        ),
		        'priority' => 2,
		    )
		);

		/* Menu columns */
    	$wp_customize->add_setting(
		    'menu_columns',
		    array(
		        'default' => '4',
		    )
		);
		$wp_customize->add_control(
		    'menu_columns',
		    array(
		        'type' => 'select',
		        'label' => 'Select the menu columns',
		        'section' => 'header_section',
		        'choices' => array(
		            '1' => '1 Column',
		            '2' => '2 Columns',
		            '3' => '3 Columns',
		            '4' => '4 Columns',
		            '5' => '5 Columns',
		            '6' => '6 Columns',
		            '7' => '7 Columns',
		            '8' => '8 Columns',
		            '9' => '9 Columns'
		        ),
		        'priority' => 3,
		    )
		);
	
		/* WPML language box */
    	$wp_customize->add_setting(
		    'header_wpml_box',
		    array(
		        'default' => '1',
		    )
		);
		$wp_customize->add_control(
		    'header_wpml_box',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Enable/Disable header WPML language box. WPML plugin must be installed.',
		        'section' => 'header_section',
		        'priority' => 4,
		    )
		);

	/**
	 * Footer section
	 */
    $wp_customize->add_section(
        'footer_section',
        array(
            'title' => 'Footer',
            'description' => 'Various footer options.',
            'priority' => 999,
        )
    );

    	/* Footer widgets */
    	$wp_customize->add_setting(
		    'footer_widgets',
		    array(
		        'default' => '1',
		    )
		);
		$wp_customize->add_control(
		    'footer_widgets',
		    array(
		        'type' => 'checkbox',
		        'label' => ' Enable/Disable footer widgets.',
		        'section' => 'footer_section',
		        'priority' => 2,
		    )
		);

	/**
	 * Comments section
	 */
    $wp_customize->add_section(
        'comments_section',
        array(
            'title' => 'Comments',
            'description' => 'Choose to enable/disable comments on all pages or posts.',
            'priority' => 998,
        )
    );
    	/* Page comments */
    	$wp_customize->add_setting(
		    'general_page_comments'
		);
		$wp_customize->add_control(
		    'general_page_comments',
		    array(
		        'type' => 'checkbox',
		        'label' => ' Enable/Disable comments on all pages.',
		        'section' => 'comments_section',
		        'priority' => 1,
		    )
		);
		/* Posts comments */
    	$wp_customize->add_setting(
		    'general_post_comments',
		    array(
		        'default' => '1',
		    )
		);
		$wp_customize->add_control(
		    'general_post_comments',
		    array(
		        'type' => 'checkbox',
		        'label' => ' Enable/Disable comments on all posts..',
		        'section' => 'comments_section',
		        'priority' => 2,
		    )
		);

	/**
	 * Custom CSS section
	 */
    $wp_customize->add_section(
        'css_section',
        array(
            'title' => 'Custom CSS',
            'description' => 'Your custom CSS goes here. Do not include the style tag.This is already done for you.',
            'priority' => 998,
        )
    );
		
		$wp_customize->add_setting( 
			'custom_css' 
		);
		$wp_customize->add_control(
		    new Textarea_Custom_Control(
		        $wp_customize,
		        'custom_css',
		        array(
		            'label' => 'CSS',
		            'section' => 'css_section',
		            'priority' => 1
		        )
		    )
		);

	/**
	 * Custom Scripts section
	 */
    $wp_customize->add_section(
        'js_section',
        array(
            'title' => 'Custom Scripts',
            'description' => 'Add custom footer scripts such as Google Analytics. Do not include the script tag. This is already done for you.',
            'priority' => 997,
        )
    );
		
		$wp_customize->add_setting( 
			'custom_js' 
		);
		$wp_customize->add_control(
		    new Textarea_Custom_Control(
		        $wp_customize,
		        'custom_js',
		        array(
		            'label' => 'JS',
		            'section' => 'js_section',
		            'priority' => 1
		        )
		    )
		);

	/**
	 * Social Media section
	 */
    $wp_customize->add_section(
        'social_section',
        array(
            'title' => 'Social Media',
            'description' => 'Add your social icons.',
            'priority' => 996,
        )
    );
    	/* RSS link */
		$wp_customize->add_setting(
		    'rss_link'
		);
		$wp_customize->add_control(
		    'rss_link',
		    array(
		        'label' => 'RSS Link (Widget)',
		        'section' => 'social_section',
		        'type' => 'text',
		        'priority' => 1,
		    )
		);

		/* Facebook Link (Widget) */
		$wp_customize->add_setting(
		    'facebook_link'
		);
		$wp_customize->add_control(
		    'facebook_link',
		    array(
		        'label' => 'Facebook Link (Widget)',
		        'section' => 'social_section',
		        'type' => 'text',
		        'priority' => 2,
		    )
		);

		/* Twitter Link (Widget) */
		$wp_customize->add_setting(
		    'twitter_link',
		    array(
		        'default' => 'okwpthemes',
		    )
		);
		$wp_customize->add_control(
		    'twitter_link',
		    array(
		        'label' => 'Twitter Link (Widget)',
		        'section' => 'social_section',
		        'type' => 'text',
		        'priority' => 3,
		    )
		);

		/* Skype Link (Widget) */
		$wp_customize->add_setting(
		    'skype_link'
		);
		$wp_customize->add_control(
		    'skype_link',
		    array(
		        'label' => 'Skype Link (Widget)',
		        'section' => 'social_section',
		        'type' => 'text',
		        'priority' => 4,
		    )
		);

		/* Vimeo Link (Widget) */
		$wp_customize->add_setting(
		    'vimeo_link'
		);
		$wp_customize->add_control(
		    'vimeo_link',
		    array(
		        'label' => 'Vimeo Link (Widget)',
		        'section' => 'social_section',
		        'type' => 'text',
		        'priority' => 5,
		    )
		);

		/* LinkedIn Link (Widget) */
		$wp_customize->add_setting(
		    'linkedin_link'
		);
		$wp_customize->add_control(
		    'linkedin_link',
		    array(
		        'label' => 'LinkedIn Link (Widget)',
		        'section' => 'social_section',
		        'type' => 'text',
		        'priority' => 6,
		    )
		);

		/* Dribble Link (Widget) */
		$wp_customize->add_setting(
		    'dribble_link'
		);
		$wp_customize->add_control(
		    'dribble_link',
		    array(
		        'label' => 'Dribble Link (Widget)',
		        'section' => 'social_section',
		        'type' => 'text',
		        'priority' => 7,
		    )
		);

		/* Forrst Link (Widget) */
		$wp_customize->add_setting(
		    'forrst_link'
		);
		$wp_customize->add_control(
		    'forrst_link',
		    array(
		        'label' => 'Forrst Link (Widget)',
		        'section' => 'social_section',
		        'type' => 'text',
		        'priority' => 8,
		    )
		);

		/* Flickr Link (Widget) */
		$wp_customize->add_setting(
		    'flickr_link'
		);
		$wp_customize->add_control(
		    'flickr_link',
		    array(
		        'label' => 'Flickr Link (Widget)',
		        'section' => 'social_section',
		        'type' => 'text',
		        'priority' => 9,
		    )
		);

		/* Google Link (Widget) */
		$wp_customize->add_setting(
		    'google_link'
		);
		$wp_customize->add_control(
		    'google_link',
		    array(
		        'label' => 'Google Link (Widget)',
		        'section' => 'social_section',
		        'type' => 'text',
		        'priority' => 10,
		    )
		);

		/* Youtube Link (Widget) */
		$wp_customize->add_setting(
		    'youtube_link'
		);
		$wp_customize->add_control(
		    'youtube_link',
		    array(
		        'label' => 'Youtube Link (Widget)',
		        'section' => 'social_section',
		        'type' => 'text',
		        'priority' => 11,
		    )
		);

		/* Tumblr Link (Widget) */
		$wp_customize->add_setting(
		    'tumblr_link'
		);
		$wp_customize->add_control(
		    'tumblr_link',
		    array(
		        'label' => 'Tumblr Link (Widget)',
		        'section' => 'social_section',
		        'type' => 'text',
		        'priority' => 12,
		    )
		);

		/* Pinterest Link (Widget) */
		$wp_customize->add_setting(
		    'pinterest_link',
		    array(
		        'default' => '',
		    )
		);
		$wp_customize->add_control(
		    'pinterest_link',
		    array(
		        'label' => 'Pinterest Link (Widget)',
		        'section' => 'social_section',
		        'type' => 'text',
		        'priority' => 13,
		    )
		);

		/* Deviantart Link (Widget) */
		$wp_customize->add_setting(
		    'deviantart_link',
		    array(
		        'default' => '',
		    )
		);
		$wp_customize->add_control(
		    'deviantart_link',
		    array(
		        'label' => 'deviantart Link (Widget)',
		        'section' => 'social_section',
		        'type' => 'text',
		        'priority' => 14,
		    )
		);

		/* Foursquare Link (Widget) */
		$wp_customize->add_setting(
		    'foursquare_link',
		    array(
		        'default' => '',
		    )
		);
		$wp_customize->add_control(
		    'foursquare_link',
		    array(
		        'label' => 'foursquare Link (Widget)',
		        'section' => 'social_section',
		        'type' => 'text',
		        'priority' => 15,
		    )
		);

		/* Github Link (Widget) */
		$wp_customize->add_setting(
		    'github_link',
		    array(
		        'default' => '',
		    )
		);
		$wp_customize->add_control(
		    'github_link',
		    array(
		        'label' => 'github Link (Widget)',
		        'section' => 'social_section',
		        'type' => 'text',
		        'priority' => 16,
		    )
		);

		/* Instagram Link (Widget) */
		$wp_customize->add_setting(
		    'instagram_link',
		    array(
		        'default' => '',
		    )
		);
		$wp_customize->add_control(
		    'instagram_link',
		    array(
		        'label' => 'instagram Link (Widget)',
		        'section' => 'social_section',
		        'type' => 'text',
		        'priority' => 17,
		    )
		);

	/**
	 * Page templates section
	 */
    $wp_customize->add_section(
        'templates_section',
        array(
            'title' => 'Page templates',
            'description' => 'Customize the style of different pages',
            'priority' => 4,
        )
    );
    	/* Portfolio slug */
		$wp_customize->add_setting(
		    'property_cpt_slug',
		    array(
		        'default' => 'property-item',
		    )
		);
		$wp_customize->add_control(
		    'property_cpt_slug',
		    array(
		        'label' => 'property slug',
		        'section' => 'templates_section',
		        'type' => 'text',
		        'priority' => 1,
		    )
		);

		/* Separator */
    	$wp_customize->add_setting('property_archive_separator');
		$wp_customize->add_control(
		    new Separator_Custom_Control(
		        $wp_customize,
		        'property_archive_separator',
		        array(
		        	'label' => 'Property category/archive page',
			        'section' => 'templates_section',
			        'priority' => 5,
		        )
		    )
		);
		/* Category/archive page layout */
    	$wp_customize->add_setting(
		    'property_archive_layout',
		    array(
		        'default' => 'masonry',
		    )
		);
		$wp_customize->add_control(
		    'property_archive_layout',
		    array(
		        'type' => 'select',
		        'label' => 'Property Category/Archive page layout',
		        'section' => 'templates_section',
		        'choices' => array(
		            'fitRows' => 'Grid Fit rows',
					'masonry' => 'Grid Masonry'
		        ),
		        'priority' => 6,
		    )
		);
		/* Category/archive page style */
    	$wp_customize->add_setting(
		    'property_archive_style',
		    array(
		        'default' => 'nogap',
		    )
		);
		$wp_customize->add_control(
		    'property_archive_style',
		    array(
		        'type' => 'select',
		        'label' => 'Property Category/Archive page style',
		        'section' => 'templates_section',
		        'choices' => array(
		            'gap' => 'Gap',
					'nogap' => 'No gap'
		        ),
		        'priority' => 7,
		    )
		);
		/* Category/archive page columns */
    	$wp_customize->add_setting(
		    'property_archive_columns',
		    array(
		        'default' => '2',
		    )
		);
		$wp_customize->add_control(
		    'property_archive_columns',
		    array(
		        'type' => 'select',
		        'label' => 'Property Category/Archive page columns',
		        'section' => 'templates_section',
		        'choices' => array(
		            '1' => '1 Column',
		            '2' => '2 Columns',
		            '3' => '3 Columns',
		            '4' => '4 Columns'
		        ),
		        'priority' => 8,
		    )
		);
		
		/* Separator */
    	$wp_customize->add_setting('blog_archive_separator');
		$wp_customize->add_control(
		    new Separator_Custom_Control(
		        $wp_customize,
		        'blog_archive_separator',
		        array(
		        	'label' => 'Blog category/archive page',
			        'section' => 'templates_section',
			        'priority' => 17,
		        )
		    )
		);
		/* Category/archive page layout */
    	$wp_customize->add_setting(
		    'archive_page_layout',
		    array(
		        'default' => 'masonry',
		    )
		);
		$wp_customize->add_control(
		    'archive_page_layout',
		    array(
		        'type' => 'select',
		        'label' => 'Category/Archive page layout',
		        'section' => 'templates_section',
		        'choices' => array(
		            'fitRows' => 'Grid Fit rows',
					'masonry' => 'Grid Masonry'
		        ),
		        'priority' => 18,
		    )
		);
		/* Category/archive page style */
    	$wp_customize->add_setting(
		    'archive_page_style',
		    array(
		        'default' => 'nogap',
		    )
		);
		$wp_customize->add_control(
		    'archive_page_style',
		    array(
		        'type' => 'select',
		        'label' => 'Category/Archive page style',
		        'section' => 'templates_section',
		        'choices' => array(
		            'gap' => 'Gap',
					'nogap' => 'No gap'
		        ),
		        'priority' => 18,
		    )
		);
		/* Category/archive page columns */
    	$wp_customize->add_setting(
		    'archive_page_columns',
		    array(
		        'default' => '2',
		    )
		);
		$wp_customize->add_control(
		    'archive_page_columns',
		    array(
		        'type' => 'select',
		        'label' => 'Category/Archive page columns',
		        'section' => 'templates_section',
		        'choices' => array(
		            '1' => '1 Column',
		            '2' => '2 Columns',
		            '3' => '3 Columns',
		            '4' => '4 Columns'
		        ),
		        'priority' => 18,
		    )
		);

		/* Separator */
    	$wp_customize->add_setting('search_separator');
		$wp_customize->add_control(
		    new Separator_Custom_Control(
		        $wp_customize,
		        'search_separator',
		        array(
		        	'label' => 'Search page',
			        'section' => 'templates_section',
			        'priority' => 19,
		        )
		    )
		);
		/* Search page layout */
    	$wp_customize->add_setting(
		    'search_page_layout',
		    array(
		        'default' => 'masonry',
		    )
		);
		$wp_customize->add_control(
		    'search_page_layout',
		    array(
		        'type' => 'select',
		        'label' => 'Search page layout',
		        'section' => 'templates_section',
		        'choices' => array(
		            'fitRows' => 'Grid Fit rows',
					'masonry' => 'Grid Masonry'
		        ),
		        'priority' => 19,
		    )
		);
		/* Search page style */
    	$wp_customize->add_setting(
		    'search_page_style',
		    array(
		        'default' => 'gap',
		    )
		);
		$wp_customize->add_control(
		    'search_page_style',
		    array(
		        'type' => 'select',
		        'label' => 'Search page style',
		        'section' => 'templates_section',
		        'choices' => array(
		            'gap' => 'Gap',
					'nogap' => 'No gap'
		        ),
		        'priority' => 19,
		    )
		);
		/* Search page columns */
    	$wp_customize->add_setting(
		    'search_page_columns',
		    array(
		        'default' => '2',
		    )
		);
		$wp_customize->add_control(
		    'search_page_columns',
		    array(
		        'type' => 'select',
		        'label' => 'Search page columns',
		        'section' => 'templates_section',
		        'choices' => array(
		            '1' => '1 Column',
		            '2' => '2 Columns',
		            '3' => '3 Columns',
		            '4' => '4 Columns'
		        ),
		        'priority' => 19,
		    )
		);
		/* Separator */
    	$wp_customize->add_setting('not_found_separator');
		$wp_customize->add_control(
		    new Separator_Custom_Control(
		        $wp_customize,
		        'not_found_separator',
		        array(
		        	'label' => '404 page',
			        'section' => 'templates_section',
			        'priority' => 21,
		        )
		    )
		);
		/* Not found title */
		$wp_customize->add_setting(
		    'not_found_page_title',
		    array(
		        'default' => 'Ooops page not found ...',
		    )
		);
		$wp_customize->add_control(
		    'not_found_page_title',
		    array(
		        'label' => 'Not found title',
		        'section' => 'templates_section',
		        'type' => 'text',
		        'priority' => 22,
		    )
		);
		/* Not found description */
		$wp_customize->add_setting( 
			'not_found_page_description',
			array(
		        'default' => 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.',
		    ) 
		);
		$wp_customize->add_control(
		    new Textarea_Custom_Control(
		        $wp_customize,
		        'not_found_page_description',
		        array(
		            'label' => 'Not found description',
		            'section' => 'templates_section',
		            'priority' => 23
		        )
		    )
		);
		/* Contact button link */
		$wp_customize->add_setting(
		    'not_found_contact_btn_link',
		    array(
		        'default' => '#',
		    )
		);
		$wp_customize->add_control(
		    'not_found_contact_btn_link',
		    array(
		        'label' => 'Contact button link',
		        'section' => 'templates_section',
		        'type' => 'text',
		        'priority' => 24,
		    )
		);
		/* Search form */
    	$wp_customize->add_setting(
		    'not_found_page_search',
		    array(
		        'default' => '1',
		    )
		);
		$wp_customize->add_control(
		    'not_found_page_search',
		    array(
		        'type' => 'checkbox',
		        'label' => 'Enable/Disable search form on not found page',
		        'section' => 'templates_section',
		        'priority' => 25,
		    )
		);
	
	

    	
		/* Primary color */
		$wp_customize->add_setting(
		    'primary-color',
		    array(
		        'default' => '#1abc9c',
		        'sanitize_callback' => 'sanitize_hex_color'
		    )
		);

		$wp_customize->add_control(
		    new WP_Customize_Color_Control(
		        $wp_customize,
		        'primary-color',
		        array(
		            'label' => 'Primary color',
		            'section' => 'colors',
		            'settings' => 'primary-color',
		            'priority' => 1,
		        )
		    )
		);

		/* Secondary color */
		$wp_customize->add_setting(
		    'secondary-color',
		    array(
		        'default' => '#0c0f21',
		        'sanitize_callback' => 'sanitize_hex_color'
		    )
		);

		$wp_customize->add_control(
		    new WP_Customize_Color_Control(
		        $wp_customize,
		        'secondary-color',
		        array(
		            'label' => 'Secondary color',
		            'section' => 'colors',
		            'settings' => 'secondary-color',
		            'priority' => 2,
		        )
		    )
		);

		/* Separator */
    	$wp_customize->add_setting('font_colors_separator');
		$wp_customize->add_control(
		    new Separator_Custom_Control(
		        $wp_customize,
		        'font_colors_separator',
		        array(
		        	'label' => 'Font colors',
			        'section' => 'colors',
			        'priority' => 3,
		        )
		    )
		);

		/* Text color */
		$wp_customize->add_setting(
		    'text-color',
		    array(
		        'default' => '#18191a',
		        'sanitize_callback' => 'sanitize_hex_color'
		    )
		);

		$wp_customize->add_control(
		    new WP_Customize_Color_Control(
		        $wp_customize,
		        'text-color',
		        array(
		            'label' => 'Text color',
		            'section' => 'colors',
		            'settings' => 'text-color',
		            'priority' => 4,
		        )
		    )
		);

		/* Link color */
		$wp_customize->add_setting(
		    'link-color',
		    array(
		        'default' => '#1abc9c',
		        'sanitize_callback' => 'sanitize_hex_color'
		    )
		);

		$wp_customize->add_control(
		    new WP_Customize_Color_Control(
		        $wp_customize,
		        'link-color',
		        array(
		            'label' => 'Link color',
		            'section' => 'colors',
		            'settings' => 'link-color',
		            'priority' => 5,
		        )
		    )
		);

		/* Headings color */
		$wp_customize->add_setting(
		    'headings-color',
		    array(
		        'default' => '#18191a',
		        'sanitize_callback' => 'sanitize_hex_color'
		    )
		);

		$wp_customize->add_control(
		    new WP_Customize_Color_Control(
		        $wp_customize,
		        'headings-color',
		        array(
		            'label' => 'Headings color',
		            'section' => 'colors',
		            'settings' => 'headings-color',
		            'priority' => 6,
		        )
		    )
		);

		/* Separator */
    	$wp_customize->add_setting('background_color_separator');
		$wp_customize->add_control(
		    new Separator_Custom_Control(
		        $wp_customize,
		        'background_color_separator',
		        array(
		        	'label' => 'Background color',
			        'section' => 'colors',
			        'priority' => 7,
		        )
		    )
		);

	/**
	 * Fonts section
	 */
	global $fontWeightsArrays;

    $wp_customize->add_section(
        'fonts_section',
        array(
            'title' => 'Fonts',
            'description' => 'You have the possibility to select from 650 google fonts and from 6 system fonts (you find them at the beginning of the list).',
            'priority' => 5,
        )
    );
        
        $wp_customize->add_setting( 
        	'body_font', 
        	array(
            	'default' => 'eurofurence+regular',
        	) 
        );
        $wp_customize->add_control( 
        	new Google_Font_Dropdown_Custom_Control( 
        		$wp_customize, 
        		'body_font', 
        		array(
		            'label'   => 'Body font family. Default: eurofurence regular',
		            'section' => 'fonts_section',
		            'settings'   => 'body_font',
		            'priority' => 1,
		        ) 
		    )
		);

		//Headings
		$wp_customize->add_setting( 
        	'headings_font', 
        	array(
            	'default' => 'Raleway:100,200,300,400,500,600,700,800,900',
        	) 
        );

        $wp_customize->add_control( 
        	new Google_Font_Dropdown_Custom_Control( 
        		$wp_customize, 
        		'headings_font', 
        		array(
		            'label'   => 'Headings font. Default: Raleway',
		            'section' => 'fonts_section',
		            'settings'   => 'headings_font',
		            'priority' => 7,
		        ) 
		    )
		);

	/**
	 * Background section
	 */
	$wp_customize->get_section('background_image')->title = __( 'Background', 'okthemes');

		/* Select background type */
    	$wp_customize->add_setting(
		    'background_type_select',
		    array(
		        'default' => 'none',
		    )
		);
		$wp_customize->add_control(
		    'background_type_select',
		    array(
		        'type' => 'select',
		        'label' => 'Background type',
		        'section' => 'background_image',
		        'choices' => array(
		        	'none' => 'None',
		            'image' => 'Background image',
					'pattern' => 'Background pattern'
		        ),
		        'priority' => 1,
		    )
		);

		/* Patterns */
    	$wp_customize->add_setting('background_type_patterns');
		$wp_customize->add_control(
		    new Pattern_Picker_Custom_Control(
		        $wp_customize,
		        'background_type_patterns',
		        array(
		        	'label'   => 'Background pattern',
			        'section' => 'background_image',
			        'priority' => 3,
		        )
		    )
		);

}

/**
 * Registers the Theme Customizer Admin script with WordPress.
 */
function luxuryvilla_customizer_scripts() {

	wp_enqueue_script(
		'luxuryvilla-theme-customizer-admin',
		get_template_directory_uri() . '/admin/customizer/js/admin-theme-customizer.js',
		array( 'jquery' ),
		'NULL',
		true
	);

}
add_action( 'customize_controls_print_footer_scripts', 'luxuryvilla_customizer_scripts' );


function luxuryvilla_customizer_style()
{
    ?>
	<style type="text/css">
		
		hr {
			border-width: 8px;
			margin: 0;
		}
		.customizer-separator span.customize-control-title {
			background: #F7FCFE;
			font-size: 12px;
			text-align: center;
			color:#2EA2CC;
			padding: 8px 0;
			margin: 0;
		}
		.customize-layout-list ul li {
			display: inline-block;
		    text-align: center;
		    width: 78px;
		}
		.customize-layout-list ul li img{
			width: 100%;
		}
		#customize-control-background_type_patterns label {
			width: 50px;
			height: 50px;
			float: left;
			text-align: center;
		}

	</style>
    <?php
}

add_action( 'customize_controls_print_footer_scripts', 'luxuryvilla_customizer_style');


function mytheme_customize_css()
{
    ?>

    <?php
    global $systemFontTrimmedArrays, $googleFontArrays, $paternArray;
    $body_font = get_theme_mod('body_font','eurofurence+regular');
    $headings_font = get_theme_mod('headings_font','Raleway:100,200,300,400,500,600,700,800,900');

    $body_font_trimmed = str_replace('+', ' ', $body_font);
    $headings_font_trimmed = str_replace('+', ' ', $headings_font);

    $body_font_clean = explode(":", $body_font, 2);
    $headings_font_clean = explode(":", $headings_font, 2);
    ?>
    

	<?php if ( !in_array( $headings_font_trimmed, $systemFontTrimmedArrays ) ) { ?>
		<link href='//fonts.googleapis.com/css?family=<?php echo esc_html( $headings_font ); ?>' rel='stylesheet' type='text/css'>
	<?php } ?>

	<?php if ( !in_array( $body_font_trimmed, $systemFontTrimmedArrays ) ) { ?>
		<link href='//fonts.googleapis.com/css?family=<?php echo esc_html($body_font); ?>' rel='stylesheet' type='text/css'>
	<?php } ?>


	<style type="text/css">

		body {
			<?php if ( $body_font != 'eurofurence+regular' ) { ?>
			font-family: <?php echo str_replace('+', ' ', $body_font_clean[0]); ?>;
			<?php } ?>
			color: <?php echo get_theme_mod('text-color','#18191a'); ?>;
		
			<?php 
			if (get_theme_mod('background_type_select') == 'pattern') {
				$pattern = get_theme_mod('background_type_patterns');
				$pattern_url = $paternArray[$pattern];
			?>

			background: url('<?php echo esc_url($pattern_url); ?>') repeat left top !important;
			<?php } ?>
		}

		.gm-style {
			font-family: <?php echo str_replace('+', ' ', $body_font_clean[0]); ?>;
			font-size: 16px;
		}

		p.meta a,
		article.post h2.entry-title,
		article.post h2.entry-title a,
		article.post h2.entry-title a:hover,
		body.search article.page h2.entry-title,
		body.search article.page h2.entry-title a,
		body.search article.page h2.entry-title a:hover,
		body.search article.property_cpt h2.entry-title,
		body.search article.property_cpt h2.entry-title a,
		body.search article.property_cpt h2.entry-title a:hover,
		article.post footer ul.post-tags li a,
		.featured-icon-box h5,
		.featured-image-box h5 {
			font-family: <?php echo str_replace('+', ' ', $body_font_clean[0]); ?>;
		}

		p.meta a,
		article.post footer ul.post-tags li a,
		.nav-pills > li > a,
		.categories_filter a,
		.contact-map-wrapper .contact-map-overlay .contact-map-address-wrapper a.gg-contact-email,
		.contact-map-address-wrapper,
		.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a,
		.wpb_content_element .wpb_accordion_header a,
		.room-wrapper .room-price,
		.widget.widget_archive a,
		.widget.widget_calendar a,
		.widget.widget_categories a,
		.widget.widget_pages a,
		.widget.widget_meta a,
		.widget.widget_recent_comments a,
		.widget.widget_recent_entries a,
		.widget.widget_tag_cloud a,
		.widget.widget_nav_menu a,
		a.more-link,
		h1, 
		h2,
		h3,
		h4,
		h5,
		h6,
		cite,
		.btn,
		legend,
		.form-control,
		#site-title a.brand,
		#site-title small,
		#main-menu.nav > li > a,
		.dropdown-menu > li > a,
		.dropdown-header,
		.datepicker td,
		.datepicker th,
		.slideshow-property-meta ul.property-meta,
		.single-property-content ul.property-meta,
		.homepage-var3-property-meta ul.property-meta,
		.homepage-var5-property-meta ul.property-meta,
		.single-property-img-caption,
		.single-property-content-area .post-social .gg-share,
		.pagination > li > a,
		.pagination > li > span,
		.error404 #content .gg-404,
		#areas-map-controls .ullist li a,
		.contact-map-wrapper .contact-map-overlay .contact-map-address-wrapper,
		.booking-form-wrapper.form-inline label,
		.booking-form-wrapper legend span,
		.booking-form-wrapper #gg-ajax-rooms .radio label .gg-room-name,
		.booking-form-wrapper #gg-ajax-rooms .radio label .gg-room-type,
		.booking-form-wrapper #gg-ajax-rooms .radio label .gg-room-price,
		.vc_progress_bar .vc_single_bar small.vc_label,
		.counter-holder p,
		.panel-heading,
		.minict_wrapper,
		.minict_wrapper span {
			font-family: <?php echo str_replace('+', ' ', $headings_font_clean[0]); ?>;
		}

		/* Link colors */
		<?php if (get_theme_mod('link-color','#1abc9c') != '#1abc9c') { ?>
			a,
			a.more-link,
			.primary-color {
				color: <?php echo get_theme_mod('link-color','#1abc9c'); ?>;
			}


		<?php } ?>

		/* Headings colors */
		<?php if (get_theme_mod('headings-color','#18191a') != '#18191a') { ?>
			h1,
			h2,
			h3,
			h4,
			h5,
			h6 {
				color: <?php echo get_theme_mod('headings-color','#18191a'); ?>;
			}
		<?php } ?>

		/* Primary colors */
		<?php if (get_theme_mod('primary-color','#1abc9c') != '#1abc9c') { ?>

			#main-menu,
			.dropdown-menu > .active > a,
			.dropdown-menu > .active > a:hover,
			.dropdown-menu > .active > a:focus,
			.slideshow-sidebar .widget-title:after,
			.gg-homepage-var3 .slideshow-sidebar .widget-title:after,
			.gg-homepage-var4 .slideshow-sidebar .widget-title:after,
			.gg-homepage-var5 .slideshow-sidebar .widget-title:after,
			.ip-header .ip-loader::after,
			footer.site-footer .widget-title:after,
			aside.sidebar-nav .widget .widget-title:after,
			.post-social ul li a,
			.post-social ul li a:hover,
			.pagination > li > span.current,
			.pagination > li > a:hover,
			.pagination > li > span:hover,
			.pagination > li > a:focus,
			.pagination > li > span:focus,
			.title-subtitle-box hr,
			.wpb-js-composer .vc_progress_bar .vc_single_bar .vc_bar,
			.counter-holder em:before,
			.counter-holder.is_box,
			.wpb-js-composer .wpb_toggle:before, 
			.wpb-js-composer #content h4.wpb_toggle:before,
			.wpb-js-composer .wpb_toggle.wpb_toggle_title_active, 
			.wpb-js-composer #content h4.wpb_toggle.wpb_toggle_title_active,
			.wpb-js-composer .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-accordion-header-active,
			.wpb-js-composer .wpb_accordion .wpb_accordion_wrapper .ui-state-default .ui-icon:before,
			.vc_progress_bar .vc_single_bar .vc_bar,
			.owl-theme .owl-controls .owl-page.active span,
			.owl-theme .owl-controls.clickable .owl-page:hover span {
				background-color: <?php echo get_theme_mod('primary-color','#1abc9c'); ?>;
			}

			.datepicker td.active:hover,
			.datepicker td.active:hover:hover,
			.datepicker td.active:focus,
			.datepicker td.active:hover:focus,
			.datepicker td.active:active,
			.datepicker td.active:hover:active,
			.datepicker td.active.active,
			.datepicker td.active.active:hover,
			.datepicker td.active.disabled,
			.datepicker td.active.disabled:hover,
			.datepicker td.active[disabled],
			.datepicker td.active[disabled]:hover {
				background-color: <?php echo get_theme_mod('primary-color','#1abc9c'); ?> !important;
			}

			.datepicker table tr td.active:hover,
			.datepicker table tr td.active:hover:hover,
			.datepicker table tr td.active.disabled:hover,
			.datepicker table tr td.active.disabled:hover:hover,
			.datepicker table tr td.active:active,
			.datepicker table tr td.active:hover:active,
			.datepicker table tr td.active.disabled:active,
			.datepicker table tr td.active.disabled:hover:active,
			.datepicker table tr td.active.active,
			.datepicker table tr td.active:hover.active,
			.datepicker table tr td.active.disabled.active,
			.datepicker table tr td.active.disabled:hover.active,
			.datepicker table tr td.active.disabled,
			.datepicker table tr td.active:hover.disabled,
			.datepicker table tr td.active.disabled.disabled,
			.datepicker table tr td.active.disabled:hover.disabled,
			.datepicker table tr td.active[disabled],
			.datepicker table tr td.active:hover[disabled],
			.datepicker table tr td.active.disabled[disabled],
			.datepicker table tr td.active.disabled:hover[disabled] {
				background-color: <?php echo get_theme_mod('primary-color','#1abc9c'); ?> !important;
			}
			
			.gg-ajax-loader {
				border-left-color: <?php echo get_theme_mod('primary-color','#1abc9c'); ?>;
			}

			.btn-primary,
			.btn-default:hover,
			.btn-default:focus,
			.btn-default:active,
			.btn-default.active,
			.open > .dropdown-toggle.btn-default,
			.btn-primary.disabled,
			.btn-primary[disabled],
			fieldset[disabled] .btn-primary,
			.btn-primary.disabled:hover,
			.btn-primary[disabled]:hover,
			fieldset[disabled] .btn-primary:hover,
			.btn-primary.disabled:focus,
			.btn-primary[disabled]:focus,
			fieldset[disabled] .btn-primary:focus,
			.btn-primary.disabled.focus,
			.btn-primary.focus[disabled],
			fieldset[disabled] .btn-primary.focus,
			.btn-primary.disabled:active,
			.btn-primary[disabled]:active,
			fieldset[disabled] .btn-primary:active,
			.btn-primary.disabled.active,
			.btn-primary.active[disabled],
			fieldset[disabled] .btn-primary.active,
			.panel-heading {
				background-color: <?php echo get_theme_mod('primary-color','#1abc9c'); ?>;
    			border-color: <?php echo get_theme_mod('primary-color','#1abc9c'); ?>;
			}

			.btn-default {
    			border-color: <?php echo get_theme_mod('primary-color','#1abc9c'); ?>;
    			color: <?php echo get_theme_mod('primary-color','#1abc9c'); ?>;
			}

			
			.btn-default-inverse:hover,
			.btn-default-inverse:focus,
			.btn-default-inverse:active,
			.btn-default-inverse.active,
			.open > .dropdown-toggle.btn-default-inverse,
			.has-success .form-control-feedback,
			.slideshow-property-meta ul.property-meta li:before,
			.single-property-content ul.property-meta li:before,
			.homepage-var3-property-meta ul.property-meta li:before,
			.homepage-var5-property-meta ul.property-meta li:before,
			.gg-homepage-var3 #main-menu.navbar-nav > li > .dropdown-menu > li > a:hover,
			.gg-homepage-var3 #main-menu.navbar-nav > li > .dropdown-menu > li > a:focus,
			.gg-homepage-var3 #main-menu.navbar-nav > li > .dropdown-menu > .active > a,
			.gg-homepage-var3 #main-menu.navbar-nav > li > .dropdown-menu > .active > a:hover,
			.gg-homepage-var3 #main-menu.navbar-nav > li > .dropdown-menu > .active > a:focus,
			.gg-homepage-var4 #main-menu.navbar-nav > li > .dropdown-menu > li > a:hover,
			.gg-homepage-var4 #main-menu.navbar-nav > li > .dropdown-menu > li > a:focus,
			.gg-homepage-var4 #main-menu.navbar-nav > li > .dropdown-menu > .active > a,
			.gg-homepage-var4 #main-menu.navbar-nav > li > .dropdown-menu > .active > a:hover,
			.gg-homepage-var4 #main-menu.navbar-nav > li > .dropdown-menu > .active > a:focus,
			.gg-homepage-var5 #main-menu.navbar-nav > li > .dropdown-menu > li > a:hover,
			.gg-homepage-var5 #main-menu.navbar-nav > li > .dropdown-menu > li > a:focus,
			.gg-homepage-var5 #main-menu.navbar-nav > li > .dropdown-menu > .active > a,
			.gg-homepage-var5 #main-menu.navbar-nav > li > .dropdown-menu > .active > a:hover,
			.gg-homepage-var5 #main-menu.navbar-nav > li > .dropdown-menu > .active > a:focus,
			.gg-homepage-var3 .homepage-var3-property:hover h1,
			.gg-homepage-var4 .homepage-var3-property:hover h1,
			.gg-homepage-var5 .homepage-var5-property h1:hover,
			.gg-homepage-var5 .owl-item.synced .homepage-var5-property h1,
			.social-icons-widget ul li a:hover,
			aside.sidebar-nav .widget .social-icons-widget ul li a:hover,
			aside.sidebar-nav .widget a:hover,
			.wpb-js-composer .wpb_content_element .widget a:hover,
			article.post footer ul.post-tags li a:hover,
			p.meta a:hover,
			aside.sidebar-nav .widget.twitter-widget ul li a,
			aside.sidebar-nav .widget.twitter-widget ul li a:hover,
			footer.site-footer .widget.contact i,
			aside.sidebar-nav .widget.contact a,
			.contact-map-wrapper .contact-map-overlay .contact-map-address-wrapper i,
			.booking-form-wrapper #gg-ajax-rooms .radio label .gg-room-price,
			.room-wrapper .room-price,
			.counter-holder .counter,
			.wpb-js-composer .wpb_toggle.wpb_toggle_title_active:before, 
			.wpb-js-composer #content h4.wpb_toggle.wpb_toggle_title_active:before,
			.wpb-js-composer .wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon:before,
			.slideshow-property-meta ul.property-meta li i,
			.single-property-content ul.property-meta li i,
			.homepage-var3-property-meta ul.property-meta li i,
			.homepage-var5-property-meta ul.property-meta li i,
			#quick-reservation-form i.entypo-calendar,
			#quick-reservation-form .minict_wrapper::after,
			.minict_wrapper ul li.selected,
			.minict_wrapper ul li:hover,
			.gg-advanced-search-template ul.property-meta-search li i,
			.post-type-archive ul.property-meta-search li i,
			.gg-advanced-search-template ul.property-meta-search li span.icon,
			.post-type-archive ul.property-meta-search li span.icon {
			    color: <?php echo get_theme_mod('primary-color','#1abc9c'); ?>;
			}

			.has-success .form-control,
			.has-success .form-control:focus,
			article.post.sticky .article-wrapper,
			article.post.sticky header.entry-header .article-header-body,
			article.post.sticky footer,
			.single-property-content-area .gg-book-now.btn:hover,
			.single-property-content-area .gg-book-now.btn:focus,
			.single-property-content-area .gg-book-now.btn:active, 
			.single-property-content-area .gg-book-now.btn.active {
			  border-color: <?php echo get_theme_mod('primary-color','#1abc9c'); ?>;
			}

			section#quick-reservation,
			.gg-homepage-var2 header.site-header #main-navbar-collapse,
			header.site-header.header-style2 #main-navbar-collapse {
			  background: <?php echo gg_hex_shift( get_theme_mod('primary-color','#1abc9c'), 'darker', 70 ); ?>; /* Old browsers */
			  background: -moz-linear-gradient(left,  <?php echo gg_hex_shift( get_theme_mod('primary-color','#1abc9c'), 'darker', 70 ); ?> 0%, <?php echo get_theme_mod('primary-color','#1abc9c'); ?> 100%); /* FF3.6+ */
			  background: -webkit-gradient(linear, left top, right top, color-stop(0%,<?php echo gg_hex_shift( get_theme_mod('primary-color','#1abc9c'), 'darker', 70 ); ?>), color-stop(100%,<?php echo get_theme_mod('primary-color','#1abc9c'); ?>)); /* Chrome,Safari4+ */
			  background: -webkit-linear-gradient(left,  <?php echo gg_hex_shift( get_theme_mod('primary-color','#1abc9c'), 'darker', 70 ); ?> 0%,<?php echo get_theme_mod('primary-color','#1abc9c'); ?> 100%); /* Chrome10+,Safari5.1+ */
			  background: -o-linear-gradient(left,  <?php echo gg_hex_shift( get_theme_mod('primary-color','#1abc9c'), 'darker', 70 ); ?> 0%,<?php echo get_theme_mod('primary-color','#1abc9c'); ?> 100%); /* Opera 11.10+ */
			  background: -ms-linear-gradient(left,  <?php echo gg_hex_shift( get_theme_mod('primary-color','#1abc9c'), 'darker', 70 ); ?> 0%,<?php echo get_theme_mod('primary-color','#1abc9c'); ?> 100%); /* IE10+ */
			  background: linear-gradient(to right,  <?php echo gg_hex_shift( get_theme_mod('primary-color','#1abc9c'), 'darker', 70 ); ?> 0%,<?php echo get_theme_mod('primary-color','#1abc9c'); ?> 100%); /* W3C */
			  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo gg_hex_shift( get_theme_mod('primary-color','#1abc9c'), 'darker', 70 ); ?>', endColorstr='<?php echo get_theme_mod('primary-color','#1abc9c'); ?>',GradientType=1 ); /* IE6-9 */
			}


		<?php } ?>

		<?php if (get_theme_mod('secondary-color','#0c0f21') != '#0c0f21') { ?>
			.btn-primary:hover,
			.btn-primary:focus,
			.btn-primary:active,
			.btn-primary.active,
			.open > .dropdown-toggle.btn-primary,
			.gg-homepage-var1 #main-menu,
			.slideshow-property,
			#single-project-gallery,
			.gg-homepage-var1 .slideshow-sidebar,
			.gg-homepage-var3 header.site-header.sidebar,
			.gg-homepage-var4 header.site-header.sidebar,
			.gg-homepage-var5 header.site-header.sidebar,
			#homepage-var5-gallery-owl.owl-carousel,
			.single-property-half-screen .single-property-meta,
			.single-property-quarter-screen .single-property-content,
			.single-property-quarter-screen .single-property-gallery,
			.single-property-quarter-screen .single-property-controls .cbp-bicontrols,
			.single-property-third-screen .single-property-content,
			.single-property-third-screen .single-property-gallery,
			.single-property-third-screen .cbp-bicontrols,
			.single-property-full-screen .single-property-meta,
			figure.effect-milo,
			figure.effect-milo-sh,
			.gg-homepage-var3 .homepage-var3-property,
  			.gg-homepage-var4 .homepage-var3-property,
  			footer.site-footer {
			  background-color: <?php echo get_theme_mod('secondary-color','#0c0f21'); ?>;
			}

			.datepicker table tr td.today, .datepicker table tr td.today:hover, .datepicker table tr td.today.disabled, .datepicker table tr td.today.disabled:hover {
				background-color: <?php echo get_theme_mod('secondary-color','#0c0f21'); ?>;
			}

			figure.effect-milo-sh h4 {
				background: -moz-linear-gradient(left,  <?php echo get_theme_mod('secondary-color','#0c0f21'); ?> 0%, rgba(255,255,255,0) 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, right top, color-stop(0%,<?php echo get_theme_mod('secondary-color','#0c0f21'); ?>), color-stop(100%,rgba(255,255,255,0))); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(left,  <?php echo get_theme_mod('secondary-color','#0c0f21'); ?> 0%,rgba(255,255,255,0) 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(left,  <?php echo get_theme_mod('secondary-color','#0c0f21'); ?> 0%,rgba(255,255,255,0) 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(left,  <?php echo get_theme_mod('secondary-color','#0c0f21'); ?> 0%,rgba(255,255,255,0) 100%); /* IE10+ */
				background: linear-gradient(to right,  <?php echo get_theme_mod('secondary-color','#0c0f21'); ?> 0%,rgba(255,255,255,0) 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo get_theme_mod('secondary-color','#0c0f21'); ?>', endColorstr='#00ffffff',GradientType=1 ); /* IE6-9 */
			}

			#site-title a.brand,
			#quick-reservation-form .minict_wrapper ul li,
			.property-select-form .minict_wrapper,
			.gg-homepage-var5 .homepage-var5-property h1,
			.single-property-content-area .gg-book-now.btn,
			.navbar-default .navbar-nav .open .dropdown-menu > .active > a,
			.navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
			.navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus,
			.navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
			.navbar-default .navbar-nav .open .dropdown-menu > li > a:focus,
			.gg-homepage-var2 #site-title a.brand,
  			header.site-header.header-style2 #site-title a.brand,
  			.nav > li > a:hover,
			.nav > li > a:focus,
			.nav-tabs > li.active > a,
			.nav-tabs > li.active > a:hover,
			.nav-tabs > li.active > a:focus,
			.nav-pills > li.active > a,
			.nav-pills > li.active > a:hover,
			.nav-pills > li.active > a:focus,
			.categories_filter ul li.active > a,
			.categories_filter ul li.active > a:hover,
			.categories_filter ul li.active > a:focus,
			.nav > li > a:hover,
			.nav > li > a:focus,
			.categories_filter ul li a:hover,
			#areas-map-controls .ullist li.active a,
			#areas-map-controls .ullist li a:hover,
			#areas-map-controls .ullist li a:active,
			.wpb_content_element.wpb_tabs .wpb_tabs_nav li.ui-tabs-active a,
			.wpb_content_element.wpb_tabs .wpb_tabs_nav li:hover a,
			.wpb_content_element.wpb_tour .wpb_tabs_nav li.ui-tabs-active a,
			.wpb_content_element.wpb_tour .wpb_tabs_nav li:hover a {
				color: <?php echo get_theme_mod('secondary-color','#0c0f21'); ?>;
			}

			.datepicker .glyphicon {
				color: <?php echo get_theme_mod('secondary-color','#0c0f21'); ?>;
			}


			#subheader {
			  border-top-color: <?php echo get_theme_mod('secondary-color','#0c0f21'); ?>;
			}

		<?php } ?>

		<?php 
		//Always at the end of the file
		if (get_theme_mod('custom_css') != '') {
			echo get_theme_mod('custom_css');
		} 
		?>

	</style>
    <?php
}

if ( ! is_admin() ) {
	add_action( 'wp_head', 'mytheme_customize_css');
}


