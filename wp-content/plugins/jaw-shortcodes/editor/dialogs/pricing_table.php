<?php

$of_options = array();
/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");
$of_options[] = array(
    "name" => "Data",
    "desc" => "",
    "id" => "pricing_table",
    "std" => "",
    "type" => "pricing_table"
);
$of_options[] = array(
    "type" => "sectionend");
/* ==== BAR ==== */
$of_options[] = array(
    "name" => "Bar",
    "type" => "sectionstart");
$of_options[] = array(
    'id' => 'bar_type',
    'type' => 'select',
    'name' => 'Bar type',
    'desc' => '',
    'std' => 'big',
    "builder" => 'true',
    "options" => array("off" => "Off", "space" => "Off without space", "line" => "Line", "box" => "Box", "big" => "Big title")
);
$of_options[] = array(
    "type" => "sectionend");
global $jaw_sc_builder_options;
$jaw_sc_builder_options['pricing_table'] = $of_options;
