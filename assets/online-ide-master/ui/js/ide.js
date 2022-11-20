let editor;

window.onload = function() {
    editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/html");
}

function changeLanguage() {
    let language = $("#languages").val();

    if(language == 'html')editor.session.setMode("ace/mode/html");
    else if(language == 'php')editor.session.setMode("ace/mode/php");
    else if(language == 'node')editor.session.setMode("ace/mode/javascript");
}

function executeCode() {
    if ($("#languages").val() != "html") {
        $.ajax({

            url: "../app/compiler.php",

            method: "POST",

            data: {
                language: $("#languages").val(),
                code: editor.getSession().getValue()
            },

            success: function(response) {
                $(".output").text(response)
            }
        })
    } else {
        $('#direita').empty();
        $('#direita').append('<iframe src="" frameborder="0" class="output" id="iframe"></iframe>');
        const iframe = document.querySelector('#iframe');
        iframe.src = "data:text/html;charset=utf-8," + encodeURI(editor.getSession().getValue())
    }
}