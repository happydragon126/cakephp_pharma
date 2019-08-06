<?php 
define('GIFT_TYPE_PHOTO', 'photo');
define('GIFT_TYPE_AUDIO', 'audio');
define('GIFT_TYPE_VIDEO', 'video');
define('GIFT_SAVED', 'saved');
define('GIFT_RECEIVED', 'received');
define('GIFT_SENT', 'sent');
define('GIFT_FILE_PATH', 'uploads' . DS . 'gifts');
define('GIFT_FILE_URL', 'uploads/gifts/');
define('GIFT_THUMB_PATH', GIFT_FILE_PATH.DS.'thumb'.DS);
define('GIFT_THUMB_URL', 'uploads/gifts/thumb/');
define('GIFT_THUMB_WIDTH', 200);
define('GIFT_THUMB_HEIGHT', 200);
define('GIFT_VIDEO_WIDTH', 900);
define('GIFT_VIDEO_HEIGHT', 560);
define('GIFT_EXT_PHOTO', 'jpg,jpeg,png,gif');
define('GIFT_EXT_VIDEO', 'mp4,flv');
define('GIFT_EXT_AUDIO', 'mp3');

define('GIFT_PERMISSION_CAN_SEND_GIFT', 'gift_can_send_gift');
define('GIFT_PERMISSION_ALLOW_PHOTO_GIFT', 'gift_allow_photo_gift');
define('GIFT_PERMISSION_ALLOW_AUDIO_GIFT', 'gift_allow_audio_gift');
define('GIFT_PERMISSION_ALLOW_VIDEO_GIFT', 'gift_allow_video_gift');
define('GIFT_EXTEND_NO_BELONG_TO_ITEM', '0');
define('GIFT_EXTEND_3_MONTHS', '3');
define('GIFT_EXTEND_6_MONTHS', '6');
define('GIFT_EXTEND_12_MONTHS', '12');
define('GIFT_EXTEND_FOREVER', '99');