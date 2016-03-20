function onSubmit(data) {
    if (data.error) {
        displayError("#error", data.error);
        return;
    }
    alert("Added the page");
    updatePages();
}

function onChangeShow(ele, id) {
    $.post("post", {
        "action": "update-page",
        "id": id,
        "show": ele.value
    }, function(data) {
        if (data.error) {
            displayError("#error", data.error);
            return;
        }
    });
}

function onDelete(id) {
    if (!confirm("Are you sure?")) {
        return;
    }
    $.post("post", {
        "action": "delete-page",
        "id": id
    }, function(data) {
        if (data.error) {
            displayError("#error", data.error);
            return;
        }
        alert("Deleted the page");
        updatePages();
    });
}

function updatePages() {
    $.post("post", {
        "action": "get-pages"
    }, function(data) {
        if (data.error) {
            displayError("#error", data.error);
            return;
        }
        data.pages.sort(function(a, b) {
            if (a.name == b.name) {
                return 0;
            }
            return a.name > b.name ? 1 : -1;
        });
        var rows = "";
        for (var i in data.pages) {
            rows += "<tr>\n";
            rows += "\t<td>" + data.pages[i].name + "</td>\n";
            rows += "\t<td>" + data.pages[i].filename + "</td>\n";
            var show = data.pages[i].show == 1;
            var optionYes = "<option value='1'" + (show ? " selected=true" : "") + ">Yes</option>";
            var optionNo = "<option value='0'" + (!show ? " selected=true" : "") + ">No</option>";
            rows += "\t<td><select onchange='onChangeShow(this, " + data.pages[i].id + ")'>" + optionYes + optionNo + "</select></td>\n";
            rows += "\t<td><button onclick='onDelete(" + data.pages[i].id + ")'>Yes</button>\n";
            rows += "</tr>\n";
        }
        $("#pages").html(rows);
    });
}

$(document).ready(function() {
    updatePages();
});
