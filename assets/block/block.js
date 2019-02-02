( function( blocks, editor, i18n, element, components, _) {

	var el = wp.element.createElement;
	var __ = wp.i18n.__;

	wp.blocks.registerBlockType(
		'easyminer-integration/easyminer-report',
		{
			title: 'Easyminer Report',
			category: 'widgets', //TODO: jakou tam mám dát kategorii?
			supportHTML: true,

			attributes: {
				//TODO: tady budou atributy, jestli budu nějaké potřebovat
			},

			edit: function (props) {

				return (
					el(
						'div', {} ,
						el('div', {className: 'ea-block-container'},
							el('a', {
								className: 'button thickbox ea-tlacitko button-primary',
								href: '#TB_inline?width=750&height=550&inlineId=ea-dialog',
								onclick: zobrazReporty()
							}, 'Zobraz Reporty')
						),
						el('p', {className: 'jsem-tu'} )
					)
				);
			},
			save() {
				// Renderuje se v PHP
				return null;
			},
		}
	);
} )(
	window.wp.blocks,
	window.wp.editor,
	window.wp.i18n,
	window.wp.element,
	window.wp.components,
	window._
);

