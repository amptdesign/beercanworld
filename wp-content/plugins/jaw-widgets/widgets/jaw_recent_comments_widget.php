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
class jaw_recent_comments_widget extends jaw_default_widget {

    /**
     *  Defining the widget options
     */
    protected $options = array(
        /*         * *************************************************************************** */
        /* COMMENTS AREA 
          /***************************************************************************** */
        0 => array('id' => 'comments_show',
            'description' => 'Show recent comments ',
            'type' => 'checkbox', // [[ text, check, select ]]
            'default' => 1),
        1 => array('id' => 'comments_title',
            'description' => 'recent comments title:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => 'Comments'),
        2 => array('id' => 'comments_num_of_posts',
            'description' => 'Number of recent comments to show:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => '5'),
        3 => array('id' => 'comments_excerpt_num',
            'description' => 'Comments excerpt:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => '100'),
    );

    /**
     * Registering the widget to the wordpress
     */
    function jaw_recent_comments_widget() {
        
        $options = array('classname' => 'recent_comments_widget', 'description' => "Theme styled recent comments to be displayed in a preview tabs");
        $controls = array('width' => 250, 'height' => 200);
        parent::__construct('recent_comments', 'J&W - Recent Comments Widget', $options, $controls);
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
        echo jaw_get_template_part('jaw_recent_comments_widget','widgets');
        
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
        $feedData->recent_comments = null;

        if (isset($instance['comments_show']) && $instance['comments_show'] == 1) {
            $recent_comments = $this->_get_recent_comments($instance);
            if (!empty($recent_comments)) {
                $feedData->recent_comments = $recent_comments;
                $feedData->number_of_sections++;
            }
        }

        return $feedData;
    }

    private function _get_recent_comments($instance) {
        $args = array('number' => $instance['comments_num_of_posts'], 'status' => 'approve');
        $comments = get_comments($args);
        return $comments;
    }
}
