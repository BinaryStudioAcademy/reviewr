App.Models.User = Backbone.Model.extend({
    urlRoot: 'api/v1/user',
    defaults: {
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        avatar: '',
        address: '',
        reputation: ''
    }
});

var user = new App.Models.User();

App.Models.Request = Backbone.Model.extend({
    urlRoot: 'api/v1/reviewrequest',
    defaults: {
        title: '',
        details: '',
        tags: '',
        group: '',
    }
});

var request = new App.Models.Request();