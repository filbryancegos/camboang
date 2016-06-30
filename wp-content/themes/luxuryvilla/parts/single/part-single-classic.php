<div class="single-property-full-screen">

    <?php 
    //Get Property options
    $property_meta_location_city = get_field('gg_property_meta_location_city');
    $property_meta_location_country = get_field('gg_property_meta_location_country');
    $property_meta_price = get_field('gg_property_meta_price');
    $property_meta_wheather = get_field('gg_property_meta_wheather');
    $property_meta_reserve = get_field('gg_property_reserve_now_url');
    $property_single_slideshow_images = get_field( 'gg_property_single_slideshow_images');
    $no_of_property_images = count($property_single_slideshow_images);

    $property_meta_location = implode(', ', array($property_meta_location_city, $property_meta_location_country));
    ?>

    <?php if( $property_single_slideshow_images ): ?>
    <div class="single-property-gallery col-md-12">
        <ul id="cbp-bi" class="cbp-bislideshow">
            <?php foreach ( $property_single_slideshow_images as $property_single_slideshow_image ) : ?>
                <li>
                    <img src="<?php echo esc_url( $property_single_slideshow_image['url'] );?>" alt="<?php echo esc_attr( $property_single_slideshow_image['alt'] ); ?>"/>
                    <?php if($property_single_slideshow_image['caption']) : ?>
                    <p class="single-property-img-caption"><?php echo esc_html( $property_single_slideshow_image['caption'] );?></p>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php if ($no_of_property_images > 1) : ?>
        <div id="cbp-bi-controls" class="cbp-bicontrols">
            <span class="cbp-biprev"></span>
            <span class="cbp-bipause"></span>
            <span class="cbp-binext"></span>
        </div>
        <?php endif; ?>
    </div><!-- /.single-property-gallery .col-md-12 -->
    <?php endif; ?>

    <div class="single-property-content gg-sans-overflow col-md-12">
        <!-- Property title -->
        <h1 class="single-property-title"><?php echo gg_wrap_word(get_the_title()); ?></h1>
        <!-- Property meta -->
        <div class="single-property-meta">    
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
                
                <?php if ($property_meta_reserve) : ?>
                <li class="property-meta-link"><a class="more-link" href="<?php echo esc_url( $property_meta_reserve ); ?>"><i class="entypo entypo-right-open"></i><?php _e('Reserve now','okthemes') ?></a></li>
                <?php endif; ?>
                
            </ul>
        </div>
        
        <!-- Property content -->
        <div class="clearfix"></div>
        <div class="single-property-content-area">
            <?php the_content(); ?>
        </div>

    </div><!-- /.col-md-12 -->

</div><!-- /.single-property-full-screen -->