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
    'name' => 'Include Posts (optional)',
    'desc' => 'The specific posts you want to display (in format 52, 45, 87)',
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

$of_options[] = array(
    'id' => 'count',
    'type' => 'text',
    'name' => 'Number of Posts (in whole slider)',
    'desc' => 'Set number of posts in whole slider.',
    'std' => '10',
);

$of_options[] = array(
    'id' => 'post_in_slide',
    'type' => 'text',
    'name' => 'Number of Posts (in One Slide)',
    'desc' => 'Set number of posts to be shown in one slide.',
    'std' => '3'    
);

$of_options[] = array(
    'id' => 'sticky_posts',
    'type' => 'toggle',
    'name' => 'Prefer Sticky Posts',
    'desc' => 'Choose how to use your sticky posts.',
    'std' => '0',
    
);
$of_options[] = array(
    'id' => 'post_in_slide',
    'type' => 'range',
    'name' => 'Number of Posts in One Slide',
    'desc' => 'Set number of posts to be shown in one slide.',
    'std' => '3',
    'min' => '1',
    'max' => '10',
    'step' => '1',
    'unit' => ''
);

$of_options[] = array(
    "type" => "sectionend");
/* ==== META ==== */
$of_options[] = array(
    "name" => "Meta",
    "type" => "sectionstart");


$of_options[] = array(
    'id' => 'blog_metadate',
    'type' => 'toggle',
    'name' => 'Meta Date',
    
    'desc' => 'Choose whether or not to show date in a post preview.',
    'std' => '1'
);

$of_options[] = array(
    'id' => 'blog_ratings',
    'type' => 'toggle',
    'name' => 'Ratings',
    
    'desc' => 'Choose whether or not to show ratings in a post preview.',
    'std' => '0'
);


$of_options[] = array(
    'id' => 'blog_meta_author',
    'type' => 'toggle',
    'name' => 'Meta author',
    'desc' => 'Choose whether or not to show author in the post preview.',
    'std' => '0'
);

$of_options[] = array(
    'id' => 'blog_comments_count',
    'type' => 'toggle',
    'name' => 'Meta commets count',
    'desc' => 'Choose whether or not to show commets count in the post preview.',
    'std' => '1'
);

$of_options[] = array(
    'id' => 'blog_meta_category',
    'type' => 'toggle',
    'name' => 'Meta category',
    'desc' => 'Choose whether or not to show category in the post preview.',
    'std' => '0'
);
$of_options[] = array(
    'id' => 'blog_meta_like',
    'type' => 'toggle',
    'name' => 'Meta Likes',
    'desc' => 'Choose whether or not to show likes in the post preview.',
    'std' => '0'
);
$of_options[] = array(
    'id' => 'blog_readers',
    'type' => 'toggle',
    'name' => '<i class="jaw-icon-eye"></i> Readers Count',
    'desc' => '',
    'std' => '0'
);
$of_options[] = array(
    'id' => 'blog_featured_post',
    'type' => 'toggle',
    'name' => '<i class="jaw-icon-star3"></i> Show info about Sticky post',
    'desc' => 'If the post is Sticky, in meta will be shown "Featured post"',
    'std' => '1',
);


$of_options[] = array(
    'id' => 'blog_category_inimage',
    'type' => 'toggle',
    'name' => 'Category label in image',
    'desc' => '',
    'std' => '1'
);

$of_options[] = array(
    'id' => 'blog_comments_inimage',
    'type' => 'toggle',
    
    'name' => 'Comments Counter in Image',
    'desc' => '',
    'std' => '1',
);

$of_options[] = array(
    "type" => "sectionend");

/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'automatic_slide',
    'type' => 'toggle',
    'name' => 'Automatic Sliding',
    'desc' => 'Decide whether or not to allow moving a content of your carousel automatically.',
    'std' => '0',
    
    "options" => array("1" => "On", "0" => "Off")
);

$of_options[] = array(
    'id' => 'columns',
    'type' => 'select',
    'name' => 'Columns count',
    'desc' => 'Columns count',
    'std' => '12',
    'mod' => 'medium',
    
    'options' => array(
        "12" => "1",
        "6" => "2",
        "4" => "3",
        "3" => "4",
        "2" => "6"
    )
);


$of_options[] = array(
    'id' => 'type',
    'type' => 'layout',
    'name' => 'Blog Type',
    'desc' => 'Select the blog type you prefer.',
    'std' => 'classical',
    'options' => array("default" => "Small", "middle" => "Middle")
);
$of_options[] = array(
    'id' => 'clickable_image',
    'type' => 'toggle',
    
    'name' => 'Hyperlink Post Images',
    'desc' => 'Decide whether post images have to be hyperlinked.',
    'std' => '2',
    'options' => array('0' => 'Off', '1' => 'Hyperlink', '2' => 'PrettyPhoto')
);


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


/* ==== TEXT SETTING ==== */
$of_options[] = array(
    "name" => "Format",
    "type" => "sectionstart");

$of_options[] = array("name" => "Number of Characters - Excerpt in Main Post",
    "desc" => "Enter a number of characters in the preview content.",
    "id" => "letter_excerpt",
    "std" => 300,
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



$of_options[] = array(
    "type" => "sectionend");

/* ==== BAR ==== */
$of_options[] = array(
    "name" => "Bar",
    "hide_if_layout" => array('shortcodes'),
    "type" => "sectionstart"
);

$of_options[] = array(
    "hide_if_layout" => array('shortcodes'),
    "type" => "sectionend");

/* Settings */
$jaw_builder_options['blog_carousel_vertical'] = $of_options;
