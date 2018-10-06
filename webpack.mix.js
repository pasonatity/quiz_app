const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/public_views/item.js', 'public/js/public_views')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/public_views/index.scss', 'public/css/public_views')
    .sass('resources/sass/public_views/item.scss', 'public/css/public_views');
