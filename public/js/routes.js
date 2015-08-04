App.Router = Backbone.Router.extend({

    routes: {
        "users": "users",
        "user/:id": "userProfile",
        "requests": "requests"
    },

    users: function() {
        console.log('Route usersListView');
        users.fetch();
        new App.Views.UsersList();
    },

    userProfile: function() {
        console.log('Route userProfile');
        users.fetch(); // TODO with id
        new App.Views.UserProfile();
    },

    requests: function() {
        console.log('Route RequestListView');
        requests.fetch();
        new App.Views.RequestsList();
    }


});

new App.Router();

Backbone.history.start();