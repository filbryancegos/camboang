<?php $contact_form_headline = get_field( 'gg_contact_form_headline' ); ?>

<div class="contact-form-wrapper">

    <?php if ($contact_form_headline) : ?>
    <h3><?php echo esc_html($contact_form_headline); ?></h3>
    <?php endif; ?>

    <div id="cf-msg"></div><!-- Message display -->

    <form 
    id="contact-form" 
    class="row" 
    data-bv-message="<?php esc_html_e( 'This value is not valid', 'okthemes' ); ?>" 
    data-bv-feedbackicons-valid="glyphicon glyphicon-ok" 
    data-bv-feedbackicons-invalid="glyphicon glyphicon-remove" 
    data-bv-feedbackicons-validating="glyphicon glyphicon-refresh"
    data-bv-container="tooltip"  
    >
    	
        <div class="form-group col-md-6">
            <label class="sr-only" for="firstname"><?php esc_html_e( 'First Name', 'okthemes' ); ?></label>
            <input data-bv-notempty="true" data-bv-notempty-message="<?php esc_html_e( 'The first name is required and cannot be empty', 'okthemes' ); ?>" placeholder="<?php esc_html_e( 'First Name', 'okthemes' ); ?>" type="text" name="firstname" id="firstname" value="" class="form-control" />
        </div>    
        <div class="form-group col-md-6">    
            <label class="sr-only" for="lastname"><?php esc_html_e( 'Last Name', 'okthemes' ); ?></label>
            <input data-bv-notempty="true" data-bv-notempty-message="<?php esc_html_e( 'The last name is required and cannot be empty', 'okthemes' ); ?>" placeholder="<?php esc_html_e( 'Last Name', 'okthemes' ); ?>" type="text" name="lastname" id="lastname" value="" class="form-control" />
        </div>
        <div class="form-group col-md-6">    
            <label class="sr-only" for="email"><?php esc_html_e( 'Email', 'okthemes' ); ?></label>
            <input data-bv-notempty="true" data-bv-notempty-message="<?php esc_html_e( 'The email is required and cannot be empty', 'okthemes' ); ?>" data-bv-emailaddress="true" data-bv-emailaddress-message="<?php esc_html_e( 'The input is not a valid email address', 'okthemes' ); ?>" placeholder="<?php esc_html_e( 'Email', 'okthemes' ); ?>" type="text" name="email" id="email" value="" class="form-control" />
        </div>
        <div class="form-group col-md-6">
            <label class="sr-only" for="phone"><?php esc_html_e( 'Phone', 'okthemes' ); ?></label>
            <input data-bv-notempty="true" data-bv-notempty-message="<?php esc_html_e( 'The phone is required and cannot be empty', 'okthemes' ); ?>" placeholder="<?php esc_html_e( 'Phone', 'okthemes' ); ?>" type="text" name="phone" id="phone" value="" class="form-control" />
        </div>
        <div class="form-group col-md-12">    
            <label class="sr-only" for="message"><?php esc_html_e( 'Message', 'okthemes' ); ?></label>
            <textarea data-bv-notempty="true" data-bv-notempty-message="<?php esc_html_e( 'The message is required and cannot be empty', 'okthemes' ); ?>" name="message" id="message" rows="10" placeholder="<?php esc_html_e( 'Message', 'okthemes' ); ?>" class="form-control"></textarea>
        </div>

            <input name="action" type="hidden" value="cf_action" />
            <input name="post_id" type="hidden" value="<?php echo esc_html($post->ID); ?>" />
          	<?php wp_nonce_field( 'contact_form_html', '_cf_nonce'); ?>
         	<button type="submit" id="cfs" class="btn btn-primary"><?php esc_html_e( 'Send', 'okthemes' ); ?></button>
        </ul>
    </form>

</div><!--Close .contact-form-wrapper -->