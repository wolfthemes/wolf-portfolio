/* global wp */
/**
 * Last Works block editor script.
 *
 * Plain JS (no build step): server-side rendered preview + inspector controls.
 */
( function ( blocks, element, blockEditor, components, serverSideRender, i18n ) {
	var el = element.createElement;
	var __ = i18n.__;

	blocks.registerBlockType( 'wolf-portfolio/last-works', {
		edit: function ( props ) {
			var atts = props.attributes;

			return el(
				element.Fragment,
				null,
				el(
					blockEditor.InspectorControls,
					null,
					el(
						components.PanelBody,
						{ title: __( 'Settings', 'wolf-portfolio' ) },
						el( components.RangeControl, {
							label: __( 'Number of works', 'wolf-portfolio' ),
							value: atts.count,
							min: 1,
							max: 24,
							onChange: function ( value ) {
								props.setAttributes( { count: value } );
							},
						} ),
						el( components.RangeControl, {
							label: __( 'Columns', 'wolf-portfolio' ),
							value: atts.col,
							min: 1,
							max: 6,
							onChange: function ( value ) {
								props.setAttributes( { col: value } );
							},
						} ),
						el( components.TextControl, {
							label: __( 'Category (work type slug)', 'wolf-portfolio' ),
							value: atts.category,
							onChange: function ( value ) {
								props.setAttributes( { category: value } );
							},
						} ),
						el( components.ToggleControl, {
							label: __( 'Padding', 'wolf-portfolio' ),
							checked: 'yes' === atts.padding,
							onChange: function ( value ) {
								props.setAttributes( { padding: value ? 'yes' : 'no' } );
							},
						} )
					)
				),
				el(
					'div',
					blockEditor.useBlockProps(),
					el( serverSideRender, {
						block: 'wolf-portfolio/last-works',
						attributes: atts,
					} )
				)
			);
		},
		save: function () {
			return null; // Dynamic block, rendered server-side.
		},
	} );
} )( wp.blocks, wp.element, wp.blockEditor, wp.components, wp.serverSideRender, wp.i18n );
