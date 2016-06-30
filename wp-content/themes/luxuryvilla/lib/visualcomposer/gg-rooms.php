<?php
class WPBakeryShortCode_gg_rooms extends WPBakeryShortCode {

   public function __construct() {  
         add_shortcode('rooms', array($this, 'gg_rooms'));  
   }

   public function gg_rooms( $atts, $content = null ) { 

         $output = $link_html = $image = $el_class = $isotope_item = $is_carousel = $carousel_data = $is_unlimited = $thumbnail = '';
         extract(shortcode_atts(array(
            'rooms_col_select'        => '',
            'property_rooms_id'       => '',
            'rooms_no_posts'          => '',
            'img_size'                => 'fullsize',
            'customsize_width'        => '',
            'customsize_height'       => '',
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

         //Enqueue magnific
         wp_enqueue_script( 'magnific' );
         wp_enqueue_style( 'magnific' );

         //Defaults
         global $gg_is_vc;
         $convert_ul = 'ul';
         $convert_li = 'li';
         

         //Apply columns class based on column selection 
         switch ($rooms_col_select) {
            case "4":
               $rooms_col_class = 'col-xs-12 col-sm-6 col-md-3';
            break;
            case "3":
               $rooms_col_class = 'col-xs-12 col-sm-6 col-md-4';
            break;
            case "2":
               $rooms_col_class = 'col-xs-12 col-sm-6 col-md-6';
            break;
            case "1":
               $rooms_col_class = 'col-xs-12 col-sm-12 col-md-12';
            break;
         }

         //Add 30px to the images for nogap mode 
         if ($grid_layout_style == 'nogap') {
          $is_unlimited = 'nogap-cols';
         }

         if ( $grid_layout_mode == 'fitRows' || $grid_layout_mode == 'masonry') {
            //Enqueue isotope
            wp_enqueue_style('isotope-css');
            wp_enqueue_script( 'isotope' );
            $isotope_item = 'isotope-item ';
         } else if ( $grid_layout_mode == 'carousel' ) {
            //Enqueue owl carousel
            wp_enqueue_script( 'owlcarousel' );
            $isotope_item = '';
            $is_carousel = 'owl-carousel';
            $convert_ul = 'div';
            $convert_li = 'div';
            $rooms_col_class ='';
            $carousel_data .= "\n\t".' data-slides-per-view = "'.$slides_per_view.'"';
            $carousel_data .= "\n\t".' data-transition-slide = "'.$transition_style.'"';
            $carousel_data .= "\n\t".' data-navigation-owl = "false"';
            $carousel_data .= "\n\t".' data-pagination-owl = "'.($hide_pagination_control !== 'yes' ? 'true' : 'false').'"';
            $carousel_data .= "\n\t".' data-autoplay = "'.($autoplay === 'yes' ? '3000' : 'false').'"';
            $carousel_data .= "\n\t".' data-rewind = "'.($wrap === 'yes' ? 'true' : 'false').'"';
            $carousel_data .= "\n\t".' data-speed = "'.$speed.'"';
            $carousel_data .= "\n\t".' data-height = "false"';
         }

         //Animation
         $css_class = $this->getCSSAnimation($css_animation);

         //Start the insanity
         $output .= "\n\t".'<div class="'.$css_class.'">';
         $output .= "\n\t".'<div class="gg_rooms">';


         $property_id = $property_rooms_id;

        if( have_rows('gg_room', $property_id) ) {
          
        $output .= "\n\t".'<'.$convert_ul.' '.$carousel_data.' class="el-grid row '.$is_carousel.' '.$is_unlimited.'" data-layout-mode="'.$grid_layout_mode.'">';
          
        while( have_rows('gg_room',$property_id) ) : the_row();
        
        // vars
        $room_name = get_sub_field('gg_room_name');
        $room_type = get_sub_field('gg_room_type');
        $room_price = get_sub_field('gg_room_price');
        $room_price_per = get_sub_field('gg_room_price_per');
        $room_image = get_sub_field('gg_room_image');
        $room_description = get_sub_field('gg_room_description');

        $output .= "\n\t".'<'.$convert_li.' class=" '.$isotope_item.' '.$rooms_col_class.' ">';

        if ($img_size !== 'fullsize') {
            $thumbnail = '<img src="'.aq_resize( $room_image['url'], $customsize_width, $customsize_height, true, true ).'" alt="'.$room_image['alt'].'" /> ';
        } else {
            $thumbnail = '<img src="'.$room_image['url'].'" alt="'.$room_image['alt'].'" /> ';          
        }
         
        $output .= "\n\t".'<div class="room-wrapper">';
        $output .= "\n\t\t".'<figure><a class="lightbox-el" href="'.$room_image['url'].'">'.$thumbnail.'</a></figure>';
        $output .= "\n\t\t".'<div class="room-wrapper-content">';
        $output .= "\n\t\t\t".'<h5>'.$room_name.'</h5>';
        $output .= "\n\t\t\t".'<p class="room-price">'.$room_price.$room_price_per.'</p>';
        $output .= "\n\t\t\t".'<p class="room-description">'.$room_description.'</p>';
        $output .= "\n\t\t".'</div>';
        $output .= "\n\t".'</div>';

        $output .= "\n\t".'</'.$convert_li.'>';

        endwhile;
         
        $output .= "\n\t".'</'.$convert_ul.'>';

        } else {
         
        $output .= "\n\t".'<p>No posts found</p>';
         
        }

        wp_reset_postdata();

         
        $output .= "\n\t".'</div>';
        $output .= "\n\t".'</div>';

        return $output;
   }
}

$WPBakeryShortCode_gg_rooms = new WPBakeryShortCode_gg_rooms();


vc_map( array(
   "name" => __("Rooms","okthemes"),
   "description" => __('Display the rooms of a property.','okthemes'),
   "base" => "rooms",
   "class" => "theme_icon_class",
   "icon" => "icon-wpb-gg_vc_rooms",
   'admin_enqueue_css' => array(get_template_directory_uri().'/lib/visualcomposer/styles.css'),
   "category" => __('OKThemes','okthemes'),
   "params" => array(
      array(
         "type" => "gg_posttype",
         "posttype" => "property_cpt",
         "heading" => __("Property", "js_composer"),
         "param_name" => "property_rooms_id",
         "description" => __("Select which property rooms to display.", "js_composer"),
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Layout mode", "js_composer"),
         "param_name" => "grid_layout_mode",
         "value" => array(__("Grid Fit rows", "js_composer") => "fitRows", __('Grid Masonry', "js_composer") => 'masonry', __('Carousel', "js_composer") => 'carousel'),
         "description" => __("Layout template.", "js_composer")
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Layout style", "js_composer"),
         "param_name" => "grid_layout_style",
         "value" => array(__("Gap", "js_composer") => "gap", __('No gap', "js_composer") => 'nogap'),
         "description" => __("Layout style.", "js_composer"),
         "dependency" => Array('element' => 'grid_layout_mode', 'value' => array('fitRows','masonry'))
      ),
      //Carousel options
      array(
          "type" => "dropdown",
          "heading" => __("Slides per view", "okthemes"),
          "param_name" => "slides_per_view",
          "value" => array(2, 3),
          "description" => __("Set numbers of slides you want to display at the same time on slider's container for carousel mode.", "okthemes"),
          "dependency" => Array('element' => 'grid_layout_mode', 'value' => array('carousel'))
      ),
      array(
          "type" => 'checkbox',
          "heading" => __("Hide pagination control", "okthemes"),
          "param_name" => "hide_pagination_control",
          "description" => __("If YES pagination control will be removed .", "okthemes"),
          "value" => Array(__("Yes, please", "okthemes") => 'yes'),
          "dependency" => Array('element' => 'grid_layout_mode', 'value' => array('carousel'))
      ),
      array(
          "type" => 'checkbox',
          "heading" => __("Autoplay", "okthemes"),
          "param_name" => "autoplay",
          "description" => __("Enables autoplay mode.", "okthemes"),
          "value" => Array(__("Yes, please", "okthemes") => 'yes'),
          "dependency" => Array('element' => 'grid_layout_mode', 'value' => array('carousel'))
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Columns count", "js_composer"),
         "param_name" => "rooms_col_select",
         "value" => array(1, 2, 3, 4),
         "admin_label" => true,
         "description" => __("Select columns count.", "js_composer"),
         "dependency" => Array('element' => 'grid_layout_mode', 'value' => array('fitRows','masonry'))
      ),
      array(
            "type" => "dropdown",
            "heading" => __("Image size", "js_composer"),
            "param_name" => "img_size",
            "value" => array(__("Full size", "js_composer") => "fullsize", __("Custom size", "js_composer") => "customsize"),
            "description" => __("Choose the image size", "js_composer")
      ),
      array(
            "type" => "textfield",
            "heading" => __("Custom size - width", "js_composer"),
            "param_name" => "customsize_width",
            "description" => __("Insert the width of the image", "js_composer"),
            "dependency" => Array('element' => "img_size", 'value' => array('customsize'))
      ),
      array(
            "type" => "textfield",
            "heading" => __("Custom size - height", "js_composer"),
            "param_name" => "customsize_height",
            "description" => __("Insert the height of the image", "js_composer"),
            "dependency" => Array('element' => "img_size", 'value' => array('customsize'))
      ),
   )
) );

?>