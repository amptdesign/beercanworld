<?php

class jaw_row {

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

    public function jaw_row_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data(array('content' => $content));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

}
