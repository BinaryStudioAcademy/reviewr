App.Router = Backbone.Router.extend({

    routes: {
        "!/users": "users",
        "!/user/:id": "showUserProfile",
        "!/requests": "requests",
        "!/request/create": "createRequest",
        "!/request/:id": "showRequestDetails",
        "!/request/:id/offer": "offerRequest",
        "!/request/:id/accept": "acceptRequest",
        "!/request/:id/decline": "declineRequest"
    },

    users: function() {
        console.log('Route usersListView');
        users.fetch();
        new App.Views.UsersList();
    },

    showUserProfile: function(id) {
        var user = new App.Models.User({id: id});
        console.log('Route userProfile', id, user.attributes);
        user.fetch({wait: true}); // with id
        var userProfile = new App.Views.UserProfile({model: user});
        user.trigger("change");
    },

    requests: function() {
        console.log('Route RequestListView');
        requests.fetch();
        new App.Views.RequestsList();
    },

    createRequest: function() {
        (new App.Views.CreateRequestForm()).render();
    },

    showRequestDetails: function(id) {
        var request = new App.Models.Request({id: id});
        console.log('Route requestDetails', id, request.attributes);
        request.fetch({wait: true}); // with id
        var requestDetails = new App.Views.RequestDetails({model: request});
        request.trigger("change");
    }



});

var router = new App.Router();

Backbone.history.start();