App.Router = Backbone.Router.extend({

    routes: {
        "": "home",
        "!/users": "users",
        "!/users/high_rep": "highestReputaionUsers",
        "!/user/:id": "showUserProfile",
        "!/requests": "requests",
        "!/request/create": "createRequest",
        "!/requests/my": "showMyRequest",
        "!/requests/offered": "offeredRequests",
        "!/requests/popular": "popularRequests",
        "!/requests/high_rate": "highestRatedRequests",
        "!/requests/group/php": "phpGroupeRequests",
        "!/requests/group/net": "netGroupeRequests",
        "!/requests/group/js": "jsGroupeRequests",
        "!/request/:id": "showRequestDetails",
        "!/request/:id/offer": "offerRequest",
        "!/request/:id/accept": "acceptRequest",
        "!/request/:id/decline": "declineRequest",
        "!/tags": "tags",
        "!/tags/popular": "popularTags",
        "!/search": "search"
    },
    
    home: function () {
        this.navigate('!/requests/my', true)
    },
    
    users: function() {
        console.log('Route usersListView');
        users.fetch();
        new App.Views.UsersList().render();
    },

    highestReputaionUsers: function() {
        console.log("Route: !/users/high_rep");
        //
    },

    showUserProfile: function(id) {
        var user = new App.Models.User({id: id});
        console.log('Route userProfile', id, user.attributes);
        user.fetch({wait: true}); // with id
        new App.Views.UserProfile({model: user}).render();
    },

    requests: function() {
        console.log('Route RequestListView');
        new App.Views.RequestsList().render();
    },

    createRequest: function() {
        var requestForm = new App.Views.CreateRequestForm({
            el: '#main-content',
            model: new App.Models.Request()
        });
        requestForm.render();
    },

    showMyRequest: function() {
        console.log('Route MyRequest');
        new App.Views.RequestsList({collection: myRequests}).render();
    },

    offeredRequests: function() {
        console.log("Route: !/requests/offered");
        //
    },

    popularRequests: function() {
        console.log("Route: !/requests/popular");
        //
    },

    highestRatedRequests: function() {
        console.log("Route: !/requests/high_rate");
        //
    },

    phpGroupeRequests: function() {
        console.log("Route: !/requests/group/php");
        //
    },

    netGroupeRequests: function() {
        console.log("Route: !/requests/group/net");
        //
    },

    jsGroupeRequests: function() {
        console.log("Route: !/requests/group/js");
        //
    },
    
    showRequestDetails: function(id) {
        
        var request = new App.Models.Request({id: id});
        
        console.log('Route requestDetails', id, request);
        
        request.fetch({wait: true}); // with id
        
        reviewers.url = App.apiPrefix + '/reviewrequest/' + id + '/offers';
        request_tags.url = App.apiPrefix + '/reviewrequest/' + id + '/tags';
        
        request_tags.fetch({wait: true});
        reviewers.fetch({wait: true}).then(function(){
            new App.Views.RequestDetails({model: request}).render();
        });


    },

    tags: function() {
        console.log("Route: !/tags");
        new App.Views.TagsList().render();
    },

    popularTags: function(){
        console.log("Route: !/tags/popular");
        //
    },

    search: function() {
        console.log("Route: !/search");
        new App.Views.Search().render();
    }


});

var router = new App.Router();

Backbone.history.start();