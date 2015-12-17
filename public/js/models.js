Backbone.Validation.configure({
    forceUpdate: true
});

_.extend(Backbone.Validation.callbacks, {
    valid: function (view, attr, selector) {
        var $el = view.$('[name=' + attr + ']'),
            $group = $el.closest('.form-group');

        $group.removeClass('has-error');
        $group.find('.help-block').html('').addClass('hidden');
    },
    invalid: function (view, attr, error, selector) {
        var $el = view.$('[name=' + attr + ']'),
            $group = $el.closest('.form-group');

        $group.addClass('has-error');
        $group.find('.help-block').html(error).removeClass('hidden');
    }
});

/*
 *---------------------------------------------------
 *  Model mixins
 *---------------------------------------------------
 */
App.ModelMixins = {
    DateFormatting: {
        turnOnDateFormatting: function (fields) {
            var self = this;

            this.on('sync', function () {
                self.attachFormattedDate(fields);
            });

            this.on('change', function () {
                self.attachFormattedDate(fields);
            });
        },

        attachFormattedDate: function (fields) {
            var self = this;

            _.each(fields, function (field) {
                if (self.has(field)) {
                    self.set(
                        'formatted_' + field,
                        self.formatDate(self.get(field))
                    );
                } else {
                    self.set('formatted_' + field, null);
                }
            })
        },

        formatDate: function (oldDate) {
            var date = new Date(oldDate);

            var options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                hour12: false
            };

            return date.toLocaleString("en-US", options);
        }
    },

    DefererAPI: {
        deferOperation: function (operation, item, attrs, customOptions) {
            var defer = $.Deferred();

            var options = {
                success: function (data, response, options) {
                    defer.resolve(data);
                },
                error: function (model, xhr, options) {
                    if (xhr.statusCode('500')) {
                        var error = JSON.parse(xhr.responseText);
                        var errorMessage = error.description ||
                            "Sever error: cannot fetch the entity data";
                        defer.reject({
                            error: errorMessage
                        });
                    } else {
                        var errors = JSON.parse(xhr.responseText);
                        defer.reject(errors);
                    }
                }
            };

            // defining a defer object for custom success and error callbacks
            if (customOptions) {
                var func;
                if (customOptions.success) {
                    func = customOptions.success;

                    options.success = function (data, response, options) {
                        this.defer = defer;
                        func.apply(this, [data, response, options]);
                    };

                    delete customOptions.success;
                }

                if (customOptions.error) {
                    func = customOptions.error;

                    options.error = function (data, response, options) {
                        this.defer = defer;
                        func.apply(this, [data, response, options]);
                    };

                    delete customOptions.error;
                }

                options =_.extend(options, customOptions);
            }

            attrs = attrs || [];

            if (operation == 'save') {
                item[operation](attrs, options);
            } else {
                item[operation](options);
            }

            return defer.promise();
        }
    }
};

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
        avatar: '',
        country: '',
        city: '',
        department: undefined,
        job: undefined
    }
});

var user = new App.Models.User();

// Current user
App.Models.CurrentUser = App.Models.User.extend(
    _.extend({}, App.ModelMixins.DefererAPI, {
        getFromServer: function (nextUrl) {
            var self = this;

            if (nextUrl) {
                this.redirect = nextUrl;
            }

            // Returns promise
            return this.deferOperation('fetch', self, [], {
                wait: true,
                async: false
            });
        },

        url : function(){
            var url = this.urlRoot;

            if(this.redirect) {
                url = url + "/?redirect=" + encodeURIComponent(this.redirect);
            }

            return url;
        },

        initialize: function (options) {
            this.options = options;
            this.urlRoot = App.prefix + '/users/login';
        }
    })
);

/*
 *---------------------------------------------------
 *  Request Model
 *---------------------------------------------------
 */
App.Models.Request = Backbone.Model.extend(
    _.extend({}, App.ModelMixins.DateFormatting, {
        urlRoot: App.getPrefix() + '/reviewrequest',
        defaults: {
            title: '',
            details: '',
            date_review: '',
            formatted_date_review: undefined,
            tags: '',
            group: '',
            created_at: '',
            formatted_created_at: undefined
        },

        validation: {
            title: {
                required: true,
                rangeLength: [5, 100]
            },
            date_review: {
                required: false
            },
            details: {
                required: true
            }
        },

        initialize: function () {
            this.turnOnDateFormatting(['date_review', 'created_at']);
        }
    })
);

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
        avatar: '',
        country: '',
        city: ''
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
App.Models.Comment = Backbone.Model.extend(
    _.extend({}, App.ModelMixins.DateFormatting, {
        defaults: {
            id: null,
            text: '',
            created_at: '',
            formatted_created_at: undefined
        },
        validation: {
            text: {
                required: true,
            }
        },

        initialize: function () {
            this.attachFormattedDate(['created_at']);
            this.turnOnDateFormatting(['created_at']);
        }
    })
);

var comment = new App.Models.Comment();

