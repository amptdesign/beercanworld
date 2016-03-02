<?php

$of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart"
);

$entries = get_posts('post_type=jaw-gallery&orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
$options = array();
foreach ($entries as $key => $entry) {
    $options[$entry->ID] = $entry->post_title;
}
$of_options[] = array(
    'id' => 'gallery',
    'type' => 'select',
    'name' => 'Select  gallery',
    'desc' => 'Specify media gallery.',
    'std' => '',
    'mod' => 'big',
    "builder" => 'true',
    "options" => $options
);

$of_options[] = array(
    "type" => "sectionend"
);

global $jaw_sc_builder_options;
$jaw_sc_builder_options['media_gallery'] = $of_options;
