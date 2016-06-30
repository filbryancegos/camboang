<?php
/**
 * Theme Functions
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */

function load_custom_wp_admin_style() {
       //wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/admin-style.css', false, '1.0.0' );
        wp_enqueue_script( 'waypoints' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

global $theme_name, $dependency_css;
$theme_name = "luxuryvilla";
$dependency_css = array();

define("OKTHEMES_TEXTDOMAIN","okthemes");
define("OKTHEMES_THEMEVERSION","1.0");

@define( 'PARENT_DIR', get_template_directory() );
@define( 'CHILD_DIR', get_stylesheet_directory() );

@define( 'PARENT_URL', get_template_directory_uri() );
@define( 'CHILD_URL', get_stylesheet_directory_uri() );

// Load plugins
require_once PARENT_DIR . '/lib/class-tgm-plugin-activation.php';
include PARENT_DIR . '/lib/register-tgm-plugins.php';

//Theme options
include get_template_directory() . '/admin/customizer/options.php';

//ACF

// 1. customize ACF path
add_filter('acf/settings/path', 'gg_acf_settings_path');
function gg_acf_settings_path( $path ) {
     // update path
    $path = get_template_directory() . '/plugins/advanced-custom-fields-pro/';
    // return
    return $path;
}

// 2. customize ACF dir
add_filter('acf/settings/dir', 'gg_acf_settings_dir');
function gg_acf_settings_dir( $dir ) {
     // update path
    $dir = get_template_directory_uri() . '/plugins/advanced-custom-fields-pro/';
    // return
    return $dir;
}


// 3. Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_false');

// 4. Include ACF
include_once( get_template_directory() . '/plugins/advanced-custom-fields-pro/acf.php' );

//5. Theme meta options
include get_template_directory() . '/lib/metaboxes.php';

// Set VC as part of the theme
if(function_exists('vc_set_as_theme')) {

    vc_set_as_theme($disable_updater = true);
    vc_set_shortcodes_templates_dir(PARENT_DIR.'/lib/visualcomposer/vc_templates/');
    require_once (PARENT_DIR . '/lib/load-vc-modules.php');
    $dependency_css[] = 'js_composer_front';

    $list = array(
        'page',
        'property_cpt'
    );
    vc_set_default_editor_post_types( $list );
}

if ( ! function_exists( 'get_field_ext' ) && ( function_exists( 'get_field' ) ) ) {
  /**
     * Extends the default ACF get_field function to allow options for a default value and fallback to global option
     *
     * @author Gabe Shackle         <gabe@hereswhatidid.com>
     * @param  string $name         Field name
     * @param  mixed $default       Default value if none found
     * @param  integer $id      Post ID to check the field value of
     * @return mixed                Value after running checks
     */
    function get_field_ext( $name = '', $default = null, $id = null ) {
        if ( ! empty( $id ) ) {
            if ( $result = get_field( $name, $id ) ) {
                return $result;
            }
        } else {
            if ( ( $result = get_field( $name ) ) || ( $result = get_field( $name, 'options' ) ) ) {
                return $result;
            }
        }
        return $default;
    }
}


// Verify if WPML is active
if ( ! function_exists( 'is_wpml_activated' ) ) {
    function is_wpml_activated() {
        if ( class_exists( 'SitePressLanguageSwitcher' ) ) {
            return true;
        } else {
            return false;
        }
    }
}

if (is_wpml_activated()) {
    function language_selector_flags(){
        $languages = icl_get_languages('skip_missing=0&orderby=code');
        if(!empty($languages)){
            foreach($languages as $l){
                if(!$l['active']) echo '<a href="'.$l['url'].'">';
                echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
                if(!$l['active']) echo '</a>';
            }
        }
    }
}

// Check if element comes from VC
function gg_is_in_vc() {
    $classes = get_body_class();
    if (in_array('blog',$classes) || in_array('single',$classes) || in_array('search',$classes) || in_array('archive',$classes) || in_array('category',$classes)) {
        return false;
    } else {
        return true;
    }
}

// Include post types
require_once (PARENT_DIR . '/lib/custom-post-types.php');

// Include widgets
require_once (PARENT_DIR . '/lib/widgets.php');

// require aq resize
require (PARENT_DIR . '/lib/aq_resizer.php');

// require Mobile_Detect
require (PARENT_DIR . '/lib/Mobile_Detect.php');

/**
 * Maximum allowed width of content within the theme.
 */
if (!isset($content_width)) {
    $content_width = 1170;
}

/**
 * Setup Theme Functions
 *
 */
if (!function_exists('gg_theme_setup')):
    function gg_theme_setup() {

        load_theme_textdomain(OKTHEMES_TEXTDOMAIN, get_template_directory() . '/lang');

        add_theme_support( 'title-tag' );
        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

        $defaults = array(
            'default-color'          => 'f3f3f3',
            'default-image'          => '',
            'default-repeat'         => '',
            'default-position-x'     => '',
        );
        add_theme_support( 'custom-background', $defaults);

        register_nav_menus(
            array(
                'main-menu' => __('Main Menu', OKTHEMES_TEXTDOMAIN)
            ));

            register_nav_menus(
                array(
                    'secondary-menu' => __('Secondary Menu', OKTHEMES_TEXTDOMAIN)
                ));
        // load custom walker menu class file
        require (PARENT_DIR . '/lib/nav/class-bootstrapwp_walker_nav_menu.php');

        set_post_thumbnail_size('full');
    }
endif;
add_action('after_setup_theme', 'gg_theme_setup');


/**
 * Load CSS styles for theme.
 *
 */
function gg_styles_loader() {
    wp_enqueue_style('luxuryvilla-bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', false, OKTHEMES_THEMEVERSION, 'all');
    wp_enqueue_style('luxuryvilla-font-elegant', get_template_directory_uri() . '/assets/elegant-font/style.css', false, OKTHEMES_THEMEVERSION, 'all');
    wp_enqueue_style('luxuryvilla-font-social', get_template_directory_uri() . '/assets/social-font/stylesheets.css', false, OKTHEMES_THEMEVERSION, 'all');
    wp_enqueue_style('luxuryvilla-font-entypo', get_template_directory_uri() . '/assets/meteor-entypo/fonts-entypo.css', false, OKTHEMES_THEMEVERSION, 'all');
    wp_enqueue_style('luxuryvilla-property-font', get_template_directory_uri() . '/assets/property-fonts/styles.css', false, OKTHEMES_THEMEVERSION, 'all');
    wp_register_style('isotope', get_template_directory_uri() . '/styles/isotope.css', false, OKTHEMES_THEMEVERSION, 'all');
    wp_register_style('magnific', get_template_directory_uri() . '/styles/magnific-popup.css', false, OKTHEMES_THEMEVERSION, 'all');
    wp_enqueue_style('owlcarouselbase', get_template_directory_uri() . '/styles/owl.carousel.css', false, OKTHEMES_THEMEVERSION, 'all');
    wp_enqueue_style('owlcarouseltheme', get_template_directory_uri() . '/styles/owl.theme.css', false, OKTHEMES_THEMEVERSION, 'all');
    wp_enqueue_style('owlcarouseltransitions', get_template_directory_uri() . '/styles/owl.transitions.css', false, OKTHEMES_THEMEVERSION, 'all');
    wp_enqueue_style('minimalect', get_template_directory_uri() . '/styles/jquery.minimalect.css', false, OKTHEMES_THEMEVERSION, 'all');
    wp_enqueue_style('bootval', get_template_directory_uri() . '/assets/bootstrap-validator/css/bootstrapValidator.css', false, OKTHEMES_THEMEVERSION, 'all');

    //wp_register_style('boot-datepicker', get_template_directory_uri() ."/assets/bootstrap-datepicker/css/datepicker.css", false, OKTHEMES_THEMEVERSION, 'all');
    wp_register_style('boot-datepicker', get_template_directory_uri() ."/assets/bootstrap-datepicker/css/datepicker-new.css", false, OKTHEMES_THEMEVERSION, 'all');

    wp_enqueue_style('luxuryvilla-default', get_stylesheet_uri());

}
add_action('wp_enqueue_scripts', 'gg_styles_loader');

/**
 * Load JavaScript and jQuery files for theme.
 *
 */
function gg_scripts_loader() {

    $setBase = (is_ssl()) ? "https://" : "http://";

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    /*Site preloader*/
    if( 1 == get_theme_mod( 'site_preloader', 1 ) ) {
        wp_enqueue_script('modernizer-preloader',get_template_directory_uri() ."/js/preload/modernizr.custom.js",array('jquery'),OKTHEMES_THEMEVERSION,true);
        wp_enqueue_script('pace',get_template_directory_uri() ."/js/preload/pace.min.js",array('jquery'),OKTHEMES_THEMEVERSION,true);
        wp_enqueue_script('classie',get_template_directory_uri() ."/js/preload/classie.js",array('jquery'),OKTHEMES_THEMEVERSION,true);
        wp_enqueue_script('main',get_template_directory_uri() ."/js/preload/main.js",array('jquery'),OKTHEMES_THEMEVERSION,true);
    }

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array('jquery'),OKTHEMES_THEMEVERSION,true);
    wp_enqueue_script('bootval', get_template_directory_uri() . '/assets/bootstrap-validator/js/bootstrapValidator.js', array('jquery'), OKTHEMES_THEMEVERSION, true);
    wp_enqueue_script('hoverintent', get_template_directory_uri() . '/js/hoverintent.js', array('jquery'), OKTHEMES_THEMEVERSION, true);
    wp_enqueue_script('placeholder', get_template_directory_uri() . '/js/placeholder.js', array('jquery'), OKTHEMES_THEMEVERSION, true);
    wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'), OKTHEMES_THEMEVERSION, true);
    wp_register_script('magnific', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array('jquery'), OKTHEMES_THEMEVERSION, true);
    wp_register_script('lazyload', get_template_directory_uri() . '/js/jquery.lazyload.min.js', array('jquery'), OKTHEMES_THEMEVERSION, true);
    wp_enqueue_script('owlcarousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), OKTHEMES_THEMEVERSION, true);
    wp_register_script('countto', get_template_directory_uri() . '/js/jquery.countto.js', array('jquery'), OKTHEMES_THEMEVERSION, true);
    wp_enqueue_script('imagesloaded',get_template_directory_uri() ."/js/jquery.imagesloaded.min.js",array('jquery'),OKTHEMES_THEMEVERSION,true);

    if( 1 == get_theme_mod( 'retina', 1 ) ) {
        wp_enqueue_script('retinajs', get_template_directory_uri() . '/js/retina.min.js', array('jquery'), OKTHEMES_THEMEVERSION, true);
    }

    wp_register_script('videobackground',get_template_directory_uri() ."/js/jquery.videobackground.js",array('jquery'),OKTHEMES_THEMEVERSION,true);

    /*Homepage var1 slideshow*/
    if( is_page_template('theme-templates/homepage-var1.php') || is_singular('property_cpt') || is_page_template('theme-templates/homepage-var2.php') || is_page_template('theme-templates/homepage-var3.php') || is_page_template('theme-templates/homepage-var4.php') || is_page_template('theme-templates/homepage-var5.php') ) {
        wp_enqueue_script('modernizer',get_template_directory_uri() ."/js/modernizr.custom.js",array('jquery'),OKTHEMES_THEMEVERSION,true);
        wp_enqueue_script('cbpBGSlideshow',get_template_directory_uri() ."/js/cbpBGSlideshow.js",array('jquery'),OKTHEMES_THEMEVERSION,true);
    }

    wp_enqueue_script('minimalect', get_template_directory_uri() . '/js/jquery.minimalect.min.js', array('jquery'), OKTHEMES_THEMEVERSION, true);
    wp_enqueue_script('nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array('jquery'), OKTHEMES_THEMEVERSION, true);


    /*Maps*/
    wp_register_script('google-map-api',$setBase."maps.google.com/maps/api/js");
    wp_register_script('maplace',get_template_directory_uri() ."/js/maplace-0.1.3.min.js",array('jquery'),OKTHEMES_THEMEVERSION,true);

    /*Bootstrap date picker */
    //wp_register_script('boot-datepicker', get_template_directory_uri() ."/assets/bootstrap-datepicker/js/bootstrap-datepicker.js",array('jquery'),OKTHEMES_THEMEVERSION,true);
    wp_enqueue_script('boot-datepicker', get_template_directory_uri() ."/assets/bootstrap-datepicker/js/bootstrap-datepicker-new.min.js",array('jquery'),OKTHEMES_THEMEVERSION,true);

    if (is_wpml_activated()) {
        if (ICL_LANGUAGE_CODE != 'en') {
            wp_enqueue_script('boot-datepicker-locale', get_template_directory_uri() ."/assets/bootstrap-datepicker/locales/bootstrap-datepicker." . ICL_LANGUAGE_CODE . ".min.js",array('jquery'),OKTHEMES_THEMEVERSION,true);
        }
    }

    wp_enqueue_script('qrfjs', get_template_directory_uri() ."/js/qrf.js",array('jquery'),OKTHEMES_THEMEVERSION,true);
    wp_localize_script( 'qrfjs', 'ajax_object_qrf',
        array(
            'ajax_url' => admin_url( 'admin-ajax.php' )
        )
    );

    wp_enqueue_script('cfjs', get_template_directory_uri() ."/js/cf.js",array('jquery'),OKTHEMES_THEMEVERSION,true);
    wp_localize_script( 'cfjs', 'ajax_object_cf',
        array(
            'ajax_url' => admin_url( 'admin-ajax.php' )
        )
    );

    wp_enqueue_script('bfjs', get_template_directory_uri() ."/js/bf.js",array('jquery'),OKTHEMES_THEMEVERSION,true);
    wp_localize_script( 'bfjs', 'ajax_object_bf',
        array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'js_alt_loading' => __( 'Loading...', 'fws-ajax-contact-form' )
        )
    );


    wp_enqueue_script('propertyjs', get_template_directory_uri() ."/js/property.js",array('jquery'),OKTHEMES_THEMEVERSION,true);
    wp_localize_script( 'propertyjs', 'ajax_object_property',
        array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
        )
    );

    wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), OKTHEMES_THEMEVERSION, true);

}
add_action('wp_enqueue_scripts', 'gg_scripts_loader');

//Admin enque script for metabox
function gg_admin_metabox_script_loader() {
    wp_enqueue_script( 'jquery-custom-admin', get_template_directory_uri() . '/js/jquery.custom.admin.js', array( 'jquery' ), OKTHEMES_THEMEVERSION, true );
    wp_enqueue_style('luxuryvilla-font-entypo', get_template_directory_uri() . '/assets/meteor-entypo/fonts-entypo.css', false, OKTHEMES_THEMEVERSION, 'all');
}
add_action( 'admin_enqueue_scripts', 'gg_admin_metabox_script_loader' );


/**
 * Function for aq_resize
 */
if (!function_exists('gg_aq_resize')) :
function gg_aq_resize( $attachment_id, $width = null, $height = null, $crop = true, $single = true ) {
    if ( is_null( $attachment_id ) )
        return null;

    $image = wp_get_attachment_image_src( $attachment_id, 'full' );
    $return = aq_resize( $image[0], $width, $height, $crop, $single );

    if ( $return ) {
        return $return;
    }
    else {
        return $image[0];
    }
}
endif;

/**
 * Define theme's widget areas.
 *
 */
function gg_widgets_init() {

    register_sidebar(
        array(
            'name'          => __('Page Sidebar', OKTHEMES_TEXTDOMAIN),
            'id'            => 'sidebar-page',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => "</div>",
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );

    register_sidebar(
        array(
            'name'          => __('Posts Sidebar', OKTHEMES_TEXTDOMAIN),
            'id'            => 'sidebar-posts',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => "</div>",
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );

    register_sidebar(
        array(
            'name'          => __('Search Sidebar', OKTHEMES_TEXTDOMAIN),
            'id'            => 'sidebar-search',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => "</div>",
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        )
    );

    register_sidebar(
        array(
            'name'          => __('Homepage Sidebar', OKTHEMES_TEXTDOMAIN),
            'id'            => 'sidebar-homepage',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => "</div>",
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );

    register_sidebar(
        array(
            'name'          => __('Areas Page (Gallery) Sidebar', OKTHEMES_TEXTDOMAIN),
            'id'            => 'sidebar-areas-page-gallery',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => "</div>",
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        )
    );

    register_sidebar(
        array(
            'name'          => __('Gallery Page Sidebar', OKTHEMES_TEXTDOMAIN),
            'id'            => 'sidebar-gallery-page',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => "</div>",
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        )
    );

    register_sidebar(
        array(
            'name'          => __('Footer First Sidebar', OKTHEMES_TEXTDOMAIN),
            'id'            => 'sidebar-footer-first',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        )
    );

    register_sidebar(
        array(
            'name'          => __('Gallery Social Sidebar', OKTHEMES_TEXTDOMAIN),
            'id'            => 'sidebar-social-first',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        )
    );

    register_sidebar(
        array(
            'name'          => __('Footer Second Sidebar', OKTHEMES_TEXTDOMAIN),
            'id'            => 'sidebar-footer-second',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        )
    );

}
add_action('init', 'gg_widgets_init');


/**
 * Display template for comments and pingbacks.
 *
 */
if (!function_exists('gg_comment')) :
    function gg_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' : ?>

                <li <?php comment_class('media, comment'); ?> id="comment-<?php comment_ID(); ?>">
                    <div class="media-body">
                        <p>
                            <?php _e('Pingback:', OKTHEMES_TEXTDOMAIN); ?> <?php comment_author_link(); ?>
                        </p>
                    </div><!--/.media-body -->
                <?php
                break;
            default :
                // Proceed with normal comments.
                global $post; ?>

                <li <?php comment_class('media'); ?> id="li-comment-<?php comment_ID(); ?>">
                        <a href="<?php echo esc_url($comment->comment_author_url);?>" class="pull-left avatar-holder">
                            <?php echo get_avatar($comment, 42); ?>
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading comment-author vcard">
                                <?php
                                printf('<cite class="fn">%1$s %2$s</cite>',
                                    get_comment_author_link(),
                                    // If current post author is also comment author, make it known visually.
                                    ($comment->user_id === $post->post_author) ? '<span class="label"> ' . __(
                                        'Post author',
                                        OKTHEMES_TEXTDOMAIN
                                    ) . '</span> ' : ''); ?>
                            </h4>
                            <p class="meta">
                                <?php printf('<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                                        esc_url(get_comment_link($comment->comment_ID)),
                                        get_comment_time('c'),
                                        sprintf(
                                            __('%1$s at %2$s', OKTHEMES_TEXTDOMAIN),
                                            get_comment_date(),
                                            get_comment_time()
                                        )
                                    ); ?>
                            </p>
                            <p class="reply">
                                <?php comment_reply_link( array_merge($args, array(
                                            'reply_text' => __('<i class="arrow_back"></i> Reply', OKTHEMES_TEXTDOMAIN),
                                            'depth'      => $depth,
                                            'max_depth'  => $args['max_depth']
                                        )
                                    )); ?>
                            </p>

                            <?php if ('0' == $comment->comment_approved) : ?>
                                <p class="comment-awaiting-moderation"><?php _e(
                                    'Your comment is awaiting moderation.',
                                    OKTHEMES_TEXTDOMAIN
                                ); ?></p>
                            <?php endif; ?>

                            <?php comment_text(); ?>


                        </div>
                        <!--/.media-body -->
                <?php
                break;
        endswitch;
    }
endif;

/**
 * Display template for post meta information.
 *
 */
if (!function_exists('gg_posted_on_single')) :
    function gg_posted_on_single() {
    // Translators: used between list items, there is a space after the comma.
    $categories_list = get_the_category_list( __( ', ', OKTHEMES_TEXTDOMAIN ) );

    $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
        esc_url( get_permalink() ),
        esc_attr( get_the_time() ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() )
    );

    // Translators: 1 is category, 2 is the date, 3 is the author's name
    if ( $categories_list && !gg_is_in_vc() ) {
        $utility_text = __( '<span class="post-date"><i class="icon_clock_alt"></i> %2$s</span> <span class="post-category"><i class="icon_menu-square_alt2"></i> %1$s</span>', OKTHEMES_TEXTDOMAIN );
    } else {
        $utility_text = __( '<span class="post-date"><i class="icon_clock_alt"></i> %2$s</span>', OKTHEMES_TEXTDOMAIN );
    }

    printf(
        $utility_text,
        $categories_list,
        $date
    );

    //Show comments
    $num_comments = get_comments_number(); // get_comments_number returns only a numeric value

    if ( comments_open() ) {
        if ( $num_comments == 0 ) {
            $comments = __('No Comments',OKTHEMES_TEXTDOMAIN);
        } elseif ( $num_comments > 1 ) {
            $comments = $num_comments . __(' Comments',OKTHEMES_TEXTDOMAIN);
        } else {
            $comments = __('1 Comment',OKTHEMES_TEXTDOMAIN);
        }
        $write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
    } else {
        $write_comments =  __('Comments off',OKTHEMES_TEXTDOMAIN);
    }

    if ( !gg_is_in_vc() ) {
        echo '<span class="post-comments"><i class="icon_comment_alt"></i> '.$write_comments.'</span>';
    }
}

endif;

/**
 * Display template for post meta information.
 *
 */
if (!function_exists('gg_posted_on')) :
    function gg_posted_on() {

    $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
        esc_url( get_permalink() ),
        esc_attr( get_the_time() ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() )
    );

    $utility_text = __( '<span class="post-date"> %1$s</span>', OKTHEMES_TEXTDOMAIN );

    printf(
        $utility_text,
        $date
    );

}
endif;


if ( ! function_exists( 'gg_page_header' ) ) :
/**
 * Display page header
*/
function gg_page_header() {
    global $post;

    if (is_home()) {
        $post_id = get_option('page_for_posts');
    } else {
        $post_id = $post->ID;
    }

    ?>

    <?php
    $page_header = get_field('gg_page_header',$post_id);
    $page_title = get_field('gg_page_title',$post_id);
    $page_description = get_field('gg_page_description',$post_id);

    ?>

    <?php if (!is_front_page() && !is_singular( 'property_cpt' )) { ?>

        <?php if ($page_header || $page_header === NULL) { ?>

        <section id="subheader" class="<?php if ( has_post_thumbnail($post_id) && !is_single() && !is_tax('property_category') ) { echo 'has_header_image'; } ?>">

            <?php if ( has_post_thumbnail($post_id) && !is_single() && !is_tax('property_category') ) { ?>
            <div class="page-header-image">
               <?php
                    if (is_home()) {
                        //echo get_the_post_thumbnail($post_id, 'full');
                        echo '<img class="wp-post-image" src="'.gg_aq_resize( get_post_thumbnail_id($post_id), 1270, 256, true, true ).'" />';
                    } else {
                        //echo get_the_post_thumbnail($post_id, 'full');
                        echo '<img class="wp-post-image" src="'.gg_aq_resize( get_post_thumbnail_id($post_id), 1270, 256, true, true ).'" />';
                    }
                ?>
            </div>
            <?php } ?>

            <?php if ($page_title || $page_header === NULL) { ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <header class="page-title">
                            <h1><?php echo gg_wrap_word(get_the_title($post_id)); ?></h1>
                        </header>

                    </div><!--/.col-md-12 -->
                </div><!--/.row -->
            </div>
            <?php } ?>

            <?php if ($page_description != '') { ?>
            <div class="container-fluid header-page-description">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">

                    <?php
                    $allowed_html =  array(
                        'a' => array(
                            'href'  => array(),
                            'title' => array()
                        ),
                        'br'     => array(),
                        'em'     => array(),
                        'strong' => array(),
                        'p'      => array(),
                    );
                    echo wp_kses($page_description, $allowed_html); ?>
                    </div>
                </div>
            </div>
            <?php } ?>

        </section>
        <?php } ?>

<?php
    }
}
endif;

/**
 * Excerpt read more
 *
 */

function gg_excerpt_more( $more ) {
    return '<br class="read-more-spacer"> <a class="more-link" href="'. get_permalink( get_the_ID() ) . '"><i class="entypo entypo-right-open"></i>' . __('Read More', OKTHEMES_TEXTDOMAIN) . '</a>';
}
add_filter( 'excerpt_more', 'gg_excerpt_more' );


/**
 * Tags widget style
 *
 */

function gg_custom_tag_cloud_widget($args) {
    $args['number']   = 0; //adding a 0 will display all tags
    $args['largest']  = 12; //largest tag
    $args['smallest'] = 12; //smallest tag
    $args['unit']     = 'px'; //tag font unit
    $args['format']   = 'list'; //ul with a class of wp-tag-cloud
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'gg_custom_tag_cloud_widget' );



/**
 * Display template for post footer information (in single.php).
 *
 */
if (!function_exists('gg_posted_in')) :
    function gg_posted_in() {

    // Translators: used between list items, there is a space after the comma.
    $tag_list = get_the_tag_list('<ul class="list-inline post-tags"><li>','</li><li>','</li></ul>');

    // Translators: 1 is the tags
    if ( $tag_list ) {
        $utility_text = __( '%1$s', OKTHEMES_TEXTDOMAIN );
    }

    printf($tag_list);

}

endif;

function gg_user_agent() {
    global $gg_is_iphone, $gg_is_ipad, $gg_is_android;
    $gg_is_iphone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $gg_is_ipad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $gg_is_android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
}

add_action( 'init', 'gg_user_agent');


/**
 * Adds custom classes to the array of body classes.
 *
 */
if (!function_exists('gg_theme_body_classes')) :
    function gg_theme_body_classes($classes) {


        if (!is_multi_author()) {
            $classes[] = 'single-author';
        }

        if (is_page_template('theme-templates/homepage-var1.php')) {
            $classes[] = 'gg-homepage-var1';
        }

        if (is_page_template('theme-templates/homepage-var2.php')) {
            $classes[] = 'gg-homepage-var2';
        }

        if (is_page_template('theme-templates/homepage-var3.php')) {
            $classes[] = 'gg-homepage-var3';
        }

        if (is_page_template('theme-templates/homepage-var4.php')) {
            $classes[] = 'gg-homepage-var4';
        }

        if (is_page_template('theme-templates/homepage-var5.php')) {
            $classes[] = 'gg-homepage-var5';
        }

        if (is_page_template('theme-templates/areas.php')) {
            $classes[] = 'gg-areas-var1';
        }
        if (is_page_template('theme-templates/areas-var2.php')) {
            $classes[] = 'gg-areas-var2';
        }

        if (is_page_template('theme-templates/booking.php')) {
            $classes[] = 'gg-booking-template';
        }

        if (is_page_template('theme-templates/gallery.php')) {
            $classes[] = 'gg-gallery-template';
        }

        if (is_page_template('theme-templates/contact.php')) {
            $classes[] = 'gg-contact-template';
        }
        if (is_page_template('theme-templates/advanced-search.php')) {
            $classes[] = 'gg-advanced-search-template';
        }

        if ('vertical' == get_theme_mod( 'layout_style', 'horizontal' )) {
            $classes[] = 'gg-has-vertical-menu';
        }

        //Notify lazyload
        if ( 1 == get_theme_mod( 'lazyload') ) {
            $classes[] = 'gg-lazyload-on';
        }

        // add classes for mobile agents
        global $gg_is_iphone, $gg_is_android, $gg_is_ipad;

        if ($gg_is_iphone || $gg_is_android || $gg_is_ipad) {
            $classes[] = 'luxuryvilla-agent-devices';
        }

        // current language code if wpml is installed
        if( function_exists( 'icl_get_home_url' ) ) {
              $classes[] = ICL_LANGUAGE_CODE;
              $classes[] = 'calendar-'.ICL_LANGUAGE_CODE;
        }

        return $classes;
    }
    add_filter('body_class', 'gg_theme_body_classes');
endif;

/**
 * Display template for pagination.
 *
 */
if (!function_exists('gg_pagination')) :
function gg_pagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<ul class=\"pagination\">";
         echo "<li class=\"disabled\"><span class=\"img-rounded page-of\">Page ".$paged." of ".$pages."</span></li>";

         if($paged > 2 && $paged > $range+1 && $showitems < $pages) {
            echo "<li><a class=\"img-rounded\" href='".get_pagenum_link(1)."'>&laquo; " . _e('First') . "</a></li>";
         }
         if($paged > 1 && $showitems < $pages) {
            echo "<li><a class=\"img-rounded\" href='".get_pagenum_link($paged - 1)."'>&lsaquo; " . _e('Previous') . "</a></li>";
         }

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li><span class=\"current img-rounded\">".$i."</span></li>":"<li><a class=\"img-rounded\" href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) {
            echo "<li><a class=\"img-rounded\" href=\"".get_pagenum_link($paged + 1)."\">" . _e('Next') . " &rsaquo;</a></li>";
         }

         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) {
            echo "<li><a class=\"img-rounded\" href='".get_pagenum_link($pages)."'>" . _e('Last') . " &raquo;</a></li>";
         }

         echo "</ul>\n";
     }
}
endif;


add_filter( 'the_password_form', 'gg_custom_password_form' );
function gg_custom_password_form() {

    global $post;

    $label = 'pwbox-'.(empty($post->ID) ? rand() : $post->ID);

    $output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">

    <p>' . __("This post is password protected. To view it please enter your password below:","okthemes") . '</p>

    <div class="input-group"><span class="input-group-addon"><i class="icon_lock_alt"></i></span><label class="sr-only" for="' . $label . '">' . __("Password:", "okthemes") . '</label><input name="post_password" id="' . $label . '" type="password" placeholder=' . __("Password:","okthemes") . ' size="20" /><span class="input-group-btn"><input type="submit" name="Submit" value="' . esc_attr__("Submit","okthemes") . '" /></span></div></form>';
    return $output;

}

/**
 * Get tax term slug
 */
if (!function_exists('gg_tax_terms_slug')) :
    function gg_tax_terms_slug($taxonomy) {
        global $post, $post_id;
        $return = '';
        // get post by post id
        $post = get_post($post->ID);
        // get post type by post
        $post_type = $post->post_type;
        // get post type taxonomies
        $terms = get_the_terms( $post->ID, $taxonomy );
        if ( !empty( $terms ) ) {
            $out = array();
            foreach ( $terms as $term )
                $out[] = 'grid-cat-' . $term->slug;
            $return = join( ' ', $out );
        }
        return $return;
    }
endif;

// get taxonomies terms links
if (!function_exists('gg_property_taxonomies_terms_links')) :
    function gg_property_taxonomies_terms_links(){
      global $post;
      // get post by post id
      $post = get_post( $post->ID );

      // get post type by post
      $post_type = 'property_cpt';

      // get post type taxonomies
      $taxonomy_slug = 'property_category';

      $out = array();
        // get the terms related to post
        $terms = get_the_terms( $post->ID, $taxonomy_slug );

        if ( !empty( $terms ) ) {
          //$out[] = "<p class='meta'><span class='post-comments'><i class='icon_menu-square_alt2'>";
          foreach ( $terms as $term ) {
            //$out[] = $term->name;
            $out[] =
              '  <a href="'
            .    get_term_link( $term->slug, $taxonomy_slug ) .'">'
            .    $term->name
            . "</a>\n";
          }
          //$out[] = "</span></p>\n";
        }

      return implode(',', $out );
    }
endif;

add_filter('wpb_widget_title', 'gg_override_widget_title', 10, 2);
function gg_override_widget_title($output = '', $params = array('')) {
  $extraclass = (isset($params['extraclass'])) ? " ".$params['extraclass'] : "";
  return '<h3 class="entry-title'.$extraclass.'">'.$params['title'].'</h3>';
}

function gg_add_wpb_to_body_if_shortcode($classes) {
    global $post;
    if (isset($post->post_content) && false !== stripos($post->post_content, '[vc_row')) {
        array_push($classes, 'wpb-is-on');
    } else {
        array_push($classes, 'wpb-is-off');
    }
    return $classes;
}

add_filter('body_class', 'gg_add_wpb_to_body_if_shortcode', 100, 1);

/**
 * Replaces the login header logo
 */
if (!function_exists('wp_admin_login_style')) :
    add_action( 'login_head', 'wp_admin_login_style' );
    function wp_admin_login_style() {
        if ( get_theme_mod( 'admin_logo' ) ) {
            echo '<style>
            .login h1 a {
                background-image: url( '.get_theme_mod('admin_logo').' ) !important;
                background-size:'.get_theme_mod('admin_logo_width').'px '.get_theme_mod('admin_logo_height').'px;
                width:'.get_theme_mod('admin_logo_width').'px;
                height:'.get_theme_mod('admin_logo_height').'px;
                margin-bottom:15px;
            }
            </style>';
        }
    }
endif;

/**
 * Color shift a hex value by a specific percentage factor
 *
 * @param string $supplied_hex Any valid hex value. Short forms e.g. #333 accepted.
 * @param string $shift_method How to shift the value e.g( +,up,lighter,>)
 * @param integer $percentage Percentage in range of [0-100] to shift provided hex value by
 * @return string shifted hex value
 * @version 1.0 2008-03-28
 */
if (!function_exists('gg_hex_shift')) :
    function gg_hex_shift( $supplied_hex, $shift_method, $percentage = 50 ) {
        $shifted_hex_value     = null;
        $valid_shift_option    = FALSE;
        $current_set           = 1;
        $RGB_values            = array( );
        $valid_shift_up_args   = array( 'up', '+', 'lighter', '>' );
        $valid_shift_down_args = array( 'down', '-', 'darker', '<' );
        $shift_method          = strtolower( trim( $shift_method ) );

        // Check Factor
        if ( !is_numeric( $percentage ) || ($percentage = ( int ) $percentage) < 0 || $percentage > 100 ) {
            trigger_error( "Invalid factor", E_USER_ERROR );
        }

        // Check shift method
        foreach ( array( $valid_shift_down_args, $valid_shift_up_args ) as $options ) {
            foreach ( $options as $method ) {
                if ( $method == $shift_method ) {
                    $valid_shift_option = !$valid_shift_option;
                    $shift_method = ( $current_set === 1 ) ? '+' : '-';
                    break 2;
                }
            }
            ++$current_set;
        }

        if ( !$valid_shift_option ) {
            trigger_error( "Invalid shift method", E_USER_ERROR );
        }

        // Check Hex string
        switch ( strlen( $supplied_hex = ( str_replace( '#', '', trim( $supplied_hex ) ) ) ) ) {
            case 3:
                if ( preg_match( '/^([0-9a-f])([0-9a-f])([0-9a-f])/i', $supplied_hex ) ) {
                    $supplied_hex = preg_replace( '/^([0-9a-f])([0-9a-f])([0-9a-f])/i', '\\1\\1\\2\\2\\3\\3', $supplied_hex );
                } else {
                    trigger_error( "Invalid hex color value", E_USER_ERROR );
                }
                break;
            case 6:
                if ( !preg_match( '/^[0-9a-f]{2}[0-9a-f]{2}[0-9a-f]{2}$/i', $supplied_hex ) ) {
                    trigger_error( "Invalid hex color value", E_USER_ERROR );
                }
                break;
            default:
                trigger_error( "Invalid hex color length", E_USER_ERROR );
        }

        // Start shifting
        $RGB_values['R'] = hexdec( $supplied_hex{0} . $supplied_hex{1} );
        $RGB_values['G'] = hexdec( $supplied_hex{2} . $supplied_hex{3} );
        $RGB_values['B'] = hexdec( $supplied_hex{4} . $supplied_hex{5} );

        foreach ( $RGB_values as $c => $v ) {
            switch ( $shift_method ) {
                case '-':
                    $amount = round( ((255 - $v) / 100) * $percentage ) + $v;
                    break;
                case '+':
                    $amount = $v - round( ($v / 100) * $percentage );
                    break;
                default:
                    trigger_error( "Oops. Unexpected shift method", E_USER_ERROR );
            }

            $shifted_hex_value .= $current_value = (
                strlen( $decimal_to_hex = dechex( $amount ) ) < 2
                ) ? '0' . $decimal_to_hex : $decimal_to_hex;
        }

        return '#' . $shifted_hex_value;
    }
endif;

if (!function_exists('gg_hex_r')) :
function gg_hex_r($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}
endif;


function gg_wrap_word( $title = '', $single = true ) {
    $ARR_title = explode(" ", $title);
    if(sizeof($ARR_title) > 1 ) {
        $ARR_title[0] = "<span class='gg-first-word'>".$ARR_title[0]."</span>";
        return implode(" ", $ARR_title);
    } elseif ($single == true) {
        return "<span class='gg-single-first-word'>".$title."</span>";
    } else {
        return $title;
    }
}

add_filter('widget_title', 'gg_title');
function gg_title($title) {
    // Cut the title to 2 parts
    $title_parts = gg_wrap_word($title, false);

    return $title_parts;
}

function gg_check_email($email) {
    if (is_email($email)) {
        return 1;
    } else {
        return __( 'The entered email address isn\'t valid.', OKTHEMES_TEXTDOMAIN );
    }
}

//Quick reservation form
function gg_qrf_ajax() {

    //Get the post id
    $post_id = absint($_POST['post_id']);

    $homepage_qrf_email      = get_field( 'gg_homepage_qrf_email',$post_id);
    $homepage_qrf_email_from = get_field( 'gg_homepage_qrf_email_from',$post_id);
    $homepage_qrf_success    = get_field( 'gg_homepage_qrf_success_msg',$post_id);
    $homepage_qrf_error      = get_field( 'gg_homepage_qrf_error_msg',$post_id);

    if ($homepage_qrf_success == '') {
        $homepage_qrf_success = __( 'Your message was sent successfully.' , OKTHEMES_TEXTDOMAIN );
    }

    if ($homepage_qrf_error == '') {
        $homepage_qrf_error = __( 'There was an error submitting the form.' , OKTHEMES_TEXTDOMAIN );
    }

    if ($homepage_qrf_email_from == '') {
        $homepage_qrf_email_from = 'noreply@yoursitename.com';
    }

    $error = '';
    $status = 'error';

    if (empty($_POST['checkin']) || empty($_POST['checkout']) || empty($_POST['qr_mainproperty']) || empty($_POST['adults']) || empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone'])) {
        $error = __( 'All fields are required to enter.' , OKTHEMES_TEXTDOMAIN );
    } else {
        if (!wp_verify_nonce($_POST['_qrf_nonce'], 'quick_reservation_form_html')) {
            $error = __( 'Verification error, try again.' , OKTHEMES_TEXTDOMAIN );
        } else {

            $checkin        = sanitize_text_field($_POST['checkin']);
            $checkout       = sanitize_text_field($_POST['checkout']);
            $property       = sanitize_text_field($_POST['qr_mainproperty']);
            $adults         = sanitize_text_field($_POST['adults']);

            $name           = sanitize_text_field($_POST['name']);
            $email          = sanitize_email($_POST['email']);
            $email_check    = gg_check_email($email);
            $phone          = sanitize_text_field($_POST['phone']);

            if ($email_check == 1) {

                //Admin
                $subject_admin = sprintf(__( 'New reservation request by: %1$s' , OKTHEMES_TEXTDOMAIN ), $name);

                //User
                $subject_user = sprintf(__( 'Your reservation request on %1$s' , OKTHEMES_TEXTDOMAIN ), get_option('blogname'));

                $message = '<html><body>';
                $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                $message .= "<tr style='background: #eee;'><td><strong>".__( 'Name', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $name . "</td></tr>";
                $message .= "<tr><td><strong>".__( 'Email', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $email . "</td></tr>";
                $message .= "<tr style='background: #eee;'><td><strong>".__( 'Phone number', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $phone . "</td></tr>";
                $message .= "<tr><td><strong>".__( 'Check in', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $checkin . "</td></tr>";
                $message .= "<tr style='background: #eee;'><td><strong>".__( 'Check out', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $checkout . "</td></tr>";
                $message .= "<tr><td><strong>".__( 'Adults', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $adults . "</td></tr>";
                $message .= "<tr style='background: #eee;'><td><strong>".__( 'Property', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . get_the_title( $property ) . "</td></tr>";
                $message .= "</table>";
                $message .= "</body></html>";


                $to = $homepage_qrf_email;
                if (!isset($to) || ($to == '') ){
                    $to = get_option('admin_email');
                }

                $emailfrom = $homepage_qrf_email_from;

                //Header admin
                $header_admin = 'From: '.get_option('blogname').' <'.$emailfrom.'>'. "\r\n";
                $header_admin .= 'Reply-To: '.$email. "\r\n";
                $header_admin .= 'Content-Type: text/html; charset=ISO-8859-1'. "\r\n";

                //Header user
                $header_user = 'From: '.get_option('blogname').' <'.$emailfrom.'>'. "\r\n";
                $header_user .= 'Reply-To: '.$emailfrom. "\r\n";
                $header_user .= 'Content-Type: text/html; charset=ISO-8859-1'. "\r\n";

                if ( wp_mail($to, $subject_admin, $message, $header_admin) ) {
                    $status = 'success';
                    $thankyou = '';
                    $error = ($thankyou != '') ? $thankyou : $homepage_qrf_success;
                } else {
                    $error = $homepage_qrf_error;
                }

                wp_mail($email, $subject_user, $message, $header_user);

            } else {
                $error = $email_check;
            }
        }
    }

    $resp = array('status' => $status, 'errmessage' => $error);
    wp_send_json($resp);
}
add_action( 'wp_ajax_qrf_action', 'gg_qrf_ajax' );
add_action( 'wp_ajax_nopriv_qrf_action', 'gg_qrf_ajax' );


//Contact form
function gg_cf_ajax() {
    //Get the post igg_d
    $post_id = absint($_POST['post_id']);

    $contact_page_email      = get_field( 'gg_contact_page_email',$post_id);
    $contact_page_email_from = get_field( 'gg_contact_page_email_from',$post_id);
    $contact_page_success    = get_field( 'gg_contact_page_success_msg',$post_id);
    $contact_page_error      = get_field( 'gg_contact_page_error_msg',$post_id);

    if ($contact_page_success == '') {
        $contact_page_success = __( 'Your message was sent successfully.' , OKTHEMES_TEXTDOMAIN );
    }

    if ($contact_page_error == '') {
        $contact_page_error = __( 'There was an error submitting the form.' , OKTHEMES_TEXTDOMAIN );
    }

    if ($contact_page_email_from == '') {
        $contact_page_email_from = 'noreply@yoursitename.com';
    }

    $error = '';
    $status = 'error';

    if ( empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message']) ) {
        $error = __( 'All fields are required to enter.' , OKTHEMES_TEXTDOMAIN );
    } else {
        if (!wp_verify_nonce($_POST['_cf_nonce'], 'contact_form_html')) {
            $error = __( 'Verification error, try again.' , OKTHEMES_TEXTDOMAIN );
        } else {

            $firstname      = sanitize_text_field($_POST['firstname']);
            $lastname       = sanitize_text_field($_POST['lastname']);
            $email          = sanitize_email($_POST['email']);
            $email_check    = gg_check_email($email);
            $phone          = sanitize_text_field($_POST['phone']);
            $messagecf      = esc_textarea($_POST['message']);


            if ($email_check == 1) {

                $subject = sprintf(__( 'New contact form message from : %1$s %2$s' , OKTHEMES_TEXTDOMAIN ), $firstname , $lastname);

                $message = '<html><body>';
                $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                $message .= "<tr style='background: #eee;'><td><strong>".__( 'First name', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $firstname . "</td></tr>";
                $message .= "<tr><td><strong>".__( 'Last name', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $lastname . "</td></tr>";
                $message .= "<tr style='background: #eee;'><td><strong>".__( 'Email', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $email . "</td></tr>";
                $message .= "<tr><td><strong>".__( 'Phone number', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $phone . "</td></tr>";
                $message .= "<tr style='background: #eee;'><td><strong>".__( 'Message', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $messagecf . "</td></tr>";
                $message .= "</table>";
                $message .= "</body></html>";

                $to = $contact_page_email;
                if (!isset($to) || ($to == '') ){
                    $to = get_option('admin_email');
                }

                $emailfrom = $contact_page_email_from;

                $header = 'From: '.get_option('blogname').' <'.$emailfrom.'>'. "\r\n";
                $header .= 'Reply-To: '.$email. "\r\n";
                $header .= 'Content-Type: text/html; charset=ISO-8859-1'. "\r\n";

                if ( wp_mail($to, $subject, $message, $header) ) {
                    $status = 'success';
                    $thankyou = '';
                    $error = ($thankyou != '') ? $thankyou : $contact_page_success;
                } else {
                    $error = $contact_page_error;
                }

            } else {
                $error = $email_check;
            }
        }
    }

    $resp = array('status' => $status, 'errmessage' => $error);
    wp_send_json($resp);
}
add_action( 'wp_ajax_cf_action', 'gg_cf_ajax' );
add_action( 'wp_ajax_nopriv_cf_action', 'gg_cf_ajax' );

//Contact form
function gg_bf_ajax() {

    //Get the post id
    $post_id = absint($_POST['post_id']);

    $booking_page_email      = get_field( 'gg_booking_page_email',$post_id);
    $booking_page_email_from = get_field( 'gg_booking_page_email_from',$post_id);
    $booking_page_success    = get_field( 'gg_booking_page_success_msg',$post_id);
    $booking_page_error      = get_field( 'gg_booking_page_error_msg',$post_id);

    if ($booking_page_success == '') {
        $booking_page_success = __( 'Your message was sent successfully.' , OKTHEMES_TEXTDOMAIN );
    }

    if ($booking_page_error == '') {
        $booking_page_error = __( 'There was an error submitting the form.' , OKTHEMES_TEXTDOMAIN );
    }

    if ($booking_page_email_from == '') {
        $booking_page_email_from = 'noreply@yoursitename.com';
    }

    $error = '';
    $status = 'error';
    if ( empty($_POST['checkin']) || empty($_POST['checkout']) || empty($_POST['mainproperty']) || empty($_POST['rooms']) || empty($_POST['adults']) || empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['country']) ) {
        $error = __( 'All fields are required to enter.' , OKTHEMES_TEXTDOMAIN );
    } else {
        if (!wp_verify_nonce($_POST['_bf_nonce'], 'booking_form_html')) {
            $error = __( 'Verification error, try again.' , OKTHEMES_TEXTDOMAIN );
        } else {

            $checkin        = sanitize_text_field($_POST['checkin']);
            $checkout       = sanitize_text_field($_POST['checkout']);
            $location       = sanitize_text_field($_POST['mainproperty']);
            $room           = sanitize_text_field($_POST['room']);
            $norooms        = sanitize_text_field($_POST['rooms']);
            $adults         = sanitize_text_field($_POST['adults']);
            $children       = sanitize_text_field($_POST['children']);
            $pets           = sanitize_text_field($_POST['pets']);
            $firstname      = sanitize_text_field($_POST['firstname']);
            $lastname       = sanitize_text_field($_POST['lastname']);
            $email          = sanitize_email($_POST['email']);
            $email_check    = gg_check_email($email);
            $phone          = sanitize_text_field($_POST['phone']);
            $country        = sanitize_text_field($_POST['country']);
            $postcode       = sanitize_text_field($_POST['postcode']);
            $messagebf      = esc_textarea($_POST['message']);


            if ($email_check == 1) {

                //Admin
                $subject_admin = sprintf(__( 'New booking from : %1$s %2$s' , OKTHEMES_TEXTDOMAIN ), $firstname , $lastname);
                //User
                $subject_user = sprintf(__( 'Your booking inquiry on %1$s' , OKTHEMES_TEXTDOMAIN ), get_option('blogname'));

                $message = '<html><body>';
                $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                $message .= "<tr style='background: #eee;'><td><strong>".__( 'Check in', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $checkin . "</td></tr>";
                $message .= "<tr><td><strong>".__( 'Check out', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $checkout . "</td></tr>";
                $message .= "<tr style='background: #eee;'><td><strong>".__( 'Location', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . get_the_title( $location ) . "</td></tr>";
                $message .= "<tr><td><strong>".__( 'Room', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $room."</td></tr>";
                $message .= "<tr style='background: #eee;'><td><strong>".__( 'Number of rooms', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $norooms . "</td></tr>";
                $message .= "<tr><td><strong>".__( 'Adults', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $adults . "</td></tr>";
                $message .= "<tr style='background: #eee;'><td><strong>".__( 'Children', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $children . "</td></tr>";
                $message .= "<tr><td><strong>".__( 'Pets', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $pets . "</td></tr>";
                $message .= "<tr style='background: #eee;'><td><strong>".__( 'First name', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $firstname . "</td></tr>";
                $message .= "<tr><td><strong>".__( 'Last name', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $lastname . "</td></tr>";
                $message .= "<tr style='background: #eee;'><td><strong>".__( 'Email', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $email . "</td></tr>";
                $message .= "<tr><td><strong>".__( 'Phone number', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $phone . "</td></tr>";
                $message .= "<tr style='background: #eee;'><td><strong>".__( 'Country', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $country . "</td></tr>";
                $message .= "<tr><td><strong>".__( 'Postcode', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $postcode . "</td></tr>";
                $message .= "<tr style='background: #eee;'><td><strong>".__( 'Message', OKTHEMES_TEXTDOMAIN)."</strong> </td><td>" . $messagebf . "</td></tr>";
                $message .= "</table>";
                $message .= "</body></html>";

                $to = $booking_page_email;
                if (!isset($to) || ($to == '') ){
                    $to = get_option('admin_email');
                }

                $emailfrom = $booking_page_email_from;

                //Header admin
                $header_admin = 'From: '.get_option('blogname').' <'.$emailfrom.'>'. "\r\n";
                $header_admin .= 'Reply-To: '.$email. "\r\n";
                $header_admin .= 'Content-Type: text/html; charset=ISO-8859-1'. "\r\n";

                //Header user
                $header_user = 'From: '.get_option('blogname').' <'.$emailfrom.'>'. "\r\n";
                $header_user .= 'Reply-To: '.$emailfrom. "\r\n";
                $header_user .= 'Content-Type: text/html; charset=ISO-8859-1'. "\r\n";

                if ( wp_mail($to, $subject_admin, $message, $header_admin) ) {
                    $status = 'success';
                    $thankyou = '';
                    $error = ($thankyou != '') ? $thankyou : $booking_page_success;
                } else {
                    $error = $booking_page_error;
                }

                //Send user email
                wp_mail($email, $subject_user, $message, $header_user);

            } else {
                $error = $email_check;
            }
        }
    }

    $resp = array('status' => $status, 'errmessage' => $error);
    wp_send_json($resp);
}
add_action( 'wp_ajax_bf_action', 'gg_bf_ajax' );
add_action( 'wp_ajax_nopriv_bf_action', 'gg_bf_ajax' );



/* Subcategories */
function gg_property_rooms(){

$property_id              = absint($_POST['main_propertyid']);
$property_whole_price     = get_field('gg_property_meta_price_booking',$property_id);
$property_whole_price_per = get_field('gg_property_meta_price_booking_per',$property_id);

$post_thumbnail_id = get_post_thumbnail_id( $property_id );
?>

<div class="radio">
    <label>
        <div class="col-md-1">
            <input type="radio" name="room" value="whole_property" checked="checked">
        </div>
        <div class="col-md-4 gg-room-name">
            <?php _e('Whole property',OKTHEMES_TEXTDOMAIN) ?>
        </div>
        <div class="col-md-3 gg-room-type">
            <?php echo get_the_title($property_id); ?>
        </div>
        <div class="col-md-3 gg-room-price">
            <?php echo esc_html($property_whole_price).'<span>'.esc_html($property_whole_price_per).'</span>'; ?>
        </div>
        <div class="col-md-1">
            <span class="gg-tooltip-trigger"></span>
            <div id="gg-tooltip">
                <img class="wp-post-image" src="<?php echo gg_aq_resize( $post_thumbnail_id, 150, 85, true, true ); ?>" />
            </div>
        </div>
    </label>
</div>

<?php if( have_rows('gg_room', $property_id) ): ?>

    <em class="gg-book-options"><?php _e('or book a room',OKTHEMES_TEXTDOMAIN); ?></em>

    <?php while( have_rows('gg_room',$property_id) ): the_row();

    // vars
    $room_name      = get_sub_field('gg_room_name');
    $room_type      = get_sub_field('gg_room_type');
    $room_price     = get_sub_field('gg_room_price');
    $room_price_per = get_sub_field('gg_room_price_per');
    $room_image     = get_sub_field('gg_room_image');
    $room_show      = get_sub_field('gg_room_show_on_booking_page');
    ?>

    <?php if ($room_show) : ?>
    <div class="radio">
      <label>
        <div class="col-md-1">
            <input type="radio" name="room" value="<?php echo esc_attr($room_name); ?>">
        </div>
        <div class="col-md-4 gg-room-name">
            <?php echo esc_html($room_name); ?>
        </div>
        <div class="col-md-3 gg-room-type">
            <?php echo esc_html($room_type); ?>
        </div>
        <div class="col-md-3 gg-room-price">
            <?php echo esc_html($room_price).'<span>'.esc_html($room_price_per).'</span>'; ?>
        </div>
        <div class="col-md-1">
            <?php if ($room_image) : ?>
            <span class="gg-tooltip-trigger"></span>
            <div id="gg-tooltip">
                <img class="wp-post-image" src="<?php echo aq_resize( $room_image['url'], 150, 85, true, true ); ?>" alt="<?php echo esc_html($room_image['alt']); ?>" />
            </div>
            <?php endif; ?>
        </div>
      </label>
    </div>
    <?php endif; ?>

    <?php endwhile; ?>

<?php endif; ?>

<?php

die();

}

add_action('wp_ajax_property_rooms', 'gg_property_rooms');
add_action('wp_ajax_nopriv_property_rooms', 'gg_property_rooms');

/* Property map info */
function gg_property_map_info(){

$property_id = $_POST['main_propertyid'];

// WP_Query arguments
$args = array (
    'post_type'              => 'property_cpt',
    'p'                      => $property_id,
    'posts_per_page'         => -1,
    'ignore_sticky_posts'    => true
);

// The Query
$property_query = new WP_Query( $args ); ?>

<?php
// The Loop
if ( $property_query->have_posts() ) :
    while ( $property_query->have_posts() ) : $property_query->the_post();
    $property_areas_content = get_field('gg_areas_property_short_description');
    ?>
        <h1 class="property-title"><strong><?php _e('About',OKTHEMES_TEXTDOMAIN); ?></strong> <?php echo get_the_title(); ?></h1>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <?php echo wp_kses_post($property_areas_content); ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

<?php

die();

}

add_action('wp_ajax_property_map_info', 'gg_property_map_info');
add_action('wp_ajax_nopriv_property_map_info', 'gg_property_map_info');

function gg_property_select_form() { ?>

<?php
if ( (is_singular('property_cpt') ) || is_page_template('theme-templates/areas.php') || is_page_template('theme-templates/areas-var2.php') ) : ?>

<div class="property-select-form pull-right">
    <form action="<?php echo esc_url(home_url()); ?>" method="get">
        <select name="gg_property_select_form" id="gg_property_select_form" class="cs-select cs-skin-border">
        <?php

        $args       = array( 'posts_per_page' => -1, 'post_type' => 'property_cpt');
        $myposts    = get_posts( $args );
        $current_id = get_queried_object_id();

        foreach ( $myposts as $post ) : setup_postdata( $post );
            $selected = ( $current_id == $post->ID ) ? ' selected="selected"' : '';
            $property_meta_location_country = get_field('gg_property_meta_location_country',$post->ID);
            printf( '<option class="level-0" %s value="%s">%s, %s</option>', $selected, get_permalink($post->ID), get_the_title($post->ID), $property_meta_location_country);
        endforeach;
        ?>
        </select>
    </form>
</div>

<script type='text/javascript'>
/* <![CDATA[ */
    jQuery(function(){
        jQuery("select#gg_property_select_form").minimalect({
            placeholder : "<?php _e('Select a property',OKTHEMES_TEXTDOMAIN); ?>",
            searchable: false,
            onchange: function(value, url) {
                var url = value; // get selected value
                if (url) { // require a URL
                    window.location = url; // redirect
                }
                return false;
            }
        });
    });
/* ]]> */
</script>

<?php endif; ?>

<?php
}
