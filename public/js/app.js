(function () {
    window.App = {
        Models: {},
        Collections: {},
        Views: {},
        Router: {},

        prefix: window.APP_PREFIX,
        apiPrefix: '/api/v1',
        websocketPort: 5588,

        getPrefix: function () {
            return this.prefix + this.apiPrefix
        },

        getSitePrefix: function () {
            return this.prefix;
        },

        poller: ''
    };
}());
