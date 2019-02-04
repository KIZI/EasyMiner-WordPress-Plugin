
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

$( document ).delegate( "#ea-button-vlozit", "click", function() {
    //wp.data.dispatch('core/editor').insert('sdsasd');


    var content = "Test content";
    var el = wp.element.createElement;
    var name = 'core/paragraph';
    // var name = 'core/html';
    insertedBlock = wp.blocks.createBlock(name, {
        content: content,
    });
    wp.data.dispatch('core/editor').insertBlocks(insertedBlock);
    wp.RichTex


    // tinyMCE.activeEditor.execCommand('mceInsertContent', 0,
    //     'easyminer_report');
    tb_remove();
});

jQuery('#ea-tlacitko').click(function(){
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
});


