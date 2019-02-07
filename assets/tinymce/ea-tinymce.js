jQuery('#ea-tlacitko').click(function(){
    zobrazReporty();
});

$( document ).delegate( "#ea-button-vlozit", "click", function() {
    tinyMCE.activeEditor.execCommand('mceInsertContent', 0,
        'easyminer_report');
    tb_remove();
});


