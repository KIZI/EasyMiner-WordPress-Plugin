
import './style.scss';
import './editor.scss';

import classnames from 'classnames';
/**
 * Internal block libraries
 */
const { __ } = wp.i18n;

const { registerBlockType } = wp.blocks;

const{
	RichText,
	InspectorControls,
	BlockControls
} = wp.editor;

const {
	PanelBody,
	TextareaControl,
	TextControl,
	Dashicon,
	Toolbar,
	Button,
	Tooltip,
} = wp.components;

/**
 * Register block
 */
export default registerBlockType( 'easyminer-integration/click-to-tweet', {
	// Block Title
	title: __( 'Easyminer Report' ),
	// Block Description
	description: __( 'An example block for Easyminer Integration plugin' ),
	// Block Category
	category: 'common',
	// Block Icon
	icon: 'analytics',
	// Block Keywords
	keywords: [
		__( 'Boilerplate' ),
		__( 'Hello World' ),
		__( 'Example' ),
	],
	//You can use string, number, boolean & object as accepted types.
	attributes: {
		tweet: {
			type: 'string',
		},
		tweetsent: {
			type: 'string',
		},
		button: {
			type: 'string',
			default: __( 'Tweet' ),
		},
		theme: {
			type: 'boolean',
			default: false,
		},
	},
	supports: {
		inserter: false
	},
	// Defining the edit interface
	edit: props => {
		const onChangeTweet = value => {
			props.setAttributes( { tweet: value } );
		};
		const onChangeTweetSent = value => {
			props.setAttributes( { tweetsent: value } );
		};
		const onChangeButton = value => {
			props.setAttributes( { button: value } );
		};

		const toggletheme = value => {
			props.setAttributes( { theme: !props.attributes.theme } );
		};

		return [
			<div className={ props.className }>
				<div className={ ( props.attributes.theme ?
					'click-to-tweet-alt' : 'click-to-tweet' ) }>
					<div className="ctt-text">
						<RichText
							format="string"
							formattingControls={ [] }
							placeholder={ __( 'Tweet, tweet!' ) }
							onChange={ onChangeTweet }
							value={ props.attributes.tweet }
							//props.attributes odkazuje na atributy, které jsme definovali výše
						/>
					</div>
					<a className="ctt-btn">
						{ props.attributes.button }
					</a>
				</div>
			</div>,
			!! props.isSelected && (
				<InspectorControls key="inspector">
					<PanelBody title={ __( 'Tweet Settings' ) } >
						<TextareaControl
							label={ __( 'Tweet Text' ) }
							value={ props.attributes.tweetsent }
							onChange={ onChangeTweetSent }
							help={ __( 'You can add hashtags and mentions here ' +
								'that will be part of the actual tweet, but not of ' +
								'the display on your post.' ) }
						/>
						<TextControl
							label={ __( 'Button Text' ) }
							value={ props.attributes.button }
							onChange={ onChangeButton }
						/>
					</PanelBody>
				</InspectorControls>
			),
			!! props.isSelected && (
				<BlockControls key="custom-controls">
					<Toolbar
						className='components-toolbar'
					>
						<Tooltip text={ __( 'Alternative Design' ) }>
							<Button
								className={ classnames(
									'components-icon-button',
									'components-toolbar__control',
									{ 'is-active': props.attributes.theme }, // čum na tu syntaxi!!!
								) }
								onClick={toggletheme}
							>
								<Dashicon icon="tablet" />
							</Button>
						</Tooltip>
					</Toolbar>
				</BlockControls>
			),
		];

	},
	// Defining the front-end interface
	save() {
		// Rendering in PHP
		return null;
	},
});



