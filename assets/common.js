
$( document ).delegate( ".ea-report-polozka", "click", function() {

    var id = this.id.replace(/ea-report-polozka-/gi, '');

    $.ajax({
        type: "GET",
        url: ajaxurl,
        data: {
            action: 'zobraz_pravidla',
            id: id,
        },
        success:function (data) {
            $('#ea-tb-container').html(data);
        },
        error:function (errorThrown) {
            console.log(errorThrown);
        }
    });
});

//toto je spolecny kod
$( document ).delegate( "#ea-button-vlozit", "click", function() {

    //TODO: tato funkce musí být implementována
    // ve scriptu pro gutenberg i ve scriptu pro tinymce
    //onVlozitReporty();
    $('.jsem-tu').html('Nejaky Text');

    // tinyMCE.activeEditor.execCommand('mceInsertContent', 0,
    //     'easyminer_report');
    tb_remove();
});

jQuery('#ea-tlacitko').click(function () {
    zobrazReporty();
});

//toto je společny kod
function zobrazReporty() {
    $.ajax({
        type: "GET",
        url: ajaxurl,
        data: {
            action: 'zobraz_reporty',
        },
        success:function (data) {
            $('#ea-tb-container').html(data);
        },
        error:function (errorThrown) {
            console.log(errorThrown);
        }
    });
}