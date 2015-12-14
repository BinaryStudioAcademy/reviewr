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
                    debugger;
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
        reputation: ''
    }
});

var user = new App.Models.User();

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
            formatted_created_at: undefined,
            reputation: ''
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
        city: '',
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
 *  Tag Model
 *---------------------------------------------------
 */
App.Models.Notification = Backbone.Model.extend({
    urlRoot: App.getPrefix() + "/notification",
    defaults: {
        id: null,
        title: ''
    }
});

var notification = new App.Models.Notification();

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
            this.turnOnDateFormatting(['created_at']);
        }
    })
);

var comment = new App.Models.Comment();

