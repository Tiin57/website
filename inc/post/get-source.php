<?php
$POST_ENV["requiresLogin"] = true;
$POST_ENV["requiresAdmin"] = true;

function handle($args) {
    global $db;
    if (!isset($args["page"])) {
        return ["error" => "Invalid parameters"];
    }
    $sql = "SELECT `markdown` FROM `Page` WHERE `filename`=':page'";
    $result = query($db, $sql, ["page" => $args["page"]]);
    if (!$result) {
        return ["error" => "Database error"];
    }
    if ($result->num_rows == 0) {
        return ["error" => "Page not found"];
    }
    return ["source" => $result->fetch_assoc()["markdown"]];
}
?>
