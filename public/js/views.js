/*
 *---------------------------------------------------
 *  Global App View
 *---------------------------------------------------
 */

App.Views.App = Backbone.View.extend({
    initialize: function() {
        console.log( this.collection.toJSON() );
    }
});

/*
 *---------------------------------------------------
 *  User View
 *---------------------------------------------------
 */

// Backbone Views for one user card

App.Views.User = Backbone.View.extend({
    model: new App.Models.User(),
    className: "user-card thumbnail",
    initialize: function(){
        this.template = _.template($('#user-card-template').html());
        this.templateProfile = _.template($('#user-profile-template').html());
    },
    events: {
        'click .select-user': 'select'
    },
    select: function () {
        $('#main-content').html('');
        $('#main-content').html(this.templateProfile( this.model.toJSON() ));
        return this;
    },
    render: function(){
        this.$el.html(this.template( this.model.toJSON() ));
        return this;
    }
});

// Backbone Views for all users

App.Views.UsersList = Backbone.View.extend({
    model: users,
    el: '#main-content',
    initialize: function() {
        this.model.on('sync', this.render, this);
        this.model.on('remove', this.render, this);
        this.model.on('invalid', function(error, message){
            alert(message);
        }, this);
        this.model.on('error', function (error, message) {
            alert(message.responseText);
        }, this);
    },
    render: function(){
        this.$el.html('');
        _.each(this.model.toArray(), function(user){
            this.$el.append( (new App.Views.User({model: user})).render().el );
            console.log('render User');
        }, this);

        return this;
    }
});

// Backbone Views for user profile

App.Views.UserProfile = Backbone.View.extend({
    model: new App.Models.User(),
    el: '#main-content',
    initialize: function(){
        this.template = _.template($('#user-profile-template').html());
    },
    events: {
        'click .cancel-user': 'cancel'
    },
    // ?????????????
    cancel: function () {
        $('#main-content').html('');
        users.render();
        return this;
    },
    render: function(){
        this.$el.html(this.template( this.model.toJSON() ));
        console.log('render UserProfile');
        return this;
    }
});


/*
 *---------------------------------------------------
 *  Review Request View
 *---------------------------------------------------
 */

// Backbone Views for one request card

App.Views.Request = Backbone.View.extend({
    model: new App.Models.Request(),
    className: "request-card thumbnail",
    initialize: function(){
        this.template = _.template($('#request-card-template').html());
    },
    events: {
        'click .request-accept': 'accept',
        'click .request-decline': 'decline'
    },
    accept: function () {

        return this;
    },
    decline: function () {

        return this;
    },
    render: function(){
        this.$el.html(this.template( this.model.toJSON() ));
        return this;
    }
});

// Backbone Views for all review requests

App.Views.RequestsList = Backbone.View.extend({
    model: requests,
    el: '#main-content',
    initialize: function() {
        this.model.on('sync', this.render, this);
        this.model.on('remove', this.render, this);
        this.model.on('invalid', function(error, message){
            alert(message);
        }, this);
        this.model.on('error', function (error, message) {
            alert(message.responseText);
        }, this);
    },
    render: function(){
        this.$el.html('');
        _.each(this.model.toArray(), function(request){
            this.$el.append( (new App.Views.Request({model: request})).render().el );
            console.log('render Request');
        }, this);

        return this;
    }
});

