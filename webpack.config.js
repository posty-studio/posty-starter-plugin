const path = require( 'path' );
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

module.exports = {
	...defaultConfig,
	entry: {
		admin: './src/js/admin/index.js',
		app: './src/js/app/index.js',
	},
	output: {
		filename: 'js/[name].js',
		path: path.resolve( 'assets' ),
	},
};
