<?php

/**
 * Prints 4 types of feed:
 * Popular ( posts )
 * Recent ( posts )
 * Comments ( comment )
 * Tags ( in post table )
 * 
 * 
 * informace jsou ve funkci widget, doporucuju kazdou promenou vardumpnout
 */
class jaw_popular_posts_widget extends jaw_default_widget {

    /**
     *  Defining the widget options
     */
    protected $options = array(
        /*         * *************************************************************************** */
        /* POPULAR AREA
          /***************************************************************************** */
        0 => array('id' => 'popular_show',
            'description' => 'Show popular posts ',
            'type' => 'checkbox', // [[ text, check, select ]]
            'default' => 1),
        1 => array('id' => 'popular_title',
            'description' => 'Popular posts title:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => 'Popular'),
        2 => array('id' => 'popular_categories',
            'description' => 'Exclude / include categories by id. E.g. 1,5,-8:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => ''),
        3 => array('id' => 'popular_num_of_posts',
            'description' => 'Number of popular posts to show:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => '5'),
    );

    /**
     * Registering the widget to the wordpress
     */
    function jaw_popular_posts_widget() {
        
        $options = array('classname' => 'popular_posts_widget', 'description' => "Theme styled recent and popular posts, comments and tags to be displayed in a preview tabs");
        $controls = array('width' => 250, 'height' => 200);
        parent::__construct('popular_posts', 'J&W - Popular Posts Widget', $options, $controls);
    }

    /*     * *************************************************************************** */
    /*     * *************************************************************************** */
    /*     * *************************************************************************** */
    /* EDIT THIS FUNCTION
      /***************************************************************************** */
    /*     * *************************************************************************** */
    /*     * *************************************************************************** */

    private function _print_widget($args, $instance, $feedData) {
        global $post;
        /*
         * data naleznes ve stdClass feedData.
         * Ma nasledujici attributy:
         * - popular_posts			// klasicky post
         * - recent_posts			// klasicky post
         * - recent_comments		// class comment
         * - tags					// class tag
         * 
         * !! V pripade ze tisknes post, je moznost ze se neaplikuji vsechny 
         * filtry ( napr na post content nebo excerpt). Pokud by to blblo, tak :
         * 
         * foreach( $feedData->popular_posts as $post ) {
         * 	setup_postdata( $post );
         * 	the_title(), the_content() || get_the_title(), get_the_content;
         * }
         * 
         * jinak presny struktury jednotlivych trid neznam, resil bych to stejne
         * jak ty var_dump, tak v tom neporadim :(
         * 
         * pokud nejsou zadna data, tak je promenna nastavena na null
         */
        
        $ret['args'] = $args;
        $ret['instance'] = $instance;
        $ret['feedData'] = $feedData;
        
        jaw_template_set_data($ret,$this);
        echo jaw_get_template_part('jaw_popular_posts_widget','widgets');
        
    }

    /**
     * Printing widget, called by wordpress
     */
    function widget($args, $instance) {
        $feedData = $this->_collect_data($instance);
        $this->_print_widget($args, $instance, $feedData);
    }

    /*     * *************************************************************************** */
    /* COLLECTING DATA
      /***************************************************************************** */

    private function _collect_data($instance) {
        $feedData = new stdClass();
        $feedData->number_of_sections = 0;
        $feedData->popular_posts = null;


        if (isset($instance['popular_show']) && $instance['popular_show'] == 1) {
            $popular_posts = $this->_get_popular_posts($instance);
            if (!empty($popular_posts)) {
                $feedData->popular_posts = $popular_posts;
                $feedData->number_of_sections++;
            }
        }


        return $feedData;
    }

    private function _get_popular_posts($instance) {
        $args = array('orderby' => 'comment_count', 'order' => 'desc', 'numberposts' => $instance['popular_num_of_posts']);
        if (!empty($instance['popular_categories']))
            $args['category'] = $instance['popular_categories'];
        $posts = get_posts($args);
        return $posts;
    }
}
