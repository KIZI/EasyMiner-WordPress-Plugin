jQuery('#ea-tlacitko').click(function(){
    zobrazReporty();
});

jQuery(document).ready(function($) {
    $( document ).delegate( "#ea-button-vlozit", "click", function() {
        var content = getReportContent();
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0,
            content);
        tb_remove();
    });
});