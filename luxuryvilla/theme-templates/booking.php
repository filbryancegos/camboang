<?php
/**
 * Template Name: Booking Page
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header(); ?>

<?php gg_page_header(); ?>

    <section id="content" class="page-fullscreen">

        <?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

        <div class="container-fluid gg-master-container">
            <div class="row">
                <div class="col-md-12">
                
                <?php get_template_part( 'parts/part', 'page' ); ?>
                <?php comments_template( '', true ); ?>

                <div class="clearfix"></div>

                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->

        <?php endwhile; endif; ?>

        <!-- Begin booking form -->

        <?php get_template_part( 'parts/part','booking-form' ); ?>

        <!-- End booking form -->

    </section>

<?php get_footer(); ?>