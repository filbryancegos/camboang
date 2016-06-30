<?php
class WPBakeryShortCode_gg_single_icon extends WPBakeryShortCode {

  public function __construct() {  
    add_shortcode('single_icon', array($this, 'gg_single_icon'));  
  }

  public function gg_single_icon( $atts, $content = null ) { 

        $output = $icon_border_style = $icon_box_style_start = $icon_box_style_end = $icon_link_html_start = $icon_link_html_end = $style = $margin_style = $icon_size_css = $icon_color_css = $featured_title = $image = $align_center = $icon_box_css = $icon_box_back = '';
        extract(shortcode_atts(array(
             'icon_link'             => '',
             'single_icon'           => '',
             'align'                 => 'pull-left',
             'el_class'              => '',
             'margin'                => '',
             'css_animation'         => '',
             'icon_size'             => 'normal',
             'icon_color'            => '',
        ), $atts));


        $css_class = $this->getCSSAnimation($css_animation);
        $el_class = $this->getExtraClass($el_class);

        if($align == "pull-center"){
          $align_center = 'style="text-align:center;"';
        } 

        if($icon_color != ""){
          $icon_color_css = ' color: '.$icon_color.';';
        }

        if( $margin != '' ) {
          $margin_style = ' margin: '.(preg_match('/(px|em|\%|pt|cm)$/', $margin) ? $margin : $margin.'px').';';
        }

        //parse featured link
        if($icon_link !=''){
          $icon_link = vc_build_link($icon_link);
          $icon_link['target'] = ( $icon_link['target'] == '' ) ? '_self' : $icon_link['target'];
          $icon_link_html_start = '<a target="'.$icon_link['target'].'" title="'.esc_attr($icon_link['title']).'" href="'.$icon_link['url'].'">';
          $icon_link_html_end = '</a>';
        }

        $style = 'style="'.$icon_color_css.$margin_style.'"';


        $output .= "\n\t".'<div class="single-icon-box '.$css_class.'" '.$align_center.'>';
        $output .= "\n\t\t".'<div class="icn-holder '.$align.'">'.$icon_link_html_start.'<i style="'.$icon_color_css.'" class="'.$single_icon.' '.$icon_size.'"></i>'.$icon_link_html_end.'</div>';
        $output .= "\n\t".'</div> ';

        return $output;
         
  }
}

$WPBakeryShortCode_gg_single_icon = new WPBakeryShortCode_gg_single_icon();  

vc_map( array(
   "name" => __("Single icon","okthemes"),
   "description" => __('Display a single icon.', 'okthemes'),
   "base" => "single_icon",
   "class" => "clear_vc_style",
   "icon" => "icon-wpb-gg_vc_single_icon_box",
   'admin_enqueue_css' => array(get_template_directory_uri().'/lib/visualcomposer/styles.css'),
   'admin_enqueue_js' => array(get_template_directory_uri().'/lib/visualcomposer/custom-vc.js'),
   "category" => __('OKThemes', 'okthemes'),

   "params" => array(
      array(
        "type" => "vc_link",
        "heading" => __("Icon URL (Link)", "okthemes"),
        "param_name" => "icon_link",
        "description" => __("Title link.", "okthemes")
      ),
      
      array(
         "type" => "dropdown",
         "heading" => __("Single icon", "okthemes"),
         "param_name" => "single_icon",
         "value" => $gg_icons_array,
         "description" => __("Choose your featured icon.", "okthemes")
      ),
      array(
         "type" => "dropdown",
         "heading" => __("Single icon size", "okthemes"),
         "param_name" => "icon_size",
         "value" => array(__("Normal", "okthemes") => "normal", __("Small", "okthemes") => "small", __("Large", "okthemes") => "large"),
         "description" => __("Select the featured icon size", "okthemes"),
         "admin_label" => true
      ),
      array(
         "type" => "colorpicker",
         "heading" => __('Single icon color', 'okthemes'),
         "param_name" => "icon_color",
         "description" => __("Select the icon color", "okthemes")
      ),
      
      array(
         "type" => "dropdown",
         "heading" => __("Align the icon", "okthemes"),
         "param_name" => "align",
         "value" => array(__("Align left", "okthemes") => "pull-left", __("Align right", "okthemes") => "pull-right", __("Align center", "okthemes") => "pull-center"),
         "description" => __("Set the alignment of the icon.", "okthemes")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Margin", "okthemes"),
        "param_name" => "margin",
        'description' => __( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'okthemes' ),
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "okthemes"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "okthemes")
      ),

      $add_css_animation,


   ),
  'js_view'  => 'luxuryvillaVcSingleIconView',
) );

?>