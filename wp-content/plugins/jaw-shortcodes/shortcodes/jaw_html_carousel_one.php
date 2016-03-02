<?php

class jaw_html_carousel_one {

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

    public function jaw_html_carousel_one_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model($content));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($content) {
        $out = array();
        
        $out['items_in_slide'] = jaw_template_get_var('items_in_slide', '1');
        $out['one_width'] = jaw_template_get_var('one_width', '12');
        $out['first'] = jaw_template_get_var('first', '');
        $out['konec'] = jaw_template_get_var('konec', 'true');
        $out['count'] = jaw_template_get_var('count', '0');
        
        if (isset($content)) {
           $out['content'] = $content;
        }
        return $out;
    }

}
