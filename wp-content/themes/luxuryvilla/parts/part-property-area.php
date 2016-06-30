<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
?>

<figure class="effect-milo-sh">

	<?php 
	    
		$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "full", false, '' );
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