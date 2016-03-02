<?php

$of_options = array();
/* ==== CONTENT ==== */
$of_options[] = array(
    "name" => "Content",
    "type" => "sectionstart");
$of_options[] = array(
    "name" => "Content of QR Code",
    "desc" => "Fill in the field with the content to be displayed in a QR reader when the code is being readed.",
    "id" => "qrcode",
    "std" => "",
    "type" => "textarea"
);
$of_options[] = array(
    "type" => "sectionend");
global $jaw_sc_builder_options;
$jaw_sc_builder_options['qrcode'] = $of_options;
