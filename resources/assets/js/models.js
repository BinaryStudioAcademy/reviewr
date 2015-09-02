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
        date_review: '',
        tags: '',
        group: '',
        created_at: '',
        reputation: ''
    },

    validation: {
        title: {
            required: true,
            rangeLength: [5, 100]
        },
        date_review: {
            required: true
        },
        details: {
            required: true
        }
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

App.Models.Comment = Backbone.Model.extend({
    defaults: {
        id: null,
        text: '',
        created_at: ''
    },
    validation: {
        text: {
            required: true,
        },
    }
});

var comment = new App.Models.Comment();

