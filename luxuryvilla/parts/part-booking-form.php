<?php
  wp_enqueue_script('boot-datepicker');
  wp_enqueue_style('boot-datepicker');
?>

<div id="bf-msg"></div><!-- Message display -->

<form id="booking-form" data-bv-message="This value is not valid" data-bv-feedbackicons-valid="glyphicon glyphicon-ok" data-bv-feedbackicons-invalid="glyphicon glyphicon-remove" data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" data-bv-container="tooltip">
	
    <fieldset class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="booking-form-wrapper booking-form-calendars">
                    <legend><span>01.</span><?php esc_html_e( 'Select check in and check out dates', 'okthemes' ); ?></legend>
                    <div class="form-group col-md-6">
                        <label class="sr-only" for="checkin"><?php esc_html_e( 'Check-in', 'okthemes' ); ?></label>
                        <i class="entypo entypo-calendar"></i>
                        <input data-bv-date="true" data-bv-date-format="MM/DD/YYYY" data-bv-date-message = "The date format is not valid" data-bv-notempty="true" data-bv-notempty-message="The checkin date is required and cannot be empty" name="checkin" type="text" id="checkin" value="" class="form-control" placeholder="<?php esc_html_e( 'Check-in', 'okthemes' ); ?>"/>
                    </div>    
                    <div class="form-group col-md-6">
                        <label class="sr-only" for="checkout"><?php esc_html_e( 'Check-out', 'okthemes' ); ?></label>
                        <i class="entypo entypo-calendar"></i>
                        <input data-bv-date="true" data-bv-date-format="MM/DD/YYYY" data-bv-date-message = "The date format is not valid" data-bv-notempty="true" data-bv-notempty-message="The checkout date is required and cannot be empty" name="checkout" type="text" id="checkout" value="" class="form-control" placeholder="<?php esc_html_e( 'Check-out', 'okthemes' ); ?>"/>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="container-fluid odd">
        <div class="row">
            <div class="col-md-12">
                <div class="booking-form-wrapper booking-form-select">
                    <legend><span>02.</span><?php esc_html_e( 'Select location', 'okthemes' ); ?></legend>
                    <div class="form-group col-md-12">
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
                        <select data-bv-notempty="true" data-bv-notempty-message = "Select a property" name="mainproperty" id="mainproperty" class="cs-select cs-skin-border">
                            <?php $i=0; while ( $select_properties->have_posts() ) : $select_properties->the_post(); $i++; ?>
                                  <option value="<?php echo absint($select_properties->post->ID);?>"><?php echo get_the_title();?></option>
                            <?php endwhile; ?>
                        </select>
                        
                        <?php } else { ?>

                        <div class="no-properties-availble"> 
                            <h3><?php esc_html_e( 'No properties available', 'okthemes' ); ?></h3>  
                        </div>
                        <?php } ?>

                        <?php 
                        // Restore original Post Data    
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="booking-form-wrapper">
                    <legend><span>03.</span><?php esc_html_e( 'Rooms and rates', 'okthemes' ); ?></legend>
                    <div class="form-group col-md-12">
                        <div id="gg-ajax-rooms"></div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="container-fluid odd">
        <div class="row">
            <div class="col-md-12">
                <div class="booking-form-wrapper form-inline booking-form-select">
                    <legend><span>04.</span><?php esc_html_e( 'Additional Informations', 'okthemes' ); ?></legend>
                    <div class="form-group col-md-6">    
                        <label class="col-sm-12 control-label" for="rooms"><?php esc_html_e( 'Rooms', 'okthemes' ); ?></label>
                        <div class="col-sm-12">
                            <select data-bv-notempty="true" data-bv-notempty-message = "Select the number of rooms" name="rooms" id="rooms" class="cs-select cs-skin-border">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-12 control-label" for="adults"><?php esc_html_e( 'Adults', 'okthemes' ); ?></label>
                        <div class="col-sm-12">
                            <select data-bv-notempty="true" data-bv-notempty-message = "Select the number of adults" name="adults" id="adults" class="cs-select cs-skin-border">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">    
                        <label class="col-sm-12 control-label" for="children"><?php esc_html_e( 'Children', 'okthemes' ); ?></label>
                        <div class="col-sm-12">
                            <select data-bv-notempty="true" data-bv-notempty-message = "Select the number of children" name="children" id="children" class="cs-select cs-skin-border">
                              <option value="0">0</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-sm-12 control-label" for="pets"><?php esc_html_e( 'Pets', 'okthemes' ); ?></label>
                        <div class="col-sm-12">
                            <select data-bv-notempty="true" data-bv-notempty-message = "Select the number of pets" name="pets" id="pets" class="cs-select cs-skin-border">
                              <option value="0">0</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="booking-form-wrapper">
                    <legend><span>05.</span><?php esc_html_e( 'Personal Informations', 'okthemes' ); ?></legend>
                    <div class="form-group col-md-6">
                        <label class="sr-only" for="firstname"><?php esc_html_e( 'First Name', 'okthemes' ); ?></label>
                        <input data-bv-notempty="true" data-bv-notempty-message="The first name is required and cannot be empty" placeholder="<?php esc_html_e( 'First Name', 'okthemes' ); ?>" type="text" name="firstname" id="firstname" value="" class="form-control" />
                    </div>    
                    <div class="form-group col-md-6">    
                        <label class="sr-only" for="lastname"><?php esc_html_e( 'Last Name', 'okthemes' ); ?></label>
                        <input data-bv-notempty="true" data-bv-notempty-message="The last name is required and cannot be empty" placeholder="<?php esc_html_e( 'Last Name', 'okthemes' ); ?>" type="text" name="lastname" id="lastname" value="" class="form-control" />
                    </div>
                    <div class="form-group col-md-6">    
                        <label class="sr-only" for="email"><?php esc_html_e( 'Email', 'okthemes' ); ?></label>
                        <input data-bv-notempty="true" data-bv-notempty-message="The email is required and cannot be empty" data-bv-emailaddress="true" data-bv-emailaddress-message="The input is not a valid email address" placeholder="<?php esc_html_e( 'Email', 'okthemes' ); ?>" type="text" name="email" id="email" value="" class="form-control" />
                    </div>
                    <div class="form-group col-md-6">
                        <label class="sr-only" for="phone"><?php esc_html_e( 'Phone', 'okthemes' ); ?></label>
                        <input data-bv-notempty="true" data-bv-notempty-message="The phone is required and cannot be empty" placeholder="<?php esc_html_e( 'Phone', 'okthemes' ); ?>" type="text" name="phone" id="phone" value="" class="form-control" />
                    </div>
                    <div class="form-group col-md-6">    
                        <label class="sr-only" for="country"><?php esc_html_e( 'Country', 'okthemes' ); ?></label>
                        <input data-bv-notempty="true" data-bv-notempty-message="The country is required and cannot be empty" placeholder="<?php esc_html_e( 'Country', 'okthemes' ); ?>" type="text" name="country" id="country" value="" class="form-control" />
                    </div>
                    <div class="form-group col-md-6">
                        <label class="sr-only" for="postcode"><?php esc_html_e( 'Post code', 'okthemes' ); ?></label>
                        <input data-bv-notempty="true" data-bv-notempty-message="The postcode is required and cannot be empty" placeholder="<?php esc_html_e( 'postcode', 'okthemes' ); ?>" type="text" name="postcode" id="postcode" value="" class="form-control" />
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

    <fieldset class="container-fluid odd">
        <div class="row">
            <div class="col-md-12">
                <div class="booking-form-wrapper">
                    <legend><span>06.</span><?php esc_html_e( 'Additional notes', 'okthemes' ); ?></legend>
                    <div class="form-group col-md-12">    
                        <label class="sr-only" for="message"><?php esc_html_e( 'Message', 'okthemes' ); ?></label>
                        <textarea name="message" id="message" rows="10" placeholder="<?php esc_html_e( 'Message', 'okthemes' ); ?>" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="booking-form-wrapper booking-form-submit-wrapper">
                    <input name="action" type="hidden" value="bf_action" />
                    <input name="post_id" type="hidden" value="<?php echo esc_html($post->ID); ?>" />
                  	<?php wp_nonce_field( 'booking_form_html', '_bf_nonce'); ?>
                 	<button type="submit" id="bfs" class="btn btn-primary"><?php esc_html_e( 'Request booking', 'okthemes' ); ?></button>
                </div>
            </div>
        </div>
    </div>

    </ul>
</form>