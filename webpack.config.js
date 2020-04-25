/**
 * External dependencies
 */
const path = require('path');

/**
 * WordPress dependencies
 */
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
    ...defaultConfig,
    entry: {
        editor: './src/js/editor/index.js',
        frontend: './src/js/frontend/index.js',
    },
    output: {
        filename: '[name].js',
        path: path.resolve('assets/js'),
    },
    resolve: {
        alias: {
            '@components': path.resolve(__dirname, 'src/js/shared/components'),
        },
    },
};
