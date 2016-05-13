<?php
  wp_enqueue_script('boot-datepicker');
  wp_enqueue_style('boot-datepicker');
?>

<!-- Reservation form -->
<section id="quick-reservation">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">           
        <form class="form-inline clearfix" role="form" id="quick-reservation-form" data-bv-message="This value is not valid" data-bv-feedbackicons-valid="glyphicon glyphicon-ok" data-bv-feedbackicons-invalid="glyphicon glyphicon-remove" data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" data-bv-container="popover">
          <div class="row">

            <div class="col-md-2 booking-form-calendars">
              <div class="form-group">
                <label class="sr-only" for="checkin"><?php _e( 'Check-in', 'okthemes' ); ?></label>
                <i class="entypo entypo-calendar"></i>
                <input data-bv-date="true" data-bv-date-format="MM/DD/YYYY" data-bv-date-message = "<?php _e( 'The date format is not valid', 'okthemes' ); ?>" data-bv-notempty="true" data-bv-notempty-message="<?php _e( 'The checkin date is required and cannot be empty', 'okthemes' ); ?>" name="checkin" type="text" id="checkin" value="" class="form-control" placeholder="<?php _e( 'Check-in', 'okthemes' ); ?>"/>
              </div>
            </div>

            <div class="col-md-2 booking-form-calendars">
              <div class="form-group">
                <label class="sr-only" for="checkout"><?php _e( 'Check-out', 'okthemes' ); ?></label>
                <i class="entypo entypo-calendar"></i>
                <input data-bv-date="true" data-bv-date-format="MM/DD/YYYY" data-bv-date-message = "<?php _e( 'The date format is not valid', 'okthemes' ); ?>" data-bv-notempty="true" data-bv-notempty-message="<?php _e( 'The checkout date is required and cannot be empty', 'okthemes' ); ?>" name="checkout" type="text" id="checkout" value="" class="form-control" placeholder="<?php _e( 'Check-out', 'okthemes' ); ?>"/>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">

                <?php 
                $args = array(
                  'orderby' => 'name',
                  'parent' => 0
                );

                // WP_Query arguments
                $args = array (
                    'post_type'              => 'property_cpt',
                    'posts_per_page'         => -1, 
                    'ignore_sticky_posts'    => true
                );

                // The Query
                $select_properties = new WP_Query( $args );
                ?>

                <?php if ( $select_properties->have_posts() ) { ?>
                <select data-bv-notempty="true" data-bv-notempty-message = "<?php _e( 'Select a property', 'okthemes' ); ?>" name="qr_mainproperty" id="qr_mainproperty" class="cs-select cs-skin-border">
                    <?php $i=0; while ( $select_properties->have_posts() ) : $select_properties->the_post(); $i++; ?>
                          <option value="<?php echo absint($select_properties->post->ID);?>"><?php echo get_the_title();?></option>
                    <?php endwhile; ?>
                </select>
                
                <?php } else { ?>

                <div class="no-properties-availble"> 
                    <p><?php _e( 'No properties available', 'okthemes' ); ?></p>  
                </div>
                <?php } ?>

              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label for="adults" class="sr-only"><?php _e( 'Adults', 'okthemes' ); ?></label>
                <select data-bv-notempty="true" data-bv-notempty-message = "<?php _e( 'Select the number of adults', 'okthemes' ); ?>" name="adults" id="adults" class="cs-select cs-skin-border">
                  <option value="1"><?php _e( '1 Adult', 'okthemes' ); ?></option>
                  <option value="2"><?php _e( '2 Adults', 'okthemes' ); ?></option>
                  <option value="3"><?php _e( '3 Adults', 'okthemes' ); ?></option>
                  <option value="4"><?php _e( '4 Adults', 'okthemes' ); ?></option>
                  <option value="5"><?php _e( '5 Adults', 'okthemes' ); ?></option>
                  <option value="6"><?php _e( '6 Adults', 'okthemes' ); ?></option>
                  <option value="6+"><?php _e( '6+ Adults', 'okthemes' ); ?></option>
                </select>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label class="sr-only" for="name"><?php _e( 'Name', 'okthemes' ); ?></label>
                <input data-bv-notempty="true" data-bv-notempty-message="<?php _e( 'The name is required and cannot be empty', 'okthemes' ); ?>" placeholder="<?php _e( 'Name', 'okthemes' ); ?>" type="text" name="name" id="name" value="" class="form-control" />
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label class="sr-only" for="email"><?php _e( 'Email', 'okthemes' ); ?></label>
                <input data-bv-notempty="true" data-bv-notempty-message="<?php _e( 'The email is required and cannot be empty', 'okthemes' ); ?>" data-bv-emailaddress="true" data-bv-emailaddress-message="<?php _e( 'The input is not a valid email address', 'okthemes' ); ?>" placeholder="<?php _e( 'Email', 'okthemes' ); ?>" type="text" name="email" id="email" value="" class="form-control" />
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label class="sr-only" for="phone"><?php _e( 'Phone', 'okthemes' ); ?></label>
                <input data-bv-notempty="true" data-bv-notempty-message="<?php _e( 'The phone is required and cannot be empty', 'okthemes' ); ?>" placeholder="<?php _e( 'Phone', 'okthemes' ); ?>" type="text" name="phone" id="phone" value="" class="form-control" />
              </div>
            </div>
            
            <div class="col-md-2">
              <input name="action" type="hidden" value="qrf_action" />
              <?php wp_nonce_field( 'quick_reservation_form_html', '_qrf_nonce'); ?>
              <input name="post_id" type="hidden" value="<?php echo esc_html($page_id); ?>" />
              <button type="submit" id="qrfs" class="btn btn-white btn-block"><?php _e( 'Book', 'okthemes' ); ?></button>
            </div>

          </div>
        </form>
        <div id="qrf-msg"></div><!-- Message display -->
      </div>
    </div>
  </div>
 
</section>