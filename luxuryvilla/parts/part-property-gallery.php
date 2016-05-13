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
    if ( has_post_thumbnail() )
        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');

        if ( 1 == get_theme_mod( 'lazyload') ) {
            echo '<img class="lazy" data-original="'.$image[0].'" alt="" />';
        } else {
           echo '<img src="'.$image[0].'" alt="" />'; 
        }
    ?>
    <figcaption>
	    <span class="el-grid-more">
	    	<a class="lightbox-el link-wrapper" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>">
	    		<i class="entypo entypo-popup"></i>
	    	</a>
		</span>
    	<h4><?php echo gg_wrap_word(get_the_title()); ?></h4>
    </figcaption>
</figure>