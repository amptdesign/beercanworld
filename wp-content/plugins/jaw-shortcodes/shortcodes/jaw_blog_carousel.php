<?php

class jaw_blog_carousel {

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

    public function jaw_blog_carousel_shortcode($atts, $content = null, $code = null) {
        $cache_id = 'blog_car_'.jaw_cache_get_id().'_'.jaw_template_inc_counter('cache_tmpl');
        if(!jaw_has_template_cache($this->_tmpl, 'simple-shortcodes','',$cache_id,'fast')){
            jaw_template_set_data($this->model($atts));
        }
        return jaw_get_template_cache($this->_tmpl, 'simple-shortcodes','',$cache_id,'fast');
        // jaw_template_set_data($this->model($atts));
        // return jaw_get_template_part($this->_tmpl, 'simple-shortcodes');
    }

    private function model($atts) {

        extract(shortcode_atts(array(
            'count' => 6,
            'cats' => array(),
            'author' => '',
            'posts' => '',
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
            'tag__in' => array(),
            'post__in' => '',
            'author__in' => array(),
            'sticky_posts' => '0',
            'slider' => false,
            'slider_source' => '',
            'slider_max' => 3,
            'image_lightbox' => '1',
            'post__not_in' => '',
            'category__in' => array()
                        ), $atts));

        $qs = array();
        $qs['paged'] = 1;
        
        
        if (is_array($cats)) {
            $qs['cat'] = implode(',', $cats);
        } else {
            $qs['cat'] = $cats;
        }

        $qs['posts_per_page'] = $count;
        $qs['post_type'] = 'post';

        $qs['order'] = $order;
        $qs['orderby'] = $orderby;
        $qs['dateformat'] = $dateformat;
        $qs['pagination'] = $pagination;
        $qs['excerpt'] = $excerpt;
        $qs['blog'] = true;
        $qs['slider'] = $slider;
        $qs['slider_source'] = $slider_source;
        $qs['slider_max'] = $slider_max;
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
        
        if ($category__in != '') {
            if (is_array($category__in)) {
                $qs['category__in'] = $category__in;
            } else {
                $qs['category__in'] = explode(',', $category__in);
            }
        }
        if ($author) {
            $qs['author'] = $author;
        }
        if ($post__in != '') {
            if (is_array($post__in)) {
                $qs['post__in'] = $post__in;
            } else {
                $qs['post__in'] = explode(',', $post__in);
            }
        }
        if ($tag__in != '') {
            if (is_array($tag__in)) {
                $qs['tag__in'] = $tag__in;
            } else {
                $qs['tag__in'] = explode(',', $tag__in);
            }
        }
        if (isset($author__in[0]) && $author__in[0] != 0) {
            $qs['author__in'] = $author__in;
        }
        switch ($sticky_posts) {
            case '0': $qs['ignore_sticky_posts'] = 1;
                break;
            case '1': $qs['post__in'] = get_option('sticky_posts');
                break;
        }


        $blog_query = new WP_Query($qs);
        if (isset($atts['box_title'])) {
            $blog_query->box_title = $atts['box_title'];
        } else {
            $blog_query->box_title = 'Blog';
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
        
        if (isset($atts['columns'])) {
            $blog_query->columns = $atts['columns'];
        } else {
            $blog_query->columns = 12;
        }

        if (isset($atts['post_in_slide'])) {
            $blog_query->post_in_slide = $atts['post_in_slide'];
        } else {
            $blog_query->post_in_slide = '3';
        }
        
        if (isset($atts['blog_metadate'])) {
            $blog_query->blog_metadate = $atts['blog_metadate'];
        } else {
            $blog_query->blog_metadate = '1';
        }
        
        if (isset($atts['blog_ratings'])) {
            $blog_query->blog_ratings = $atts['blog_ratings'];
        } else {
            $blog_query->blog_ratings = '1';
        }
        if (isset($atts['blog_readers'])) {
            $blog_query->blog_readers = $atts['blog_readers'];
        } else {
            $blog_query->blog_readers = '1';
        }
        if (isset($atts['blog_featured_post'])) {
            $blog_query->blog_featured_post = $atts['blog_featured_post'];
        } else {
            $blog_query->blog_featured_post = '1';
        }
        if (isset($atts['image_clickable'])) {
            $blog_query->image_clickable = $atts['image_clickable'];
        } else {
            $blog_query->image_clickable = '1';
        }
        if (isset($atts['clickable_image'])) {
            $blog_query->clickable_image = $atts['clickable_image'];
        } else {
            $blog_query->clickable_image = '1';
        }
        if (isset($atts['blog_meta_type_icon'])) {
            $blog_query->blog_meta_type_icon = $atts['blog_meta_type_icon'];
        } else {
            $blog_query->blog_meta_type_icon = '1';
        }
        
        if (isset($atts['blog_meta_author'])) {
            $blog_query->blog_meta_author = $atts['blog_meta_author'];
        } else {
            $blog_query->blog_meta_author = '1';
        }
        
        if (isset($atts['blog_comments_count'])) {
            $blog_query->blog_comments_count = $atts['blog_comments_count'];
        } else {
            $blog_query->blog_comments_count = '1';
        }
        
        if (isset($atts['blog_meta_category'])) {
            $blog_query->blog_meta_category = $atts['blog_meta_category'];
        } else {
            $blog_query->blog_meta_category = '1';
        }
        if (isset($atts['blog_meta_like'])) {
            $blog_query->blog_meta_like = $atts['blog_meta_like'];
        } else {
            $blog_query->blog_meta_like = '1';
        }
        if (isset($atts['blog_category_inimage'])) {
            $blog_query->blog_category_inimage = $atts['blog_category_inimage'];
        } else {
            $blog_query->blog_category_inimage = '1';
        }
        if (isset($atts['blog_comments_inimage'])) {
            $blog_query->blog_comments_inimage = $atts['blog_comments_inimage'];
        } else {
            $blog_query->blog_comments_inimage = '1';
        }  
        if (isset($atts['automatic_slide'])) {
            $blog_query->automatic_slide = $atts['automatic_slide'];
        } else {
            $blog_query->automatic_slide = '0';
        }
        if (isset($atts['letter_excerpt'])) {
            $blog_query->letter_excerpt = $atts['letter_excerpt'];
        } else {
            $blog_query->letter_excerpt = 300;
        }
        if (isset($atts['letter_excerpt_title'])) {
            $blog_query->letter_excerpt_title = $atts['letter_excerpt_title'];
        } else {
            $blog_query->letter_excerpt_title = 60;
        }
        if (isset($atts['carousel_style'])) {
            $blog_query->carousel_style = $atts['carousel_style'];
        } else {
            $blog_query->carousel_style = 'bar';
        }

        return $blog_query;
    }

}
