/*
 *---------------------------------------------------
 *  Users Collection
 *---------------------------------------------------
 */

App.Collections.Users = Backbone.Collection.extend({
    url: 'api/v1/user',
    model: App.Models.User

});

//instantiate collection of users

var users = new App.Collections.Users();


/*
 *---------------------------------------------------
 *  Requests Collection
 *---------------------------------------------------
 */

App.Collections.Requests = Backbone.Collection.extend({
    url: 'api/v1/reviewrequest',
    model: App.Models.Request

});

//instantiate collection of requests

var requests = new App.Collections.Requests();


/*
 *---------------------------------------------------
 *  Reviewer Collection
 *---------------------------------------------------
 */

App.Collections.Reviewers = Backbone.Collection.extend({
    url: 'api/v1/reviewrequest/:id/offers',
    model: App.Models.Reviewer

});

//instantiate collection of reviewers

var reviewers = new App.Collections.Reviewers();