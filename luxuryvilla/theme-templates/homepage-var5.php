<?php
/**
 * Template Name: Homepage Var 5
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header();

//Load carousel
wp_enqueue_script('owlcarousel');

?>

<script type="text/javascript">
jQuery(document).ready(function($) {
 
  var sync1 = $("#homepage-var5-gallery-owl");
  var sync2 = $("#homepage-var5-prop-owl");
 
  sync1.owlCarousel({
    singleItem : true,
    transitionStyle : 'fade',
    slideSpeed : 1000,
    navigation: true,
    navigationText: ["<i class='entypo entypo-left-open-big'></i>","<i class='entypo entypo-right-open-big'></i>"],
    pagination:false,
    afterAction : syncPosition,
    responsiveRefreshRate : 200
  });
 
  sync2.owlCarousel({
    pagination:false,
    responsiveRefreshRate : 100,
    afterInit : function(el){
      el.find(".owl-item").eq(0).addClass("synced");
    }
  });
 
  function syncPosition(el){
    var current = this.currentItem;
    $("#homepage-var5-prop-owl")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if($("#homepage-var5-prop-owl").data("owlCarousel") !== undefined){
      center(current)
    }
  }
 
  $("#homepage-var5-prop-owl").on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).data("owlItem");
    sync1.trigger("owl.goTo",number);
  });
 
  function center(number){
    var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in sync2visible){
      if(num === sync2visible[i]){
        var found = true;
      }
    }
 
    if(found===false){
      if(num>sync2visible[sync2visible.length-1]){
        sync2.trigger("owl.goTo", num - sync2visible.length+2)
      }else{
        if(num - 1 === -1){
          num = 0;
        }
        sync2.trigger("owl.goTo", num);
      }
    } else if(num === sync2visible[sync2visible.length-1]){
      sync2.trigger("owl.goTo", sync2visible[1])
    } else if(num === sync2visible[0]){
      sync2.trigger("owl.goTo", num-1)
    }
    
  }
 
});
</script>

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

    <div class="homepage-var5-property-holder">
    
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

                <div id="homepage-var5-prop-owl" class="col-md-4 owl-carousel">

                    <?php $i=0; while ( $property_query->have_posts() ) : $property_query->the_post(); $i++;?>

                            <div class="homepage-var5-property">
                                
                                <h1><?php echo gg_wrap_word(get_the_title()); ?></h1>

                            </div>
                        
                    <?php endwhile; ?>

                </div><!-- /homepage-var5-gallery-owl -->
                
            <?php } ?>

            <?php 
            // Restore original Post Data    
            wp_reset_postdata();
            ?>


            <?php
            // WP_Query arguments
            $args_gallery = array (
                'post_type'              => 'property_cpt',
                'post__not_in'           => $exclude_ids,
                'posts_per_page'         => -1, 
                'ignore_sticky_posts'    => true
            );

            // The Query
            $property_query_gallery = new WP_Query( $args_gallery );

            // The Loop
            if ( $property_query_gallery->have_posts() ) { ?>

            <div id="homepage-var5-gallery-owl" class="slideshow-property-gallery col-md-8 owl-carousel">

            <?php $i=0; while ( $property_query_gallery->have_posts() ) : $property_query_gallery->the_post(); $i++;?>
            <?php 
            
            //Get Property options
            $property_meta_location_city = get_field('gg_property_meta_location_city');
            $property_meta_location_country = get_field('gg_property_meta_location_country');
            $property_meta_location = implode(', ', array($property_meta_location_city, $property_meta_location_country));

            $property_meta_price = get_field('gg_property_meta_price');
            $property_meta_wheather = get_field('gg_property_meta_wheather');
            $property_homepage_slideshow_images = get_field( 'gg_property_homepage_slideshow_images');

            ?>

            <div class="homepage-var5-gallery-wrapper">

                <div class="homepage-var5-property-meta">
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
                <?php if( $property_homepage_slideshow_images ): ?>
                    <ul id="cbp-bi-<?php echo esc_attr($i); ?>" class="cbp-bislideshow">
                        <?php foreach ( $property_homepage_slideshow_images as $property_homepage_slideshow_image ) : ?>
                            <li><img src="<?php echo esc_url($property_homepage_slideshow_image['url']); ?>" alt="<?php echo esc_attr($property_homepage_slideshow_image['alt']); ?>"/></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php if ($no_of_property_images > 1) : ?>
                    <div id="cbp-bi-<?php echo esc_attr($i); ?>-controls" class="cbp-bicontrols">
                        <span class="cbp-biprev"></span>
                        <span class="cbp-bipause"></span>
                        <span class="cbp-binext"></span>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div><!-- /.homepage-var5-gallery-wrapper -->

            <?php endwhile; ?>

            </div><!-- /#homepage-var5-prop-owl -->
            <?php } ?>

            <?php 
            // Restore original Post Data    
            wp_reset_postdata();
            ?>

        </div>

    </div> <!-- /.homepage-var3-property-holder -->

</section>

<?php get_footer(); ?>