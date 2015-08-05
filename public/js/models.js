/*
 *---------------------------------------------------
 *  Users Model
 *---------------------------------------------------
 */

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


/*
 *---------------------------------------------------
 *  Request Model
 *---------------------------------------------------
 */

App.Models.Request = Backbone.Model.extend({
    urlRoot: 'api/v1/reviewrequest',
    defaults: {
        title: '',
        details: '',
        tags: '',
        group: ''
    }
});

var request = new App.Models.Request();


/*
 *---------------------------------------------------
 *  Reviewer Model
 *---------------------------------------------------
 */

App.Models.Reviewer = Backbone.Model.extend({
    urlRoot: 'api/v1/reviewer',
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

var reviewer = new App.Models.Reviewer();