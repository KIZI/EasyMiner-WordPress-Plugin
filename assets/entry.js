( function( blocks, editor, i18n, element, components, _, plugins) {

    var el = wp.element.createElement;
    var Fragment = wp.element.Fragment;
    var PluginSidebar = wp.editPost.PluginSidebar;
    var PluginSidebarMoreMenuItem = wp.editPost.PluginSidebarMoreMenuItem;
    var registerPlugin = wp.plugins.registerPlugin;

    registerPlugin( 'easyminer-integration', {
        icon: 'analytics',
        render: EasyminerIntegrationButton,
    } );
    
    function EasyminerIntegrationButton() {

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
                'Content of the sidebar'
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

