<?php
require_once(__DIR__ . "/inc/auth.php");
if (!is_admin()) {
    header("HTTP/1.1 403 Forbidden");
    echo("You are not authorized to access this page.");
    exit;
}
require_once(__DIR__ . "/inc/header.php");
?>
<h3>Add page</h3>
<p>Every new publicly (and privately) accessible page on the site requires a row in the `pages` table on the database. You can add a row with this form.</p>
<div>
    <span style="display: none;" class="bold">Error: <span id="error" class="color-red"></span></span><br />
    <input type="hidden" class="form-input" data-form="add-page" name="action" value="add-page" />
    <input type="text" class="form-input" data-form="add-page" name="name" placeholder="Page name" /><br />
    <input type="text" class="form-input" data-form="add-page" name="filename" placeholder="File name" /><br />
    <label for="add-page-show">Should show page?</label>
    <select id="add-page-show" class="form-input" data-form="add-page" name="show">
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select><br />
    <button class="form-submit" data-form-callback="onSubmit" data-form-target="post" data-form="add-page">Submit</button>
</div><br />
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Filename</th>
            <th>Should Show</th>
            <th>Delete?</th>
        </tr>
    </thead>
    <tbody id="pages"></tbody>
</table>

<?php require_once(__DIR__ . "/inc/footer.php"); ?>
