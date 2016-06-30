<?php
/**
 * Property post template
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header(); ?>

<?php gg_page_header(); ?>

<section id="content" class="page-fullscreen">
    <div class="container-fluid">
        <div class="row">
            <?php while (have_posts()) : the_post();

                $property_single_layout_style = get_field('gg_property_single_layout_style');
                
                if ($property_single_layout_style != '') 
                    get_template_part( 'parts/single/part', 'single-' . esc_html($property_single_layout_style) );
                else
                    get_template_part( 'parts/single/part', 'single-half-screen' );
                ?>

            <?php endwhile; // end of the loop. ?>

        </div><!-- /.row -->
    </div><!--/.container -->    
</section>

<?php get_footer(); ?>