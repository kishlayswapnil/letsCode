let editor;

window.onload = function() {
    editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/python");
}

function changeLanguage() {

    let language = $("#languages").val();
    if(language == 'python')editor.session.setMode("ace/mode/python");
    else if(language == 'java')editor.session.setMode("ace/mode/java");
}

function executeCode() {

    $.ajax({

        url: "/letsCode/app/compiler.php",

        method: "POST",

        data: {
            language: $("#languages").val(),
            code: editor.getSession().getValue()
        },

        success: function(response) {
            $(".output").text(response)
        }
    })
}