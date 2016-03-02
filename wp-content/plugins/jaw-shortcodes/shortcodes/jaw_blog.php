<?php

class jaw_blog {

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

    public function jaw_blog_shortcode($atts, $content = null, $code = null) {
        $cache_id = 'blog_'.jaw_cache_get_id().'_'.jaw_template_inc_counter('cache_tmpl');
        if(!jaw_has_template_cache($this->_tmpl, '','',$cache_id,'fast')){
            jaw_template_set_data($this->model($atts));
        }
        return jaw_get_template_cache($this->_tmpl, '','',$cache_id,'fast',true);
        //  jaw_template_set_data($this->model($atts));
        //  return jaw_get_template_part($this->_tmpl);
    }

    


    private function model($atts) {
        wp_reset_query();
        extract(shortcode_atts(array(
            'count' => 6,
            'cats' => '',
            'category__in' => array(),
            'category__not_in' => array(),
            'tag__in' => array(),
            'tag__not_in' => array(),
            'author' => '',
            'posts' => '',
            'paged' => 1,
            'order' => '',
            'orderby' => '',
            'dateformat' => '',
            'pagination' => 'none',
            'excerpt' => '15',
            'metaauthor' => '',
            'offset' => '',
            'metacategory' => '',
            'metadate' => '',
            'metacomments' => '',
            'metacaption' => '',
            'ratings' => '',
            'author__in' => array(),
            'sticky_posts' => '0',
            'slider' => false,
            'slider_source' => '',
            'slider_max' => 3,
            'image_clickable' => '0',
            'image_lightbox' => '1',
            'post__not_in' => '',
            'post__in' => ''
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
        if ($tag__in != '') {
            if (is_array($tag__in)) {
                $qs['tag__in'] = $tag__in;
            } else {
                $qs['tag__in'] = explode(',', $tag__in);
            }
        }
        if ($tag__not_in != '') {
            if (is_array($tag__not_in)) {
                $qs['tag__not_in'] = $tag__not_in;
            } else {
                $qs['tag__not_in'] = explode(',', $tag__not_in);
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
        $qs['posts_per_page'] = $count;
        $qs['offset'] = $offset;

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

        if (isset($atts['columns'])) {
            $blog_query->columns = $atts['columns'];
        } else {
            $blog_query->columns = 12;
        }

        $image_size = 'large';

        if (isset($atts['blog_top_image'])) {
            if ((is_array($atts['blog_top_image']) && isset($atts['blog_top_image'][0])) || is_numeric($atts['blog_top_image'])) {
                $atts['blog_top_image'][0] = json_decode(json_encode($atts['blog_top_image'][0]));
                if (isset($atts['blog_top_image'][0]->id)) {
                    $blog_query->top_image_id = $atts['blog_top_image'][0]->id;
                } else {
                    $blog_query->top_image_id = $atts['blog_top_image'];
                }
                $blog_query->url = "";
            } else {
                $blog_query->url = $atts['blog_top_image'];
            }
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

        if (class_exists('jwOpt')) {
            $blog_query->element_blog_dateformat = jwOpt::get_option('blog_dateformat', 'M j, Y');
        } else {
            $blog_query->element_blog_dateformat = 'M j, Y';
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
        if (isset($atts['std_post_image_clickable'])) {
            $blog_query->std_post_image_clickable = $atts['std_post_image_clickable'];
        } else {
            $blog_query->std_post_image_clickable = '2';
        }        
        if (isset($atts['std_post_thumbnail_clickable'])) {
            $blog_query->std_post_thumbnail_clickable = $atts['std_post_thumbnail_clickable'];
        } else {
            $blog_query->std_post_thumbnail_clickable = '2';
        }        
        if (isset($atts['clickable_image'])) {
            $blog_query->clickable_image = $atts['clickable_image'];
        } else {
            $blog_query->clickable_image = '0';
        }
        
        if (isset($atts['bar_show_categories'])) {
            $blog_query->bar_show_categories = $atts['bar_show_categories'];
        } else {
            $blog_query->bar_show_categories = '0';
        }

        if (isset($atts['box_size'])) {
            $blog_query->box_size = $atts['box_size'];
        } else {
            $blog_query->box_size = 'max';
        }


        $blog_query->bar_type = jaw_template_get_var('bar_type', 'bar_type_1');

        $blog_query->pagination = $pagination;
        $blog_query->blog_pagination = $pagination;

        return $blog_query;
    }

}
