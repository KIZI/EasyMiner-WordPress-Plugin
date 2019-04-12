( function( blocks, element ) {
    var el = element.createElement;

    var blockStyle = {
        backgroundColor: '#900',
        color: '#fff',
        padding: '20px',
    };

    blocks.registerBlockType( 'easyminerintegration/easyminerblock', {
        title: 'EasyMiner',
        icon: 'universal-access-alt',
        category: 'layout',

        attributes: {
            content: {
                type: 'string',
                source: 'html',
            },
        },

        edit: function(props) {
            return el(
                'div',
                null,
                'text'
            );
        },

        save: function(props) {
            return props.attributes.content;
        },
    } );
}(
    window.wp.blocks,
    window.wp.element
) );

jQuery(document).ready(function($) {
    $( document ).delegate( ".editor-block-list-item-easyminerintegration-easyminerblock",
        "click",
        zobrazThickbox);
});



