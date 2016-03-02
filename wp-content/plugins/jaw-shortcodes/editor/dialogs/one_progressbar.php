<?php

$of_options = array();
/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");
$of_options[] = array(
    "name" => "Title",
    "desc" => "Value is in percent 0 - 100",
    "id" => "title",
    "std" => "",
    "type" => "text"
);
$of_options[] = array(
    "name" => "Value",
    "desc" => "Value is in percent 0 - 100",
    "id" => "value",
    "std" => "",
    "type" => "text"
);
$of_options[] = array(
    "name" => "Color",
    "desc" => "",
    "id" => "color",
    "std" => "#EFEFEF",
    "type" => "color"
);
$of_options[] = array(
    "type" => "sectionend");
global $jaw_sc_builder_options;
$jaw_sc_builder_options['one_progressbar'] = $of_options;
