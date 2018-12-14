/**
 * Internal block libraries
 */

import { withState } from '@wordpress/compose';

const { __ } = wp.i18n;

const {
	PluginSidebar,
	PluginSidebarMoreMenuItem
} = wp.editPost;

const { createBlock } = wp.blocks;

const {
	PanelBody,
	TextControl,
	Button,
	TreeSelect
} = wp.components;

const {
	Component,
	Fragment
} = wp.element;

const {
	dispatch
} = wp.data;

const { registerPlugin } = wp.plugins;



const MyTreeSelect = withState( {
	page: 'p21',
} )( ( { page, setState } ) => (
	<TreeSelect
		label="Parent page"
		noOptionLabel="No parent page"
		onChange={ ( page ) => setState( { page } ) }
		selectedId={ page }
		tree={ [
			{
				name: 'Page 1',
				id: 'p1',
				children: [
					{ name: 'Descend 1 of page 1', id: 'p11' },
					{ name: 'Descend 2 of page 1', id: 'p12' },
				],
			},
			{
				name: 'Page 2',
				id: 'p2',
				children: [
					{
						name: 'Descend 1 of page 2',
						id: 'p21',
						children: [
							{
								name: 'Descend 1 of Descend 1 of page 2',
								id: 'p211',
							},
						],
					},
				],
			},
		] }
	/>
) );

class Easyminer_Integration_Sidebar extends Component {

	render() {
		const onClickButton = value => {
			dispatch('core/editor').insertBlocks(createBlock('easyminer-integration/click-to-tweet'));
		};
		return (
			<Fragment>
				<PluginSidebarMoreMenuItem
					target="easyminer-integration-sidebar">
					{__('Hello Easyminer Integration')}
				</PluginSidebarMoreMenuItem>
				<PluginSidebar
					name="easyminer-integration-sidebar"
					title={ __( 'Easyminer Integration' ) }
				>
					<PanelBody>
						<MyTreeSelect/>

						<Button onClick={onClickButton}>Vložit blok</Button>
					</PanelBody>
				</PluginSidebar>
			</Fragment>
		)
	}
}

registerPlugin( 'easyminer-integration', {
	icon: 'analytics',
	render: Easyminer_Integration_Sidebar,
} );
