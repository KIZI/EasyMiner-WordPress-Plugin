function zobrazReporty() {
    $.ajax({
        type: "GET",
        url: ajaxurl,
        data: {
            action: 'zobraz_reporty',
        },
        success:function (data) {
            console.log("success");
            $('#ea-tb-container').html(data);
        },
        error:function (errorThrown) {
            console.log(errorThrown);
        }
    });
}

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
