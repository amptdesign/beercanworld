<?php

class jaw_about_author extends jaw_default_widget {

    /**
     *  Defining the widget options
     */
    
    protected $options = array();
            
   

    /**
     * Registering the widget to the wordpress
     */
    function jaw_about_author() {
        $this->options = $this->get_options();
        $options = array('classname' => 'jwAboutAuthor', 'description' => "");
        $controls = array('width' => 250, 'height' => 200);
        parent::__construct('jwAboutAuthor', 'J&W - About Author Widget', $options, $controls);
    }

    function widget($args, $instance) {
        $ret['args'] = $args;
        $ret['instance'] = $instance;

        jaw_template_set_data($ret, $this);
        echo jaw_get_template_part('jaw_about_author', 'widgets');
    }

    
     public function get_options() {
        $sdbs = get_users();
        $authors = array();
        $authors[] = array('name' => 'Actual Post Author', 'value' => 'auto');
        if (isset($sdbs) && count($sdbs) > 0) {
            foreach ((array) $sdbs as $k => $sdb) {
                $authors[] = array('name' => $sdb->data->display_name, 'value' => $sdb->data->ID);
            }
        }
        $option = array(0 => array('id' => 'about_author',
        'description' => 'Show Author',
        'type' => 'select',
        'values' => $authors,
        'default' => 'auto'
        ));

        return $option;
    }
    
}

?>