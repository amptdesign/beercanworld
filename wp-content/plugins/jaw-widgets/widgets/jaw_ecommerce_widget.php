<?php

/**
 * jwlogin_widget
 * 
 * 
 */
class jaw_ecommerce_widget extends jaw_default_widget {
    
    protected $options = array(        
        0 => array('id' => 'login_show',
            'description' => 'Show Login/MyAccount item ',
            'type' => 'checkbox', // [[ text, check, select ]]
            'default' => 1),
        1 => array('id' => 'wishlist_show',
            'description' => 'Show wishlist item ',
            'type' => 'checkbox', // [[ text, check, select ]]
            'default' => 1),
        2 => array('id' => 'cart_show',
            'description' => 'Show cart item ',
            'type' => 'checkbox', // [[ text, check, select ]]
            'default' => 1),
    );

    function jaw_ecommerce_widget() {
        $options = array('classname' => 'jaw_ecommerce_widget', 'description' => "Theme-based eCommerce widget");
        $controls = array('width' => 250, 'height' => 200);
        parent::__construct('jaw_ecommerce_widget', 'J&W - eCommerce  Widget', $options, $controls);
    }

    function widget($args, $instance) {
        
        $ret['args'] = $args;
        $ret['instance'] = $instance;
        extract($args); 
        
        echo $before_widget;
        
        jaw_template_set_data($ret, $this);
        echo jaw_get_template_part('jaw_ecommerce_widget','widgets');
        
        echo $after_widget;
    }
}

