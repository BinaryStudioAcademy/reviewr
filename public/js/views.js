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
    template: _.template($('#user-card-template').html()),
    initialize: function(){
    },
    events: {
        'click .show-user': 'show'
    },
    show: function () {
        // Show popup without change history
        //router.navigate('!/user/' + this.model.get("id"), true);
        router.showUserProfile(this.model.get("id"));
        return this;
    },
    render: function(){
        this.$el.html(this.template( this.model.toJSON() ));
        return this;
    }
});

// Backbone Views for author of request (also use model user, but another template)

App.Views.Author = Backbone.View.extend({
    model: user,
    template: _.template($('#author-card-template').html()),
    initialize: function(){
    },
    events: {
        'click .show-user': 'show'
    },
    show: function () {
        // Show popup without change history
        //router.navigate('!/user/' + this.model.get("id"), true);
        router.showUserProfile(this.model.get("id"));
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
        $('#spinner').show();
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
                $('#spinner').hide();
            },
            reset: true
        });
        return this;
    }
});

// Backbone Views for user profile

App.Views.UserProfile = Backbone.View.extend({
    model: user,
    el: '#popup',
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
        $('#spinner').hide();
        $('#myModal').modal();
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
    offers: 0,
    className: 'col-xs-12 col-sm-6 col-md-4 request',
    initialize: function(options){
        this.offers = options.offers;
        this.template = _.template($('#request-card-template').html());
        this.model.on('change', this.render, this);
    },
    events: {
        'click .request-offer-btn': 'createOffers',
        'click .request-details-btn': 'showDetails',
        'click .request-delete-btn': 'deleteRequestConfirm',
        'click .undo-offer-btn': 'undoOfferConfirm'
    },
    createOffers: function () {
        reviewers.url = App.getPrefix() + '/user/0/offeron/' + this.model.get('id');
        reviewers.fetch({wait: true});
        this.model.set({'offers_count': this.current() + 1});
        this.$el.find('.request-offer-btn').html('Undo');
        this.$el.find('.request-offer-btn').addClass('undo-offer-btn');
        this.$el.find('.request-offer-btn').removeClass('request-offer-btn');
        
       
        return this;
    },
    showDetails: function () {
        router.navigate('!/request/' + this.model.get('id'), true);
        return this;
    },
    current: function() {
        return this.model.get('offers_count');
    },
    deleteRequestConfirm: function () {
        var that = this;
        var confirmModal = new App.Views.ConfirmModal({
            cb: function(){
                //use that to run functions for this view
                that.deleteRequest();
            },
            body: "Delete this review request"
        });
        confirmModal.render();
    },
    deleteRequest: function () {
        this.stopListening();
        this.model.destroy({wait: true});
        this.remove();
    },
    undoOfferConfirm: function() {
        var that = this;
        var confirmModal = new App.Views.ConfirmModal({
            cb: function(){
                //use that to run functions for this view
                that.undoOffer();
            },
            body: "Undo your offer to this review request"
        });
        confirmModal.render();
    },
    undoOffer: function() {
        reviewers.url = App.getPrefix() + '/user/offeroff/' + this.model.get('id');
        reviewers.fetch({wait: true});
        this.model.set({'offers_count': this.current() - 1});
        this.$el.find('.undo-offer-btn').html('Offer');
        this.$el.find('.undo-offer-btn').addClass('request-offer-btn');
        this.$el.find('.undo-offer-btn').removeClass('undo-offer-btn');
        //If you want finally remove offer from list uncomment this
        //this.remove();
    },
    render: function(){
        var data = {offer : this.model.toJSON()};
        for (var i = 0; i < this.offers.length; i++) {
            if (this.offers[i].id == this.model.get('id')) {
                data.status = 'You send offer';
            }
        };
        this.$el.html(this.template( data ));
        return this;
    }
});

// Backbone Views for all review requests

App.Views.RequestsList = Backbone.View.extend({
    collection: requests,
    el: '#main-content',
    initialize: function() {
    },
    render: function() {
        console.log(this.collection);
        this.stopListening();
        this.$el.empty();
        $('#spinner').show();

        var that = this;
        var offers;
        reviewers.url = App.getPrefix() + '/myrequests';
        reviewers.fetch({
        async:false,
        success: function(requests, res, req) {
                offers = res.message;
           }
        });
        console.log(offers);
  
        this.collection.fetch({
            success: function(requests, res, req) {
                if (!requests.length) {
                    console.log('Render empty view here!!');
                } else {
                    _.each(requests.models, function(rq) {
                        that.renderRequest(rq, offers);
                        console.log('render Request');
                    });
                }
                $('#spinner').hide();
            },
            reset: true
        });
    },

    renderRequest: function(rq, offers) {
        var requestView = new App.Views.Request({model: rq, offers: offers});
        this.$el.append(requestView.render().$el);
    }
});

// Backbone Views for Review Request Details

App.Views.RequestDetails = Backbone.View.extend({
    model: request,
    el: '#main-content',
    initialize: function(){
        this.template = _.template($('#review-request-details-template').html());
        // Temporary blocked because Like btn render all page
        //this.model.on('change', this.render, this);
    },
    events: {
        'click .back-request': 'back',
        'click .like': 'like',
        'click .undo-like': 'undoLike',
    },
    back: function () {
        router.navigate('!/requests', true);
        return this;
    },

    like: function () {
        //users.url = App.getPrefix() + '/reputationUp/' + this.model.get('id');
        //users.fetch();
        this.model.save({
            reputation: parseInt(this.model.get('reputation')) + 1
        }, {
            patch: true
        });
        this.$el.find('.like').html('Undo like').addClass('undo-like').removeClass('like');
        $('#reputation').text(this.model.get('reputation'));
        return this;
    },
   
    undoLike: function () {
        //users.url = App.getPrefix() + '/reputationDown/' + this.model.get('id');
        //users.fetch();
        this.model.save({
            reputation: parseInt(this.model.get('reputation'))-1
        }, {
            patch: true
        });
        this.$el.find('.undo-like').html('Like').addClass('like').removeClass('undo-like');
        $('#reputation').text(this.model.get('reputation'));
        return this;
    },

    checkVote: function(){
        return _.contains(_.pluck(this.model.get('votes'), 'id'), authUserId);
    },

    render: function(){
       
        var that = this;

        this.stopListening();

        // Fetch All Request Details
        this.$el.html( this.template(this.model.toJSON()) );
        // Render Request Author
        var author = new App.Models.User(this.model.get('user'));
        this.$el.find('.requestor').html((new App.Views.Author({
            model: author
        })).render().el);

        var tags = this.model.get('tags');

        // Fetch Request Reviewers (Offers)
        var reviewersBlock = this.$el.find('.reviewers');

        reviewersBlock.empty();

        var req_id = this.model.get('id');
        var user_id = this.model.get('user_id');

        //
        //var offers;
        //users.url = App.getPrefix() + '/usersforrequest/' + this.model.get('id');
        //users.fetch({
        //async:false,
        //success: function(requests, res, req) {
        //        offers = res.message;
        //   }
        //});
        //users.url = App.getPrefix() + '/reviewrequest/'+ this.model.get('id') + '/checkvote';
        //var check;
        //users.fetch({
        //async:false,
        //success: function(requests, res, req) {
        //       check = res.toString();
        //   }
        //});
        //
        
        if (this.checkVote()) {
            this.$el.find('.like').html('Undo like');
            this.$el.find('.like').addClass('undo-like');
            this.$el.find('.like').removeClass('like');
        }
        //
        //console.log(offers);

        // ????
        //users.url = App.getPrefix() + '/reviewrequest/'+ this.model.get('id') +'/checkvote';

        var reviewers = this.model.get('users');
        _.each(reviewers, function (reviewer, request_id) {
            reviewersBlock.append((new App.Views.Reviewer({
                model: reviewer,
                request_id: req_id,
                author_id: user_id,
                acceptOffers: reviewers
            }) ).render().el);
        }, this);

        // Render Request Tags
        var request_tags_list = this.$el.find(".tags");
        request_tags_list.empty();
        _.each(tags, function(tag) {
            request_tags_list.append( (new App.Views.Tag({model: tag}) ).render().el );
            console.log('render Tag', tag);
        }, this);

        // Render Comments
        comments.url = App.getPrefix() + '/reviewrequest/' + req_id + '/comment';
        new App.Views.CommentsList({'rid': req_id}).render()



        // X-Editable field

        // Check review request belong to auth user
        if (this.model.get('user_id') == authUserId) {
            $('#title').editable({
                mode: 'inline',
                type: 'text',
                inputclass: 'input-title',
                name: 'title',
                success: function(response, newValue) {
                    that.model.save({title: newValue}, {patch: true}); //update backbone model
                }
            });
            $('#details').editable({
                mode: 'inline',
                type: 'textarea',
                name: 'details',
                success: function(response, newValue) {
                    that.model.save({details: newValue}, {patch: true}); //update backbone model
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
    
    bindings: {
        '[name=title]': {
            observe: 'title',
            setOptions: {
                validate: true
            }
        },
        '[name=date_review]': {
            observe: 'date_review',
            setOptions: {
                validate: true
            }
        }    
    },

    initialize: function(options) {
        this.model = options.model;
        Backbone.Validation.bind(this);
    },
    storeRequest: function(e) {
        e.preventDefault();

        var tags = $('.tags-input').tokenfield('getTokens');
        for (var i = 0; i < tags.length; i++) {
            tags[i]= tags[i].value;
        }

        console.log(tags);
        this.model.set({
            id: null,
            title: $('.title-input').val(),
            details: $('.details-input').html(),
            tags: tags,
            group_id: $('input[name="group-input"]:checked').val(),
            date_review:  $('#date_review').val(),
        });

        this.stopListening()
        console.log(this.model.isValid());

        if(this.model.isValid(true)) { 
            this.model.save(null, {
                success: function(rq) {
                    router.navigate('!/request/' + rq.get("id"), true);
                }
            });
            this.$el.empty();
        }
    },
    render: function() {
        this.$el.html(this.template);
        // WYSIWYG Editor show
        $('#editor').wysiwyg();
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), nowDate.getHours(), nowDate.getMinutes(), 0, 0);
        $("#date_review").datetimepicker({
            autoclose: true,
            startDate: today,
            format: 'yyyy-mm-dd hh:ii'
        });
        $('.tags-input').tokenfield();
        return this;
    },

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
    author_id: 0,
    acceptOffers:0,
    className: "reviewer text-center col-md-2 col-sm-3 col-xs-6",
    initialize: function(options){
        this.acceptOffers = options.acceptOffers;
        this.request_id = options.request_id;
        this.author_id = options.author_id;
        this.template = _.template($('#reviewer-card-template').html());
        //this.on('change', this.render, this);

    },
    events: {
        'click .accept': 'acceptOffer',
        'click .decline': 'declineOffer',
    },
    acceptOffer: function () {
        reviewers.url = App.getPrefix() + '/user/' + this.model.id + '/accept/' + this.request_id;
        reviewers.fetch({wait: true});
        this.$el.find('.accept').html('Decline');
        this.$el.find('.accept').addClass('decline btn-danger');
        this.$el.find('.accept').removeClass('accept btn-primary');
        return this;
    },
    declineOffer: function () {
        reviewers.url = App.getPrefix() + '/user/'+ this.model.id +'/decline/' + this.request_id;
        reviewers.fetch({wait: true});
        this.$el.find('.decline').html('Accept');
        this.$el.find('.decline').addClass('accept btn-primary');
        this.$el.find('.decline').removeClass('decline btn-danger');

        return this;
    },
    render: function(){
        var data = {
                   author_id : this.author_id,
                   offer : this.model};
      
        for (var i = 0; i < this.acceptOffers.length; i++) {
            if (this.acceptOffers[i].id == this.model.id) {
                data.status = 'You accepted';
            }
        };
        this.$el.html(this.template(data ));
        
        return this;
    }
});

// Backbone Views for all reviewers

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
        this.$el.find('.reviewers').append(reviewerView.render().$el);
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
        this.$el.html(this.template( this.model ));
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
        $('#spinner').show();
        var that = this;

        this.collection.fetch({
            success: function(tags, res, tag) {
                if (!tags.length) {
                    console.log('Render No-Tags view here');
                } else {
                    that.$el.html(that.template());
                    _.each(tags.models, function(tag) {
                        that.renderTag(tag);
                        console.log('Tag Model Render');
                    });
                }
                $('#spinner').hide();
            },
            reset: true
        });
    },
    renderTag: function(tag) {
        var tagView = new App.Views.Tag({model: tag.toJSON()});
        this.$el.find('.tags').append(tagView.render().$el);
    }
 });


/*
 *---------------------------------------------------
 *  New Tag View
 *---------------------------------------------------
 */

 App.Views.NewTag = Backbone.View.extend({
    model: tag,
    className: 'col-sm-2 col-xs-4',
    id: 'tag-tile',
    template: _.template($('#new-tag-template').html()),
    render: function(){
        this.$el.html(this.template( this.model ));
        return this;
    }
 });


 /*
 *---------------------------------------------------
 *  New Tags List View
 *---------------------------------------------------
 */

 App.Views.NewTagsList = Backbone.View.extend({
    collection: tags,
    el: "#main-content",
    template: _.template($("#new-tags-list-template").html()),
    initialize: function() {
        this.collection.on('remove', this.render, this);
    },
    render: function(){
        this.$el.empty();
        $('#spinner').show();
        var that = this;

        this.collection.fetch({
            success: function(tags, res, tag) {
                if (!tags.length) {
                    console.log('Render No-Tags view here');
                } else {
                    that.$el.html(that.template());
                    _.each(tags.models, function(tag) {
                        that.renderTag(tag);
                        console.log('Tag Model Render');
                    });
                }
                
                /* carousel initialize */
                $('.carousel').carousel();
                /* end carousel initialize */

                /* ready element resize */
                $(".tile").height($(".tile").width());
                $(".carousel").height($(".tile").width());
                $(".item").height($(".tile").width());
                /* ready element resize */

                $('#spinner').hide();
            },
            reset: true
        });
    },
    renderTag: function(tag) {
        var tagView = new App.Views.NewTag({model: tag.toJSON()});
        this.$el.find('#tags-list').append(tagView.render().$el);
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
    }, 250),

    f: function() {
        Backbone.ajax({
            type: "POST",
            async: false,
            data: "keyword" + "=" + $("#search-input").val(),
            url: App.getPrefix() + "/tags/search",
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
            search_results_div.append('<div class="thumbnail text-center">' + '<p>' + r.id + '</p>' + '<p>' + r.title + '</p>' + '</div>');
        });
    }
 });

/*
 *---------------------------------------------------
 *  Confirm Modal View
 *---------------------------------------------------
 */

App.Views.ConfirmModal = Backbone.View.extend({
    el: "#confirm-modal",
    events: {
        "click .btn-ok": "runCallBack"
    },
    initialize: function(args){
        var that = this;
        this.$el.on('hide.bs.modal', function(){
            that.undelegateEvents();
        }),
        this.$el.find('.modal-body').html("<p>"+args.body+"</p>");
        this.cb = args.cb;
    },
    render: function(){
        this.$el.modal('show');
    },
    runCallBack: function(){
        this.cb();
    }
});


/*
 *---------------------------------------------------
 *  Notification View
 *---------------------------------------------------
 */

 App.Views.Notification = Backbone.View.extend({
    model: notification,
    tagName: 'li',
    initialize: function(){
        this.template = _.template($('#notification-template').html());
    },
    render: function(){
        this.$el.html(this.template( this.model ));
        return this;
    }
 });


 /*
 *---------------------------------------------------
 *  Notification List View
 *---------------------------------------------------
 */

 App.Views.NotificationsList = Backbone.View.extend({
    collection: notifications,
    el: "#main-content",
    template: _.template($("#notifications-list-template").html()),
    initialize: function() {
        this.collection.on('remove', this.render, this);
    },
    
    render: function(){
        this.$el.empty();
        $('#spinner').show();
        var that = this;

        this.collection.fetch({
            success: function(notifications, res, notification) {
                if (!notifications.length) {
                    console.log('Render No-Tags view here');
                } else {
                    that.$el.html(that.template());
                    _.each(notifications.models, function(notification) {
                        that.renderNotifications(notification);
                        console.log('Tag Model Render');
                    });
                }
                $('#spinner').hide();
            },
            reset: true
        });
    },


    renderNotifications: function(notification) {
        var notificationView = new App.Views.Notification({model: notification.toJSON()});
        this.$el.find('.notifications').append(notificationView.render().$el);
    }
});

/*
 *---------------------------------------------------
 *  Comment View
 *---------------------------------------------------
 */

// Backbone Views for one comment

App.Views.Comment = Backbone.View.extend({
    model: comment,
    className: 'list-group-item single-comment',
    template: _.template($('#single-comment-template').html()),
    initialize: function(){
    },
    events: {
        'click .delete-btn': 'deleteComment'
    },
    deleteComment: function () {
        // Delete comment action
        console.log('Comment ' + this.model.get('id') + ' deleted');
        return this;
    },
    render: function(){
        this.$el.html(this.template( this.model ));  //toJSON() ???
        return this;
    }
});


// Backbone Views for comments list

App.Views.CommentsList = Backbone.View.extend({
    model: comment,
    collection: comments,
    el: "#chat-region",
    template: _.template($("#comments-list-template").html()),
    events: {
        'submit': 'storeComment'
    },

    bindings: {
        '[name=text]': {
            observe: 'text',
            setOptions: {
                validate: true
            }
        },
 
    },

    initialize: function(options) {
        var that = this;
        this.options = options;
        this.collection.on('remove', this.render, this);
        this.collection.on('add', this.renderComment, this);
        Backbone.Validation.bind(this);
        //App.poller = Backbone.Poller.get(this.collection, {delay: 2000}).start();
       
    },
    render: function() {
        this.stopListening();
        this.$el.empty();
        $('#spinner').show();  // May be not need

        var that = this;

        this.collection.fetch({
            success: function(comments, res, req) {
                if (!comments.length) {
                    console.log('Render No-comment view here');
                } else {
                    that.$el.html(that.template());
                    _.each(comments.models, function(comment) {
                        that.renderComment(comment);
                        console.log('Comment Render');
                    });
                }
                $('#spinner').hide();
            },
            reset: true
        });
    },

    renderComment: function(comment) {
        var commentView = new App.Views.Comment({model: comment.toJSON()});
        this.$el.find('#comments-list').append(commentView.render().el);
    },

    renderLastComment: function(comment){
        this.renderComment(comment);
        $("html, body").animate({ scrollTop: $(document).height() }, 500);
    },
    storeComment: function(e) {
        e.preventDefault();
        this.stopListening();

        // rid already exist after render comments
        //var rid = this.options.rid;
        this.model.set({
            id: null,
            text: $('#text').val(),
        });
        
        if (this.model.isValid(true)) {

            this.collection.create({
                text: $('#text').val(),
            }, {
                wait: true
            });

            console.log(comment);
            $('#text').val('');
        }
    }
});


/*
 *---------------------------------------------------
 *  Tags Cloud Page View
 *---------------------------------------------------
 */

 App.Views.TagsCloud = Backbone.View.extend({
    collection: tags,
    el: '#main-content',
    render: function() {
        
        this.$el.empty();

        $('#spinner').show();

        var that = this;

        this.collection.fetch({
            success: function(model, response, options){
                var words = tags.models.map(function(tag_model) {
                    return {
                        text: tag_model.attributes.title,
                        weight: _.random(8, 60),
                        link: "#!/requests/tag/" + tag_model.attributes.id,
                    };
                });
                that.cloudRender(words);
                $('#spinner').hide();
            }});
    },
    cloudRender: function(words){
        this.$el.html('<div id="tags-cloud"></div>');
        $('#tags-cloud').jQCloud(words, {autoResize: true});
    }
 });