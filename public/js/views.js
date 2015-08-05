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
    },
    events: {
        'click .select-user': 'select'
    },
    select: function () {
        router.navigate('!/user/' + this.model.get("id"), true);
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
    model: user,
    el: '#main-content',
    initialize: function(){
        this.template = _.template($('#user-profile-template').html());
        this.model.on('change', this.render, this);
    },
    events: {
        'click .cancel-user': 'cancel'
    },
    cancel: function () {
        router.navigate('!/users', true);
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
        'click .request-decline': 'decline',
        'click .request-details': 'details'
    },
    accept: function () {

        return this;
    },
    decline: function () {

        return this;
    },
    details: function () {
        router.navigate('!/request/' + this.model.get("id"), true);
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

// Backbone Views for Review Request Details

App.Views.RequestDetails = Backbone.View.extend({
    model: request,
    el: '#main-content',
    initialize: function(){
        this.template = _.template($('#review-request-details-template').html());
        this.model.on('change', this.render, this);
    },
    events: {
        'click .back-request': 'back'
    },
    back: function () {
        router.navigate('!/requests', true);
        return this;
    },
    render: function(){
        this.$el.html(this.template( this.model.toJSON() ));
        console.log('render Request Details');
        return this;
    }
});

// Backbone Views for Review Request Creation Form

App.Views.CreateRequestForm = Backbone.View.extend({

    el: '#main-content',
    initialize: function() {
        this.template = _.template($('#create-request-form-template').html());
    },
    events: {
        'submit': 'storeRequest'
    },
    storeRequest: function(e) {
        e.preventDefault();
        var request = new App.Models.Request({
            title: $('.title-input').val(),
            details: $('.details-input').val(),
            tags: $('.tags-input').val(),
            group: $('input[name="group-input"]:checked').val()
        });
        request.save();
        // TODO render one request card
    },
    render: function() {
        this.$el.html(this.template);
    }

});

