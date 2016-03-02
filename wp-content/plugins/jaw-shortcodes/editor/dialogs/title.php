<?php

$of_options = array();
/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");
$of_options[] = array(
    "name" => "Title Text",
    "desc" => "",
    "id" => "title_text",
    "std" => "",
    "type" => "text"
);
$of_options[] = array(
    "type" => "sectionend");
/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");
$of_options[] = array(
    'id' => 'type',
    'type' => 'select',
    'name' => 'Title Type',
    'desc' => 'Select the title type you prefer.',
    'std' => 'big',
    "builder" => 'true',
    "options" => array("like_divider" => "Divider", "line" => "Line", "box" => "Box", "big" => "Big title")
);
$of_options[] = array(
    "name" => "Text Color",
    "desc" => "Pick a color of your title (by default: #000000).",
    "id" => "text_color",
    "std" => "#000000",
    "type" => "color"
);
$of_options[] = array(
    "name" => "Line Color",
    "desc" => "Pick a color of the line below your title (by default: #000000).",
    "id" => "line_color",
    "std" => "#000000",
    "type" => "color"
);
$of_options[] = array(
    "type" => "sectionend");
global $jaw_sc_builder_options;
$jaw_sc_builder_options['title'] = $of_options;
