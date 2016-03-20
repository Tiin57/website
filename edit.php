<?php
require_once(__DIR__ . "/inc/auth.php");
if (!is_logged_in() || !is_admin()) {
    echo("Access forbidden");
    exit;
}
$_HTML["js"] = ["https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.3/ace.js"];
require_once(__DIR__ . "/inc/header.php");
?>
<input type="hidden" name="action" value="edit-page" data-form="edit-page" class="form-input" />
<select id="page" name="page" class="form-input" data-form="edit-page" >
<?php
$result = query($db, "SELECT `filename`,`name` FROM `Page`;", []);
if (!$result):
?>
    <option>Database error</option>
<?php else: ?>
<?php
$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}
function cmp($a, $b) {
    return strcmp($a["name"], $b["name"]);
}
usort($rows, "cmp");
foreach ($rows as $k => $row): ?>
    <option value="<?=$row["filename"]?>"><?=$row["name"]?></option>
<?php endforeach; ?>
<?php endif; ?>
</select>
<span style="display: none;" class="bold">Error: <span id="error" class="color-red"></span></span><br />
<div id="editor" name="source" data-form="edit-page" class="form-input" data-form-getvalue="getEditorValue"></div><br />
<button id="submit" class="form-submit" data-form="edit-page" data-form-callback="onSubmit" data-form-target="post">Submit</button>
<?php require_once(__DIR__ . "/inc/footer.php"); ?>
