<?php

class jaw_woo_carousel_vertical_small {

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

    public function jaw_woo_carousel_vertical_small_shortcode($atts, $content = null, $code = null) {
        jaw_template_set_data($this->model($atts));
        return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts) {

        extract(shortcode_atts(array(
            'post_type' => 'product',
            'count' => 6,
            'product_cat' => '',
            'paged' => 1,
            'order' => '',
            'orderby' => '',
            'dateformat' => '',
            'pagination' => '',
            'excerpt' => '15',
            'metaauthor' => '',
            'metacategory' => '',
            'metadate' => '',
            'metacomments' => '',
            'metacaption' => '',
            'ratings' => '',
            'slider' => false,
            'slider_source' => '',
            'slider_max' => 3,
            'image_clickable' => '0',
            'image_lightbox' => '1',
            'post__not_in' => '',
            'on_sale' => '0'
                        ), $atts));

        $qs = array();
        $qs['paged'] = 1;
        
        if(isset($on_sale) && $on_sale == '1' && function_exists('wc_get_product_ids_on_sale')){
            $product_ids_on_sale = wc_get_product_ids_on_sale();
            $post__in = array_merge( array(0), $product_ids_on_sale );
        }
        
        if (isset($product_cat) && !empty($product_cat)) {
            if(!is_array($product_cat)) {
                $product_cat = explode(',', $product_cat);
            }   
        }
        
        if(!empty($product_cat)){
            $qs['tax_query'] = array(
                array(
                    "taxonomy" => "product_cat",
                    "field" => "slug",
                    "terms" => $product_cat,
                    "operator" => "IN"
                )
            );
        }

        $qs['ignore_sticky_posts'] = 1;
        $qs['posts_per_page'] = $count;
        $qs['post_type'] = $post_type;
        $qs['post_status'] = 'publish';
        $qs['post__in'] = $post__in;
        $qs['order'] = $order;
        $qs['orderby'] = $orderby;
        $qs['dateformat'] = $dateformat;

        $qs['excerpt'] = $excerpt;

        //only visible
        $qs['meta_query'] = array();

        $qs['meta_query'][] = array(
            'key' => '_visibility',
            'value' => array('catalog', 'visible'),
            'compare' => 'IN'
        );
        if ('yes' === get_option('woocommerce_hide_out_of_stock_items')) {
            $qs['meta_query'][] = array('key' => '_stock_status',
                'value' => 'outofstock',
                'compare' => '!=');
        }
        
        $blog_query = new WP_Query($qs);
        
        if (isset($atts['box_title'])) {
            $blog_query->box_title = $atts['box_title'];
        } else {
            $blog_query->box_title = 'Blog';
        }
        
        if (isset($atts['box_style'])) {
            $blog_query->box_style = $atts['box_style'];
        } else {
            $blog_query->box_style = '10';
        }
        
        if (isset($atts['type'])) {
            $blog_query->type = $atts['type'];
        } else {
            $blog_query->type = 'default';
        }
        
        if (isset($atts['box_size'])) {
            $blog_query->box_size = $atts['box_size'];
        } else {
            $blog_query->box_size = '4';
        }

        if (isset($atts['post_in_slide'])) {
            $blog_query->post_in_slide = $atts['post_in_slide'];
        } else {
            $blog_query->post_in_slide = '3';
        }
        if (isset($atts['automatic_slide'])) {
            $blog_query->automatic_slide = $atts['automatic_slide'];
        } else {
            $blog_query->automatic_slide = '0';
        }
        if (isset($atts['letter_excerpt'])) {
            $blog_query->letter_excerpt = $atts['letter_excerpt'];
        } else {
            $blog_query->letter_excerpt = '300';
        }
        if (isset($atts['letter_excerpt_title'])) {
            $blog_query->letter_excerpt_title = $atts['letter_excerpt_title'];
        } else {
            $blog_query->letter_excerpt_title = '60';
        }
        if (isset($atts['carousel_style'])) {
            $blog_query->carousel_style = $atts['carousel_style'];
        } else {
            $blog_query->carousel_style = 'bar';
        }
        
        if (isset($atts['catalog_mode'])) {
            $blog_query->catalog_mode = $atts['catalog_mode'];
        } else {
            $blog_query->catalog_mode = 'off';
        }
        
        return $blog_query;
    }

}