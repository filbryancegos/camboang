<div class="single-property-quarter-screen">
<?php 
//Get Property options
$property_meta_location_city = get_field('gg_property_meta_location_city');
$property_meta_location_country = get_field('gg_property_meta_location_country');
$property_meta_price = get_field('gg_property_meta_price');
$property_meta_wheather = get_field('gg_property_meta_wheather');
$property_single_slideshow_images = get_field( 'gg_property_single_slideshow_images');
$no_of_property_images = count($property_single_slideshow_images);

$property_overview_content = get_field('gg_overview_content');
$property_meta_location = implode(', ', array_filter(array($property_meta_location_city, $property_meta_location_country)));

$property_meta = get_field('gg_property_meta');
$property_share_box = get_field('gg_property_share_box');
$property_book_now = get_field('gg_property_book_now');
$property_book_now_url = get_field('gg_property_book_now_url');

//Conditionals for Share
$permalink = get_permalink($post->ID);
$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');
$featured_image = $featured_image['0'];
$post_title = rawurlencode(get_the_title($post->ID));

?>

<?php if( $property_single_slideshow_images ): ?>
<div class="single-property-gallery col-md-10">
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

    <div class="single-property-controls">
	    <!-- Slideshow controls -->
	    <?php if ($no_of_property_images > 1) : ?>
	    <div id="cbp-bi-controls" class="cbp-bicontrols">
	        <span class="cbp-biprev"></span>
	        <span class="cbp-bipause"></span>
	        <span class="cbp-binext"></span>
	    </div>
	    <?php endif; ?>

	    <!-- Property title -->
	    <h1 class="single-property-title"><?php echo gg_wrap_word(get_the_title()); ?></h1>
    </div><!-- /.single-property-controls -->

</div><!-- /.col-md-10 -->
<?php endif; ?>

<div class="single-property-content col-md-2">
    <!-- Property meta -->
    <?php if ($property_meta) : ?>
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
        </ul>
    </div>
    <?php endif; ?>
    
    <!-- Property content -->
    <div class="single-property-content-area">
        
        <?php if ($property_overview_content) : ?>
        <?php echo wp_kses_post($property_overview_content); ?>
        <?php endif; ?>

        <?php if ($property_share_box) : ?>
        <div class="post-social">
            <p class="gg-share"><?php _e('Share', 'okthemes'); ?></p>
            <ul class="list-inline">
            	<li><a class="symbol social-facebook" title="circlefacebook" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink); ?>&amp;images=<?php echo esc_url($featured_image); ?>"></a></li>
                <li><a class="symbol social-twitter" title="circletwitter" target="_blank" href="https://twitter.com/share?url=<?php echo esc_url($permalink); ?>&amp;text=Check out this <?php echo esc_url($permalink); ?>"></a></li>
            </ul>
        </div>
        <?php endif; ?>

        <?php if ($property_book_now) : ?>
        <a class="gg-book-now btn btn-primary btn-block" href="<?php echo esc_url($property_book_now_url); ?>"><?php _e('Book Now','okthemes'); ?></a>
        <?php endif; ?>

    </div>

</div><!-- /.col-md-3 -->

</div><!-- /.single-property-quarter-screen -->