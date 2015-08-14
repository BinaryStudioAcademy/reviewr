(function() {
    window.App = {
        Models: {},
        Collections: {},
        Views: {},
        Router: {},

        prefix: 'reviewr',
        apiPrefix: '/api/v1',

        getPrefix: function() {
            return this.prefix + this.apiPrefix
        }

    };



}());