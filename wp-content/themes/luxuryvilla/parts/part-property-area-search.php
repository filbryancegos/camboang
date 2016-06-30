<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
?>

<?php
	//Get Property options
	$property_meta_location_city    = get_field('gg_property_meta_location_city');
	$property_meta_location_country = get_field('gg_property_meta_location_country');
	$property_meta_location         = implode(', ', array($property_meta_location_city, $property_meta_location_country));
	$property_meta_address          = get_field('gg_property_meta_location_address');
	$property_meta_price            = get_field('gg_property_meta_price');
	$property_sleeps                = get_field('gg_sleeps');
	$property_bedrooms              = get_field('gg_bedrooms');
	$property_bathrooms             = get_field('gg_bathrooms');

    $property_in = get_the_terms( $post->ID, 'property_category' );
    
    if ( $property_in && ! is_wp_error( $property_in ) ) : 
		$property_in_terms = array();
		foreach ( $property_in as $term ) {
			$property_in_terms[] = $term->name;
		}
		$property_in_terms_list = join( ", ", $property_in_terms );
	endif;
?>

<figure class="effect-milo-sh">

	<?php 
	    $src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
	    $property_area_image_url = $src[0];

	?>

	<?php if ( 1 == get_theme_mod( 'lazyload') ) : ?>
    	<img class="lazy" data-original="<?php echo esc_url($property_area_image_url); ?>" alt="<?php echo get_the_title(); ?>"/>
    <?php else : ?>
    	<img src="<?php echo esc_url($property_area_image_url); ?>" alt="<?php echo get_the_title(); ?>"/>
    <?php endif; ?>

    <figcaption>
    	<span class="el-grid-more">
	    	<a class="link-wrapper" href="<?php echo get_permalink(); ?>">
	    		<i class="entypo entypo-list"></i>
	    	</a>
		</span>
		<h4><?php echo gg_wrap_word(get_the_title()); ?></h4>
    </figcaption>
</figure>
<ul class="property-meta-search">
	<?php if ($property_in_terms_list) : ?>
	<li class="property-meta-type"><i class="entypo entypo-layout"></i><?php echo esc_html($property_in_terms_list); ?></li>
	<?php endif; ?>

	<?php if ($property_meta_location != ', ') : ?>
    <li class="property-meta-location"><i class="entypo entypo-location"></i><?php echo esc_html( $property_meta_location ); ?></li>
    <?php endif; ?>
    <?php if ($property_meta_price) : ?>
    <li class="property-meta-price"><i class="entypo entypo-bookmark"></i><?php echo esc_html( $property_meta_price ); ?></li>
    <?php endif; ?>
    <?php if ($property_sleeps) : ?>
	<li><i class="entypo entypo-users"></i><?php _e('Sleeps','okthemes'); ?> <?php echo esc_html($property_sleeps); ?></li>
	<?php endif; ?>
	<?php if ($property_bedrooms) : ?>
	<li><span class="icon icon-bedroom"></span><?php echo esc_html($property_bedrooms); ?> <?php if ($property_bedrooms == '1') echo __('bedroom','okthemes'); else echo __('bedrooms','okthemes'); ?></li>
	<?php endif; ?>
	<?php if ($property_bathrooms) : ?>
	<li><span class="icon icon-bathroom"></span><?php echo esc_html($property_bathrooms); ?> <?php if ($property_bedrooms == '1') echo __('bathroom','okthemes'); else echo __('bathrooms','okthemes'); ?></li>
	<?php endif; ?>
</ul>


