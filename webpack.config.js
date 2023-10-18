const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

module.exports = {
	...defaultConfig,
	entry: {
		...defaultConfig.entry(),
		app: './src/js/app/index.js',
		admin: './src/js/admin/index.js',
	},
};
