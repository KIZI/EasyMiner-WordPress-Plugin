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

$( document ).delegate( ".ea-report-polozka", "click", function() {
    var checkbox = this.getElementsByTagName('input')[0];
    var vybran = checkbox.checked;
    checkbox.checked = !vybran;
});

function zobrazObsah(id) {
   // var id = this.id.replace(/ea-report-polozka-/gi, '');
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
}

function getShortCodeContent() {
    var output = '';
    var items = document.
                getElementById('ea-reports-list').
                getElementsByTagName('li');
    for (let item of items) {
        var vybran =    item.
                        getElementsByTagName('input')[0].
                        checked;
        if (vybran == true) {
            output +=   item.
                        getElementsByTagName('a')[0].
                        innerHTML + "\n";
        }
    }
    return output
}

