<?php
$headings_array = array(
   __("Heading 1", "js_composer")         => "h1", 
   __("Heading 2", "js_composer")         => "h2", 
   __("Heading 3", "js_composer")         => "h3", 
   __("Heading 4", "js_composer")         => "h4",
   __("Heading 5", "js_composer")         => "h5",
   __("Heading 6", "js_composer")         => "h6"
);

$add_css_animation = array(
    "type" => "dropdown",
    "heading" => __("CSS Animation", "js_composer"),
    "param_name" => "css_animation",
    "admin_label" => true,
    "value" => array(__("No", "js_composer") => '', __("Top to bottom", "js_composer") => "top-to-bottom", __("Bottom to top", "js_composer") => "bottom-to-top", __("Left to right", "js_composer") => "left-to-right", __("Right to left", "js_composer") => "right-to-left", __("Appear from center", "js_composer") => "appear"),
    "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "js_composer")
  );

$align_array = array(
   __("Align left", "js_composer")         => "pull-left", 
   __("Align right", "js_composer")        => "pull-right", 
   __("Align center", "js_composer")       => "pull-center"
);

$portfolio_col_select_array = array(
   __("Two columns", "js_composer")       => "two_columns", 
   __("Three columns", "js_composer")     => "three_columns", 
   __("Four columns", "js_composer")      => "four_columns"
);

$team_col_select_array = array(
   __("Two columns", "js_composer")       => "two_columns", 
   __("Three columns", "js_composer")     => "three_columns", 
   __("Four columns", "js_composer")      => "four_columns"
);

$testimonials_col_select_array = array(
   __("One column", "js_composer")        => "one_column",
   __("Two columns", "js_composer")       => "two_columns", 
   __("Three columns", "js_composer")     => "three_columns"
);

//Default VC arrays

$colors = array(
   'Blue' => 'blue', // Why __( 'Blue', 'js_composer' ) doesn't work?
   'Turquoise' => 'turquoise',
   'Pink' => 'pink',
   'Violet' => 'violet',
   'Peacoc' => 'peacoc',
   'Chino' => 'chino',
   'Mulled Wine' => 'mulled_wine',
   'Vista Blue' => 'vista_blue',
   'Black' => 'black',
   'Grey' => 'grey',
   'Orange' => 'orange',
   'Sky' => 'sky',
   'Green' => 'green',
   'Juicy pink' => 'juicy_pink',
   'Sandy brown' => 'sandy_brown',
   'Purple' => 'purple',
   'White' => 'white'
);

$sizes = array(
   'Mini' => 'btn-mini',
   'Small' => 'btn-small',
   'Normal' => 'md',
   'Large' => 'btn-large'
);

$button_styles = array(
   'Rounded' => 'rounded',
   'Square' => 'square',
   'Round' => 'round',
   'Outlined' => 'outlined',
   //'3D' => '3d',
   'Square Outlined' => 'square_outlined'
);

$cta_styles = array(
   'Rounded' => 'rounded',
   'Square' => 'square',
   'Round' => 'round',
   'Outlined' => 'outlined',
   'Square Outlined' => 'square_outlined'
);

$txt_align = array(
   'Left' => 'left',
   'Right' => 'right',
   'Center' => 'center',
   'Justify' => 'justify'
);

$el_widths = array(
   '100%' => '',
   '90%' => '90',
   '80%' => '80',
   '70%' => '70',
   '60%' => '60',
   '50%' => '50'
);

$sep_styles = array(
   'Border' => '',
   'Dashed' => 'dashed',
   'Dotted' => 'dotted',
   'Double' => 'double'
);

$box_styles = array(
   'Default' => '',
   'Rounded' => 'vc_box_rounded',
   'Border' => 'vc_box_border',
   'Outline' => 'vc_box_outline',
   'Shadow' => 'vc_box_shadow',
   'Bordered shadow' => 'vc_box_shadow_border',
   '3D Shadow' => 'vc_box_shadow_3d',
   'Circle' => 'vc_box_circle', //new
   'Circle Border' => 'vc_box_border_circle', //new
   'Circle Outline' => 'vc_box_outline_circle', //new
   'Circle Shadow' => 'vc_box_shadow_circle', //new
   'Circle Border Shadow' => 'vc_box_shadow_border_circle' //new
);

$target_arr = array(
   __( 'Same window', 'js_composer' ) => '_self',
   __( 'New window', 'js_composer' ) => "_blank"
);

$img_style_arr = array(
   __( 'Default (Square corners)', 'okthemes' ) => "default",
   __( 'Rounded corners', 'okthemes' ) => "rounded",
   __( 'Circle', 'okthemes' ) => "circle"
);

//Entypo icons array
$gg_icons_array = array ( 0 => 'entypo-note ', 1 => 'entypo-logo-db ', 2 => 'entypo-music ', 3 => 'entypo-search ', 4 => 'entypo-flashlight ', 5 => 'entypo-mail ', 6 => 'entypo-heart ', 7 => 'entypo-heart-empty ', 8 => 'entypo-star ', 9 => 'entypo-star-empty ', 10 => 'entypo-user ', 11 => 'entypo-users ', 12 => 'entypo-user-add ', 13 => 'entypo-video ', 14 => 'entypo-picture ', 15 => 'entypo-camera ', 16 => 'entypo-layout ', 17 => 'entypo-menu ', 18 => 'entypo-check ', 19 => 'entypo-cancel ', 20 => 'entypo-cancel-circled ', 21 => 'entypo-cancel-squared ', 22 => 'entypo-plus ', 23 => 'entypo-plus-circled ', 24 => 'entypo-plus-squared ', 25 => 'entypo-minus ', 26 => 'entypo-minus-circled ', 27 => 'entypo-minus-squared ', 28 => 'entypo-help ', 29 => 'entypo-help-circled ', 30 => 'entypo-info ', 31 => 'entypo-info-circled ', 32 => 'entypo-back ', 33 => 'entypo-home ', 34 => 'entypo-link ', 35 => 'entypo-attach ', 36 => 'entypo-lock ', 37 => 'entypo-lock-open ', 38 => 'entypo-eye ', 39 => 'entypo-tag ', 40 => 'entypo-bookmark ', 41 => 'entypo-bookmarks ', 42 => 'entypo-flag ', 43 => 'entypo-thumbs-up ', 44 => 'entypo-thumbs-down ', 45 => 'entypo-download ', 46 => 'entypo-upload ', 47 => 'entypo-upload-cloud ', 48 => 'entypo-reply ', 49 => 'entypo-reply-all ', 50 => 'entypo-forward ', 51 => 'entypo-quote ', 52 => 'entypo-code ', 53 => 'entypo-export ', 54 => 'entypo-pencil ', 55 => 'entypo-feather ', 56 => 'entypo-print ', 57 => 'entypo-retweet ', 58 => 'entypo-keyboard ', 59 => 'entypo-comment ', 60 => 'entypo-chat ', 61 => 'entypo-bell ', 62 => 'entypo-attention ', 63 => 'entypo-alert ', 64 => 'entypo-vcard ', 65 => 'entypo-address ', 66 => 'entypo-location ', 67 => 'entypo-map ', 68 => 'entypo-direction ', 69 => 'entypo-compass ', 70 => 'entypo-cup ', 71 => 'entypo-trash ', 72 => 'entypo-doc ', 73 => 'entypo-docs ', 74 => 'entypo-doc-landscape ', 75 => 'entypo-doc-text ', 76 => 'entypo-doc-text-inv ', 77 => 'entypo-newspaper ', 78 => 'entypo-book-open ', 79 => 'entypo-book ', 80 => 'entypo-folder ', 81 => 'entypo-archive ', 82 => 'entypo-box ', 83 => 'entypo-rss ', 84 => 'entypo-phone ', 85 => 'entypo-cog ', 86 => 'entypo-tools ', 87 => 'entypo-share ', 88 => 'entypo-shareable ', 89 => 'entypo-basket ', 90 => 'entypo-bag ', 91 => 'entypo-calendar ', 92 => 'entypo-login ', 93 => 'entypo-logout ', 94 => 'entypo-mic ', 95 => 'entypo-mute ', 96 => 'entypo-sound ', 97 => 'entypo-volume ', 98 => 'entypo-clock ', 99 => 'entypo-hourglass ', 100 => 'entypo-lamp ', 101 => 'entypo-light-down ', 102 => 'entypo-light-up ', 103 => 'entypo-adjust ', 104 => 'entypo-block ', 105 => 'entypo-resize-full ', 106 => 'entypo-resize-small ', 107 => 'entypo-popup ', 108 => 'entypo-publish ', 109 => 'entypo-window ', 110 => 'entypo-arrow-combo ', 111 => 'entypo-down-circled ', 112 => 'entypo-left-circled ', 113 => 'entypo-right-circled ', 114 => 'entypo-up-circled ', 115 => 'entypo-down-open ', 116 => 'entypo-left-open ', 117 => 'entypo-right-open ', 118 => 'entypo-up-open ', 119 => 'entypo-down-open-mini ', 120 => 'entypo-left-open-mini ', 121 => 'entypo-right-open-mini ', 122 => 'entypo-up-open-mini ', 123 => 'entypo-down-open-big ', 124 => 'entypo-left-open-big ', 125 => 'entypo-right-open-big ', 126 => 'entypo-up-open-big ', 127 => 'entypo-down ', 128 => 'entypo-left ', 129 => 'entypo-right ', 130 => 'entypo-up ', 131 => 'entypo-down-dir ', 132 => 'entypo-left-dir ', 133 => 'entypo-right-dir ', 134 => 'entypo-up-dir ', 135 => 'entypo-down-bold ', 136 => 'entypo-left-bold ', 137 => 'entypo-right-bold ', 138 => 'entypo-up-bold ', 139 => 'entypo-down-thin ', 140 => 'entypo-left-thin ', 141 => 'entypo-note-beamed ', 142 => 'entypo-up-thin ', 143 => 'entypo-cw ', 144 => 'entypo-arrows-ccw ', 145 => 'entypo-level-down ', 146 => 'entypo-level-up ', 147 => 'entypo-shuffle ', 148 => 'entypo-loop ', 149 => 'entypo-switch ', 150 => 'entypo-play ', 151 => 'entypo-stop ', 152 => 'entypo-pause ', 153 => 'entypo-record ', 154 => 'entypo-to-end ', 155 => 'entypo-to-start ', 156 => 'entypo-fast-forward ', 157 => 'entypo-fast-backward ', 158 => 'entypo-progress-0 ', 159 => 'entypo-progress-1 ', 160 => 'entypo-progress-2 ', 161 => 'entypo-progress-3 ', 162 => 'entypo-target ', 163 => 'entypo-palette ', 164 => 'entypo-list ', 165 => 'entypo-list-add ', 166 => 'entypo-signal ', 167 => 'entypo-trophy ', 168 => 'entypo-battery ', 169 => 'entypo-back-in-time ', 170 => 'entypo-monitor ', 171 => 'entypo-mobile ', 172 => 'entypo-network ', 173 => 'entypo-cd ', 174 => 'entypo-inbox ', 175 => 'entypo-install ', 176 => 'entypo-globe ', 177 => 'entypo-cloud ', 178 => 'entypo-cloud-thunder ', 179 => 'entypo-flash ', 180 => 'entypo-moon ', 181 => 'entypo-flight ', 182 => 'entypo-paper-plane ', 183 => 'entypo-leaf ', 184 => 'entypo-lifebuoy ', 185 => 'entypo-mouse ', 186 => 'entypo-briefcase ', 187 => 'entypo-suitcase ', 188 => 'entypo-dot ', 189 => 'entypo-dot-2 ', 190 => 'entypo-dot-3 ', 191 => 'entypo-brush ', 192 => 'entypo-magnet ', 193 => 'entypo-infinity ', 194 => 'entypo-erase ', 195 => 'entypo-chart-pie ', 196 => 'entypo-chart-line ', 197 => 'entypo-chart-bar ', 198 => 'entypo-chart-area ', 199 => 'entypo-tape ', 200 => 'entypo-graduation-cap ', 201 => 'entypo-language ', 202 => 'entypo-ticket ', 203 => 'entypo-water ', 204 => 'entypo-droplet ', 205 => 'entypo-air ', 206 => 'entypo-credit-card ', 207 => 'entypo-floppy ', 208 => 'entypo-clipboard ', 209 => 'entypo-megaphone ', 210 => 'entypo-database ', 211 => 'entypo-drive ', 212 => 'entypo-bucket ', 213 => 'entypo-thermometer ', 214 => 'entypo-key ', 215 => 'entypo-flow-cascade ', 216 => 'entypo-flow-branch ', 217 => 'entypo-flow-tree ', 218 => 'entypo-flow-line ', 219 => 'entypo-flow-parallel ', 220 => 'entypo-rocket ', 221 => 'entypo-gauge ', 222 => 'entypo-traffic-cone ', 223 => 'entypo-cc ', 224 => 'entypo-cc-by ', 225 => 'entypo-cc-nc ', 226 => 'entypo-cc-nc-eu ', 227 => 'entypo-cc-nc-jp ', 228 => 'entypo-cc-sa ', 229 => 'entypo-cc-nd ', 230 => 'entypo-cc-pd ', 231 => 'entypo-cc-zero ', 232 => 'entypo-cc-share ', 233 => 'entypo-cc-remix ', 234 => 'entypo-github ', 235 => 'entypo-github-circled ', 236 => 'entypo-flickr ', 237 => 'entypo-flickr-circled ', 238 => 'entypo-vimeo ', 239 => 'entypo-vimeo-circled ', 240 => 'entypo-twitter ', 241 => 'entypo-twitter-circled ', 242 => 'entypo-facebook ', 243 => 'entypo-facebook-circled ', 244 => 'entypo-facebook-squared ', 245 => 'entypo-gplus ', 246 => 'entypo-gplus-circled ', 247 => 'entypo-pinterest ', 248 => 'entypo-pinterest-circled ', 249 => 'entypo-tumblr ', 250 => 'entypo-tumblr-circled ', 251 => 'entypo-linkedin ', 252 => 'entypo-linkedin-circled ', 253 => 'entypo-dribbble ', 254 => 'entypo-dribbble-circled ', 255 => 'entypo-stumbleupon ', 256 => 'entypo-stumbleupon-circled ', 257 => 'entypo-lastfm ', 258 => 'entypo-lastfm-circled ', 259 => 'entypo-rdio ', 260 => 'entypo-rdio-circled ', 261 => 'entypo-spotify ', 262 => 'entypo-spotify-circled ', 263 => 'entypo-qq ', 264 => 'entypo-instagram ', 265 => 'entypo-dropbox ', 266 => 'entypo-evernote ', 267 => 'entypo-flattr ', 268 => 'entypo-skype ', 269 => 'entypo-skype-circled ', 270 => 'entypo-renren ', 271 => 'entypo-sina-weibo ', 272 => 'entypo-paypal ', 273 => 'entypo-picasa ', 274 => 'entypo-soundcloud ', 275 => 'entypo-mixi ', 276 => 'entypo-behance ', 277 => 'entypo-google-circles ', 278 => 'entypo-vkontakte ', 279 => 'entypo-smashing ', 280 => 'entypo-sweden ', 281 => 'entypo-db-shape ', 282 => 'entypo-right-thin'); 

function entypoPrefix(&$value,$key) {
  $value="entypo $value";
}
array_walk($gg_icons_array,"entypoPrefix");

// Initialising Shortcodes
if (class_exists('WPBakeryVisualComposerAbstract')) {

   /**
    * Taxonomy checkbox list field.
    *
    */
   function gg_taxonomy_settings_field($settings, $value) {
      $dependency = vc_generate_dependencies_attributes($settings);

      $terms_fields = array();
      $terms_slugs = array();

      $value_arr = $value;
      if ( !is_array($value_arr) ) {
         $value_arr = array_map( 'trim', explode(',', $value_arr) );
      }

      if ( !empty($settings['taxonomy']) ) {

         $terms = get_terms( $settings['taxonomy'] );
         if ( $terms && !is_wp_error($terms) ) {

            foreach( $terms as $term ) {
               $terms_slugs[] = $term->slug;

               $terms_fields[] = sprintf(
                  '<label><input id="%s" class="%s" type="checkbox" name="%s" value="%s" %s/>%s</label>',
                  $settings['param_name'] . '-' . $term->slug,
                  $settings['param_name'].' '.$settings['type'],
                  $settings['param_name'],
                  $term->slug,
                  checked( in_array( $term->slug, $value_arr ), true, false ),
                  $term->name
               );
            }
         }
      }

      return '<div class="gg_taxonomy_block">'
            .'<input type="hidden" name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-checkboxes '.$settings['param_name'].' '.$settings['type'].'_field" value="'.$value.'" '.$dependency.' />'
             .'<div class="gg_taxonomy_terms">'
             .implode( $terms_fields )
             .'</div>'
          .'</div>';
   }
   vc_add_shortcode_param('gg_taxonomy', 'gg_taxonomy_settings_field', get_template_directory_uri() . '/lib/visualcomposer/gg-taxonomy.js' );

   /**
    * Posts checkbox list field.
    *
    */
   function gg_posttype_settings_field($settings, $value) {
      $dependency = vc_generate_dependencies_attributes($settings);

      $posts_fields = array();
      $terms_slugs = array();

      $value_arr = $value;
      if ( !is_array($value_arr) ) {
         $value_arr = array_map( 'trim', explode(',', $value_arr) );
      }

      if ( !empty($settings['posttype']) ) {

         $args = array(
            'no_found_rows' => 1,
            'ignore_sticky_posts' => 1,
            'posts_per_page' => -1,
            'post_type' => $settings['posttype'],
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
         );

         $gg_query = new WP_Query( $args );
         if ( $gg_query->have_posts() ) {

            foreach( $gg_query->posts as $p ) {
               $posts_fields[] = sprintf(
                  '<label><input id="%s" class="%s" type="checkbox" name="%s" value="%s" %s/>%s</label>',
                  $settings['param_name'] . '-' . $p->ID,
                  $settings['param_name'] . ' ' . $settings['type'],
                  $settings['param_name'],
                  $p->ID,
                  checked( in_array( $p->ID, $value_arr ), true, false ),
                  $p->post_title
               );
            }
         }
      }

      return '<div class="gg_posttype_block">'
            .'<input type="hidden" name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-checkboxes '.$settings['param_name'].' '.$settings['type'].'_field" value="'.$value.'" '.$dependency.' />'
             .'<div class="gg_posttype_post">'
             .implode( $posts_fields )
             .'</div>'
          .'</div>';
   }
   vc_add_shortcode_param('gg_posttype', 'gg_posttype_settings_field', get_template_directory_uri() . '/lib/visualcomposer/gg-posttype.js' );
}

?>