<?php

global $jaw_builder_options;

$of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'cats',
    'type' => 'multidropdown',
    'name' => 'Include Category',
    'desc' => 'Choose the categories you want to use in the carousel.',
    "page" => null,
    "chosen" => "true",
    "target" => 'cat',
    "prompt" => "Choose category..",
    
);
$of_options[] = array(
    'id' => 'tag__in',
    'type' => 'multidropdown',
    'name' => 'Include Blog Tags',
    'desc' => '',
    "page" => null,
    "chosen" => "true",
    "target" => 'tag',
    "prompt" => "Choose tag..",
    
);
$of_options[] = array(
    'id' => 'author__in',
    'type' => 'multidropdown',
    'name' => 'Include Authors',
    'desc' => '',
    "page" => null,
    "chosen" => "true",
    "target" => 'author',
    "prompt" => "Choose Authors..",
    
);
$of_options[] = array(
    'id' => 'post__in',
    'type' => 'text',
    'name' => 'Include Posts by IDs',
    'desc' => 'The specific posts you want to display by IDs (in format 52, 45, 87)',
    "std" => '',
);
$of_options[] = array(
    'id' => 'order',
    'type' => 'select',
    'name' => 'Post Order',
    'desc' => 'Posts order (ascending or descending).',
    'std' => 'desc',
    'mod' => 'small',
    
    'options' => array("desc" => "Desc", "asc" => "Asc")
);

$of_options[] = $jaw_builder_options['global_orderby'];

$of_options[] = array(
    'id' => 'count',
    'type' => 'text',
    'name' => 'Number of Posts',
    'desc' => 'Set number of posts in whole slider.',
    'std' => '10',
);

$of_options[] = array(
    'id' => 'columns',
    'type' => 'select',
    'name' => 'Number of shown posts (columns)',
    'desc' => 'How much posts will be shown withour sliding.',
    'std' => '3',
    
    "options" => array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5")
);
$of_options[] = array(
    'id' => 'sticky_posts',
    'type' => 'toggle',
    'name' => 'Prefer Sticky Posts',
    'desc' => 'Choose how to use your sticky posts.',
    'std' => '0',
    
);

$of_options[] = array(
    "type" => "sectionend");

/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");
    


$of_options[] = array(
    'id' => 'clickable_image',
    'type' => 'toggle',
    'name' => 'Clickable Image',
    'desc' => 'Add permalink to post on image.',
    'std' => '1',
    
);

$of_options[] = array(
    'id' => 'slider_arrows',
    'type' => 'toggle',
    'name' => 'Show Slider Arrows',
    'desc' => 'Show / Hide slider arrows.',
    'std' => '1',
    
);

$of_options[] = array(
    'id' => 'automatic_slide',
    'type' => 'toggle',
    'name' => 'Automatic Sliding',
    'desc' => 'Decide whether or not to allow moving a content of your carousel automatically.',
    'std' => 'true',
    
    'options' => array('false' => 'Off', 'true' =>'On')
);

$of_options[] = array("name" => "Interval between slides",
    "desc" => "in ms",
    "id" => "slider_interval",
    "std" => 5000,
    "type" => "text"
);


$of_options[] = array("name" => "Number of Characters - Excerpt in Main Post",
    "desc" => "Enter a number of characters in the preview content.",
    "id" => "letter_excerpt",
    "std" => 150,
    "mod" => 'micro',
    'maxlength' => 4,
    "type" => "text"
);

$of_options[] = array("name" => "Number of Characters - Post Titles",
    "desc" => "Enter a number of characters for your post titles.",
    "id" => "letter_excerpt_title",
    "std" => 60,
    "mod" => 'micro',
    'maxlength' => 4,
    "type" => "text"
);

$of_options[] = $jaw_builder_options['show_on_devices'];

$of_options[] = array(
    'id' => 'class',
    'type' => 'text',
    "hide_if_layout" => array('shortcodes'),
    'name' => '<i class="jaw-icon-code"></i> Custom Class',
    'desc' => 'Insert your custom class for this element.',
    'std' => ''
);

$of_options[] = array(
    "type" => "sectionend");

/* ==== Styling ==== */
$of_options[] = array(
    "name" => "Styling",
    "type" => "sectionstart");


$of_options[] = array(
    'id' => 'slider_preset_color',
    'name' => '<i class="jaw-icon-palette jaw-preset-icon"></i> Color preset',
    'desc' => '',
    'type' => 'select_preset',
    "target" => "color"
);

$of_options[] = array(
    "type" => "sectionend"
);

/* ==== BAR ==== */
$of_options[] = array(
    "name" => "Bar",
    "hide_if_layout" => array('shortcodes'),
    "type" => "sectionstart"
);

// Typ baru se prejima z globalni promenne definovane v metabox-builder.php
$of_options[] = $jaw_builder_options['global_bar_type']; 
$of_options[] = $jaw_builder_options['global_custom_link'];

$of_options[] = array(
    "hide_if_layout" => array('shortcodes'),
    "type" => "sectionend");

/* Settings */
$jaw_builder_options['slider_5'] = $of_options;
