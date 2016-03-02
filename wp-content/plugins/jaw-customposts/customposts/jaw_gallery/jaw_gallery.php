<?php

/**
 * Post Slides
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
add_action('init', 'register_jaw_gallery');


add_action('add_meta_boxes', 'add_custom_meta_box_jaw_gallery');
add_action('save_post', 'save_custom_meta_jaw_gallery');

function register_jaw_gallery() {
    
    global $jaw_customposts_class;
    
    $data = $jaw_customposts_class->getData();
    $rewrite = 'jaw_gallery';
    
    if (isset($data['active']['jaw_gallery']['rewrite'])) {
        $rewrite = $data['active']['jaw_gallery']['rewrite'];
    }
    
    $labels = array(
        'name' => __('JaW Gallery', 'jaw_cp'),
        'singular_name' => __('Gallery item', 'jaw_cp'),
        'add_new' => __('Add New', 'jaw_cp'),
        'add_new_item' => __('Add New gallery Item', 'jaw_cp'),
        'edit_item' => __('Edit gallery Item', 'jaw_cp'),
        'new_item' => __('New gallery Item', 'jaw_cp'),
        'view_item' => __('View gallery Item', 'jaw_cp'),
        'search_items' => __('Search gallery Items', 'jaw_cp'),
        'not_found' => __('No gallery items found', 'jaw_cp'),
        'not_found_in_trash' => __('No gallery items found in Trash', 'jaw_cp'),
        'parent_item_colon' => __('Parent gallery:', 'jaw_cp'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => __('Custom Post Type - gallery Pages', 'jaw_cp'),
        'supports' => array('title'),
        'taxonomies' => array('jaw-gallery-category'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 15,
        'menu_icon' => plugins_url('images/gallery.png', __FILE__),
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => $rewrite),
        'capability_type' => 'post'
    );

    register_post_type('jaw-gallery', $args);
}

function add_custom_meta_box_jaw_gallery() {
    add_meta_box(
        'jaw_gallery_meta_box', // $id
        __('Gallery settings', 'jaw_cp'), // $title
        'show_custom_meta_box_jaw_gallery', // $callback
        'jaw-gallery', // $page
        'normal', // $context
        'high'); // $priority
}

// The Callback Meta Boxes
function show_custom_meta_box_jaw_gallery() {
    global $custom_meta_gallery, $post;
    
    // Use nonce for verification
    echo '<input type="hidden" name="custom_meta_box_nonce" value="' . wp_create_nonce(basename(__FILE__)) . '" />';

    // Begin the field table and loop
    echo '<table class="form-table" ng-controller="customPostAdminCtrl">';
    
    foreach ((array)$custom_meta_gallery as $field) {
        // get value of this field if it exists for this post
        $meta = get_post_meta($post->ID, $field['id'], false);
        if (isset($meta[0])) {
            $meta = $meta[0];
        } else if (isset($field['std'])) {
            $meta = $field['std'];
        } else {
            $meta = '';
        }

        // begin a table row with
        $class = '';
        if (isset($field['class'])) {
            $class = $field['class'];
        }
        echo '<tr class="' . $class . '">
		<th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th>
		<td>';

        $c = "element_" . $field['type'];
        
        echo jwPluginsElements::$c($field, $meta);

        echo '</td>';
        if (isset($field['desc'])) {
            echo '<td>';
            echo $field['desc'];
            //descrtprion
            echo '</td>';
        }
        echo '</tr>';
    } // end foreach
    
    echo '</table>'; // end table
}

// Save the Data - Metaboxes
function save_custom_meta_jaw_gallery($post_id) {
    global $custom_meta_gallery;
    // verify nonce
    // if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))

    if (!isset($_POST['custom_meta_box_nonce']) || !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
        return $post_id;
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // loop through fields and save the data
    foreach ((array)$custom_meta_gallery as $field) {
        if ($field['type'] == 'tax_select')
            continue;
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    } // enf foreach
}

