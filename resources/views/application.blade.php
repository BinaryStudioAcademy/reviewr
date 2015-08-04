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

<div id="menu"> <!-- Блок меню -->
    <ul>
        <li><a href="#!/users">users</a></li>
        <li><a href="#!/requests">requests</a></li>
        <li><a href="#!/request/create">create request</a></li>
    </ul>
</div>

<div id="notifications">

    <!-- Backbone notification paste here -->

</div>

<!-- Navbar feature -->

<div class="container" data-role="main">

    <div id="main-content">

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

{{-- Create Review Request backbone template--}}

<script type="text/template" id="create-request-form-template">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">CREATE REQUEST</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('#') }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Title</label>
                                <div class="col-md-6">
                                    <input type="text" class="title-input form-control" name="title" placeholder="Title">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Details</label>
                                <div class="col-md-6">
                                    <textarea class="details-input form-control" rows="3" placeholder="Details"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Tags</label>
                                <div class="col-md-6">
                                    <input type="text" class="tags-input form-control" name="hashtags" placeholder="use in this input regexp: #\w+">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Group</label>
                                <div class="col-md-6">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="group-input" value="php" checked>
                                            PHP
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="group-input" value=".net">
                                            .NET
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="group-input" value="js">
                                            JS
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-default">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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