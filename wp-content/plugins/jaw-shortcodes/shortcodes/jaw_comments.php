<?php

class jaw_comments {

    private $_data = array();
    private $_tmpl;

    public function __construct($tmpl = null) {
        $this->class_name = get_class();
        if (isset($tmpl)) {
            $this->_tmpl = $tmpl;
        } else {
            $this->_tmpl = substr($this->class_name, 4);
        }
        add_shortcode($this->class_name, array($this, $this->class_name . '_shortcode'));
    }

    public function jaw_comments_shortcode($atts, $content = null, $code = null) {
        $cache_id = 'comments_'.jaw_cache_get_id().'_'.jaw_template_inc_counter('cache_tmpl');
        if(!jaw_has_template_cache($this->_tmpl, 'simple-shortcodes','',$cache_id,'fast')){
            jaw_template_set_data($this->model($atts));
        }
        return jaw_get_template_cache($this->_tmpl, 'simple-shortcodes','',$cache_id,'fast');
        // jaw_template_set_data($this->model((array) $atts));
        // return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts) {
 
        shortcode_atts(array(
            'number' => '12',
            'offset' => '',
            'orderby' => 'comment_date_gmt ',
            'order' => 'DESC',
            'post_id' => 0,
            'post_type' => '',
            'post__in' => '',
            'status' => '',
            'animate' => '1',
            'animate_style' => 'slide',
            'animate_duration' => '800',
            'animate_direction' => 'left',
            'animate_easing' => 'slide'
                ), $atts);
        
        $atts['post_id'] = null;
        
        if (isset($atts['box_title'])) {
            $atts['box_title'] = $atts['box_title'];
        }
        
        if (isset($atts['box_size'])) {
            $atts['box_size'] = $atts['box_size'];
        } else {
            $atts['box_size'] = 'max';
        }
        if (isset($atts['post__in']) && !is_array($atts['post__in'])) {
            $atts['post__in'] = explode(",",$atts['post__in']);
        }
        $atts['comments'] = get_comments($atts);
        return $atts;
    }
}
