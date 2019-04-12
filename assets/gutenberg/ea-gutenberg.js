jQuery(document).ready(function($) {

    var editorsData = wp.data.select("core/editor");

    $( document ).delegate( ".editor-block-list-item-easyminerintegration-easyminerblock",
        "click",
        function () {
            zobrazThickbox();
            $("#TB_window").find('#TB_closeWindowButton').click(
                function () {
                    var clientId = editorsData.getSelectedBlock().clientId;
                    wp.data.dispatch('core/editor').removeBlock(clientId);
                }
            );
        }
    );

    $( document ).delegate( "#ea-button-vlozit", "click", function() {
        var clientId = editorsData.getSelectedBlock().clientId;
        var blockIndex = editorsData.getBlockIndex(clientId);
        var content = getReportContent();
        var name = 'core/html';
        //var name = 'easyminerintegration/easyminerblock';
        insertedBlock = wp.blocks.createBlock(name, {
            content: content,
        });
        wp.data.dispatch('core/editor').removeBlock(clientId);
        wp.data.dispatch('core/editor').insertBlock(insertedBlock, blockIndex);
        tb_remove();
    });
});

( function( blocks, element ) {
    var el = element.createElement;

    var blockStyle = {
        backgroundColor: 'rgba(153,0,0,0)',
        color: 'rgb(0,0,0)',
        padding: '20px',
        textAlign: 'center',
        fontSize: '8pt',
    };

    blocks.registerBlockType( 'easyminerintegration/easyminerblock', {
        title: 'EasyMiner Report Block',
        icon: 'analytics',
        category: 'embed',
        edit: function() {
            return el(
                'p',
                { style: blockStyle },
                'EasyMiner Analytical Report Block'
            );
        },
        save: function () {
            return null;
        }
    } );
}(
    window.wp.blocks,
    window.wp.element
) );