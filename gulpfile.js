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



elixir(function (mix) {
    mix.styles([
        "bootstrap.css",
        "jquery-ui.css",
        "select2.min.css",
        "bootstrap-editable.css",
        "jqcloud.min.css",
        "styles.css",
        "bootstrap-datetimepicker.css",
        "emojione.min.css",
        "jquery.textcomplete.css"
    ]);

    mix.scripts([
        "vendor/jquery/jquery.js",
        "vendor/bootstrap/bootstrap.js",
        "vendor/jquery/jqueryui.js",
        "vendor/underscore/underscore.js",
        "vendor/backbone/backbone.js",
        "vendor/bootstrap/bootstrap-datetimepicker.min.js",
        "vendor/jcloud/jqcloud.min.js",
        "vendor/select2/select2.full.min.js",
        "vendor/backbone/backbone.poller.min.js",
        "vendor/backbone/backbone.validation.min.js",
        "vendor/bootstrap-editable.min.js",
        "vendor/emojione.min.js",
        "vendor/jquery.textcomplete.min.js",
        "vendor/jquery.textcomplete.emojione.js",
        "app.js",
        "models.js",
        "collections.js",
        "views.js",
        "routes.js",
    ]);

    mix.version([
        'css/all.css',
        'js/all.js'
    ]);
});