const mix = require('laravel-mix');
const LiveReloadPlugin = require('webpack-livereload-plugin');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.options({ publicPath: 'public' });
mix.copyDirectory('resources/assets/images', 'public/images')
mix.copyDirectory('resources/assets/svg', 'public/svg')
    .copyDirectory('resources/assets/fonts', 'public/fonts')
    .copyDirectory('resources/js', 'public/js')
    .postCss('resources/assets/css/app.css', 'public/css', [
        require('tailwindcss'),
        require('autoprefixer')
    ])
    .browserSync('localhost:8000'); // Add BrowserSync for live reloading

mix.webpackConfig({
    devServer: {
        hot: true,
        host: 'localhost',
        port: 8080,
        proxy: {
            '*': 'http://localhost:8000'
        },
        headers: {
            'Access-Control-Allow-Origin': '*'
        }
    }
});