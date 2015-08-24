requirejs.config({
    baseUrl: 'js',
    paths: {
        backbone: 'vendor/backbone/backbone',
        jquery: 'vendor/backbone/jquery',
        underscore: 'vendor/backbone/underscore',
        bootstrap: 'vendor/bootstrap/bootstrap.min',
        validation: 'vendor/backbone/backbone.validation',
        stickit: 'vendor/backbone/backbone.stickit',
        'moment': 'vendor/moment/moment-with-locales.min',
    },
    shim: {
        underscore: {
            exports: '_'
        },
        backbone: {
            deps: ['jquery', 'underscore'],
            exports: 'Backbone'
        },
        bootstrap: ['jquery'],
        validation: ['backbone'],
    }
});
