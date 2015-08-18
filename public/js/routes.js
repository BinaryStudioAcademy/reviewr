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
        "!/requests/group/:group_id": "sortRequestsByGroups",
        "!/requests/tag/:tag_id": "sortRequestsByTags",
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
        users.url = App.getPrefix() + "/user";
        new App.Views.UsersList().render();
    },

    highestReputaionUsers: function() {
        console.log("Route: !/users/high_rep");
        users.url = App.getPrefix() + "/users/high_rep";
        new App.Views.UsersList().render();
    },

    showUserProfile: function(id) {
        $('#spinner').show();
        var user = new App.Models.User({id: id});
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
        new App.Views.RequestsList({collection: offeredRequests}).render();
    },

    popularRequests: function() {
        console.log("Route: !/requests/popular");
        requests.url = App.getPrefix() + "/reviewrequest/popular";
        new App.Views.RequestsList().render();
    },

    highestRatedRequests: function() {
        console.log("Route: !/requests/high_rate");
        requests.url = App.getPrefix() + "/reviewrequest/high_rate";
        new App.Views.RequestsList().render();
    },

    sortRequestsByGroups: function(group_id) {
        console.log("Route: !/requests/group/" + group_id);
        requests.url = App.getPrefix() + "/reviewrequest/group/" + group_id;
        new App.Views.RequestsList().render();
    },

    sortRequestsByTags: function(tag_id) {
        requests.url = App.getPrefix() + "/reviewrequest/tag/" + tag_id;
        new App.Views.RequestsList().render();
    },

    showRequestDetails: function(id) {

        var request = new App.Models.Request({id: id});
        console.log('Route requestDetails');
        $('#spinner').show();
        request.fetch({wait: true}).then(function(){
            new App.Views.RequestDetails({model: request}).render();
            $('#spinner').hide();
        });

        //reviewers.url = App.getPrefix() + '/reviewrequest/' + id + '/offers';
        //request_tags.url = App.getPrefix() + '/reviewrequest/' + id + '/tags';
        //
        //
        //request_tags.fetch({wait: true});
        //reviewers.fetch({wait: true}).then(function(){
        //    new App.Views.RequestDetails({model: request}).render();
        //});

    },


    tags: function() {
        console.log("Route: !/tags");
        tags.url = App.getPrefix() + "/tag";
        new App.Views.TagsList().render();
    },

    popularTags: function(){
        console.log("Route: !/tags/popular");
        tags.url = App.getPrefix() + "/tags/popular";
        new App.Views.TagsList().render();
    },

    search: function() {
        console.log("Route: !/search");
        new App.Views.Search().render();
    }


});

var router = new App.Router();

Backbone.history.start();