<?php

/**
 * IceTea Framework.
 */

ini_set("display_errors", true);
define("BASEPATH", __DIR__);

/**
 * Database.
 */
define("DBHOST", "localhost");
define("DBUSER", "debian-sys-maint");
define("DBPASS", "");
define("DBNAME", "icetea");
define("DBPORT", "3306");

/**
 * Base URL.
 */
$baseurl = "http".(isset($_SERVER['HTTPS']) ? "s" : "")."://".(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : "localhost");
define("BASEURL", $baseurl);
define("ROUTER_FILE", false);
