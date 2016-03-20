<?php
require_once(__DIR__ . "/utils.php");
require_once(__DIR__ . "/mysql.php");

$db = setup_database();
if (!$db) {
    echo("Database error");
    exit;
}

function generate_page_dependencies() {
    global $_HTML;
    $rootdir = __DIR__ . "/..";
    $rootpath = dirname($_SERVER["SCRIPT_NAME"]);
    $fname = basename($_SERVER["SCRIPT_NAME"], ".php");
    $output = "";
    if (!isset($_HTML["css"])) {
        $_HTML["css"] = [];
    }
    if (!isset($_HTML["js"])) {
        $_HTML["js"] = [];
    }
    if (file_exists($rootdir . "/css/$fname.css")) {
        $_HTML["css"][] = "css/$fname.css";
    }
    if (file_exists($rootdir . "/js/$fname.js")) {
        $_HTML["js"][] = "js/$fname.js";
    }
    if (isset($_HTML["css"])) {
        foreach ($_HTML["css"] as $k => $link) {
            $output .= "<link rel='stylesheet' href='$link' />\n";
        }
    }
    if (isset($_HTML["js"])) {
        foreach ($_HTML["js"] as $k => $link) {
            $output .= "<script src='$link'></script>\n";
        }
    }
    return $output;
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?=$_HTML["title"]?></title>
        <link rel="stylesheet" href="css/global.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <script src="js/global.js"></script>
        <script src="js/form.js"></script>
        <?=generate_page_dependencies();?>
        <?=$_HTML["head"]?>
    </head>
    <body>
        <ul class="navbar" id="navbar">
<?php
$result = query($db, "SELECT * FROM `Page`;", []);
if (!$result || $result->num_rows == 0):
?>
            <li><span>Database error</span></li>
            <script>console.log("<?=$db->error?>");</script>
<?php else: ?>
<?php while ($row = $result->fetch_assoc()): ?>
<?php if ($row["show"] == 1): ?>
            <li><a href="page-<?=$row["filename"]?>"><?=$row["name"]?></a></li>
<?php endif; ?>
<?php endwhile; ?>
<?php endif; ?>
            <ul class="navbar-right">
<?php if (is_logged_in()): ?>
<?php if (is_admin()): ?>
                <li><a href="admin">Admin</a></li>
                <li><a href="edit">Edit</a></li>
<?php endif; ?>
                <li><span>User: <?=$_SESSION["username"]?></span></li>
<?php else: ?>
                <li><a href="login">Log in</a></li>
<?php endif; ?>
            </ul>
        </ul>
