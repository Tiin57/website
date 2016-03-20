<?php
require_once(__DIR__ . "/config.php");

function setup_database() {
    global $MYSQL_HOSTNAME, $MYSQL_USERNAME, $MYSQL_PASSWORD, $MYSQL_DATABASE;
    $db = new mysqli($MYSQL_HOSTNAME, $MYSQL_USERNAME, $MYSQL_PASSWORD, $MYSQL_DATABASE);
    if ($db->connect_errno) {
        return false;
    }
    return $db;
}
?>
