let mix = require('laravel-mix');
let _ = require('lodash');
let jsonfile = require('jsonfile');

let vendor = jsonfile.readFileSync('./vendor.json');

let imagemin = require('imagemin-webpack-plugin').default;
let jpeg = require('imagemin-mozjpeg');

mix.webpackConfig({
    module: {
        rules: [{
            test: /\.scss/,
            loader: 'import-glob-loader'
        }]
    },
    plugins: [
        new imagemin({
            test: /\.(jpe?g)/i,
            plugins: [
                jpeg({
                    quality: 80,
                })
            ],
        }),
    ],
});

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/font.scss', 'public/css')
   .sass('resources/assets/sass/vendor.scss', 'public/css');

if (vendor.local.js.length > 0) {
    mix.extract(vendor.local.js, 'js/vendor.js');
}

if (vendor.local.css.length > 0) {
    _.forEach(vendor.local.css, (v) => {
        if (v[0].endsWith('.css')) {
            mix.postCss(`node_modules/${v[0]}`, `public/css/vendor/${v[1]}`);
        } else if (v[0].endsWith('.scss') || v[0].endsWith('.sass')) {
            mix.sass(`node_modules/${v[0]}`, `public/css/vendor/${v[1]}`);
        } else if (v[0].endsWith('.less')) {
            mix.less(`node_modules/${v[0]}`, `public/css/vendor/${v[1]}`);
        }
    });
}

mix.version();

if (! mix.inProduction()) {
    mix.disableNotifications();
}