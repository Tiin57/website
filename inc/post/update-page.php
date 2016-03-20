<?php
$POST_ENV["requiresLogin"] = true;
$POST_ENV["requiresAdmin"] = true;

function handle($args) {
    global $db;
    if (!params_isset(["id", "show"], $args)) {
        return ["error" => "Invalid parameters"];
    }
    $sql = "UPDATE `Page` SET `show`=:show WHERE `id`=:id";
    $result = query($db, $sql, ["id" => $args["id"], "show" => $args["show"]]);
    if (!$result) {
        return ["error" => "Database error"];
    }
    return ["success" => true];
}
?>
