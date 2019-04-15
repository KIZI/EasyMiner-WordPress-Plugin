jQuery(document).ready(function($) {

    $( document ).delegate( "#ea-button", "click", showThickbox);

    $( document ).delegate( "#ea-button-insert", "click", function() {
        var content = getReportContent();
        var editor = tinyMCE.activeEditor;
        if(editor) {
            tinyMCE.activeEditor.execCommand('mceInsertRawHTML', 0,
                content);
        } else {
            var textarea = $('#content');
            var cursorPosition = textarea.prop("selectionStart");
            var text = textarea.val();
            var textBefore = text.substring(0,  cursorPosition);
            var textAfter  = text.substring(cursorPosition, text.length);
            textarea.val(textBefore + content + textAfter);
        }
        tb_remove();
    });
});