/*
 *---------------------------------------------------
 *  Users Model
 *---------------------------------------------------
 */

App.Models.User = Backbone.Model.extend({
    urlRoot: App.apiPrefix + '/user',
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
    urlRoot: App.apiPrefix + '/reviewrequest',
    defaults: {
        title: '',
        details: '',
        tags: '',
        group: '',
        created_at: '',
        reputation: ''
    }
});

var request = new App.Models.Request();


/*
 *---------------------------------------------------
 *  Reviewer Model
 *---------------------------------------------------
 */

App.Models.Reviewer = Backbone.Model.extend({
    urlRoot: App.apiPrefix + '/reviewer',
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


/*
 *---------------------------------------------------
 *  Tag Model
 *---------------------------------------------------
 */

 App.Models.Tag = Backbone.Model.extend({
    urlRoot: App.apiPrefix + '/tag',
    defaults: {
        id: null,
        title: ""
    }
 });

 var tag = new App.Models.Tag();