/*
 *---------------------------------------------------
 *  Global App View
 *---------------------------------------------------
 */
App.Views.App = Backbone.View.extend({
    initialize: function () {
        //
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
    initialize: function () {
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
    render: function () {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
});

// Backbone Views for author of request (also use model user, but another template)
App.Views.Author = Backbone.View.extend({
    model: user,
    template: _.template($('#author-card-template').html()),
    initialize: function () {
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
    render: function () {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
});

// Backbone Views for all users
App.Views.UsersList = Backbone.View.extend({
    collection: users,
    el: '#main-content',
    initialize: function () {
        this.collection.on('remove', this.render, this);
    },
    render: function () {
        this.$el.empty();
        $('#spinner').show();
        var that = this;

        this.collection.fetch({
            success: function (users, res, req) {
                if (!users.length) {
                    console.log('Render No-Users view here');
                } else {
                    _.each(users.models, function (user) {
                        var userView = new App.Views.User({model: user});
                        that.$el.append(userView.render().$el);
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
    initialize: function () {
        this.template = _.template($('#user-profile-template').html());
    },
    events: {
        'click .cancel-user': 'cancel'
    },
    cancel: function () {
        router.navigate('!/users', true);
        return this;
    },
    render: function () {
        this.$el.html(this.template(this.model.toJSON()));
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
    initialize: function (options) {
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
        reviewers.url = App.getPrefix()
            + '/user/'
            + App.CurrentUser.get('binary_id')
            + '/offeron/'
            + this.model.get('id');
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
    current: function () {
        return this.model.get('offers_count');
    },
    deleteRequestConfirm: function () {
        var that = this;
        var confirmModal = new App.Views.ConfirmModal({
            cb: function () {
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
    undoOfferConfirm: function () {
        var that = this;
        var confirmModal = new App.Views.ConfirmModal({
            cb: function () {
                //use that to run functions for this view
                that.undoOffer();
            },
            body: "Undo your offer to this review request"
        });
        confirmModal.render();
    },
    undoOffer: function () {
        reviewers.url = App.getPrefix() + '/user/offeroff/' + this.model.get('id');
        reviewers.fetch({wait: true});
        this.model.set({'offers_count': this.current() - 1});
        this.$el.find('.undo-offer-btn').html('Offer');
        this.$el.find('.undo-offer-btn').addClass('request-offer-btn');
        this.$el.find('.undo-offer-btn').removeClass('undo-offer-btn');
    },
    render: function () {
        var data = {
            offer: this.model.toJSON()
        };

        for (var i = 0; i < this.offers.length; i++) {
            if (this.offers[i].id == this.model.get('id')) {
                data.status = 'You send offer';
            }
        }

        this.$el.html(this.template(data));
        return this;
    }
});

// Backbone Views for all review requests
App.Views.RequestsList = Backbone.View.extend({
    collection: requests,
    el: '#main-content',
    messageForEmptyView: 'There is no requests yet',

    initialize: function (options) {
        if (options && options.messageForEmptyView) {
            this.messageForEmptyView = options.messageForEmptyView;
        }

        this.collection.on('remove', function (model, collection, options) {
            if (!collection.length) {
                this.render();
            }
        }, this);
    },
    render: function () {
        this.stopListening();
        this.$el.empty();
        $('#spinner').show();

        var self = this;
        var offers;
        reviewers.url = App.getPrefix() + '/myrequests';
        reviewers.fetch({
            async: false,
            success: function (requests, res, req) {
                offers = res.message;
            }
        });

        this.collection.fetch({
            success: function (requests, res, req) {
                if (!requests.length) {
                    var emptyView = new App.Views.EmptyView({
                        message: self.messageForEmptyView
                    });
                    emptyView.render();
                } else {
                    _.each(requests.models, function (rq) {
                        rq.attachFormattedDate(['date_review', 'created_at']);
                        self.renderRequest(rq, offers);
                    });
                }
                $('#spinner').hide();
            },
            reset: true
        });
    },

    renderRequest: function (rq, offers) {
        var requestView = new App.Views.Request({model: rq, offers: offers});
        this.$el.append(requestView.render().$el);
    }
});

// Backbone Views for Review Request Details
App.Views.RequestDetails = Backbone.View.extend({
    model: request,
    el: '#main-content',
    initialize: function () {
        this.template = _.template($('#review-request-details-template').html());
        this.model.on(
            'change:formatted_date_review',
            function () {
                $('#date_review').html(this.model.get('formatted_date_review'));
            },
            this
        );
    },
    events: {
        'click .back-request': 'back',
        'click .delete-date-review': 'clearDateReview',
        'mouseenter .date-review': 'showDeleteButton',
        'mouseleave .date-review': 'hideDeleteButton'
    },
    back: function () {
        router.navigate('!/requests', true);
        return this;
    },

    clearDateReview: function () {
        this.model.set('date_review', null);
        this.model.save({date_review: null}, {patch: true}); //update backbone model
        this.hideDeleteButton();
        $('#date_review').html('Assign');
    },

    showDeleteButton: function () {
        if (
            this.isAuthor(this.model.get('user_id'))
            && this.model.get('date_review')
        ) {
            $('.delete-date-review').show();
        }
    },

    hideDeleteButton: function () {
        $('.delete-date-review').hide();
    },

    isAccepted: function () {
        // Find Object with myOffer info
        var myOffer = _.findWhere(
            this.model.get('users'),
            {
                id: App.CurrentUser.get('id')
            }
        );

        if (myOffer) {
            // I am accepted or no?
            return (myOffer.pivot.isAccepted == 1);
        } else {
            // I am not offer
            return false;
        }
    },

    isAuthor: function (userId) {
        // If request user id == logged user
        return (userId == App.CurrentUser.get('id'));
    },

    showDateError: function () {
        $('.date-review').addClass('has-error');
        $('.date-review .help-block').removeClass('hidden');
        var self = this;

        setTimeout(function () {
            self.hideDateError();
        }, 2000)
    },

    hideDateError: function () {
        $('.date-review').removeClass('has-error');
        $('.date-review .help-block').addClass('hidden');
    },

    render: function () {
        var self = this;
        this.stopListening();

        // Fetch All Request Details
        this.$el.html(this.template(this.model.toJSON()));

        // Render Request Author
        var author = new App.Models.User(this.model.get('user'));
        this.$el.find('.requestor').html(
            (new App.Views.Author({
                model: author
            })).render().el);

        var tags = this.model.get('tags');

        // Fetch Request Reviewers (Offers)
        var reviewersBlock = this.$el.find('.reviewers');
        reviewersBlock.empty();

        var req_id = this.model.get('id');
        var user_id = this.model.get('user_id');

        var reviewers = this.model.get('users');

        if(_.isEmpty(reviewers)) {
            this.$el.find('.reviewers-header').append(' There are no reviewers for now');
        } else {
            _.each(reviewers, function (reviewer, request_id) {
            reviewersBlock.append(
                (new App.Views.Reviewer({
                    model: reviewer,
                    request_id: req_id,
                    author_id: user_id,
                    acceptOffers: reviewers
                })).render().el);
            }, this);
        }

        // Render Request Tags
        var request_tags_list = this.$el.find(".tags");
        request_tags_list.empty();
        _.each(tags, function (tag) {
            request_tags_list.append((new App.Views.Tag({model: tag}) ).render().el);
        }, this);

        // Render Comments (if user accepted or author of RR)
        if (this.isAccepted() || this.isAuthor(user_id)) {
            comments.url = App.getPrefix() + '/reviewrequest/' + req_id + '/comment';
            new App.Views.CommentsList({'rid': req_id}).render();
        } else {
            console.log ('Chat is blocked for user: ' + user_id);
        }

        // X-Editable field
        // Check review request belong to auth user
        if (this.model.get('user_id') == App.CurrentUser.get('id')) {
            $('#title').editable({
                mode: 'inline',
                type: 'text',
                inputclass: 'input-title',
                name: 'title',
                success: function (response, newValue) {
                    self.model.save({title: newValue}, {patch: true}); //update backbone model
                }
            });

            $('#details').editable({
                mode: 'inline',
                type: 'textarea',
                name: 'details',
                success: function (response, newValue) {
                    self.model.save({details: newValue}, {patch: true}); //update backbone model
                }
            });

            $('#date_review').editable({
                mode: 'popup',
                type: 'datetime',
                name: 'date_review',
                display: false,
                clear: 'Clear the date',
                autoclose: true,
                placement: 'right',
                setStartDate: new Date(),
                datetimepicker: {
                    startDate: new Date(),
                    todayBtn: true,
                    minuteStep: 10
                },
                success: function (response, newValue) {
                    var oldValue = self.model.roungToMinutes(new Date());
                    newValue = self.model.roungToMinutes(newValue);

                    if (newValue.getTime() === oldValue.getTime()) {
                        self.showDateError();
                        return;
                    }

                    var globalDateTime = self.model.formatToGlobal(newValue);
                    self.model.save({date_review: globalDateTime}, {patch: true}); //update backbone model
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
        'submit': 'storeRequest',
        'click .delete-date-review': 'clearDateReview',
        'keydown [name=title], [name=details]' : 'clearValidationMessages'
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
        },
        '[name=details]': {
            observe: 'details',
            setOptions: {
                validate: true
            }
        }
    },

    initialize: function (options) {
        this.model = options.model;
        Backbone.Validation.bind(this);
    },

    storeRequest: function (e) {
        e.preventDefault();

        this.model.set({
            id: null,
            title: $('.title-input').val(),
            details: $('.details-input').val(),
            tags: $('.tags-input').val(),
            group_id: $('input[name="group-input"]:checked').val(),
            date_review: $('#date_review').val(),
        });

        this.stopListening();

        if (this.model.isValid(true)) {
            this.model.save(null, {
                success: function (rq) {
                    router.navigate('!/request/' + rq.get("id"), true);
                }
            });
            this.$el.empty();
        }
    },

    clearDateReview: function () {
        $('#date_review').val('');
        $('#date_review_view').html('Select date of review request');
    },

    showDeleteButton: function () {
        $('.delete-date-review').show();
    },

    hideDeleteButton: function () {
        $('.delete-date-review').hide();
    },

    render: function () {
        var self = this;

        this.$el.html(this.template);
        var nowDate = new Date();
        var today = new Date(
            nowDate.getFullYear(),
            nowDate.getMonth(),
            nowDate.getDate(),
            nowDate.getHours(),
            nowDate.getMinutes(),
            0,
            0
        );

        $('#date_review_view').editable({
            mode: 'popup',
            type: 'datetime',
            name: 'date_review',
            display: false,
            clear: 'Clear the date',
            autoclose: true,
            placement: 'right',
            setStartDate: new Date(),
            datetimepicker: {
                startDate: new Date(),
                todayBtn: true,
                minuteStep: 10
            },
            success: function (response, newValue) {
                var oldValue = self.model.roungToMinutes(new Date());
                newValue = self.model.roungToMinutes(newValue);

                if (newValue.getTime() === oldValue.getTime()) {
                    //self.showDateError();
                    return;
                    console.log('Datetime input error')
                }

                self.showDeleteButton();
                $('#date_review').val(self.model.formatToGlobal(newValue));
                $('#date_review_view').html(self.model.formatToString(newValue));
            }
        });

        tags.fetch({
            wait: true,
            async: true,
            success: function (requests, res, req) {
                res = _.pluck(res, 'title');
                $(".tags-input").select2({
                    tags: true,
                    placeholder: "Enter or select a tag for review",
                    tokenSeparators: [',', ' '],
                    data: res
                });
            }
        });

        return this;
    },

    clearValidationMessages: function(e) {
        var errorMessages = $("span.help-block");
        if (errorMessages.length > 0) {
            $(e.currentTarget).siblings('.help-block').addClass('hidden');
            $(e.currentTarget).parents('.form-group').removeClass('has-error');
        }
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
    author_id: 0,
    acceptOffers: 0,
    className: "reviewer text-center col-md-2 col-sm-3 col-xs-6",
    initialize: function (options) {
        this.acceptOffers = options.acceptOffers;
        this.request_id = options.request_id;
        this.author_id = options.author_id;
        this.template = _.template($('#reviewer-card-template').html());
        //this.on('change', this.render, this);
    },
    events: {
        'click .accept': 'acceptOffer',
        'click .decline': 'declineOfferConfirm',
        'click .user-inf': 'show'
    },
    acceptOffer: function () {
        reviewers.url = App.getPrefix() + '/user/' + this.model.id + '/accept/' + this.request_id;
        reviewers.fetch({wait: true});
        this.$el.find('.accept').html('Decline');
        this.$el.find('.accept').addClass('decline btn-danger');
        this.$el.find('.accept').removeClass('accept btn-primary');
        this.$el.find('#decline').hide();
        return this;
    },
    show: function () {
        // Show popup without change history
        //router.navigate('!/user/' + this.model.get("id"), true);
        router.showUserProfile(this.model.id);
        return this;
    },
    declineOfferConfirm: function () {
        var self = this;
        var confirmModal = new App.Views.ConfirmModal({
            cb: function () {
                //use that to run functions for this view
                self.declineOffer();
            },
            body: "Decline this offer?"
        });
        confirmModal.render();
    },
    declineOffer: function () {
        reviewers.url = App.getPrefix() + '/user/' + this.model.id + '/decline/' + this.request_id;
        reviewers.fetch({wait: true});
        this.remove();
        this.render();
        return this;
    },
    render: function () {
        var data = {
            author_id: this.author_id,
            offer: this.model
        };

        for (var i = 0; i < this.acceptOffers.length; i++) {
            if (this.acceptOffers[i].id == this.model.id) {
                data.status = 'You accepted';
            }
        }

        this.$el.html(this.template(data));

        return this;
    }
});

// Backbone Views for all reviewers
App.Views.Reviewers = Backbone.View.extend({
    collection: reviewers,
    el: '#main-content',
    initialize: function () {
        this.collection.on('remove', this.render, this);
    },
    render: function () {
        this.$el.empty();

        var that = this;

        this.collection.fetch({
            success: function (reviewers, res, reviewer) {
                _.each(requests.models, function (reviewer) {
                    that.renderReviewer(reviewer);
                });
            },
            reset: true
        });
    },
    renderReviewer: function (reviewer) {
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
    initialize: function () {
        this.template = _.template($('#tag-template').html());
    },
    render: function () {
        this.$el.html(this.template(this.model));
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
    initialize: function () {
        this.collection.on('remove', this.render, this);
    },
    render: function () {
        this.$el.empty();
        $('#spinner').show();
        var that = this;

        this.collection.fetch({
            success: function (tags, res, tag) {
                if (!tags.length) {
                    console.log('Render No-Tags view here');
                } else {
                    that.$el.html(that.template());
                    _.each(tags.models, function (tag) {
                        that.renderTag(tag);
                    });
                }
                $('#spinner').hide();
            },
            reset: true
        });
    },
    renderTag: function (tag) {
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
    render: function () {
        this.$el.html(this.template(this.model));
        return this;
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

    keywordSearch: _.debounce(function () {
        if ($("#search-input").val().length >= 2) {
            this.renderResults(this.f());
        } else {
            console.log("Min Length Of Search Keyword: 2");
        }
    }, 250),

    f: function () {
        Backbone.ajax({
            type: "POST",
            async: false,
            data: "keyword" + "=" + $("#search-input").val(),
            url: App.getPrefix() + "/tags/search",
            success: function (data) {
                content = data;
            }
        });
        return content;
    },

    render: function () {
        this.$el.empty();
        this.$el.html(this.template);
    },

    renderResults: function (res) {
        var search_results_div = this.$el.find(".search-results");
        search_results_div.empty();

        _.each(res, function (r) {
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
    initialize: function (args) {
        var that = this;
        this.$el.on('hide.bs.modal', function () {
            that.undelegateEvents();
        }),
            this.$el.find('.modal-body').html("<p>" + args.body + "</p>");
        this.cb = args.cb;
    },
    render: function () {
        this.$el.modal('show');
    },
    runCallBack: function () {
        this.cb();
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
    initialize: function () {
    },
    events: {
        'click .delete-btn': 'deleteComment'
    },
    deleteComment: function () {
        // Delete comment action
        console.log('Comment ' + this.model.get('id') + ' deleted');
        return this;
    },
    render: function () {
        this.$el.html(this.template(this.model));  //toJSON() ???
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
        }
    },

    initialize: function (options) {
        var self = this;
        this.options = options;
        this.collection.on('remove', this.render, this);
        this.collection.on('add', this.renderLastComment, this);
        Backbone.Validation.bind(this);
        //App.poller = Backbone.Poller.get(this.collection, {delay: 2000});

        //Web socket subscriber
        ab.connect(
            'ws://' + window.location.hostname + ':' + App.websocketPort + '/' + App.prefix,
            function(session) {
                //App.poller.stop();
                session.subscribe('request/' + self.options.rid + '/comments', function(topic, data) {
                    self.collection.add(data.data);
                });
            },
            function(code, reason, detail) {
                console.warn('WebSocket connection closed (code, reason, detail): ', code, reason, detail);
                // If connection failed use alternative method 'live poling'
                //App.poller.start();
            },
            {
                'maxRetries': 60,
                'retryDelay': 4000,
                'skipSubprotocolCheck': true
            }
        );


    },
    render: function () {
        this.stopListening();
        this.$el.empty();
        $('#spinner').show();  // May be not need

        var that = this;

        this.collection.fetch({
            success: function (comments, res, req) {
                // Render layout view
                that.$el.html(that.template());
                // Add smiles autocomplete to id=text field
                $("#text").textcomplete(tcParams);
                // Render each comment
                _.each(comments.models, function (comment) {
                    that.renderComment(comment);

                });
                $('#spinner').hide();
            }
        });
    },

    renderComment: function (comment) {
        var commentView = new App.Views.Comment({model: comment.toJSON()});
        this.$el.find('#comments-list').append(commentView.render().el);
    },

    renderLastComment: function (comment) {
        this.renderComment(comment);
        lastComment = this.$el.find('#comments-list');
            if (lastComment[0] != undefined) {
                        lastComment.animate({scrollTop: lastComment[0].scrollHeight}, 500);
            }
    },
    storeComment: function (e) {
        e.preventDefault();
        this.stopListening();

        this.model.set({
            id: null,
            text: $('#text').val(),
        });

        if (this.model.isValid(true)) {

            var ecs_input = _.escape($('#text').val());
            this.collection.create({
                text: emojione.shortnameToImage(ecs_input),
            }, {
                wait: true
            });

            $('#text').val('');
        }
    }
});

App.Views.EmptyView = Backbone.View.extend({
    template: _.template($("#empty-list-template").html()),
    el: '#main-content',

    initialize: function (options) {
        this.options = options;
    },

    render: function () {
        this.$el.html(this.template(this.options));
        return this;
    }
});