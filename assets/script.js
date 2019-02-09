function zobrazReporty() {
    var vlozitButtton = document.getElementById('ea-button-vlozit');
    vlozitButtton.setAttribute('disabled', 'disabled');
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
    var vlozitButtton = document.getElementById('ea-button-vlozit');
    var checkbox = this.getElementsByTagName('input')[0];
    var vybran = checkbox.checked;
    if (vybran) {
        this.classList.remove('ea-vybrana');
        this.classList.add('ea-nevybrana');
    } else {
        this.classList.remove('ea-nevybrana');
        this.classList.add('ea-vybrana');
    }
    checkbox.checked = !vybran;
    if (getPocetVybranychReportu() == 0)
        vlozitButtton.setAttribute('disabled', 'disabled');
    else
        vlozitButtton.removeAttribute('disabled');

});

$( document ).delegate( ".ea-polozka-checkbox", "click", function() {
    this.checked = !this.checked;
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

function getPocetVybranychReportu() {
    var pocet = 0;
    var items = document.
    getElementById('ea-reports-list').
    getElementsByTagName('li');
    for (let item of items) {
        var vybran =    item.
        getElementsByTagName('input')[0].
            checked;
        if (vybran == true) {
            pocet = pocet + 1;
        }
    }
    return pocet;
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

