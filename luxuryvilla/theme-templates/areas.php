<?php
/**
 * Template Name: Areas Page - Map
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header(); ?>

<?php gg_page_header(); ?>

<?php
//Enqueue scripts
wp_enqueue_script('google-map-api');
wp_enqueue_script('maplace');
$map_marker        = get_template_directory_uri() .'/images/map-marker.png';

$exclude_field     = get_field('gg_exclude_properties');
$map_property_link = get_field('gg_areas_map_property_link');

if ($exclude_field) {
    $exclude_ids = array_values($exclude_field);
} else {
    $exclude_ids = '';
}

// WP_Query arguments
$args = array (
    'post_type'              => 'property_cpt',
    'post__not_in'           => $exclude_ids,
    'posts_per_page'         => -1, 
    'ignore_sticky_posts'    => true
);

// The Query
$map_query = new WP_Query( $args );

// The Loop
if ( $map_query->have_posts() ) {

?>

<!-- Map script -->
<script type="text/javascript">
var $j = jQuery.noConflict();
$j(document).ready(function(){
var LocsB = [

    <?php
    while ( $map_query->have_posts() ) : $map_query->the_post();
    $map_latitude                   = get_field('gg_map_latitude');
    $map_longitude                  = get_field('gg_map_longitude');
    $map_zoom                       = get_field('gg_map_zoom');
    
    $property_meta_location_city    = get_field('gg_property_meta_location_city');
    $property_meta_location_country = get_field('gg_property_meta_location_country');
    $property_meta_location         = implode(', ', array($property_meta_location_city, $property_meta_location_country));
    $property_meta_phone            = get_field('gg_property_meta_phone');
    $property_meta_email            = get_field('gg_property_meta_email');
    $property_meta_address          = get_field('gg_property_meta_location_address');
    $property_directions            = implode(', ', array_filter(array($map_latitude, $map_longitude)));

    if ($map_property_link == 'ajax_page') {
        $map_property_link_html = '<a href="#areas-map-property">'.__('Read more','okthemes') .'</a>';
    } elseif ($map_property_link == 'property_page') {
        $map_property_link_html = '<a href="'.get_permalink().'">'.__('Read more','okthemes') .'</a>';
    }

    if (!$map_zoom)
        $map_zoom = '12';

    ?>

    <?php if ($map_latitude || $map_longitude) :  ?>

    {
        lat: <?php echo esc_js($map_latitude); ?>,
        lon: <?php echo esc_js($map_longitude); ?>,
        title: '<?php echo get_the_title(); ?>',
        html: [
            <?php if (has_post_thumbnail()) : ?>
            '<img class="wp-post-image" src="<?php echo gg_aq_resize( get_post_thumbnail_id(), 173, 100, true, true ); ?>" />',
            <?php endif; ?>
            "<h3><?php echo gg_wrap_word(get_the_title()); ?></h3>",
            <?php if ($property_meta_location != ', ') : ?>
            '<p><strong><?php echo esc_html($property_meta_location); ?></strong></p>',
            <?php endif; ?>
            <?php if ($property_meta_address) : ?>
            '<p><?php echo esc_html($property_meta_address); ?></p>',
            <?php endif; ?>
            <?php if ($property_meta_phone) : ?>
            '<p><?php echo esc_html($property_meta_phone); ?></p>',
            <?php endif; ?>
            <?php if ($property_meta_email) : ?>
            '<p><?php echo antispambot($property_meta_email); ?></p>',
            <?php endif; ?>
            <?php if ($map_property_link != 'none') : ?>
            '<?php echo wp_kses_post($map_property_link_html); ?>',
            <?php endif; ?>
            <?php if ($property_directions != ', ') : ?>
            '<a class="btn btn-primary gg-get-directions" href="//www.google.com/maps/dir/Current+Location/<?php echo esc_html($property_directions); ?>"><?php _e('Get directions','okthemes'); ?></a>',
            <?php endif; ?>
        ].join(''),
        propID: <?php echo esc_js($post->ID); ?>,
        icon : '<?php echo esc_js($map_marker); ?>',
        zoom: <?php echo esc_js($map_zoom); ?>,
    },
    <?php endif;  ?>

    <?php endwhile; ?>
];

var m = new Maplace({
    locations: LocsB,
    map_div: '#areas-map',
    controls_div: '#areas-map-controls',
    controls_type: 'list', //dropdown
    controls_on_map: false,
    controls_applycss: false,
    view_all_text: '<?php _e("View all","okthemes"); ?>',  
    controls_title: '',
    styles: {
        'LightGrey': [{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3d3d3"}]},{"featureType":"transit","stylers":[{"color":"#808080"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b3b3b3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":1.8}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#d7d7d7"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ebebeb"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#a7a7a7"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#696969"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#d6d6d6"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#dadada"}]}]
    },
});

<?php if ( ($map_property_link != 'none') && ($map_property_link != 'property_page') ): ?>
m.o.afterCreateMarker = function (index, location, marker) {
  google.maps.event.addListener(marker, 'click', function() {

    var propertyid = marker.propID;
        
    $j("#areas-map-property").html('<div class="gg-ajax-loader">Loading...</div>');
    
    $j.ajax({
        type:"POST",
        url:"<?php echo admin_url('admin-ajax.php'); ?>",
        data:'action=property_map_info&main_propertyid=' + propertyid,
        success:function(results){
            $j("#areas-map-property").empty();
            $j("#areas-map-property").append(results);
        }
    });

  });
};
<?php endif; ?>

m.Load();

//Clear the content of #areas-map-property when View all is clicked
$j("#ullist_a_all").click(function() {
    $j('#areas-map-property').html('');
});

});

</script>

<!-- Map holder -->
<div id="areas-map-controls"></div>
<div id="areas-map"></div>

<!-- Property info holder -->
<div id="areas-map-property"></div>

<!-- Page content -->
<div class="clearfix"></div>
<section id="content" class="page-fullscreen">

    <?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

    <div class="container-fluid gg-master-container">
        <div class="row">
            <div class="col-md-12">
            
            <?php get_template_part( 'parts/part', 'page' ); ?>

            <div class="clearfix"></div>

            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->

    <?php endwhile; endif; ?>

</section>

<?php } else { ?>

<div class="no-properties-availble"> 
    <h3><?php _e( 'No properties available', 'okthemes' ); ?></h3>  
</div>
    
<?php } ?>


<?php get_footer(); ?>