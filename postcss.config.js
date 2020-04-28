module.exports = ({ file, options, env }) => ({
    plugins: {
        'postcss-import': true,
        'postcss-preset-env': true,
        cssnano: env === 'production'
    }
});
