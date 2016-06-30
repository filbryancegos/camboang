<?php
/**
 * Template Name: Homepage Var 1
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header(); ?>

<?php
    global $page_id;
    $page_id = ( is_front_page() ? get_option( 'page_on_front' ) : get_the_ID() );
    $homepage_sidebar = get_field('gg_homepage_sidebar', $page_id);
    $homepage_qrf     = get_field('gg_homepage_qrf', $page_id);
    $exclude_field    = get_field('gg_exclude_properties', $page_id);

    if ($exclude_field) {
        $exclude_ids = array_values($exclude_field);
    } else {
        $exclude_ids = '';
    }

    //Slideshow options
    $slider_autoplay         = get_field('gg_slider_autoplay', $page_id);
    $slider_autoplay_speed   = get_field('gg_slider_autoplay_speed', $page_id);
    $background_images_speed = get_field('gg_background_images_speed', $page_id);

    if (!$slider_autoplay || $slider_autoplay === NULL || $slider_autoplay_speed === NULL) {
        $slider_autoplay_speed = 'false';
    }

    if ($background_images_speed === NULL) {
       $background_images_speed = '6000';
    }

?>

<?php
if ($homepage_qrf)
    get_template_part( 'parts/part','quick-reservation' );
?>

<section id="content" class="page-fullscreen ip-main <?php if ( $homepage_sidebar && ('horizontal' == get_theme_mod( 'layout_style', 'horizontal' )) ) echo 'gg-page-has-sidebar'; ?>">

    <?php
    //Load carousel
    wp_enqueue_script('owlcarousel');

    // WP_Query arguments
    $args = array (
        'post_type'              => 'property_cpt',
        'post__not_in'           => $exclude_ids,
        'posts_per_page'         => -1,
        'ignore_sticky_posts'    => true
    );

    // The Query
    $property_query = new WP_Query( $args );

        // The Loop
        if ( $property_query->have_posts() ) { ?>

            <div id="single-project-gallery"
            class                   = "owl-carousel homepage-slideshow-1"
            data-slides-per-view    = "1"
            data-single-item        = "true"
            data-transition-slide   = "fade"
            data-navigation-owl     = "false"
            data-pagination-owl     = "false"
            data-lazyload           = "false"
            data-autoplay           = "<?php echo esc_attr($slider_autoplay_speed); ?>"
            data-autoplay-bg-images = "<?php echo esc_attr($background_images_speed); ?>"
            data-rewind             = "true"
            data-speed              = "5000"
            data-height             = "false">

                <?php $i=0; while ( $property_query->have_posts() ) : $property_query->the_post(); $i++;?>

                    <?php
                    //Get Property options
                    $property_meta_location_city        = get_field('gg_property_meta_location_city');
                    $property_meta_location_country     = get_field('gg_property_meta_location_country');
                    $property_meta_location             = implode(', ', array($property_meta_location_city, $property_meta_location_country));

                    $property_meta_price                = get_field('gg_property_meta_price');
                    $property_meta_wheather             = get_field('gg_property_meta_wheather');
                    $property_homepage_slideshow_images = get_field( 'gg_property_homepage_slideshow_images');
                    $no_of_property_images              = count($property_homepage_slideshow_images);
                    ?>

                    <div class="slideshow-property">
                        <?php if( $property_homepage_slideshow_images ): ?>
                        <div class="slideshow-property-gallery">
                            <ul id="cbp-bi-<?php echo esc_attr($i); ?>" class="cbp-bislideshow">
                                <?php
                                    foreach ( $property_homepage_slideshow_images as $property_homepage_slideshow_image ) :
                                        $detect = new Mobile_Detect();
                                        if ( $detect->isMobile() ) {
                                            // Featured image for mobile users
                                           $property_homepage_slideshow_image_url = aq_resize( $property_homepage_slideshow_image['url'], 736, 380, true );
                                        } elseif ( $detect->isTablet() ) {
                                            // Featured image for tablet users
                                           $property_homepage_slideshow_image_url = aq_resize( $property_homepage_slideshow_image['url'], 1024, 568, true );
                                        } else {
                                           // Featured image for all other users
                                           $property_homepage_slideshow_image_url = $property_homepage_slideshow_image['url'];
                                        }
                                ?>
                                    <li>
                                        <img src="<?php echo esc_url($property_homepage_slideshow_image_url); ?>" alt="<?php echo esc_attr($property_homepage_slideshow_image['alt']); ?>"/>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php if ($no_of_property_images > 1) : ?>
                            <div id="cbp-bi-<?php echo esc_attr($i); ?>-controls" class="cbp-bicontrols">
                                <span class="cbp-biprev"></span>
                                <span class="cbp-bipause"></span>
                                <span class="cbp-binext"></span>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <div class="slideshow-property-meta">
                            <h1><?php echo gg_wrap_word(get_the_title()); ?></h1>
                            <ul class="property-meta list-inline">

                                <?php if ($property_meta_location != ', ') : ?>
                                <li class="property-meta-location"><i class="entypo entypo-location"></i><?php echo esc_html( $property_meta_location ); ?></li>
                                <?php endif; ?>

                                <?php if ($property_meta_price) : ?>
                                <li class="property-meta-price"><i class="entypo entypo-bookmark"></i><?php echo esc_html( $property_meta_price ); ?></li>
                                <?php endif; ?>
                                <?php if ($property_meta_wheather) : ?>
                                <li class="property-meta-wheather"><i class="entypo entypo-light-up"></i><?php echo esc_html( $property_meta_wheather ); ?></li>
                                <?php endif; ?>

                                <li class="property-meta-link"><a class="more-link" href="<?php the_permalink(); ?>"><i class="entypo entypo-right-open"></i><?php _e('More details','okthemes') ?></a></li>

                            </ul>
                        </div>

                    </div>

                <?php endwhile; ?>

            </div>

            <?php
            //Display navigation if we have more than 1 post
            if ( $property_query->found_posts > 1 ) : ?>
            <div class="slideshow-property-navigation">
                <a class="custom-property-nav prev"><i class="entypo entypo-left-open-big"></i></a>
                <a class="custom-property-nav next"><i class="entypo entypo-right-open-big"></i></a>
            </div>
            <?php endif; ?>

            <?php } else { ?>

            <div class="no-properties-availble">
                <h3><?php _e( 'No properties available', 'okthemes' ); ?></h3>
            </div>

            <?php } ?>

            <?php
            // Restore original Post Data
            wp_reset_postdata();
            ?>

            <?php if ( $homepage_sidebar && ('horizontal' == get_theme_mod( 'layout_style', 'horizontal' )) ) : ?>
            <div class="slideshow-sidebar">
                <?php get_sidebar('vertical'); ?>
            </div>
            <?php endif; ?>

</section>

<?php get_footer(); ?>
