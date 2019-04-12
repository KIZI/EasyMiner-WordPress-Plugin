jQuery(document).ready(function($) {

    $( document ).delegate( ".editor-block-list-item-easyminerintegration-easyminerblock",
        "click",
        function () {
            zobrazThickbox();
            $("#TB_window").find('#TB_closeWindowButton').click(
                function () {
                    var editorsData = wp.data.select("core/editor");
                    var clientId = editorsData.getSelectedBlock().clientId;
                    wp.data.dispatch('core/editor').removeBlock(clientId);
                }
            );
        });

    $( document ).delegate( "#ea-button-vlozit", "click", function() {

        var editorsData = wp.data.select("core/editor");
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