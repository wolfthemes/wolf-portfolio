/**
 * Compiles src/styles/*.scss to assets/css/, where older themes
 * and the plugin enqueue (WFOLIO_CSS) expect the files.
 */
const path = require( 'path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const CssMinimizerPlugin = require( 'css-minimizer-webpack-plugin' );
const RemoveEmptyScriptsPlugin = require( 'webpack-remove-empty-scripts' );

const baseConfig = ( minimize ) => ( {
	entry: {
		portfolio: './src/styles/portfolio.scss',
	},
	output: {
		path: path.resolve( __dirname, 'assets/css' ),
	},
	module: {
		rules: [
			{
				test: /\.scss$/,
				use: [ MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader' ],
			},
		],
	},
	plugins: [
		new RemoveEmptyScriptsPlugin(),
		new MiniCssExtractPlugin( {
			filename: minimize ? '[name].min.css' : '[name].css',
		} ),
	],
	optimization: {
		minimize,
		minimizer: [ new CssMinimizerPlugin() ],
	},
	mode: 'production',
	devtool: false,
} );

module.exports = [ baseConfig( false ), baseConfig( true ) ];
