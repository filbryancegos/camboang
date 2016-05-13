<?php
//Remove the new params
vc_remove_param ('vc_single_image', 'source' );
vc_remove_param ('vc_single_image', 'custom_src' );
vc_remove_param ('vc_single_image', 'external_img_size' );
vc_remove_param ('vc_single_image', 'external_style' );
vc_remove_param ('vc_single_image', 'external_border_color' );
vc_remove_param ('vc_single_image', 'onclick' );
vc_remove_param ('vc_single_image', 'caption' );
vc_remove_param ('vc_single_image', 'add_caption' );
vc_remove_param ('vc_single_image', 'border_color' );
vc_remove_param ('vc_single_image', 'style' );

vc_remove_param ('vc_single_image', 'img_link_large' );
vc_remove_param ('vc_single_image', 'link' );
vc_remove_param ('vc_single_image', 'img_link_target' );
vc_remove_param ('vc_single_image', 'el_class' );
vc_remove_param ('vc_single_image', 'css' );

vc_remove_param ('vc_single_image', 'image' );


vc_add_param("vc_single_image", array(
    'type' => 'attach_image',
    'heading' => __( 'Image', 'js_composer' ),
    'param_name' => 'image',
    'value' => '',
    'description' => __( 'Select image from media library.', 'js_composer' ),
  )
);

//Image size
vc_add_param("vc_single_image", array(
      "type" => "dropdown",
      "heading" => __("Image size", "js_composer"),
      "param_name" => "img_size",
      "value" => array(__("Full size", "js_composer") => "fullsize", __("Custom size", "js_composer") => "customsize"),
      "description" => __("Choose the image size", "js_composer")
  )
);
vc_add_param("vc_single_image", array(
      "type" => "dropdown",
      "heading" => __("Image style", "js_composer"),
      "param_name" => "img_style",
      "value" => $img_style_arr,
      "std" => "default",
      "description" => __("Choose the image style", "js_composer")
  )
);
vc_add_param("vc_single_image", array(
      "type" => "textfield",
      "heading" => __("Custom size - width", "js_composer"),
      "param_name" => "customsize_width",
      "description" => __("Insert the width of the image", "js_composer"),
      "dependency" => Array('element' => "img_size", 'value' => array('customsize'))
  )
);
vc_add_param("vc_single_image", array(
      "type" => "textfield",
      "heading" => __("Custom size - height", "js_composer"),
      "param_name" => "customsize_height",
      "description" => __("Insert the height of the image", "js_composer"),
      "dependency" => Array('element' => "img_size", 'value' => array('customsize'))
  )
);


vc_add_param("vc_single_image", array(
  "type" => 'checkbox',
  "heading" => __("Link to large image?", "okthemes"),
  "param_name" => "img_link_large",
  "description" => __("If selected, image will be linked to the bigger image.", "okthemes"),
  "value" => Array(__("Yes, please", "okthemes") => 'yes')
));

?>