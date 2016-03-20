$(document).ready(function() {
    function onFormSubmit(ele) {
        var formName = ele.getAttribute("data-form");
        var inputs = $(".form-input[data-form='" + formName + "']");
        var finalData = {};
        inputs.each(function(index, element) {
            var name = element.getAttribute("name");
            if (element.hasAttribute("data-form-getvalue")) {
                var getter = window[element.getAttribute("data-form-getvalue")];
                if (getter) {
                    element.value = getter();
                } else {
                    console.log("Getter " + element.getAttribute("data-form-getvalue") + " does not exist");
                }
            }
            finalData[name] = element.value || "";
        });
        console.log(finalData);
        var callback = window[ele.getAttribute("data-form-callback")];
        $.post(ele.getAttribute("data-form-target"), finalData, function(data) {
            if (callback) {
                callback(data);
            }
            console.log("Submitted form " + formName);
        });
    }
    $(".form-submit").on("click", function(evt) {
        onFormSubmit(this);
    });
    $(".form-input[type='text']").on("keydown", function(evt) {
        if (evt.keyCode == 13) {
            var ele = $(".form-submit[data-form='" + this.getAttribute("data-form") + "']")[0];
            onFormSubmit(ele);
        }
    });
});
