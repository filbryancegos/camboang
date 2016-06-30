<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
?>

<?php 

global $gallery_columns_class;

while( have_rows('gg_gallery') ): the_row(); 
	// vars
	$gallery_name = get_sub_field('gg_gallery_name');
	$gallery_images = get_sub_field('gg_gallery_images');
	?>

	<?php foreach ($gallery_images as $gallery_image) : ?>

		<li class="<?php echo esc_attr( $gallery_columns_class ); ?> isotope-item grid-cat-<?php echo sanitize_title(get_the_title()); ?> grid-subcat-<?php echo sanitize_title($gallery_name); ?>" >
		    <figure class="effect-milo-sh">
			    <?php
	                $gallery_image_url = $gallery_image['url']; 
			    ?>

			    <?php if ( 1 == get_theme_mod( 'lazyload') ) : ?>
		    		<img class="lazy" data-original="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php echo esc_attr( $gallery_image['alt'] ); ?>" />
		    	<?php else : ?>
		    		<img src="<?php echo esc_url( $gallery_image_url ); ?>" alt="<?php echo esc_attr( $gallery_image['alt'] ); ?>" />
		    	<?php endif; ?>
			    
			    <figcaption>
			    	<span class="el-grid-more">
				    	<a class="lightbox-el link-wrapper" href="<?php echo esc_url( $gallery_image['url'] ); ?>">
				    		<i class="entypo entypo-popup"></i>
				    	</a>
			    	</span>
			    	<?php if ($gallery_image['caption'] != '') : ?>
			     	<h4><?php echo gg_wrap_word($gallery_image['caption']); ?></h4>
			     	<?php endif; ?>
			    </figcaption>
				
			</figure>
		</li><!-- // property item column -->

	<?php endforeach; ?>

<?php endwhile; ?>

