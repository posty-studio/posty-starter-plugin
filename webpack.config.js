/**
 * External dependencies
 */
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

/**
 * WordPress dependencies
 */
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
    ...defaultConfig,
    entry: {
        'js/editor': './src/js/editor/index.js',
        'js/frontend': './src/js/frontend/index.js',
        'css/editor': './src/css/editor.css',
        'css/frontend': './src/css/frontend.css'
    },
    output: {
        filename: '[name].js',
        path: path.resolve('assets')
    },
    resolve: {
        alias: {
            '@components': path.resolve(__dirname, 'src/js/shared/components')
        }
    },
    module: {
        ...defaultConfig.module,
        rules: [
            ...defaultConfig.module.rules,
            {
                test: /\.css$/i,
                use: [MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader']
            }
        ]
    },
    plugins: [...defaultConfig.plugins, new MiniCssExtractPlugin()]
};
