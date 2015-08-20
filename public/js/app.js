(function() {
    window.App = {
        Models: {},
        Collections: {},
        Views: {},
        Router: {},

        prefix: window.APP_PREFIX,
        apiPrefix: '/api/v1',

        getPrefix: function() {
            return this.prefix + this.apiPrefix
        },

        poller: ''

    };



}());