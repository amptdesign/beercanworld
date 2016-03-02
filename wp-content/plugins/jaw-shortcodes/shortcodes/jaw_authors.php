<?php

class jaw_authors {

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

    public function jaw_authors_shortcode($atts, $content = null, $code = null) {
        $cache_id = 'authors_'.jaw_cache_get_id().'_'.jaw_template_inc_counter('cache_tmpl');
        if(!jaw_has_template_cache( $this->_tmpl,'simple-shortcodes','',$cache_id,'fast')){
            jaw_template_set_data($this->model($atts));
        }
        return jaw_get_template_cache($this->_tmpl, 'simple-shortcodes','',$cache_id,'fast');
        // jaw_template_set_data($this->model((array) $atts));
        // return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts) {

        if (isset($atts['authors'])) {
            $atts['authors'] = explode(',', $atts['authors']);
        }
        return $atts;
    }

}
