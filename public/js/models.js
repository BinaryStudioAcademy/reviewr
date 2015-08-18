// Since we are automatically updating the model, we want the model
// to also hold invalid values, otherwise, we might be validating
// something else than the user has entered in the form.
// See: http://thedersen.com/projects/backbone-validation/#configuration/force-update
Backbone.Validation.configure({
    forceUpdate: true
});

// Extend the callbacks to work with Bootstrap, as used in this example
// See: http://thedersen.com/projects/backbone-validation/#configuration/callbacks
_.extend(Backbone.Validation.callbacks, {
    valid: function (view, attr, selector) {
      //  alert('!!!');
        var $el = view.$('[name=' + attr + ']'), 
            $group = $el.closest('.form-group');
        
        $group.removeClass('has-error');
        $group.find('.help-block').html('').addClass('hidden');
    },
    invalid: function (view, attr, error, selector) {
      //  debugger;
        // alert('XXxx');
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
            rangeLength: [6, 100]
        },
        date_review: {
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