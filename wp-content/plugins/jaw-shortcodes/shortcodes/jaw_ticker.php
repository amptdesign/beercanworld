<?php

class jaw_ticker {

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

    public function jaw_ticker_shortcode($atts, $content = null, $code = null) {
        $cache_id = 'ticker_'.jaw_cache_get_id().'_'.jaw_template_inc_counter('cache_tmpl');
        if(!jaw_has_template_cache( $this->_tmpl,'simple-shortcodes','',$cache_id,'fast')){
            jaw_template_set_data($this->model($atts));
        }
        return jaw_get_template_cache($this->_tmpl, 'simple-shortcodes','',$cache_id,'fast');
        // jaw_template_set_data($this->model($atts));
        // return jaw_get_template_part($this->_tmpl,"simple-shortcodes");
    }

    private function model($atts) {
        extract(shortcode_atts(array(
            'count' => 6,
            'cats' => '',
            'ticker_type' => "default",
            'ticker_title' => "Breaking News",
            'category__in' => array(),
            'category__not_in' => array(),
            'author' => '',
            'posts' => '',
            'orderby' => '',
            'dateformat' => '',
            'pagination' => 'none',
            'post__not_in' => ''
                        ), $atts));

        $qs = array();
        if (is_front_page()) {
            $qs['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $qs['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }
        if (is_array($cats)) {
            $qs['cat'] = implode(',', $cats);
        } else {
            $qs['cat'] = $cats;
        }
        if ($category__in != '') {
            if (is_array($category__in)) {
                $qs['category__in'] = $category__in;
            } else {
                $qs['category__in'] = explode(',', $category__in);
            }
        }
        if ($category__not_in != '') {
            if (is_array($category__not_in)) {
                $qs['category__not_in'] = $category__not_in;
            } else {
                $qs['category__not_in'] = explode(',', $category__not_in);
            }
        }
        $qs['posts_per_page'] = $count;
        $qs['post_type'] = 'post';
        $qs['orderby'] = $orderby;
        $qs['dateformat'] = $dateformat;
        $qs['blog'] = true;
        $qs['post__not_in'] = $post__not_in;
        
        switch($orderby) {
            case "most_liked" :  // for most liked posts
                $qs['orderby'] = "meta_value_num";
                $qs['meta_key'] = "jaw_rating_value";
            break;
            case "most_visited" : // for most visited posts
                $qs['orderby'] = "meta_value_num";
                $qs['meta_key'] = "jaw_readers";
            break;
            default:
                $qs['orderby'] = $orderby; 
            break;
        }
        
        if ($author) {
            $qs['author'] = $author;
        }
        if ($posts) {
            $qs['post__in'] = explode(',', $posts);
        }

        $blog_query = new WP_Query($qs);

        if (isset($atts['box_title'])) {
            $blog_query->box_title = $atts['box_title'];
        } else {
            $blog_query->box_title = 'Blog';
        }
        if (isset($atts['ticker_preset_color'])) {
            $blog_query->ticker_preset_color = $atts['ticker_preset_color'];
        } else {
            $blog_query->ticker_preset_color = 'ticker_preset_color';
        }
        if (isset($atts['ticker_type'])) {
            $blog_query->ticker_type = $atts['ticker_type'];
        } else {
            $blog_query->ticker_type = 'default';
        }
        
        if (isset($atts['ticker_title'])) {
            $blog_query->ticker_title = $atts['ticker_title'];
        } else {
            $blog_query->ticker_title = 'default';
        }

        if (isset($atts['columns'])) {
            $blog_query->columns = $atts['columns'];
        } else {
            $blog_query->columns = 12;
        }

        if (isset($atts['letter_excerpt_title'])) {
            $blog_query->letter_excerpt_title = $atts['letter_excerpt_title'];
        } else {
            $blog_query->letter_excerpt_title = 60;
        }
        if (isset($atts['automatic_slide'])) {
            $blog_query->automatic_slide = $atts['automatic_slide'];
        } else {
            $blog_query->automatic_slide = '0';
        }
        if (isset($atts['ticker_direction'])) {
            $blog_query->ticker_direction = $atts['ticker_direction'];
        } else {
            $blog_query->ticker_direction = 'horizontal';
        }

        $blog_query->bar_type = jaw_template_get_var('bar_type', 'bar_type_1');

        $blog_query->pagination = $pagination;

        return $blog_query;
    }

}
