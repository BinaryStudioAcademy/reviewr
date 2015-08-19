/*
 *---------------------------------------------------
 *  Users Model
 *---------------------------------------------------
 */

App.Models.User = Backbone.Model.extend({
    urlRoot: App.getPrefix() + '/user',
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
    urlRoot: App.getPrefix() + '/reviewrequest',
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
    urlRoot: App.getPrefix() + '/reviewer',
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
    urlRoot: App.getPrefix() + "/tag",
    defaults: {
        id: null,
        title: ''
    }
 });

 var tag = new App.Models.Tag();


/*
 *---------------------------------------------------
 *  Comment Model
 *---------------------------------------------------
 */

App.Models.Comment = Backbone.Model.extend({
    urlRoot: App.getPrefix() + "/comment",
    defaults: {
        id: null,
        text: '',
        created_at: ''
    }
});

var comment = new App.Models.Comment();