function displayError(id, msg) {
    $(document.getElementById(id.substring(1)).parentNode).show();
    $(id).html(msg);
}
