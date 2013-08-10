<?php

define("DB_LOC",                SITE_DB);

//include_once("config/databases_framework.php");

// Duckling
define("UT_ITE",                DB_LOC.".items");                       // Items

define("UT_TAG",                DB_LOC.".tags");                       // Item tags
define("UT_TAGGINGS",           DB_LOC.".taggings");                   // Item tags relations

define("UT_ITE_NEW",            DB_LOC.".item_news");                  // Items type news
define("UT_ITE_PER",            DB_LOC.".item_person");                // Items type person
define("UT_ITE_AUD",            DB_LOC.".item_audio");                 // Items type audio
define("UT_ITE_DOW",            DB_LOC.".item_download");              // Items type download
define("UT_ITE_TEX",            DB_LOC.".item_text");                  // Items type text
define("UT_ITE_IMA",            DB_LOC.".item_image");                 // Items type image
define("UT_ITE_VID",            DB_LOC.".item_video");                 // Items type video

define("UT_ITE_SET",            DB_LOC.".item_set");                   // Items type set
define("UT_ITE_SET_ITE",        DB_LOC.".item_set_items");             // Items type set items





?>