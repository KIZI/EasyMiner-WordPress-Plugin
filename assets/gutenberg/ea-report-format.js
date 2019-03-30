( function( wp ) {

    var MyCustomButton = function( props ) {
        return wp.element.createElement(
            wp.editor.RichTextToolbarButton, {
                icon: 'analytics',
                className: null,
                title: EasyMinerGutenbergLocalizeFormat.easyminer_report,
                onClick: function() {
                    tb_show( 'Blabla bla', '#TB_inline?width=' + 750 +
                        '&height=' + 550 + '&inlineId=ea-dialog' );
                    zobrazReporty();
                },
            }
        );
    };

    wp.richText.registerFormatType(
        'easyminer-integration/report-format', {
            title: EasyMinerGutenbergLocalizeFormat.easyminer_report,
            tagName: 'samp',
            className: null,
            edit: MyCustomButton,
        }
    );
} )( window.wp );