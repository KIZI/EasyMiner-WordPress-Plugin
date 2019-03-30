( function( wp ) {

    var MyCustomButton = function( props ) {
        return wp.element.createElement(
            wp.editor.RichTextToolbarButton, {
                icon: 'analytics',
                className: null,
                title: EasyMinerGutenbergLocalizeFormat.easyminer_report,
                onClick: zobrazThickbox,
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