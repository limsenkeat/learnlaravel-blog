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
    .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'resources/css/libs/sb-admin-2.css'

], 'public/css/libs.css');

mix.scripts([
    'resources/js/libs/jquery/jquery.js',
    'resources/js/libs/jquery-easing/jquery.easing.js',
    'resources/js/sb-admin-2.js',

], 'public/js/libs.js');