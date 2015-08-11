App.Router = Backbone.Router.extend({

    routes: {
        "": "home",
        "!/users": "users",
        "!/user/:id": "showUserProfile",
        "!/requests": "requests",
        "!/request/create": "createRequest",
        "!/request/:id": "showRequestDetails",
        "!/request/:id/offer": "offerRequest",
        "!/request/:id/accept": "acceptRequest",
        "!/request/:id/decline": "declineRequest",
        "!/tags": "tags"
    },
    
    home: function () {
        this.navigate('!/requests', true)
    },
    
    users: function() {
        console.log('Route usersListView');
        users.fetch();
        new App.Views.UsersList().render();
    },

    showUserProfile: function(id) {
        var user = new App.Models.User({id: id});
        console.log('Route userProfile', id, user.attributes);
        user.fetch({wait: true}); // with id
        new App.Views.UserProfile({model: user}).render();
    },

    requests: function() {
        console.log('Route RequestListView');
        requests.fetch();
        new App.Views.RequestsList().render();
    },

    createRequest: function() {
        var requestForm = new App.Views.CreateRequestForm({
            el: '#main-content',
            model: new App.Models.Request()
        });
        requestForm.render();
    },

    showRequestDetails: function(id) {
        
        var request = new App.Models.Request({id: id});
        
        console.log('Route requestDetails', id, request);
        
        request.fetch({wait: true}); // with id
        
        reviewers.url = 'api/v1/reviewrequest/' + id + '/offers';
        request_tags.url = "api/v1/reviewrequest/" + id + "/tags";
        
        reviewers.fetch({wait: true});
        request_tags.fetch({wait: true});

        new App.Views.RequestDetails({model: request}).render();
    },

    tags: function() {
        console.log("Route: !/tags");
        tags.fetch();
        new App.Views.TagsList();
    }


});

var router = new App.Router();

Backbone.history.start();