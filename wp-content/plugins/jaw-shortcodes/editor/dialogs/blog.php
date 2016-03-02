<?php

global $jaw_builder_options;

$of_options = array();

/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");

$of_options[] = array(
    'id' => 'category__in',
    'type' => 'multidropdown',
    'name' => 'Include Blog Category',
    'desc' => '(Doesn`t include child categories)',
    "page" => null,
    "chosen" => "true",
    "target" => 'cat',
    "prompt" => "Choose category..",
    
);
$of_options[] = array(
    'id' => 'category__not_in',
    'type' => 'multidropdown',
    'name' => 'Exclude Blog Category',
    'desc' => '(Doesn`t include child categories)',
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
    'id' => 'tag__not_in',
    'type' => 'multidropdown',
    'name' => 'Exclude Blog Tags',
    'desc' => '',
    "page" => null,
    "chosen" => "true",
    "target" => 'tag',
    "prompt" => "Choose tag..",
    
);

$of_options[] = array(
    'id' => 'count',
    'type' => 'text',
    'name' => 'Number of Posts',
    'desc' => 'Set number of posts per page.',
    'std' => '6',
);


$of_options[] = array(
    'id' => 'offset',
    'type' => 'text',
    'name' => 'Offset Posts',
    'desc' => 'Start print post form X post.',
    'std' => '0',
);

$of_options[] = array(
    'id' => 'pagination',
    'type' => 'select',
    'name' => 'Pagination Style',
    'desc' => 'Choose the pagination style you prefer.',
    'std' => 'number',
    'mod' => 'medium',
    
    'options' => array("infinite" => "infinite", "infinitemore" => "infinite with more", "none" => "none", "number" => "number", "wordpress" => "wordpress"),
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
    "type" => "sectionend");
/* ==== META ==== */
$of_options[] = array(
    "name" => "Meta",
    "type" => "sectionstart");
$options[] = array(
    'id' => 'blog_category_inimage',
    'type' => 'toggle',
    'name' => 'Category label in image',
    'desc' => '',
    'std' => '1'
);

$of_options[] = array(
    'id' => 'blog_metadate',
    'type' => 'toggle',
    'name' => '<i class="jaw-icon-clock"></i> Meta Date',
    
    'desc' => 'Choose whether or not to show date in a post preview.',
    'std' => '1'
);

$of_options[] = array(
    'id' => 'blog_meta_author',
    'type' => 'toggle',
    'name' => '<i class="jaw-icon-user"></i> Meta author',
    'desc' => 'Choose whether or not to show author in the post preview.',
    'std' => '0'
);

$of_options[] = array(
    'id' => 'blog_comments_count',
    'type' => 'toggle',
    'name' => '<i class="jaw-icon-bubble"></i> Meta Number of Comments',
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
    'name' => '<i class="jaw-icon-heart-on"></i> Meta Likes',
    'desc' => 'Choose whether or not to show likes in the post preview.',
    'std' => '0'
);

$of_options[] = array(
    'id' => 'blog_ratings',
    'type' => 'toggle',
    'name' => '<i class="jaw-icon-star3"></i> Ratings',
    
    'desc' => 'Choose whether or not to show ratings in a post preview.',
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
    
    'name' => 'Categories Label in Image',
    'desc' => '',
    'std' => '1',
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
    'class' => 'fullwidth-option',
    'options' => array("default" => "Small", "middle" => "middle", "mix" => "Mix")
);



$of_options[] = array("name" => "Number of Characters - Post Titles",
    "desc" => "Enter a number of characters for your post titles.",
    "id" => "letter_excerpt_title",
    "std" => 60,
    "mod" => 'micro',
    'maxlength' => 4,
    "type" => "text"
);

$of_options[] = array("name" => "Number of Characters - Excerpt in Main Post",
    "desc" => "Enter a number of characters in a preview content.",
    "id" => "letter_excerpt",
    "std" => 275,
    "mod" => 'micro',
    'maxlength' => 4,
    "type" => "text"
);




$of_options[] = array(
    'id' => 'clickable_image',
    'type' => 'toggle',
    
    'name' => 'Hyperlink Post Images',
    'desc' => 'Decide whether post images have to be hyperlinked.',
    'std' => '2',
    'options' => array('0' => 'Off', '1' => 'Hyperlink', '2' => 'PrettyPhoto')
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


/* ==== IMAGE ==== */
$of_options[] = array(
    "name" => "Top Image",
    "type" => "sectionstart");

$of_options[] = array(
    "name" => "Image",
    "desc" => "Choose the image you need or remove it clicking the Remove button. ",
    "id" => "blog_top_image",
    "type" => "simple_media_picker",
    'std' => '',
    'mod' => 'image',
    'multiple' => false
);

$of_options[] = array(
    "name" => "Image link",
    "desc" => "Enter a link",
    "id" => "blog_top_image_link",
    "std" => "",
    "mod" => '',
    "type" => "text"
);
$of_options[] = array(
    "type" => "sectionend");



/* ==== BAR ==== */
$of_options[] = array(
    "name" => "Bar",
    "hide_if_layout" => array('shortcodes'),
    "type" => "sectionstart");


$of_options[] = array(
    'id' => 'bar_show_categories',
    'type' => 'toggle',
    "hide_if_layout" => array('shortcodes'),
    'name' => 'Show List of Categories',
    'desc' => 'Works only with Include Category!',
    'std' => '0',
    "class" => "jw-el-hidden  jw-el-show-bar_type-bar_type_1 jw-el-show-bar_type-bar_type_2 jw-el-show-bar_type-bar_type_3",
    
    "options" => array(
        "0" => "Off",
        "1" => "On"
    )
);

// Typ baru se prejima z globalni promenne definovane v metabox-builder.php

$of_options[] = $jaw_builder_options['global_bar_type']; 
$of_options[] = $jaw_builder_options['global_custom_link'];


$of_options[] = array(
    "hide_if_layout" => array('shortcodes'),
    "type" => "sectionend");


/* Settings */
$jaw_builder_options['blog'] = $of_options;
