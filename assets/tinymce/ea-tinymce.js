function onVlozitReporty() {
    tinyMCE.activeEditor.execCommand('mceInsertContent', 0,
        'easyminer_report');
}

jQuery('#ea-tlacitko').click(function(){
    zobrazReporty();
});


