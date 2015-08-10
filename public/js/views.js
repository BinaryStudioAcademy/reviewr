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
    model: user,
    className: "user-card",
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
        console.log('render UserList starting...');
        _.each(this.model.toArray(), function(user){
            this.$el.append( (new App.Views.User({model: user})).render().el );
            console.log('render User');
        }, this);
        console.log('render UserList end.');
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
    model: request,
    className: "col-xs-12 col-sm-6 col-md-4 request",
    initialize: function(){
        this.template = _.template($('#request-card-template').html());
        this.model.on('change', this.render, this);
    },
    events: {
        'click .request-offers-btn': 'createOffers',
        'click .request-details-btn': 'showDetails'
    },
    createOffers: function () {

        return this;
    },
    showDetails: function () {
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
    collection: requests,
    el: '#main-content',
    initialize: function() {
        this.collection.on('remove', this.render, this);
    },
    render: function() {
        this.$el.empty();

        var that = this;

        this.collection.fetch({
            success: function(requests, res, req) {
                if (!requests.length) {
                    console.log('Render empty view here!!');
                } else {
                    _.each(requests.models, function(rq) {
                        that.renderRequest(rq);
                        console.log('render Request');
                    });
                }
            },
            reset: true
        });
    },

    renderRequest: function(rq) {
        var requestView = new App.Views.Request({model: rq});
        this.$el.append(requestView.render().$el);
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

        // Fetch Request Author
        var author = new App.Models.User(this.model.get('user'));
        this.$el.find('.requestor').html( (new App.Views.User({model: author})).render().el);

        // Fetch Request Reviewers
        var reviewersBlock = this.$el.find('.reviewers');
        reviewersBlock.empty();
        _.each(reviewers.toArray(), function(reviewer){
            reviewersBlock.append( (new App.Views.Reviewer({model: reviewer}) ).render().el );
            console.log('render Request');
        }, this);

        console.log('render Request Details');
        return this;
    }
});

// Backbone Views for Review Request Creation Form

App.Views.CreateRequestForm = Backbone.View.extend({
    template: _.template($('#create-request-form-template').html()),
    events: {
        'submit': 'storeRequest'
    },
    initialize: function(options) {
        this.model = options.model;
    },
    storeRequest: function(e) {
        e.preventDefault();
        this.model.set({
            title: $('.title-input').val(),
            details: $('.details-input').val(),
            tags: $('.tags-input').val(),
            group_id: $('input[name="group-input"]:checked').val()
        });
        this.model.save(null, {
            success: function(rq) {
                router.navigate('!/request/' + rq.get("id"), true);
            }
        });
    },
    render: function() {
        this.$el.html(this.template);
        return this;
    }
});


/*
 *---------------------------------------------------
 *  Reviewer View
 *---------------------------------------------------
 */

// Backbone Views for one reviewer small card

App.Views.Reviewer = Backbone.View.extend({
    model: reviewer,
    className: "reviewer",
    initialize: function(){
        this.template = _.template($('#reviewer-card-template').html());
    },
    events: {
    },
    render: function(){
        this.$el.html(this.template( this.model.toJSON() ));
        return this;
    }
});

// Backbone Views for all reviewers
// TODO: rewrite w/o sync. See requests!!!

App.Views.Reviewers = Backbone.View.extend({
    model: reviewers,
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
        _.each(this.model.toArray(), function(reviewer){
            this.$el.find('.reviewers').append( (new App.Views.Reviewer({model: reviewer})).render().el );
            console.log('render Reviewer');
        }, this);

        return this;
    }
});