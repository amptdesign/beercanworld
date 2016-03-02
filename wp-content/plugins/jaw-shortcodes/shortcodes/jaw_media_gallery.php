<?php

class jaw_media_gallery {

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

    public function jaw_media_gallery_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data((array) $this->model($atts));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts) {

        
        if (isset($atts['box_size'])) {
            $atts['box_size'] = $atts['box_size'];
        } else {
            $atts['box_size'] = 'max';
        }
        
        if (isset($atts['gallery'])) {
            $atts['gallery'] = (int)$atts['gallery'];
        } else {
            $atts['gallery'] = 0;
        }
        
        $_gallery_image = $this->get_gallery_image($atts['gallery']);
        if (isset($_gallery_image)) {
            $atts['_gallery_image'] = $_gallery_image;
        }
        
        return $atts;
    }
    
    private function get_gallery_image($id = 0) {
        
        if ($id > 0) {
            $_gallery_image = get_post_meta($id, '_gallery_image', true);
            $image_parse=json_decode($_gallery_image,true);
            $image_id=($image_parse[0]['id']);
            return jwMedia::getAttachmentSrc($image_id, 'full');
 
        }
        
        return;
        
    }

}
