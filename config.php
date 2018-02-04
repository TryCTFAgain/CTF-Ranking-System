<?php
/**
 * Created by PhpStorm.
 * User: Kevinlpd
 * Date: 29-Dec-17
 * Time: 10:24 PM
 */
// base
define("DS"					, DIRECTORY_SEPARATOR);
define("DOCUMENT_ROOT"		, getcwd() . DS);
define("PATH_ROOT"			, "http://" . $_SERVER['SERVER_NAME'] . "/");
// directory
define("ASSETS"				, PATH_ROOT . "assets/");
define("RESOURCES"			, PATH_ROOT . "resources/");
define("RESOURCES_"			, DOCUMENT_ROOT . "resources" . DS);
define("PAGES"				, DOCUMENT_ROOT . "pages" . DS);
define("ERROR"				, DOCUMENT_ROOT . "errors" . DS);
define("LIBS"				, DOCUMENT_ROOT . "libs" . DS);
define("MODEL"				, LIBS . "model.php");
// database
define("DBHOST"				, "localhost");
define("DBNAME"				, "scoreboardctfkma");
define("DBUSER"				, "root");
define("DBPASS"				, "");





?>
