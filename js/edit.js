var editor;

function onSubmit(data) {
    if (data.error) {
        displayError("#error", data.error);
        return;
    }
    alert("Edits submitted");
}

function getEditorValue() {
    return editor.getValue();
}

$(document).ready(function() {
    function onPageChange() {
        $("#page").attr("disabled", true);
        $.post("post", {
            "action": "get-source",
            "page": $("#page").val()
        }, function(data) {
            if (data.error) {
                displayError("#error", data.error);
                return;
            }
            editor.setValue(data.source);
            $("#page").attr("disabled", false);
        }, "json");
    }
    $(window).bind("keydown", function(evt) {
        if (!event.ctrlKey && !event.metaKey) {
            return;
        }
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's':
            event.preventDefault();
            $("#submit").click();
            break;
        }
    });
    editor = ace.edit("editor");
    editor.$blockScrolling = Infinity;
    editor.session.setMode("ace/mode/markdown");
    editor.getSession().setUseWrapMode(true);
    onPageChange();
    $("#page").change(onPageChange);
});
