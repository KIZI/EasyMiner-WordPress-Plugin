$( document ).delegate( "#ea-button-vlozit", "click", function() {

    var editorsData = wp.data.select("core/editor");
    var clientId = editorsData.getSelectedBlock().clientId;
    var blockIndex = editorsData.getBlockIndex(clientId);
    var content = getShortCodeContent();
    var name = 'core/paragraph';
    insertedBlock = wp.blocks.createBlock(name, {
        content: content,
    });
    wp.data.dispatch('core/editor').insertBlock(insertedBlock, blockIndex + 1);
    tb_remove();
});