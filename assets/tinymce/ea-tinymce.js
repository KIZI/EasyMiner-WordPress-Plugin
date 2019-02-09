jQuery('#ea-tlacitko').click(function(){
    zobrazReporty();
});

$( document ).delegate( "#ea-button-vlozit", "click", function() {
    var content = getShortCodeContent();
    tinyMCE.activeEditor.execCommand('mceInsertContent', 0,
        content);
    tb_remove();
});