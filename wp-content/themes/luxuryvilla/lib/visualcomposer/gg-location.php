<?php
class WPBakeryShortCode_gg_location extends WPBakeryShortCode {

   public function __construct() {  
         add_shortcode('location', array($this, 'gg_location'));  
   }

   public function gg_location( $atts, $content = null ) { 

         $output = $link_html = $image = $el_class = $isotope_item = $is_carousel = $carousel_data = $is_unlimited = '';
         extract(shortcode_atts(array(
            'location_col_select'        => '',
            'property_location_id'       => '',
            'location_no_posts'          => '',
            'posts_in'                => '',
            'posts_not_in'            => '',
            'orderby'                 => '',
            'order'                   => '',
            'grid_layout_mode'        => 'fitRows',
            'grid_layout_style'       => 'gap',
            'el_class'                => '',
            'css_animation'           => '',
            'slides_per_view'         => '1',
            'transition_style'        => 'fade',
            'wrap'                    => '',
            'autoplay'                => '',
            'hide_pagination_control' => '',
            'hide_prev_next_buttons'  => '',
            'speed'                   => '200',
            'css_animation'           => '',
         ), $atts));

        //Enqueue scripts
        wp_enqueue_script('google-map-api');
        wp_enqueue_script('maplace');
        $map_marker = get_template_directory_uri() .'/images/map-marker.png';

        $property_id = $property_location_id;

        //Get Property options
        $property_meta_address = get_field('gg_property_meta_location_address', $property_id);
        $property_meta_phone = get_field('gg_property_meta_phone', $property_id);
        $property_meta_email = get_field('gg_property_meta_email', $property_id);

        $map_latitude = get_field('gg_map_latitude', $property_id);
        $map_longitude = get_field('gg_map_longitude', $property_id);
        $map_zoom = get_field('gg_map_zoom', $property_id);
        $unique_id = rand();

        $property_meta_location_city = get_field('gg_property_meta_location_city', $property_id);
        $property_meta_location_country = get_field('gg_property_meta_location_country', $property_id);
        $property_meta_location = implode(', ', array($property_meta_location_city, $property_meta_location_country));
        $property_directions = implode(', ', array_filter(array($map_latitude, $map_longitude)));

        if (!$map_zoom) $map_zoom = '12';
        
        ?>

        <!-- Map script -->
        <script type="text/javascript">
        ;(function ($, window, undefined) {
        $(document).ready(function() {
        
        jQuery('.property-map-holder').each(function(){ 
          var map_holder = '<?php echo "#property-map-".$unique_id; ?>';
          var m = new Maplace({
            locations:
                [{
                    lat: <?php echo esc_js($map_latitude); ?>,
                    lon: <?php echo esc_js($map_longitude); ?>,
                    icon : '<?php echo esc_js($map_marker); ?>',
                    title: '<?php echo esc_js(get_the_title($property_id)); ?>',
                    html: [
                        "<h3><?php echo gg_wrap_word(get_the_title($property_id)); ?></h3>",
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
                        <?php if ($property_directions != ', ') : ?>
                        '<a class="btn btn-primary gg-get-directions" href="//www.google.com/maps/dir/Current+Location/<?php echo esc_html($property_directions); ?>"><?php _e('Get directions','okthemes'); ?></a>',
                        <?php endif; ?>
                    ].join(''),

                    zoom: <?php echo json_encode($map_zoom, JSON_NUMERIC_CHECK); ?>
                }
            ],
            map_div: map_holder,
            styles: {
                'LightGrey': [{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3d3d3"}]},{"featureType":"transit","stylers":[{"color":"#808080"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b3b3b3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":1.8}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#d7d7d7"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ebebeb"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#a7a7a7"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#696969"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#d6d6d6"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#dadada"}]}]
            },
          });

          
          if( $('.property-map-holder').parents('.vc_tta-tabs').length == 1 ) {
            
            $( '[data-vc-tab]' ).on( 'show.vc.tab', function ( e ) {
                var href = $(e.target).attr('href');
                if ( $(href).find(map_holder).length > 0 ) {
                  m.Load();
                }
            } );

          } else {

            if($(map_holder).parents('.wpb_tab').length == 1) {

              $('.ui-tabs').on('tabscreate', function (event, ui) {
                if ( ( ui.tab.index() == '0') && (ui.panel.find(map_holder).length > 0) ) {
                  m.Load();
                }
              });

              $('.ui-tabs').on('tabsactivate', function (event, ui) {
                if ( ( ui.newTab.index() != '0') && (ui.newPanel.find(map_holder).length > 0) ) {
                  m.Load();
                }
              });
            } else {
              m.Load();
            }
          }
         
          
          });//each

            
        });//ready

        })(jQuery, this);

        </script>

        <?php
        $output = "\n\t".'<div id="property-map-'.$unique_id.'" class="property-map-holder"></div>';
        return $output;

   }
}

$WPBakeryShortCode_gg_location = new WPBakeryShortCode_gg_location();


vc_map( array(
   "name" => __("Location","okthemes"),
   "description" => __('Display the location of a property.','okthemes'),
   "base" => "location",
   "class" => "theme_icon_class",
   "icon" => "icon-wpb-gg_vc_location",
   'admin_enqueue_css' => array(get_template_directory_uri().'/lib/visualcomposer/styles.css'),
   "category" => __('OKThemes','okthemes'),
   "params" => array(
      array(
         "type" => "gg_posttype",
         "posttype" => "property_cpt",
         "heading" => __("Property", "js_composer"),
         "param_name" => "property_location_id",
         "description" => __("Select which property location to display.", "js_composer"),
      ),
   )
) );

?>