/*
 *---------------------------------------------------
 *  Global App View
 *---------------------------------------------------
 */

App.Views.App = Backbone.View.extend({
    initialize: function() {
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
    collection: users,
    el: '#main-content',
    initialize: function() {
        this.collection.on('remove', this.render, this);
    },
    render: function(){
        this.$el.empty();

        var that = this;

        this.collection.fetch({
            success: function(users, res, req){
                if (!users.length) {
                    console.log('Render No-Users view here');
                } else {
                    _.each(users.models, function (user) {
                        var userView = new App.Views.User({model: user});
                        that.$el.append(userView.render().$el);
                        console.log('render User');
                    });
                }
            },
            reset: true
        });
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
    className: 'col-xs-12 col-sm-6 col-md-4 request',
    initialize: function(){
        this.template = _.template($('#request-card-template').html());
        this.model.on('change', this.render, this);
        //this.model.on('destroy', this.render, this);
    },
    events: {
        'click .request-offer-btn': 'createOffers',
        'click .request-details-btn': 'showDetails',
        'click .request-delete-btn': 'deleteRequest'
    },
    createOffers: function () {
        reviewers.url = App.apiPrefix + '/user/0/offeron/' + this.model.get('id');
        reviewers.fetch({wait: true});
        return this;
    },
    showDetails: function () {
        router.navigate('!/request/' + this.model.get('id'), true);
        return this;
    },
    deleteRequest: function () {
        this.stopListening();
        this.model.destroy({wait: true});
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
        console.log(this.collection);

        this.stopListening();
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
        var that = this;

        this.stopListening();
        // Fetch Request Details
        this.$el.html( this.template(this.model.toJSON()) );

        // Fetch Request Author
        var author = new App.Models.User(this.model.get('user'));
        this.$el.find('.requestor').html( (new App.Views.User({model: author})).render().el);

        // Fetch Request Reviewers (Offers)
        var reviewersBlock = this.$el.find('.reviewers');
        reviewersBlock.empty();
        var req_id = this.model.get('id');
        _.each(reviewers.toArray(), function(reviewer, request_id) {
            reviewersBlock.append( (new App.Views.Reviewer({model: reviewer, request_id: req_id }) ).render().el );
        }, this);

        // Fetch Request Tags
        var request_tags_list = this.$el.find(".tags");
        request_tags_list.empty();
        _.each(request_tags.toArray(), function(request_tag) {
            request_tags_list.append( (new App.Views.Tag({model: request_tag}) ).render().el );
            console.log('render Tag');
        }, this);

        // X-Editable field

        // Check review request belong to auth user
        if (this.model.get('user_id') == authUserId) {
            $('#title').editable({
                mode: 'inline',
                type: 'text',
                name: 'title',
                success: function(response, newValue) {
                    that.model.set('title', newValue); //update backbone model
                    that.model.save(null, {patch: true});
                }
            });
            $('#details').editable({
                mode: 'inline',
                type: 'textarea',
                name: 'details',
                success: function(response, newValue) {
                    that.model.set('details', newValue); //update backbone model
                    that.model.save(null, {patch: true});
                }
            });
        }


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
        
        var tags = $('.tags-input').tokenfield('getTokens');
        for (var i = 0; i < tags.length; i++) {
            tags[i]= tags[i].value;
        }

        this.model.set({
            id: null,
            title: $('.title-input').val(),
            details: $('.details-input').html(),
            tags: tags,
            group_id: $('input[name="group-input"]:checked').val()
        });
        this.stopListening()
        this.$el.empty();
        this.model.save(null, {
            success: function(rq) {
                router.navigate('!/request/' + rq.get("id"), true);
            }
        });
    },
    render: function() {
        this.$el.html(this.template);

        // WYSIWYG Editor show
        $('#editor').wysiwyg();

        $('.tags-input').tokenfield();
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
    request_id: 0,
    className: "reviewer",
    initialize: function(options){
        this.request_id = options.request_id;
        this.template = _.template($('#reviewer-card-template').html());

    },
    events: {
        'click .accept': 'acceptOffer',
        'click .decline': 'declineOffer',
    },
    acceptOffer: function () {
        reviewers.url = App.apiPrefix + '/user/0/accept/' + this.request_id;
        reviewers.fetch({wait: true});
        return this;
    },
    declineOffer: function () {
        reviewers.url = App.apiPrefix + '/user/0/decline/' + this.request_id;
        reviewers.fetch({wait: true});
        return this;
    },
    render: function(){
        this.$el.html(this.template( this.model.toJSON() ));
        
        return this;
    }
});

// Backbone Views for all reviewers
// TODO: rewrite w/o sync. See requests!!!

App.Views.Reviewers = Backbone.View.extend({
    collection: reviewers,
    el: '#main-content',
    initialize: function() {
        this.collection.on('remove', this.render, this);
    },
    render: function(){
        this.$el.empty();

        var that = this;

        this.collection.fetch({
            success: function(reviewers, res, reviewer) {
                _.each(requests.models, function(reviewer) {
                    that.renderReviewer(reviewer);
                    console.log('Reviewer Model Render');
                });
            },
            reset: true
        });

    },
    renderReviewer: function(reviewer) {
        var reviewerView = new App.Views.Reviewer({model: reviewer});
        this$el.find('.reviewers').append(reviewerView.render().$el);
    }
});


/*
 *---------------------------------------------------
 *  Tag View
 *---------------------------------------------------
 */

 App.Views.Tag = Backbone.View.extend({
    model: tag,
    tagName: 'li',
    initialize: function(){
        this.template = _.template($('#tag-template').html());
    },
    render: function(){
        this.$el.html(this.template( this.model.toJSON() ));
        return this;
    }
 });


 /*
 *---------------------------------------------------
 *  Tags List View
 *---------------------------------------------------
 */

 App.Views.TagsList = Backbone.View.extend({
    collection: tags,
    el: "#main-content",
    template: _.template($("#tags-list-template").html()),
    initialize: function() {
        this.collection.on('remove', this.render, this);
    },
    render: function(){
        this.$el.empty();

        var that = this;

        this.collection.fetch({
            success: function(tags, res, tag) {
                if (!tags.length) {
                    // Render Empty View Here
                } else {
                    that.$el.html(that.template());
                    _.each(tags.models, function(tag) {
                        that.renderTag(tag);
                        console.log('Tag Model Render');
                    });
                }
            },
            reset: true
        });
    },
    renderTag: function(tag) {
        var tagView = new App.Views.Tag({model: tag});
        this.$el.find('.tags').append(tagView.render().$el);
    }
 });


 /*
 *---------------------------------------------------
 *  Search View
 *---------------------------------------------------
 */

 App.Views.Search = Backbone.View.extend({
    el: "#main-content",
    template: _.template($("#search-view-template").html()),
    
    events: {
        "keyup #search-input": "keywordSearch"
    },

    keywordSearch: _.debounce(function(){
        if ($("#search-input").val().length >= 2)
        {
            this.renderResults(this.f());
        } else {
            console.log("Min Length Of Search Keyword: 2");
        }
    }, 1000),

    f: function() {
        Backbone.ajax({
            type: "POST",
            async: false,
            data: "keyword" + "=" + $("#search-input").val(),
            url: "/api/v1/tags/search",
            success: function(data) {
                content = data;
            }
        });
        console.log(content);
        return content;
    },

    render: function() {
        console.log("Render Search Page Template");
        this.$el.empty();
        this.$el.html(this.template);
    },

    renderResults: function(res) {
        var search_results_div = this.$el.find(".search-results");

        search_results_div.empty();

        console.log("Render Search Results");
        
        _.each(res, function(r){
            search_results_div.append('<div class="text-center">' + '<p>' + r.id + '</p>' + '<p>' + r.title + '</p>' + '</div>');
        });
    }
 });