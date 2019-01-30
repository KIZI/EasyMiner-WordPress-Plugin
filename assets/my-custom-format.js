console.log('my-custom-format.js');
( function( wp ) {
    var MyCustomButton = function( props ) {
        return wp.element.createElement(
            wp.editor.RichTextToolbarButton, {
                icon: 'editor-code',
                className: 'ea-tlacitko',
                title: 'Sample output',
                onClick: function() {
                    tb_show( 'oik Shortcodes', '#TB_inline?width=' + 750 +
                        '&height=' + 550 + '&inlineId=ea-dialog' );
                    $.ajax({
                        type: "GET",
                        url: ajaxurl,
                        data: {
                            action: 'zobraz_reporty',
                        },
                        success:function (data) {
                            $('#ea-tb-container').html(data);
                        },
                        error:function (errorThrown) {
                            console.log(errorThrown);
                        }
                    });
                },
            }
        );
    }

    wp.richText.registerFormatType(
        'my-custom-format/sample-output', {
            title: 'Sample output',
            tagName: 'samp',
            className: null,
            edit: MyCustomButton,
        }
    );
} )( window.wp );

(function abs(data) {
    console.log('NEEXOOO')


})(window.wp.data);