App.Router = Backbone.Router.extend({
    routes: {
        "": "home",
        "!/user/:id": "showUserProfile",
        "!/requests": "requests",
        "!/request/create": "createRequest",
        "!/requests/my": "showMyRequest",
        "!/requests/offered": "offeredRequests",
        "!/requests/popular": "popularRequests",
        "!/requests/high_rate": "highestRatedRequests",
        "!/requests/group/:group_id": "sortRequestsByGroups",
        "!/requests/user/:user_id": "sortRequestsByUser",
        "!/requests/tag/:tag_id": "sortRequestsByTags",
        "!/request/:id": "showRequestDetails",
        "!/request/:id/offer": "offerRequest",
        "!/request/:id/accept": "acceptRequest",
        "!/request/:id/decline": "declineRequest",
        "!/tags": "tags",
        "!/tags/popular": "popularTags",
        "!/notifications": "notifications",
        "!/tags/cloud": "tagsCloud",
        "!/logout": "logout"
    },

    home: function () {
        this.navigate('!/requests', true)
    },

    showUserProfile: function (id) {
        $('#spinner').show();
        var user = new App.Models.User({id: id});
        user.fetch({wait: true}); // with id
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
        new App.Views.RequestsList({collection: myRequests}).render();
    },

    offeredRequests: function () {
        new App.Views.RequestsList({collection: offeredRequests}).render();
    },

    popularRequests: function () {
        requests.url = App.getPrefix() + "/reviewrequest/popular";
        new App.Views.RequestsList().render();
    },

    highestRatedRequests: function () {
        requests.url = App.getPrefix() + "/reviewrequest/high_rate";
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

    tags: function () {
        tags.url = App.getPrefix() + "/tag";
        new App.Views.NewTagsList().render();
    },

    popularTags: function () {
        tags.url = App.getPrefix() + "/tags/popular";
        new App.Views.NewTagsList().render();
    },

    tagsCloud: function () {
        new App.Views.TagsCloud().render();
    },

    notifications: function () {
        new App.Views.NotificationsList().render();
    },
    
    logout: function () {
        var logoutUrl = 'http://' + window.location.hostname + '/' + App.getSitePrefix() + '/auth/logout';
        window.location.assign(logoutUrl);
    }
});

var router = new App.Router();

Backbone.history.start();