<?php
$POST_ENV["requiresLogin"] = true;
$POST_ENV["requiresAdmin"] = true;

function handle($args) {
    global $db;
    if (!params_isset(["id"], $args)) {
        return ["error" => "Invalid parameters"];
    }
    $sql = "DELETE FROM `Page` WHERE `id`=:id;";
    $result = query($db, $sql, ["id" => $args["id"]]);
    if (!$result) {
        return ["error" => "Database error"];
    }
    return ["success" => true];
}
?>
