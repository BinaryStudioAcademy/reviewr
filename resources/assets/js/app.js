(function () {
    window.App = {
        Models: {},
        Collections: {},
        Views: {},
        Router: {},

        prefix: window.APP_PREFIX,
        apiPrefix: '/api/v1',

        getPrefix: function () {
            return this.prefix + this.apiPrefix
        },

        poller: ''

    };

  //  listenChangeForNotifications();
}());

function listenChangeForNotifications() {
    $.ajax({
        type: 'GET',
        url: App.getPrefix() + '/checknotification',
        async: true,
        cache: false,

        success: function (data) {
            $('#notification').html(data);
            setTimeout(listenChangeForNotifications, 5000);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log('error ' + textStatus + 'errorThrown');
            setTimeout(listenChangeForNotifications, 5000);
        }

    });
}

var enableSubmit = function(ele) {
    $(ele).removeAttr("disabled");
};

$(document).on('click', '.like', function () {
    var that = this;
    $(this).attr("disabled", true);
    setTimeout(function() { enableSubmit(that) }, 1000);
});

$(document).on('click', '.undo-like', function () {
    var that = this;
    $(this).attr("disabled", true);
    setTimeout(function() { enableSubmit(that) }, 1000);
});

