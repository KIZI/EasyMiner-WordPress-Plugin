$( document ).delegate( "#ea-button-vlozit", "click", function() {
    var content = "Test content";
    var name = 'core/paragraph';
    insertedBlock = wp.blocks.createBlock(name, {
        content: content,
    });
    wp.data.dispatch('core/editor').insertBlocks(insertedBlock);
    tb_remove();
});