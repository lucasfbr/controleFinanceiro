const elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir(function (mix) {

    mix.styles([
        '../../../node_modules/materialize-css/dist/css/materialize.css',
        '../../../resources/assets/css/style.css',
        //'../../../node_modules/bootstrap/dist/css/bootstrap.css'

    ], 'public/css/styles.css');

    mix.scripts([
        '../../../node_modules/jquery/dist/jquery.js',
        '../../../node_modules/jquery-mask-plugin/dist/jquery.mask.js',
        '../../../node_modules/materialize-css/dist/js/materialize.js',
        '../../../resources/assets/js/funcoes.js',
        //'../../../node_modules/bootstrap/dist/js/bootstrap.js'
    ], 'public/js/scripts.js');

    mix.browserify('main.js')

    //pega o conteudo de uma pasta e joga em outra pasta
    //nete caso de node_modules/font-awesome/fonts para /public/fonts/
    //mix.copy('node_modules/font-awesome/fonts', 'public/fonts');

    mix.copy('node_modules/materialize-css/dist/fonts', 'public/fonts');

    //mix.copy('node_modules/ionicons/fonts', 'public/fonts');

})
