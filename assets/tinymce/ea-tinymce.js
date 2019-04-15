jQuery(document).ready(function($) {

    $( document ).delegate( "#ea-button", "click", showThickbox);

    $( document ).delegate( "#ea-button-insert", "click", function() {
        var content = getReportContent();
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0,
            content);
        tb_remove();
    });
});