( function( blocks, editor, i18n, element, components, _, plugins) {

    // var registerPlugin = plugins.registerPlugin;
    // var el = element.createElement;
    var tridy = {
        'button': true,
        'thickbox': true
    };

    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var Button = wp.element.Button;
    var PluginSidebar = wp.editPost.PluginSidebar;
    var PluginSidebarMoreMenuItem = wp.editPost.PluginSidebarMoreMenuItem;
    var registerPlugin = wp.plugins.registerPlugin;

    registerPlugin( 'easyminer-integration', {
        icon: 'analytics',
        render: EasyminerIntegrationButton,
    } );
    
    function EasyminerIntegrationButton() {
        // return
        // el(
        //     'a',
        //     {
        //         classNames: tridy,
        //         id: 'ea-tlacitko',
        //         href: '#TB_inline?&width=600&height=550&inlineId=ea-dialog'
        //     }
        // );
        return el(
            Fragment,
            {},
            el(
                PluginSidebarMoreMenuItem,
                {
                    target: 'sidebar-name',
                },
                'My Sidebar'
            ),
            el(
                PluginSidebar,
                {
                    name: 'sidebar-name',
                    title: 'My Sidebar',
                },
                el(
                    'a',
                    {
                        class: 'button thickbox',
                        id: 'ea-tlacitko',
                        href: '#TB_inline?&width=600&height=550&inlineId=ea-dialog'
                    },
                    'Content'
                )
            )
        );
    }
} )(
    window.wp.blocks,
    window.wp.editor,
    window.wp.i18n,
    window.wp.element,
    window.wp.components,
    window._,
    window.wp.plugins
);

