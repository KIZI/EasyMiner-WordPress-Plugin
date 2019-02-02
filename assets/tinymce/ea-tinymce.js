

function onVlozitReporty() {
    //wp.data.dispatch('core/editor').insert('sdsasd');
    var content = "Test content";
    var el = wp.element.createElement;
    var name = 'core/paragraph';
    // var name = 'core/html';
    insertedBlock = wp.blocks.createBlock(name, {
        content: content,
    });
    wp.data.dispatch('core/editor').insertBlocks(insertedBlock);
}

