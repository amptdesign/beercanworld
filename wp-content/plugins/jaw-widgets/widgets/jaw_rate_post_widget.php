<?php

class jaw_rate_post_widget extends jaw_default_widget {

    /**
     *  Defining the widget options
     */
    protected $options = array(
        0 => array('id' => 'ratings_title',
            'description' => 'Ratings title:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => '')
    );

    function jaw_rate_post_widget() {
        $options = array('classname' => 'jwRatePostWidget', 'description' => "widget for rating posts");
        $controls = array('width' => 250, 'height' => 200);
        parent::__construct('jwRatePostWidget', 'J&W - Rate Post Widget for JaWesome', $options, $controls);
    }

    function widget($args, $instance) {
        global $post;
        $ret = array();
        $ret['args'] = $args;
        $ret['instance'] = $instance;
        
        $ratings = maybe_unserialize(get_post_meta(get_the_ID(), 'jaw_rating', TRUE));

        if (isset($ratings['user'])) {
            $user_rating = $ratings;
            $ret['user_rating'] = $user_rating;
        } else {
            
        }

        jaw_template_set_data($ret, $this);
        echo jaw_get_template_part('jaw_rate_widget', 'widgets');
    }

}
