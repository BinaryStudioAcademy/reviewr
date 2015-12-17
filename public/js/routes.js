App.Router = Backbone.Router.extend({
    routes: {
        "": "home",
        "!/user/:id": "showUserProfile",
        "!/requests": "requests",
        "!/request/create": "createRequest",
        "!/requests/my": "showMyRequest",
        "!/requests/offered": "offeredRequests",
        "!/requests/popular": "popularRequests",
        "!/requests/group/:group_id": "sortRequestsByGroups",
        "!/requests/user/:user_id": "sortRequestsByUser",
        "!/requests/tag/:tag_id": "sortRequestsByTags",
        "!/request/:id": "showRequestDetails",
        "!/request/:id/offer": "offerRequest",
        "!/request/:id/accept": "acceptRequest",
        "!/request/:id/decline": "declineRequest",
        "!/logout": "logout"
    },

    execute: function(callback, args, name) {
        if (!App.CurrentUser) {
            var currentUser = new App.Models.CurrentUser();
            var urlToReturn = Backbone.history.fragment;

            $.when(currentUser.getFromServer(urlToReturn)).done(function (user) {
                App.CurrentUser = user;

                if (!Backbone.history.navigate(urlToReturn, { trigger: true })) {
                    Backbone.history.loadUrl(urlToReturn);
                }
            });

            return false;
        } else {
            callback.apply(this, args);
        }
    },

    home: function () {
        this.navigate('!/requests', true)
    },

    showUserProfile: function (id) {
        $('#spinner').show();
        var user = new App.Models.User({id: id});
        user.fetch({
            wait: true,
            async: false
        }); // with id
        new App.Views.UserProfile({model: user}).render();
    },

    requests: function () {
        requests.url = App.getPrefix() + '/reviewrequest';
        new App.Views.RequestsList().render();
    },

    createRequest: function () {
        var requestForm = new App.Views.CreateRequestForm({
            el: '#main-content',
            model: new App.Models.Request()
        });
        requestForm.render();
    },

    showMyRequest: function () {
        new App.Views.RequestsList({
            collection: myRequests,
            messageForEmptyView: "You haven't created any requests yet"
        }).render();
    },

    offeredRequests: function () {
        new App.Views.RequestsList({
            collection: offeredRequests,
            messageForEmptyView: "You haven't offered any requests review yet"
        }).render();
    },

    popularRequests: function () {
        requests.url = App.getPrefix() + "/reviewrequest/popular";
        new App.Views.RequestsList().render();
    },

    sortRequestsByGroups: function (group_id) {
        requests.url = App.getPrefix() + "/reviewrequest/group/" + group_id;
        new App.Views.RequestsList().render();
    },

    sortRequestsByUser: function (user_id) {
        requests.url = App.getPrefix() + "/reviewrequest/user/" + user_id;
        new App.Views.RequestsList().render();
    },

    sortRequestsByTags: function (tag_id) {
        requests.url = App.getPrefix() + "/reviewrequest/tag/" + tag_id;
        new App.Views.RequestsList().render();
    },

    showRequestDetails: function (id) {
        var request = new App.Models.Request({id: id});
        $('#spinner').show();
        request.fetch({wait: true}).then(function () {
            new App.Views.RequestDetails({model: request}).render();
            $('#spinner').hide();
        });
    },

    // For logout throw the local link
    logout: function () {
        var logoutUrl = 'http://'
            + window.location.hostname
            + '/' + App.getSitePrefix()
            + '/users/logout';

        window.location.assign(logoutUrl);
    }
});

// Overriding for using token authorization
var sync = Backbone.sync;
Backbone.sync = function (method, model, options) {
    var error = function () {};
    var success = function () {};

    if (options.error) {
        error = options.error;
    }

    options.error = function (xhr, textStatus, errorThrown) {
        // If user is not authorized
        if (xhr.status === 401 ) {
            var urlToReturn = Backbone.history.fragment;
            // Fetch user from server
            var currentUser = new App.Models.CurrentUser();

            $.when(currentUser.getFromServer(urlToReturn)).done(function (user) {
                App.CurrentUser = user;

                if (!Backbone.history.navigate(urlToReturn, { trigger: true })) {
                    Backbone.history.loadUrl(urlToReturn);
                }
            });
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

var router = new App.Router();
Backbone.history.start();