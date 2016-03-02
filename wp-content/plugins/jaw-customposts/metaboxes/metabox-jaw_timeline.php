<?php
global $custom_meta_timeline;


$custom_meta_timeline[] = array(
    'id' => 'timeline_type',
    'type' => 'select',
    'label' => 'Timeline Type',
    'desc' => 'Choose your timeline post type.',
    'std' => 'image',
    'mod' => 'medium',
    "options" => array("image" => "Image", "gallery" => "Gallery", "video" => "Video", "link" => "Link", 'map' => 'Map')
);

//Image
$custom_meta_timeline[] = array("label" => "Timeline Image",
    "desc" => "Upload your image.",
    "id" => "_timeline_image",
    "std" => "",
    "type" => "simplemediapicker");

//Gallery
$custom_meta_timeline[] = array("label" => "Gallery",
    "desc" => "",
    "id" => "_timeline_gallery",
    "type" => "media_picker",
);

//Video
$custom_meta_timeline[] = array("label" => "Video src",
    "desc" => "URL video (youtube, vimeo). Create a thumbnail using Featured Image.",
    "id" => "_timeline_video_link",
    "std" => "",
    "type" => "text");

// Doc, Link
$custom_meta_timeline[] = array("label" => "URL Link",
    "desc" => "Insert the link on which you want to redirect a user after clicking.",
    "id" => "_timeline_link",
    "std" => "",
    "type" => "text");

$custom_meta_timeline[] = array("label" => "Link Target",
    "desc" => "Define a link target.",
    "id" => "_timeline_link_target",
    "std" => "_blank",
    "type" => "select",
    "options" => array("_blank" => "_blank", "_top" => "_top", "_parent" => "_parent", "_self" => "_self"));


// maps
$custom_meta_timeline[] = array("label" => "Longitude",
    "desc" => "Enter a longitude value in decimal number (if the Address field above is empty).",
    "id" => "_timeline_longitude",
    "std" => "",
    "type" => "text");

$custom_meta_timeline[] = array("label" => "Latitude",
    "desc" => "Enter a latitude value in decimal number (if the Address field above is empty).",
    "id" => "_timeline_latitude",
    "std" => "",
    "type" => "text");

$custom_meta_timeline[] = array("label" => "Zoom",
    "desc" => "Select a zoom level for the map.",
    "id" => "_timeline_zoom",
    "std" => "1",
    "type" => "text",
    'value' => "1",
    'min' => '1',
    'max' => '19',
    'step' => '1',
    'unit' => '');

$custom_meta_timeline[] = array("label" => "Map marker",
    "id" => "_timeline_marker",
    "std" => "0",
    "type" => "select",
    "options" => array("1" => "On", "0" => "Off"));

$custom_meta_timeline[] = array("label" => "Marker Description",
    "id" => "_timeline_marker_description",
    "std" => "",
    "desc" => 'Enter your marker description via HTML code.',
    "type" => "textarea");


$custom_meta_timeline[] = array(
    'id' => '_timeline_description_open',
    'type' => 'select',
    'label' => 'Marker Description Opened',
    "desc" => "Decide when the marker description has to be opened.",
    "std" => "start",
    "options" => array("click" => "After click", "start" => "On start")
);

$custom_meta_timeline[] = array(
    'id' => '_timeline_controls',
    'type' => 'select',
    'label' => 'Map Controls',
    "desc" => "Decide whether or not to make the map control tools available.",
    "std" => "1",
    "options" => array("1" => "On", "0" => "Off")
);

$custom_meta_timeline[] = array(
    'id' => '_timeline_disabledoubleclickzoom',
    'type' => 'select',
    'label' => 'Disable Doubleclick Zoom',
    "desc" => "Turn this option on to disable doubleclick zoom feature.",
    "std" => "1",
    "options" => array("1" => "On", "0" => "Off")
);

$custom_meta_timeline[] = array(
    'id' => '_timeline_scrollwheel',
    'type' => 'select',
    'label' => 'Enable Scrool Wheel',
    "desc" => "Turn this option on to enable using of a mouse scroll wheel on the map.",
    "std" => "0",
    "options" => array("1" => "On", "0" => "Off")
);

$custom_meta_timeline[] = array(
    'id' => '_timeline_dragable',
    'type' => 'select',
    'label' => 'Panning Map',
    'desc' => 'Decide whether or not to allow panning the map using mouse (drag & drop).',
    "std" => "1",
    "options" => array("1" => "On", "0" => "Off")
);

$custom_meta_timeline[] = array(
    "label" => 'Map Type',
    "id" => "_timeline_maptype",
    "std" => "ROADMAP",
    "type" => "select",
    "desc" => "Select the map type you prefer.",
    "options" => array(
        "" => "Choose",
        "ROADMAP" => "Road Map",
        "SATELLITE" => "Google Earth Map",
        "HYBRID" => "Mixture of normal and satellite",
        "TERRAIN" => "Physical Map"
    )
);