<?php
function handle($args) {
    global $db;
    $sql = "SELECT * FROM `Page`;";
    $result = query($db, $sql, []);
    if (!$result) {
        return ["error" => "Database error"];
    }
    $pages = [];
    while ($row = $result->fetch_assoc()) {
        $pages[] = [
            "id" => $row["id"],
            "name" => $row["name"],
            "filename" => $row["filename"],
            "show" => $row["show"]
        ];
    }
    return ["pages" => $pages];
}
?>
