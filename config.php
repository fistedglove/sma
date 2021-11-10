<?php
/**
 * This file contains the Configuration for this School Management System
 * Modify with Caution
 */

defined("ACADEMIC_YEAR")? NULL: define("ACADEMIC_YEAR","2021/2022");

defined("DB_PASS")? NULL : define("DB_PASS","");

defined("DB_SERVER")? NULL: define("DB_SERVER", "localhost");
defined("DB_USER")? NULL : define("DB_USER", "root");

defined("DB_NAME")?NULL : define("DB_NAME", "PHPSMS" );

defined("SITE_ROOT")? NULL : define("SITE_ROOT", $_SERVER['DOCUMENT_ROOT']);
defined("DS")? NULL : define("DS", "/");
defined("APP_ROOT")? NULL : define ("APP_ROOT", "phpsms");
defined("WEBSITE")? NULL : define("WEBSITE", "http://localhost" );
defined("CONTROLLER_PATH")? null: define("CONTROLLER_PATH", SITE_ROOT.DS.APP_ROOT.DS. "controller". DS);
defined("MODEL_PATH")? null: define("MODEL_PATH", SITE_ROOT.DS.APP_ROOT.DS. "model". DS);
defined("VIEW_PATH")? null: define("VIEW_PATH", SITE_ROOT.DS.APP_ROOT.DS. "view". DS);

date_default_timezone_set("Europe/London");

include_once(SITE_ROOT.DS. APP_ROOT.DS. 'lib/database_object.php');
include_once(SITE_ROOT.DS. APP_ROOT.DS. 'lib/mysql_database.php');
include_once(SITE_ROOT.DS. APP_ROOT.DS. 'lib/dispatcher.php');
include_once(SITE_ROOT.DS. APP_ROOT.DS. 'lib/functions.php');
include_once(SITE_ROOT.DS. APP_ROOT.DS. 'lib/pagination.php');
include_once(SITE_ROOT.DS. APP_ROOT.DS. 'lib/session.php');

?>