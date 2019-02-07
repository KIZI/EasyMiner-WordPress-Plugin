( function( wp ) {

    var MyCustomButton = function( props ) {
        return wp.element.createElement(
            wp.editor.RichTextToolbarButton, {
                icon: 'analytics',
                className: null,
                title: 'Easyminer Report',
                onClick: function() {
                    tb_show( '', '#TB_inline?width=' + 750 +
                        '&height=' + 550 + '&inlineId=ea-dialog' );
                    zobrazReporty();
                },
            }
        );
    };

    wp.richText.registerFormatType(
        'easyminer-integration/report-format', {
            title: 'Easyminer Report',
            tagName: 'samp',
            className: null,
            edit: MyCustomButton,
        }
    );
} )( window.wp );