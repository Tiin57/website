<?php
if (!isset($_POST["action"]) || strpos($_POST["action"], "..") !== false) {
    header("HTTP/1.1 422 Unprocessable entity");
    echo("Invalid parameters");
    exit;
}
header("Content-Type: application/json");
require_once(__DIR__ . "/inc/utils.php");
require_once(__DIR__ . "/inc/mysql.php");

function error($msg) {
    echo(json_encode(["error" => $msg]));
    exit;
}

$db = setup_database();
if (!$db) {
    error("Database connection failed");
}
$POST_ENV = [
    "requiresLogin" => false,
    "requiresAdmin" => false
];
$filename = __DIR__ . "/inc/post/" . $_POST["action"] . ".php";
require_once($filename);
if ($POST_ENV["requiresLogin"] && !is_logged_in()) {
    error("Login required");
}
if ($POST_ENV["requiresAdmin"] && !is_admin()) {
    error("Insufficient privileges");
}
echo(json_encode(handle($_POST)));
?>
