(function () {
    window.App = {
        Models: {},
        Collections: {},
        Views: {},
        Router: {},

        prefix: window.APP_PREFIX,
        apiPrefix: '/api/v1',
        websocketPort: 5588,

        getPrefix: function () {
            return this.prefix + this.apiPrefix
        },

        getSitePrefix: function () {
            return this.prefix;
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
