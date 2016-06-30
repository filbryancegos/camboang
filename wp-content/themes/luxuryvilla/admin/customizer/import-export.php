<?php 

function gg_add_customizer_menu() {
  add_theme_page( 'Customizer Import', 'Import theme options', 'edit_theme_options', 'import', 'gg_customizer_import_option_page' );
  add_theme_page( 'Customizer Export', 'Export theme options', 'edit_theme_options', 'export', 'gg_customizer_export_option_page' );
  add_theme_page( 'Load Demo Content', 'Load Demo content', 'edit_theme_options', 'import_content', 'gg_customizer_import_content_page' );
}

add_action( 'admin_menu', 'gg_add_customizer_menu' );


//Output buffering

ob_start();

//Import
function gg_customizer_import_option_page() {
?>
  <div class="wrap">
    <div id="icon-tools" class="icon32"><br></div>
    <h2>Customizer Import</h2>
    <?php
    if ( isset( $_FILES['import'] ) && check_admin_referer( 'gg-customizer-import' ) ) {
      if ( $_FILES['import']['error'] > 0 ) {
        wp_die( 'An error occured.' );
      } else {
        $file_name = $_FILES['import']['name'];
        $file_ext  = strtolower( end( explode( '.', $file_name ) ) );
        $file_size = $_FILES['import']['size'];
        if ( ( $file_ext == 'json' ) && ( $file_size < 500000 ) ) {
          $encode_options = file_get_contents( $_FILES['import']['tmp_name'] );
          $options        = json_decode( $encode_options, true );
          foreach ( $options as $key => $value ) {
            set_theme_mod( $key, $value );
          }
          echo '<div class="updated"><p>All options were restored successfully!</p></div>';
        } else {
          echo '<div class="error"><p>Invalid file or file size too big.</p></div>';
        }
      }
    }
    ?>
    <form method="post" enctype="multipart/form-data">
      <?php wp_nonce_field( 'gg-customizer-import' ); ?>
      <p>If you have settings in a backup file (json) on your computer, the Import system can import it into this site. To get started, upload your backup file using the form below.</p>
      <p>Choose a file (json) from your computer: <input type="file" id="customizer-upload" name="import"></p>
      <p class="submit">
        <input type="submit" name="submit" id="customizer-submit" class="button" value="Upload file and import">
      </p>
    </form>
  </div>
<?php
}



//Export Page
function gg_customizer_export_option_page() {
  if ( ! isset( $_POST['export'] ) ) {
  ?>
    <div class="wrap">
      <div id="icon-tools" class="icon32"><br></div>
      <h2>Customizer Export</h2>
      <form method="post">
        <?php wp_nonce_field( 'gg-customizer-export' ); ?>
        <p>When you click the button below, the Export system will create a backup file (json) for you to save to your computer.</p>
        <p>This text file can be used to restore your settings here on "Smarty", or to easily setup another website with the same theme settings.</p>
        <p><em>Please note that this export manager backs up only your theme settings and not your content. To backup your content, please use the WordPress Export Tool.</em></p>
        <p class="submit"><input type="submit" name="export" class="button button-primary" value="Download Backup File"></p>
      </form>
    </div>

  <?php
    $options   = get_theme_mods();

  } elseif ( check_admin_referer( 'gg-customizer-export' ) ) {

    $blogname  = strtolower( str_replace(' ', '', get_option( 'blogname' ) ) );
    $date      = date( 'm-d-Y' );
    $json_name = $blogname . '-customizer-' . $date;
    $options   = get_theme_mods();

    unset( $options['nav_menu_locations'] );

    foreach ( $options as $key => $value ) {
      $value              = maybe_unserialize( $value );
      $need_options[$key] = $value;
    }

    //$json_file = json_encode( $need_options );

    ob_clean();

    echo json_encode( $need_options );

    header( 'Content-Type: text/json; charset=' . get_option( 'blog_charset' ) );
    header( 'Content-Disposition: attachment; filename=' . $json_name . '.json' );

    exit();

  }
}

//Import default content
function gg_customizer_import_content_page() {
  if ( ! isset( $_POST['import-content'] ) ) {
?>
    <div class="wrap">
    <form enctype="multipart/form-data" method="post">
    <?php wp_nonce_field( 'gg-customizer-import-content' ); ?>
    <input type="hidden" name="gg-customizer-import-content" value="true" />

        <h2>Import demo content</h2>
        <p>This area allows you to install the demo theme content for easy management.</p>
        <p style="color:#E07B7B"><strong>Preinstall notes:</strong></p>
        <ul style="color:#E07B7B">
          <li>Make sure you run this imports on a <strong>clean WordPress installation</strong>, otherwise unpredictable errors may occure.</li>
          <li>Follow the bellow steps in the <strong>exact given order</strong>.</li>
        </ul>
        
        <h3><strong>Step 1.</strong> Import Default Content <em>(pages, posts, images)</em></h3>
        <p>Please download the <a href="<?php echo get_stylesheet_directory_uri().'/luxuryvilla_demo_content.xml';?>">demo content file (right click - save as)</a> to your desktop, then go to <a href="<?php echo admin_url('import.php');?>">Import</a> option and choose WordPress (install the plugin if needed). Once you are there, run the importer by uploading the sample content file. This will load in all the Pages, Posts and images. </p>
        <h3><strong>Step 2.</strong> Import Default Settings:</h3>
        <p>If you wish to setup other demo content, please check the options below. Do this <strong>after</strong> importing default content above (Step 1).</p>
        <ul>
            <li><input type="checkbox" name="default_content[theme]" value="1"> (1) Import Theme Settings</li>
            <li><input type="checkbox" name="default_content[menu]" value="1"> (2) Import Menu Settings</li>
            <li><input type="checkbox" name="default_content[widgets]" value="1"> (3) Import Sidebars and Widgets
            <input type="hidden" name="widget_positions" value="YToxMDp7czoxOToid3BfaW5hY3RpdmVfd2lkZ2V0cyI7YTowOnt9czoxMjoic2lkZWJhci1wYWdlIjthOjM6e2k6MDtzOjc6InBhZ2VzLTIiO2k6MTtzOjEwOiJhcmNoaXZlcy0zIjtpOjI7czoxMDoiY2FsZW5kYXItMiI7fXM6MTM6InNpZGViYXItcG9zdHMiO2E6NDp7aTowO3M6MjQ6ImdnX3JlY2VudF9wb3N0c193aWRnZXQtMiI7aToxO3M6MTc6InJlY2VudC1jb21tZW50cy0zIjtpOjI7czoxMToidGFnX2Nsb3VkLTIiO2k6MztzOjE5OiJnZ190d2l0dGVyX3dpZGdldC0yIjt9czoxNDoic2lkZWJhci1zZWFyY2giO2E6Mjp7aTowO3M6ODoic2VhcmNoLTMiO2k6MTtzOjI0OiJnZ19zb2NpYWxfaWNvbnNfd2lkZ2V0LTMiO31zOjE2OiJzaWRlYmFyLWhvbWVwYWdlIjthOjE6e2k6MDtzOjY6InRleHQtMiI7fXM6MjY6InNpZGViYXItYXJlYXMtcGFnZS1nYWxsZXJ5IjthOjE6e2k6MDtzOjY6InRleHQtNCI7fXM6MjA6InNpZGViYXItZ2FsbGVyeS1wYWdlIjthOjE6e2k6MDtzOjY6InRleHQtNSI7fXM6MjA6InNpZGViYXItZm9vdGVyLWZpcnN0IjthOjI6e2k6MDtzOjY6InRleHQtMyI7aToxO3M6MjQ6ImdnX3NvY2lhbF9pY29uc193aWRnZXQtMiI7fXM6MjE6InNpZGViYXItZm9vdGVyLXNlY29uZCI7YToxOntpOjA7czoxNzoiZ2dfYndtYXBfd2lkZ2V0LTIiO31zOjEzOiJhcnJheV92ZXJzaW9uIjtpOjM7fQ==">
            <input type="hidden" name="widget_options" value="YToxMTp7czo1OiJwYWdlcyI7YToyOntpOjI7YTozOntzOjU6InRpdGxlIjtzOjU6IlBhZ2VzIjtzOjY6InNvcnRieSI7czoxMDoicG9zdF90aXRsZSI7czo3OiJleGNsdWRlIjtzOjA6IiI7fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjg6ImFyY2hpdmVzIjthOjI6e2k6MzthOjM6e3M6NToidGl0bGUiO3M6ODoiQXJjaGl2ZXMiO3M6NToiY291bnQiO2k6MDtzOjg6ImRyb3Bkb3duIjtpOjA7fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjg6ImNhbGVuZGFyIjthOjI6e2k6MjthOjE6e3M6NToidGl0bGUiO3M6ODoiQ2FsZW5kYXIiO31zOjEyOiJfbXVsdGl3aWRnZXQiO2k6MTt9czoyMjoiZ2dfcmVjZW50X3Bvc3RzX3dpZGdldCI7YToyOntpOjI7YToyOntzOjU6InRpdGxlIjtzOjEyOiJSZWNlbnQgcG9zdHMiO3M6NjoibnVtYmVyIjtpOjA7fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjE1OiJyZWNlbnQtY29tbWVudHMiO2E6Mjp7aTozO2E6Mjp7czo1OiJ0aXRsZSI7czoxNToiUmVjZW50IGNvbW1lbnRzIjtzOjY6Im51bWJlciI7aTo1O31zOjEyOiJfbXVsdGl3aWRnZXQiO2k6MTt9czo5OiJ0YWdfY2xvdWQiO2E6Mjp7aToyO2E6Mjp7czo1OiJ0aXRsZSI7czo0OiJUYWdzIjtzOjg6InRheG9ub215IjtzOjg6InBvc3RfdGFnIjt9czoxMjoiX211bHRpd2lkZ2V0IjtpOjE7fXM6MTc6ImdnX3R3aXR0ZXJfd2lkZ2V0IjthOjI6e2k6MjthOjM6e3M6NToidGl0bGUiO3M6NzoiVHdpdHRlciI7czo4OiJ1c2VybmFtZSI7czo2OiJlbnZhdG8iO3M6NToicG9zdHMiO3M6MToiMyI7fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjY6InNlYXJjaCI7YToyOntpOjM7YToxOntzOjU6InRpdGxlIjtzOjY6IlNlYXJjaCI7fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjIyOiJnZ19zb2NpYWxfaWNvbnNfd2lkZ2V0IjthOjM6e2k6MjthOjE6e3M6NToidGl0bGUiO3M6MDoiIjt9aTozO2E6MTp7czo1OiJ0aXRsZSI7czoxMjoiU29jaWFsIGljb25zIjt9czoxMjoiX211bHRpd2lkZ2V0IjtpOjE7fXM6NDoidGV4dCI7YTo1OntpOjI7YTozOntzOjU6InRpdGxlIjtzOjEyOiJMdXh1cnkgVmlsbGEiO3M6NDoidGV4dCI7czo3MToiMTA4MDAtMjA0OTggVklBIFNBTiBNQVJJTk8sDQpDVVBFUlRJTk8sIENBIDk1MDE0LCBVU0ENCisxLTM1NC04OTUtNDU5MmEiO3M6NjoiZmlsdGVyIjtiOjA7fWk6MzthOjM6e3M6NToidGl0bGUiO3M6MTI6Ikx1eHVyeSBWaWxsYSI7czo0OiJ0ZXh0IjtzOjcwOiIxMDgwMC0yMDQ5OCBWSUEgU0FOIE1BUklOTywNCkNVUEVSVElOTywgQ0EgOTUwMTQsIFVTQQ0KKzEtMzU0LTg5NS00NTkyIjtzOjY6ImZpbHRlciI7YjowO31pOjQ7YTozOntzOjU6InRpdGxlIjtzOjI4OiJBcmVhcyBQYWdlIChHYWxsZXJ5KSBTaWRlYmFyIjtzOjQ6InRleHQiO3M6MjEyOiJQZWxsZW50ZXNxdWUgc2NlbGVyaXNxdWUgcGhhcmV0cmEgZW5pbSBldSBhbGlxdWFtLiBQZWxsZW50ZXNxdWUgZXVpc21vZCBmZWxpcyB2ZWxpdCwgc2VkIGFsaXF1YW0gZW5pbSBhbGlxdWFtIGF0Lg0KDQpOdW5jIHF1aXMgZmFjaWxpc2lzIGZlbGlzOyBlZ2V0IGlhY3VsaXMgbGFjdXMuIE51bGxhbSBub24gYXVndWUgaW4gbmlzaSBwZWxsZW50ZXNxdWUgbGFvcmVldC4NCiI7czo2OiJmaWx0ZXIiO2I6MDt9aTo1O2E6Mzp7czo1OiJ0aXRsZSI7czoyMDoiR2FsbGVyeSBQYWdlIFNpZGViYXIiO3M6NDoidGV4dCI7czoyMzg6Ik1vcmJpIHZlbCB1cm5hIHV0IGFyY3UgZmVybWVudHVtIGFsaXF1YW0gdmVsIHF1aXMgbmliaC4gU2VkIHZpdGFlIGFyY3UgbWFnbmEhIA0KDQpOdWxsYSBkaWduaXNzaW0gYSBhdWd1ZSB2ZWwgc2VtcGVyLiBTZWQgbmVjIG1vbGxpcyBhbnRlLiBJbiBlZ2V0IGVsaXQgaW4gZG9sb3IgZGljdHVtIGFsaXF1ZXQuIEludGVnZXIgY3Vyc3VzIG1vbGVzdGllIGRvbG9yLCBxdWlzIHBvcnRhIGRvbG9yIHRlbXBvciB1dC4gDQoiO3M6NjoiZmlsdGVyIjtiOjA7fXM6MTI6Il9tdWx0aXdpZGdldCI7aToxO31zOjE1OiJnZ19id21hcF93aWRnZXQiO2E6Mjp7aToyO2E6Mzp7czo1OiJ0aXRsZSI7czowOiIiO3M6ODoibGF0aXR1ZGUiO3M6MTA6IjM3LjMzNTA3ODYiO3M6OToibG9uZ2l0dWRlIjtzOjEyOiItMTIyLjAyOTU3NzIiO31zOjEyOiJfbXVsdGl3aWRnZXQiO2k6MTt9fQ==">
            </li>
        </ul>

        <input type="submit" class="button-primary" name="import-content" value="<?php _e('Import demo data','okthemes') ?>" />
    </form>
    </div>

    <?php
    } elseif ( check_admin_referer( 'gg-customizer-import-content' ) ) {



      // save all options:
      $data = $_POST;

      if(isset($data['default_content']) && is_array($data['default_content'])){
      
      //import theme settings
      if(isset($data['default_content']['theme'])&&$data['default_content']['theme']){

        $encode_options='{"0":false,"background_color":"f1f1f1","background_image":"","background_repeat":"","background_position_x":"","background_attachment":"scroll","retina":false,"tagline_check":false,"logo_separator":"","logo_check":false,"main_logo":"","logo_width":"","logo_height":"","logo_margin_top":"0","main_logo_retina":"","admin_logo_separator":"","admin_logo_check":false,"admin_logo":"","admin_logo_width":"","admin_logo_height":"","favicon_separator":"","favicon_logo":"","header_search":"1","header_cart":"1","header_social_icns":"1","header_wpml_box":"1","footer_extras":"1","footer_extras_copyright":"Copyright 2014 - All rights reserved luxuryvilla","general_page_comments":"","general_post_comments":"1","custom_css":"","custom_js":"","forum_page_layout":"with_right_sidebar","forum_index_search":"1","general_store_separator":"","store_catalog_mode":"","shop_product_columns":"3","product_per_page":"12","store_add_to_wishlist":"1","store_add_to_compare":"1","store_sale_flash":"1","store_products_price":"1","store_add_to_cart":"1","product_store_separator":"","product_page_layout":"no_sidebar","product_sale_flash":"1","product_products_price":"1","product_products_excerpt":"1","product_products_meta":"1","product_add_to_cart":"1","product_related_products":"1","product_upsells_products":"1","product_reviews_tab":"1","product_description_tab":"1","product_attributes_tab":"1","cart_store_separator":"","product_crosssells_products":"1","rss_link":"","rss_link_header":"1","facebook_link":"asd","facebook_link_header":"1","twitter_link":"okwpthemes","twitter_link_header":"1","skype_link":"","skype_link_header":"1","vimeo_link":"","vimeo_link_header":"1","linkedin_link":"","linkedin_link_header":"1","dribble_link":"","dribble_link_header":"1","forrst_link":"","forrst_link_header":"1","flickr_link":"","flickr_link_header":"1","google_link":"","google_link_header":"1","youtube_link":"","youtube_link_header":"1","tumblr_link":"","tumblr_link_header":"1","pinterest_link":"","pinterest_link_header":"1","deviantart_link":"","deviantart_link_header":"1","foursquare_link":"","foursquare_link_header":"1","github_link":"","github_link_header":"1","portfolio_cpt_slug":"portfolio-item","portfolio_archive_separator":"","archive_portfolio_page_style":"fullwidth","archive_portfolio_page_columns":"four_columns","portfolio_inner_separator":"","portfolio_related_posts":"1","portfolio_related_posts_title":"Related posts","portfolio_related_posts_number":"3","blog_inner_separator":"","blog_inner_page_style":"right","blog_inner_image":"1","blog_share_box":"1","blog_archive_separator":"","archive_page_style":"nogap","search_separator":"","search_page_style":"nogap","not_found_separator":"","not_found_page_title":"Ooops page not found ...","not_found_page_description":"It seems we can\u2019t find what you\u2019re looking for. Perhaps searching, or one of the links below, can help.","not_found_contact_btn_link":"#","not_found_page_search":"1","primary-color":"#1abc9c","primary-accent-color":"#ff5454","secondary-color":"#0c0f21","tertiary-color":"#d9e2e9","tertiary-accent-color":"#f7f8f8","special-accent-color":"#33c3ff","font_colors_separator":"","text-color":"#18191a","link-color":"#1abc9c","headings-color":"#18191a","menu-color":"#b6bbbf","background_color_separator":"","body_font":"eurofurence+regular","body_font_style":"400","logo_font":"Pacifico","logo_font_style":"400","background_type_select":"none","background_type_patterns":"","footer_widgets":true,"property_cpt_slug":"property-item","property_archive_separator":"","archive_property_page_style":"fullwidth","archive_property_page_columns":"four_columns","archive_page_layout":"masonry","archive_page_columns":"2","search_page_layout":"masonry","search_page_columns":"2","property_archive_layout":"fitRows","property_archive_style":"gap","property_archive_columns":"3","header_style":"style1","menu_width":"col-md-4","menu_columns":"4","headings_font":"Raleway:100,200,300,400,500,600,700,800,900","layout_style":"horizontal","site_preloader":"1"}';
          $options        = json_decode( $encode_options, true );
          foreach ( $options as $key => $value ) {
            set_theme_mod( $key, $value );
          }

        $frontpage = get_page('28');
        $blogpage = get_page('9');   
        update_option('show_on_front', 'page');    // show on front a static page
        update_option('page_on_front', $frontpage->ID);
        update_option('page_for_posts', $blogpage->ID);
        
        echo '<div class="updated"><p>Theme Settings were installed!</p></div>';
           
      }
      
      
      //import menu settings
      if(isset($data['default_content']['menu'])&&$data['default_content']['menu']){
          $menus = get_terms('nav_menu');
          $save = array();
          foreach($menus as $menu){
              if($menu->name == 'Main'){
                  $save['main-menu'] = $menu->term_id;
              }
          }
          if($save){
              set_theme_mod( 'nav_menu_locations', array_map( 'absint', $save ) );
              echo '<div class="updated"><p>Menu Settings were installed!</p></div>';
          }
      }
      
      
      //import widgets and widget settings
            if(isset($data['default_content']['widgets']) && $data['default_content']['widgets']){
                $export = false;
                if($export){
                    // export widgets
                    $widget_positions = get_option('sidebars_widgets');
                    $widget_options = array();
                    foreach($widget_positions as $sidebar_name => $widgets){
                        if(is_array($widgets)){
                            foreach($widgets as $widget_name){
                                $widget_name_strip = preg_replace('#-\d+$#','',$widget_name);
                                $widget_options[$widget_name_strip] = get_option('widget_'.$widget_name_strip);
                            }
                        }
                    }
                    $a = base64_encode(serialize($widget_positions));
                    $b = base64_encode(serialize($widget_options));
                    echo "widget_positions: \n\n\n$a\n\n\n widget_options \n\n\n$b\n\n\n";exit;
                }else{
                    // import widgets
                    $widget_positions = get_option('sidebars_widgets');

                    $import_widget_positions = unserialize(base64_decode($_REQUEST['widget_positions']));
                    $import_widget_options = unserialize(base64_decode($_REQUEST['widget_options']));
                    foreach($import_widget_options as $widget_name => $widget_options){
                        $existing_options = get_option('widget_'.$widget_name,array());
                        $new_options = $existing_options + $widget_options;
                        update_option('widget_'.$widget_name,$new_options);
                    }
                    update_option('sidebars_widgets',array_merge($widget_positions,$import_widget_positions));
                    echo '<div class="updated"><p>Widget Settings were installed!</p></div>';
                } 
            }
        }



    } ?>

<?php
}