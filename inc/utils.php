<?php

function params_isset($fields, $params) {
    foreach ($fields as $k => $field) {
        if (!isset($params[$field])) {
            return false;
        }
    }
    return true;
}

function is_admin() {
    global $admins, $username;
    if (!is_logged_in()) {
        return false;
    }
    foreach ($admins as $k => $adminUsername) {
        if ($adminUsername == $_SESSION["username"]) {
            return true;
        }
    }
    return false;
}

function is_logged_in() {
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    return isset($_SESSION["CAS"]) && !isset($_SESSION["casbad"]);
}

function assoc_to_numeric($assoc) {
    $numeric = [];
    foreach ($assoc as $k => $v) {
        $numeric[] = $v;
    }
    return $numeric;
}

function list_directory($dirname) {
    return assoc_to_numeric(array_diff(scandir($dirname), ["..", "."]));
}

function query($db, $sql, $params) {
    $tempsql = $sql;
    foreach ($params as $key => $value) {
        $tempsql = str_replace(":" . $key, $db->escape_string($value), $tempsql);
    }
    $rows = $db->query($tempsql);
    if ($db->errno) {
        return false;
    }
    return $rows;
}

?>
