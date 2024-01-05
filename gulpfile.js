var elixir = require('laravel-elixir');

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

/*
elixir(function(mix) {
	 mix.styles([
        "normalize.css",
        "main.css"
    ], 'public/build/css/everything.css', 'public/css') 
    .version('css/app.css');
    
});
*/

 

/*
elixir(function(mix) {
    mix.sass('app.scss')
    .version('css/app.css');
    
});
*/
 

/*
elixir(function(mix) {
    mix.styles([
        'normalize.css',
        'main.css'
    ]);
});
*/
/*
elixir(function(mix) {
    mix.version('css/all.css');
});
*/

/*
elixir(function(mix) {
    mix.version(['css/all.css', 'js/app.js']);
});
*/

elixir(function(mix) {
    mix.styles([
        "bootstrap.min.css",
        "font-awesome.min.css",
        "ionicons.min.css"
    ], 'build/css/packege1.css', 'build/style/bootstrap/css');
});
 

elixir(function(mix) {
    mix.styles([
        "AdminLTE.min.css",
        "bootstrap-rtl.min.css"
    ], 'build/css/packege2.css', 'build/style/dist/css');
});
 
 

elixir(function(mix) {
    mix.styles([
        "_all-skins.min.css"
    ], 'build/css/packege3.css', 'build/style/dist/css/skins');
});
 
 

elixir(function(mix) {
    mix.styles([
        "fonts-fa.css"
    ], 'build/css/packege4.css', 'build/style/dist/fonts');
});
 
 
 

elixir(function(mix) {
    mix.styles([
        "blue.css"
    ], 'build/css/packege5.css', 'build/style/plugins/iCheck/flat');
});
 
 
 

elixir(function(mix) {
    mix.styles([
        "morris.css"
    ], 'build/css/packege6.css', 'build/style/plugins/morris');
});
 
 
 

elixir(function(mix) {
    mix.styles([
        "jquery-jvectormap-1.2.2.css"
    ], 'build/css/packege7.css', 'build/style/plugins/jvectormap');
});
 
 
 

elixir(function(mix) {
    mix.styles([
        "fonts-fa.css"
    ], 'build/css/packege8.css', 'build/style/dist/fonts');
});
 
 
 

elixir(function(mix) {
    mix.styles([
        "fonts-fa.css"
    ], 'build/css/packege9.css', 'build/style/dist/fonts');
});
 








elixir(function(mix) {
    mix.version('css/packege1.css');
    
});
 
 
elixir(function(mix) {
    mix.version('css/packege2.css');
    
});
 
 
