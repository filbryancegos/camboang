<?php
    if(!isset($_GET['sleeps'])) {
        $_GET['sleeps'] = '';
    }
    if(!isset($_GET['bedrooms'])) {
        $_GET['bedrooms'] = '';
    }
    if(!isset($_GET['bathrooms'])) {
        $_GET['bathrooms'] = '';
    }
    if(!isset($_GET['city'])) {
        $_GET['city'] = '';
    }
    if(!isset($_GET['country'])) {
        $_GET['country'] = '';
    }
    if(!isset($_GET['property_type'])) {
        $_GET['property_type'] = '';
    }
    ?>
    <?php
    $purl = get_post_type_archive_link('property_cpt');
    ?>
    <div class="advanced-search-form">
        <form method="get" class="advanced-searchform" action="<?php echo $purl; ?>">
        
            <input type="hidden" name="post_type" value="property_cpt" />
            
            <?php
            $query_for_search = new WP_Query(array(
                'post_type' => 'property_cpt',
                'posts_per_page' => -1,
            ));
            while($query_for_search->have_posts()): $query_for_search->the_post();
                
                $property_city = get_field('gg_property_meta_location_city');
                $property_country = get_field('gg_property_meta_location_country');

                if($property_city):
                $city[] = $property_city;
                endif;

                if($property_country):
                $country[] = $property_country;
                endif;

                if(isset($city)) {
                if($city) {
                    $city = array_unique($city);
                }
                }

                if(isset($country)) {
                if($country) {
                    $country = array_unique($country);
                }
                }

            endwhile;
            ?>

            <?php
            $property_type = get_terms('property_category');
            if($property_type):
            ?>
            <div class="form-group">
                <label for="property_type" class="sr-only"><?php _e('Property type','okthemes'); ?></label>
                <select name="property_type"> 
                    <option value="*"><?php _e('All types','okthemes'); ?></option>
                    <?php foreach($property_type as $pt): ?>
                    <option value="<?php echo $pt->slug; ?>" <?php if($_GET['property_type'] == $pt->slug): ?>selected="selected"<?php endif; ?>><?php echo $pt->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php endif; ?>

            <?php if($country): ?>
            <div class="form-group">
                <label for="country" class="sr-only"><?php _e('Country','okthemes'); ?></label>
                <select name="country">
                    <option value="*"><?php _e('All countries','okthemes'); ?></option>
                    <?php foreach($country as $s): ?> 
                    <option value="<?php echo $s; ?>" <?php if($_GET['country'] == $s): ?>selected="selected"<?php endif; ?>><?php echo $s; ?></option>
                    <?php endforeach; ?> 
                </select>
            </div>
            <?php endif; ?>

            <?php if($city): ?>
            <div class="form-group">
                <label for="city" class="sr-only"><?php _e('City','okthemes'); ?></label>
                <select name="city"> 
                    <option value="*"><?php _e('All cities','okthemes'); ?></option> 
                    <?php foreach($city as $c): ?>
                    <option value="<?php echo $c; ?>" <?php if($_GET['city'] == $c): ?>selected="selected"<?php endif; ?>><?php echo $c; ?></option>
                    <?php endforeach; ?> 
                </select>
            </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="sleeps" class="sr-only"><?php _e('Sleeps','okthemes'); ?></label>
                <select name="sleeps"> 
                    <option value="*"><?php _e('Sleeps','okthemes'); ?></option> 
                    <option value="1" <?php if($_GET['sleeps'] == '1'): ?>selected="selected"<?php endif; ?>>1+</option>
                    <option value="2" <?php if($_GET['sleeps'] == '2'): ?>selected="selected"<?php endif; ?>>2+</option>
                    <option value="3" <?php if($_GET['sleeps'] == '3'): ?>selected="selected"<?php endif; ?>>3+</option>
                    <option value="4" <?php if($_GET['sleeps'] == '4'): ?>selected="selected"<?php endif; ?>>4+</option>
                    <option value="5" <?php if($_GET['sleeps'] == '5'): ?>selected="selected"<?php endif; ?>>5+</option>
                    <option value="6" <?php if($_GET['sleeps'] == '6'): ?>selected="selected"<?php endif; ?>>6+</option>
                    <option value="7" <?php if($_GET['sleeps'] == '7'): ?>selected="selected"<?php endif; ?>>7+</option>
                    <option value="8" <?php if($_GET['sleeps'] == '8'): ?>selected="selected"<?php endif; ?>>8+</option>
                    <option value="9" <?php if($_GET['sleeps'] == '9'): ?>selected="selected"<?php endif; ?>>9+</option>
                    <option value="10" <?php if($_GET['sleeps'] == '10'): ?>selected="selected"<?php endif; ?>>10+</option>
                    <option value="11" <?php if($_GET['sleeps'] == '11'): ?>selected="selected"<?php endif; ?>>11+</option>
                    <option value="12" <?php if($_GET['sleeps'] == '12'): ?>selected="selected"<?php endif; ?>>12+</option>
                </select>
            </div>

            <div class="form-group">
                <label for="bedrooms" class="sr-only"><?php _e('Bedrooms','okthemes'); ?></label>
                <select name="bedrooms"> 
                    <option value="*"><?php _e('Bedrooms','okthemes'); ?></option> 
                    <option value="1" <?php if($_GET['bedrooms'] == '1'): ?>selected="selected"<?php endif; ?>>1+</option>
                    <option value="2" <?php if($_GET['bedrooms'] == '2'): ?>selected="selected"<?php endif; ?>>2+</option>
                    <option value="3" <?php if($_GET['bedrooms'] == '3'): ?>selected="selected"<?php endif; ?>>3+</option>
                    <option value="4" <?php if($_GET['bedrooms'] == '4'): ?>selected="selected"<?php endif; ?>>4+</option>
                    <option value="5" <?php if($_GET['bedrooms'] == '5'): ?>selected="selected"<?php endif; ?>>5+</option>
                    <option value="6" <?php if($_GET['bedrooms'] == '6'): ?>selected="selected"<?php endif; ?>>6+</option>
                </select>
            </div>

            <div class="form-group">
                <label for="bathrooms" class="sr-only"><?php _e('Bathrooms','okthemes'); ?></label>
                <select name="bathrooms"> 
                    <option value="*"><?php _e('Bathrooms','okthemes'); ?></option> 
                    <option value="1" <?php if($_GET['bathrooms'] == '1'): ?>selected="selected"<?php endif; ?>>1+</option>
                    <option value="2" <?php if($_GET['bathrooms'] == '2'): ?>selected="selected"<?php endif; ?>>2+</option>
                    <option value="3" <?php if($_GET['bathrooms'] == '3'): ?>selected="selected"<?php endif; ?>>3+</option>
                    <option value="4" <?php if($_GET['bathrooms'] == '4'): ?>selected="selected"<?php endif; ?>>4+</option>
                    <option value="5" <?php if($_GET['bathrooms'] == '5'): ?>selected="selected"<?php endif; ?>>5+</option>
                    <option value="6" <?php if($_GET['bathrooms'] == '6'): ?>selected="selected"<?php endif; ?>>6+</option>
                </select>
            </div>

            <div class="form-group"><input type="submit" class="submit-advanced" name="submit" value="<?php _e('Search','okthemes'); ?>" /></div>
        </form>
    </div>