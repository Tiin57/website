<?php
if (defined("CONFIG_ALREADY_SET")) {
    return;
}
require_once(__DIR__ . "/credentials.php");
$DEBUG = true;
if ($DEBUG) {
    ini_set("display_errors", "1");
    error_reporting(E_ALL);
}
define("CONFIG_ALREADY_SET", true);
?>
