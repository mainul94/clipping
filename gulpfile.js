const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss')
    .webpack('app.js');
    mix.sass('web_custom.scss');
    mix.sass('admin_customize.scss');
    mix.sass('../src/scss/custom.scss');
    mix.scripts('../src/js/custom.js','public/js/custom.js');
    mix.scripts('../src/js/dropzone.js','public/js/dropzone.js');
    mix.scripts('../src/js/helpers/smartresize.js','public/js/smartresize.js');
    mix.copy('resources/assets/src/js/helpers/panel.js','public/js/panel.js');
    mix.copy('resources/assets/vendors/','public/vendors/');
});