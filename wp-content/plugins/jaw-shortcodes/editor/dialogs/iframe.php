<?php

$of_options = array();
/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");
$of_options[] = array(
    "name" => "Source",
    "desc" => "Enter a source URL for your iframe.",
    "id" => "src",
    "std" => "http://",
    "type" => "text"
);
$of_options[] = array(
    "type" => "sectionend");
/* ==== DESIGN ==== */
$of_options[] = array(
    "name" => "Design",
    "type" => "sectionstart");
$of_options[] = array(
    'id' => 'height',
    'type' => ' text',
    'name' => 'Height',
    'desc' => 'Set height of your iframe.',
    'std' => '600',
    'value' => "10",
    'min' => '0',
    'max' => '960',
    'step' => '1',
    'unit' => 'px'
);
$of_options[] = array(
    "type" => "sectionend");
global $jaw_sc_builder_options;
$jaw_sc_builder_options['iframe'] = $of_options;
