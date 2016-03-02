<?php

global $custom_meta_gallery;

$custom_meta_gallery[] = array(
    "label" => "Gallery thumbnail",
    "desc" => "Used as thubnail in jaw gallery shortcode",
    "id" => "_gallery_image",
    "std" => "",
    "type" => "simple_media_picker"
);

$custom_meta_gallery[] = array(
    "label" => "Photos gallery",
    "desc" => "All Gallery Images choose here",
    "id" => "_gallery_items",
    "std" => "",
    "type" => "media_picker"
);
// video gallery
$custom_meta_gallery[] = array(
    "label" => "Video gallery",
    "desc" => "Click the [ + ] button for add a video URL (youtube, vimeo etc...) - <span style=\"font-weight:bold;color:#D6492F;\">ONLY URL</span>",
    "id" => "_gallery_video_link",
    "std" => "",
    "type" => "list",
    "mod" => "big"
);
// embed gallery
$custom_meta_gallery[] = array(
    "label" => "Embed gallery",
    "desc" => "Click the [ + ] button for add an embed URL (youtube, vimeo etc...) - <span style=\"font-weight:bold;color:#D6492F;\">ONLY IFRAME</span>",
    "id" => "_gallery_embed_link",
    "std" => "",
    "type" => "list",
    "mod" => "big"
);
// share icons
$custom_meta_gallery[] = array(
    "id" => "_gallery_show_share",
    "label" => "Show Social Icons",    
    'desc' => 'Turn on this option to show a social icons in gallery.',
    "std" => "On",
    "type" => "select",
    "options" => array("Off" => "Off", "On" => "On")
);

// display image description
$custom_meta_gallery[] = array(
    "id" => "_gallery_image_description",
    "label" => "Show Image Description",    
    'desc' => 'Turn on this option to show an image description in gallery.',
    "std" => "On",
    "type" => "select",
    "options" => array("Off" => "Off", "On" => "On")
);