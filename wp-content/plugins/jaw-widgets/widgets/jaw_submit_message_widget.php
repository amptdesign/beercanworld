<?php
/* * **
 * Twitter widget - nejdriv se podiva do cache. pokud neni, nebo je prosla
 * pak stahne pomoci wp_remote tweety. Je potreba doplnit funkce _getOption
 * a _setOption vasima j(e)wOptions.
 * 
 * samotne tisknuti je ve funkci widget( $args, $instance). Pokud jsou data
 * null, pak se nepodarilo spojeni a netisknout :)
 * 
 * 
 * 
 * 
 */

class jaw_submit_message_widget extends jaw_default_widget {

    private static $_model = null;

    /**
     *  Defining the widget options
     */
    protected $options = array(
        0 => array('id' => 'box_title',
            'description' => 'Title',
            'type' => 'text',
            'default' => ''),
        1 => array('id' => 'style',
            'description' => 'Style',
            'type' => 'select', // [[ text, check, select ]]
            'default' => 'message',
            'values' => array(
                 array('name' => 'Submit a Message', 'value' => 'message'),
                 array('name' => 'Submit a Video', 'value' => 'video')
            ),
        ),
        2 => array('id' => 'modal_id',
            'description' => 'Easy Modal ID',
            'type' => 'text',
            'default' => ''),
    );

    /**
     * Registering the widget to the wordpress
     */
    function jaw_submit_message_widget() {
        $options = array('classname' => 'jwSubmitMessage', 'description' => "Theme-based Submit message");
        $controls = array('width' => 250, 'height' => 200);
        parent::__construct('jwSubmitMessage', 'J&W - Submit Message Widget', $options, $controls);
    }

    /**
     * Printing widget, called by wordpress
     */
    function widget($args, $instance) {

        jaw_template_set_data($instance);
        if(isset($instance['box_title']) && $instance['box_title'] != ''){
            echo jaw_get_template_part('section_bar', 'simple-shortcodes');
        }
        echo jaw_get_template_part('submit_message', 'simple-shortcodes');
        
    }


}

