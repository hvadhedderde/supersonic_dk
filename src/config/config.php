<?php

/**
* This file contains definitions
*
* @package Config
*/
error_reporting(E_ALL);

/**
* Site name
*/
define("SITE_UID", "SON");
define("SITE_NAME", "Supersonic");
define("SITE_DB", "supersonic");
define("SITE_URL", "supersonic.dk");
define("ADMIN_FRONT", "/items/item_news.php");

define("DEFAULT_LANGUAGE_ISO", "en"); // Reginal language English
define("DEFAULT_COUNTRY_ISO", "dk"); // Reginal country Denmark


include_once($_SERVER["FRAMEWORK_PATH"]."/config/file_paths.php");
include_once("config/databases.php");
include_once("config/connect.php");

include_once("class/system/page.core.class.php");

include_once("class/system/html.class.php");
include_once("class/system/query.class.php");
include_once("class/system/filesystem.class.php");
include_once("class/system/validator.class.php");

include_once("class/items/item.class.php");

//include_once("class/system/security.class.php");
//include_once("class/system/performance.class.php");

include_once("class/system/page.class.php");
?>
