<?php
/**
 * Template Name: Homepage Var 3
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header(); ?>

<section id="content" class="page-fullscreen ip-main <?php if ('horizontal' == get_theme_mod( 'layout_style', 'horizontal' )) echo 'col-md-10 col-md-offset-2'; ?>">

    <?php
    $page_id = ( is_front_page() ? get_option( 'page_on_front' ) : get_the_ID() );
    $homepage_images = get_field('gg_homepage_var3_images', $page_id);
    $no_of_property_images = count($homepage_images);

    $exclude_field = get_field('gg_exclude_properties', $page_id);

    if ($exclude_field) {
        $exclude_ids = array_values($exclude_field);
    } else {
        $exclude_ids = '';
    }
    ?>

    <?php if( $homepage_images ): ?>
    <div class="slideshow-homepage-var3-gallery">
        <ul id="cbp-bi-homepage-var3" class="cbp-bislideshow">
            <?php foreach ( $homepage_images as $homepage_image ) : ?>
                <li><img src="<?php echo esc_url($homepage_image['url']); ?>" alt="<?php echo esc_attr($homepage_image['alt']); ?>"/></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <div class="homepage-var3-property-holder">
    
        <?php
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

                    <?php while ( $property_query->have_posts() ) : $property_query->the_post(); ?>

                        <?php

                        $count = $property_query->post_count;
                        //$property_column_class = 'col-md-' . floor( 12 / $count );
                        $property_column_style = 'width: ' . ( 100 / $count ) . '%';

                        //Get Property options
                        $property_meta_location_city = get_field('gg_property_meta_location_city');
                        $property_meta_location_country = get_field('gg_property_meta_location_country');
                        $property_meta_location = implode(', ', array($property_meta_location_city, $property_meta_location_country));

                        $property_meta_price = get_field('gg_property_meta_price');
                        $property_meta_wheather = get_field('gg_property_meta_wheather');
                        $property_homepage_slideshow_images = get_field( 'gg_property_homepage_slideshow_images');
                        ?>

                        <div class="homepage-var3-property" style="<?php echo esc_attr($property_column_style); ?>">
                            
                            <a class="homepage-var3-wrapper-link" href="<?php the_permalink(); ?>"></a>

                            <h1><?php echo gg_wrap_word(get_the_title()); ?></h1>

                            <div class="homepage-var3-property-meta">

                                <ul class="property-meta list-unstyled">

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

                <?php } else { ?>

                <div class="no-properties-availble"> 
                    <h3><?php _e( 'No properties available', 'okthemes' ); ?></h3>  
                </div>
                    
                <?php } ?>

                <?php 
                // Restore original Post Data    
                wp_reset_postdata();
                ?>

    </div> <!-- /.homepage-var3-property-holder -->

</section>

<?php get_footer(); ?>