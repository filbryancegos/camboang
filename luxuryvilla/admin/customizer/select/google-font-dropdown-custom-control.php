<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * A class to create a dropdown for all google fonts
 */
 class Google_Font_Dropdown_Custom_Control extends WP_Customize_Control
 {
    private $fonts = false;

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        global $googleFontArrays, $systemFontArrays;

        $mixedFontArrays = array_merge($googleFontArrays, $systemFontArrays);
        asort($mixedFontArrays);

        $this->fonts = $mixedFontArrays;
        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
    {
        if(!empty($this->fonts))
        {
            ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <select <?php $this->link(); ?>>
                    
                        <?php
                            foreach ( $this->fonts as $k => $value )
                            {
                                $font_string = "";
                                $font_string = str_replace(' ', '+', $value['family']); 
                                
                                if(count($value['variants'])) 
                                    $font_string .= ":". implode(',', $value['variants']);
                                   
                                printf('<option value="%s" %s>%s</option>', $font_string, selected($this->value(), str_replace(' ', '+', $value['family']), false), $value['family']);
                            }
 
                        ?>

                    </select>
                </label>
            <?php
        }
    }
 }
?>