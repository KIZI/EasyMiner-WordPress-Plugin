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





