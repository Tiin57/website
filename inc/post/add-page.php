<?php
$POST_ENV["requiresLogin"] = true;
$POST_ENV["requiresAdmin"] = true;

function handle($args) {
    global $db;
    if (!params_isset(["name", "filename"], $args)) {
        return ["error" => "Invalid parameters"];
    }
    $sql = "INSERT INTO `Page`(`name`, `filename`) VALUES(':name', ':filename');";
    $result = query($db, $sql, ["name" => $args["name"], "filename" => $args["filename"]]);
    if (!$result) {
        return ["error" => "Database error"];
    }
    return ["success" => true];
}
?>
