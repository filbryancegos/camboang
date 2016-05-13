<?php
class WPBakeryShortCode_gg_Widget_Twitter extends WPBakeryShortCode {

   public function __construct() {  
         add_shortcode('widget_twitter', array($this, 'gg_widget_twitter'));  
   }

   public function gg_widget_twitter( $atts, $content = null ) { 

         $output = $title = $username = $limit = $link = '';
         extract(shortcode_atts(array(
             'title'    => '',
             'username' => '',
             'limit'    => '',
             'link'     => '',
         ), $atts));

         
         $output = '<div class="vc_widget vc_widget_twitter">';
         $type = 'TwitterFeedWidget';
         $args = array();

         ob_start();
         the_widget( $type, $atts, $args );
         $output .= ob_get_clean();

         $output .= '</div>';

         return $output;
   }
}

$WPBakeryShortCode_gg_Widget_Twitter = new WPBakeryShortCode_gg_Widget_Twitter();


vc_map( array(
   "name" => __("Widget: Twitter", "okthemes"),
   "description" => __('Display twitter posts.', 'okthemes'),
   "base" => "widget_twitter",
   "class" => "theme_icon_class",
   "weight" => -50,
   "icon" => "icon-wpb-gg_vc_twitter",
   'admin_enqueue_css' => array(get_template_directory_uri().'/lib/visualcomposer/styles.css'),
   "category" => __('OKThemes', 'okthemes'),
   "params" => array(
      array(
         "type" => "textfield",
         "heading" => __("Title", "okthemes"),
         "param_name" => "title",
         "description" => __("Insert title here", "okthemes")
      ),
      array(
         "type" => "textfield",
         "heading" => __("Username", "okthemes"),
         "param_name" => "username",
         "admin_label" => true,
         "description" => __("Insert username here.", "okthemes")
      ),
      array(
         "type" => "textfield",
         "heading" => __("Number of posts to display", "okthemes"),
         "param_name" => "limit",
         "description" => __("Insert number of posts to display here.", "okthemes")
      ),
      array(
         "type" => "textfield",
         "heading" => __("Username link", "okthemes"),
         "param_name" => "link",
         "description" => __("Insert your Twitter username link here", "okthemes")
      ),
   )
) );

?>