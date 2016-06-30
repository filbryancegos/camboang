<?php
/**
 * Template Name: Contact Page
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header(); ?>

<?php gg_page_header(); ?>

<?php

$contact_form                 = get_field( 'gg_contact_form' );

$contact_phone                = get_field( 'gg_contact_phone' );
$contact_email                = get_field( 'gg_contact_email' );
$contact_address              = get_field( 'gg_contact_address' );

$contact_map                  = get_field( 'gg_contact_map' );
$contact_map_latitude         = get_field( 'gg_contact_map_latitude' );
$contact_map_longitude        = get_field( 'gg_contact_map_longitude' );
$contact_zoom                 = get_field( 'gg_contact_zoom' );
$contact_map_infowindow       = get_field( 'gg_contact_map_infowindow' );
$contact_map_infowindow_clean = preg_replace('/^\s+|\n|\r|\s+$/m', '', $contact_map_infowindow);
$contact_map_infowindow_title = get_field( 'gg_contact_map_infowindow_title' );
?>

<?php if ($contact_map) {
//Enqueue scripts
wp_enqueue_script('google-map-api');
wp_enqueue_script('maplace');
$map_marker = get_template_directory_uri() .'/images/map-marker.png';

if (!$contact_zoom)
    $contact_zoom = '12';

?>

<!-- Map script -->
<script type="text/javascript">
;(function ($, window, undefined) {
$(document).ready(function() {

var contact_map = new Maplace({
    locations:
        [{
            lat: <?php echo esc_js($contact_map_latitude); ?>,
            lon: <?php echo esc_js($contact_map_longitude); ?>,
            icon : <?php echo json_encode($map_marker); ?>,
            title: <?php echo json_encode($contact_map_infowindow_title); ?>,
            html: <?php echo json_encode($contact_map_infowindow_clean); ?>,
            zoom: <?php echo esc_js($contact_zoom); ?>
        }
    ],
    map_div: '#contact-map',
    styles: {
        'LightGrey': [{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3d3d3"}]},{"featureType":"transit","stylers":[{"color":"#808080"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b3b3b3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":1.8}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#d7d7d7"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ebebeb"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#a7a7a7"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#696969"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#d6d6d6"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#dadada"}]}]
    },

});

contact_map.Load();

$('#gg-view-on-map').click(function(e) {
    e.preventDefault();
    $('.contact-map-overlay').fadeOut(100, function() {
        $('#contact-map').fadeTo( "slow", 1 );
    });
});

});//ready

})(jQuery, this);

</script>
<?php } ?>

<!-- Map holder -->
<?php if ( $contact_phone ||  $contact_address || $contact_email || $contact_map) { ?>
<div class="contact-map-wrapper">
    <div class="contact-map-overlay">

        <div class="contact-map-address-wrapper col-md-12">
            <?php if ($contact_phone) { ?>
            <div class="col-md-4">
                <i class="entypo entypo-phone"></i>
                <p><?php echo esc_html($contact_phone); ?></p>
            </div>
            <?php } ?>

            <?php if ($contact_address) { ?>
            <div class="col-md-4">
                <address>
                    <i class="entypo entypo-location"></i><br/>
                    <?php echo esc_html($contact_address); ?>
                </address>
                <?php if ($contact_map) { ?>
                <a id="gg-view-on-map" class="btn btn-primary" href="#"><?php esc_html_e('View on map', 'okthemes'); ?></a>
                <?php } ?>
            </div>
            <?php } ?>

            <?php if ($contact_email) { ?>
            <div class="col-md-4">
                <i class="entypo entypo-mail"></i>
                <a class="gg-contact-email" href="mailto:<?php echo antispambot($contact_email,1); ?>"><?php echo antispambot($contact_email); ?></a>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php if ($contact_map) { ?>
    <div id="contact-map" style="opacity:0"></div>
    <?php } ?>

</div>
<?php } ?>



<?php $vc_is_active = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true ); ?>

    <section id="content" class="page-fullscreen">

        <?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

        <?php if ( $vc_is_active === 'true' ) : ?>

            <div id="content" <?php post_class( 'visual-composer-page' ); ?>>

                <?php the_content(); ?>

            </div>

        <?php else : ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                
                <?php get_template_part( 'parts/part', 'page' ); ?>
                <?php comments_template( '', true ); ?>

                <div class="clearfix"></div>

                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->

        <?php endif; ?>

        <?php endwhile; endif; ?>

        <?php if ($contact_form) : ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                <?php get_template_part( 'parts/part','contact-form' ); ?>

                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
        <?php endif; ?>

    </section>

<?php get_footer(); ?>