<?php
$POST_ENV["requiresLogin"] = true;
$POST_ENV["requiresAdmin"] = true;

require_once(__DIR__ . "/../../vendor/autoload.php");
function handle($args) {
    global $db;
    if (!params_isset(["page", "source"], $args)) {
        return ["error" => "Invalid parameters"];
    }
    $parser = new \cebe\markdown\GithubMarkdown();
    $parser->html5 = true;
    $html = $parser->parse($args["source"]);
    $sql = "UPDATE `Page` SET `markdown`=':markdown', `html`=':html' WHERE `filename`=':filename';";
    $result = query($db, $sql, [
        "html" => $html,
        "markdown" => $args["source"],
        "filename" => $args["page"]
    ]);
    if (!$result) {
        return ["error" => "Database error"];
    } else {
        return ["success" => true];
    }
}
?>
