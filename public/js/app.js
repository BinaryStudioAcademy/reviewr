(function() {
    window.App = {
        Models: {},
        Collections: {},
        Views: {},
        Router: {},

        prefix: window.APP_PREFIX,
        apiPrefix: '/api/v1',

        getPrefix: function() {
            return this.prefix + this.apiPrefix
        }

    };
    waitForMsg();
}());

function waitForMsg() {
    $.ajax({
    type: 'GET',
    url: App.getPrefix() + '/checknotification',
    async: true,
    cache: false,

    success: function(data) {
       // alert('!!');
        //alert(data);
        setTimeout('waitForMsg()', 1000);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown){
        console.log('error '+ textStatus + 'errorThrown');
        setTimeout('waitForMsg()', 15000);
    }

})
}