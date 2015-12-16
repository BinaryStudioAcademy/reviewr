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

    // Overriding for using token authorization
    Backbone.sync = function (method, model, options) {
        var error = function () {};
        var success = function () {};

        if (options.error) {
            error = options.error;
        }

        options.error = function (xhr, textStatus, errorThrown) {
            // If user is not authorized
            if (xhr.status === 401 ) {
                // Fetch user from server
                var user = new User.CurrentUserModel();
                user.fetch({wait: true});

                // Assign user
                App.User.Current = user;

                // Move back to the necessary route
                var url =  Backbone.history.fragment;

                if (!Backbone.history.navigate(url, { trigger: true })) {
                    Backbone.history.loadUrl(url);
                }
            } else if (xhr.status === 303 ) {
                location.reload();
            } else if (xhr.status === 302 ) {
                document.location = xhr.responseJSON.redirectTo;
            } else {
                error(xhr, textStatus, errorThrown);
            }
        };

        if (options.success) {
            success = options.success;
        }

        options.success = function (resp) {
            success(resp);
        };

        return sync(method, model, options);
    };
}());
