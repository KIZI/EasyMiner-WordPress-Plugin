jQuery(document).ready(function($) {

    $( document ).delegate( "#ea-tlacitko", "click", zobrazThickbox);

    $( document ).delegate( ".ea-report-polozka", "click", function() {
        var id = this.id.replace(/ea-report-polozka-/gi, '');
        zobrazObsah(id);
    });

    $( document ).delegate( ".ea-polozka-checkbox", "click", function() {
        this.checked = !this.checked;
    });
});

function zobrazThickbox() {
    tb_show( 'Blabla bla', '#TB_inline?inlineId=ea-dialog' );
    zobrazReporty();
}

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

    /*_ _ _ ÚPRAVA THICKBOXU _ _ _ */
    $(document).find("#TB_window").css({
        'min-width' : '750px',
        'max-height': '500px'
        }
    );
    $(document).find("#TB_ajaxContent").css({
            'min-width' : '750px',
            'min-height': '500px'
        }
    );
    console.log("ahoooj");
}

function zobrazObsah(id) {
    $.ajax({
        type: "GET",
        url: ajaxurl,
        data: {
            action: 'zobraz_casti',
            id: id,
        },
        success:function (data) {
            $('#ea-tb-container').html(data);
            //zaškrknu všechny checkboxy
            setAllCheckboxes(
                $("#easyminerReportUL").find("input[type=checkbox]").get(),
                true
            );
        },
        error:function (errorThrown) {
            console.log(errorThrown);
        }
    });
}

function getReportContent() {
    //TODO tady bude ajax Požadavek na HTML od PHP
}

/**
 * _ _ _ TREESELECT JAVASCRIPT _ _ _
 * **/

function areAllUnchecked(checkboxes) {
    var result = true;
    for (let checkbox of checkboxes) {
        if (checkbox.checked)
            result = false;
    }
    return result;
}

function setAllCheckboxes(checkboxes, value) {
    for (let checkbox of checkboxes) {
        checkbox.checked = value;
    }
}

function getParent(node) {
    var parent = $(node).parent().parent().parent().find("> input[type=checkbox]").get(0);
    return parent;
}

jQuery(document).ready(function($) {

    $(document).delegate("#easyminerReportUL .sipka", "click", function(){
        //TODO: otoč šipku
        $(this).parent().find("ul").get(0).classList.toggle("closed");
    });

    $(document).delegate("#easyminerReportUL input:checkbox", "change", function(){
        var parents = [];
        var child = this;
        while (parent = getParent(child)) {
            var siblings = $(child).parent().parent().find("> li > input[type=checkbox]").get();
            if (areAllUnchecked(siblings)) parent.checked = false;
            parents.push(parent);
            child = parent;
        }

        if (parents && this.checked)
            setAllCheckboxes(parents, true);

        var children = $(this).parent().find("ul > li > input[type=checkbox]");
        setAllCheckboxes(children, this.checked);
    });
});