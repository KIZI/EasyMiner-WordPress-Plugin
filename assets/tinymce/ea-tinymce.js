jQuery(document).ready(function($) {
    $( document ).delegate( "#ea-button-vlozit", "click", function() {
        var content = getReportContent();
        console.log(content);
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0,
            content);
        tb_remove();
    });
});