<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Reviewr</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('css/bootstrap.css') }}"  rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>

<div id="notifications">

    <!-- Backbone notification paste here -->

</div>

<!-- Navbar feature -->

<div class="container" data-role="main">

    <div id="main-content" class="wrapper">

        <!-- Backbone views will paste here -->

    </div>

</div>

{{-- One Review Request card backbone template--}}

<script type="text/template" id="request-card-template">
    <p>Status: </p>
    <div class="clearfix">
        <img src="http://www.placeholders.ru/placeholder/b5b5b5/696969/border/nocross/150x150.png" alt="">
        <div class="user-info">
            <p>user info</p>
            <p>Reputation: </p>
        </div>
    </div>
    <p>Title: <%= title %></p>
    <p>Rating: <%= reputation %></p>
    <p>Details: <%= details %></p>
    <div class="text-center">
        <p>
            <a href="" class="request-accept btn btn-primary" role="button">Accept</a>
            <a href="" class="request-decline btn btn-default" role="button">Decline</a>
        </p>
    </div>
</script>


{{-- One user card backbone template--}}

<script type="text/template" id="user-card-template">

    <img src="<%= avatar %>" alt="">
    <div class="user-info">
        <p><%= first_name + ' ' + last_name %></p>
        <p><%= email %></p>
        <p><%= phone %></p>
        <p>Reputation: <%= reputation %></p>
    </div>
    <div class="text-center">
        <p>
            <button class="btn btn-primary select-user">Select</button>
        </p>
    </div>

</script>


{{-- User Profile backbone template--}}

<script type="text/template" id="user-profile-template">
    <div class="user-profile">
        <div class="photo pull-left">
            <img src="<%= avatar %>" alt=""  width="200" height="200">
        </div>
        <div class="info">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('#') }}">
                <div class="form-group">
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="first_name" placeholder="<%= first_name %>">
                        <input type="text" class="form-control" name="last_name" placeholder="<%= last_name %>">
                        <input type="email" class="form-control" name="email" placeholder="<%= email %>">
                        <input type="text" class="form-control" name="phone" placeholder="<%= phone %>">
                        <input type="text" class="form-control" name="address" placeholder="<%= address %>">
                        <input type="text" class="form-control" name="reputation" placeholder="<%= reputation %>">
                    </div>
                </div>
            </form>
        </div>
        <p>SOME TEXT ADDITIONALLY</p>
    </div>
    <div class="well well-sm text-center">SOME BAR
        <button class="btn btn-primary cancel-user">Cancel</button>
    </div>
</script>

<script src="{{ asset('js/vendor/underscore/underscore.js') }}"></script>
<script src="{{ asset('js/vendor/jquery/jquery.js') }}"></script>
<script src="{{ asset('js/vendor/backbone/backbone.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap/bootstrap.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/models.js') }}"></script>
<script src="{{ asset('js/collections.js') }}"></script>
<script src="{{ asset('js/views.js') }}"></script>
<script src="{{ asset('js/routes.js') }}"></script>

</body>
</html>