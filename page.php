<?php
if (!isset($_GET["pagename"])) {
    header("HTTP/1.1 422 Unprocessable entity");
    echo("Invalid parameters.");
    exit;
}
require_once(__DIR__ . "/inc/header.php");

function get_page_contents($db, $filename) {
    $sql = "SELECT `name`,`html` FROM `Page` WHERE `filename`=':filename';";
    $result = query($db, $sql, ["filename" => $filename]);
    if (!$result) {
        return false;
    }
    if ($result->num_rows == 0) {
        return "";
    }
    return $result->fetch_assoc()["html"];
}
?>
<?=get_page_contents($db, $_GET["pagename"]);?>
<?php require_once(__DIR__ . "/inc/footer.php"); ?>
