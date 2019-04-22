jQuery(document).ready(function($) {

    var editorsData = wp.data.select("core/editor");

    $( document ).delegate( ".editor-block-list-item-easyminerintegration-easyminerblock",
        "click",
        function () {
            showThickbox();
            setTimeout(function () {
                var blocks = editorsData.getBlocks();
                for (let block of blocks) {
                    if (block.name === 'easyminerintegration/easyminerblock') {
                        clientId = block.clientId;
                        wp.data.dispatch('core/editor').removeBlock(clientId);
                    }
                }
            }, 0);
        }
    );

    $( document ).delegate( "#ea-button-insert", "click", function() {
        var clientId = editorsData.getSelectedBlock().clientId;
        var blockIndex = editorsData.getBlockIndex(clientId);
        var content = getReportContent();
        var name = 'core/html';
        insertedBlock = wp.blocks.createBlock(name, {
            content: content,
        });
        wp.data.dispatch('core/editor').insertBlock(insertedBlock, blockIndex + 1);
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
        title: eaGutenbergLocalize.blockName,
        icon: 'analytics',
        category: 'embed',
        edit: function() {
            return el(
                'p',
                { style: blockStyle },
                eaGutenbergLocalize.blockName
            );
        },
        save: function () {
            return null;
        }
    });
}(
    window.wp.blocks,
    window.wp.element
) );