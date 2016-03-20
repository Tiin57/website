<?php
session_start();
if (isset($_SESSION["CAS"]) && !isset($_SESSION["casbad"])) {
    header("Location: " . (isset($_GET["returnto"]) ? $_GET["returnto"] : "index"));
} else {
    require_once(__DIR__ . "/inc/auth.php");
}
?>
