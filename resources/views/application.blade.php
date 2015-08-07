<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="">

    <title>Reviewer - Binary Academy</title>

    <link href="css/bootstrap.css"  rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <button type="button" class="btn sidebar-btn">
                <span class="sr-only">Sidebar navigation</span>
                <span class="glyphicon glyphicon-menu-hamburger"></span>
            </button>
            <a class="navbar-brand" href="">REVIEWER</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="#!/requests">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        Requests
                    </a>
                </li>
                <li><a href="#!/tags">
                        <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                        Tags
                    </a>
                </li>
                <li><a href="#!/users">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        Users
                    </a>
                </li>
                <li><a href="#!/badges">
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        Badges
                    </a>
                </li>
                <li><a href="#!/popular">
                        <span class="glyphicon glyphicon-fire" aria-hidden="true"></span>
                        Popular
                    </a>
                </li>
                <li><a href="#!/request/create">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        Create request
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Search</a></li>
                <li><a href="#">Notifications <span class="label label-primary">5</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <strong>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}&nbsp;<span class="caret"></span></strong>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Profile &amp; Settings</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/auth/logout">Log Out</a></li>
                    </ul>
                </li>
                <li><img src="{{ Auth::user()->avatar }}" class="img-thumbnail" width="48" height="48"></li>
            </ul>
        </div>
    </div>
</nav>

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

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><%= title %> <span class="badge"><%= reputation %></span></h3>
            </div>
            <div class="panel-body">
                <p class="status">STATUS</p>
                <div class="row user-data">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 user-photo">
                        <img src="<%= user.avatar %>" class="img-responsive" alt="">
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 user-info">
                        <p><%= user.first_name + '' + user.last_name%></p>
                        <p><%= user.email %></p>
                        <p><%= user.phone %></p>
                        <p>Group: <%= group.title %></p>
                    </div>
                </div>
            </div>
            <div class="panel-footer text-center">
                <p class="description"><%- details %></p>
                <button class="request-offer-btn btn btn-primary">Offer</button>
                <button class="request-details-btn btn btn-info">Details</button>
            </div>
        </div>

</script>


{{-- Create Review Request Form backbone template--}}

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
                                            <input type="radio" name="group-input" value="1" checked>
                                            PHP
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="group-input" value="2">
                                            .NET
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="group-input" value="3">
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


{{-- Review Request details backbone template--}}

<script type="text/template" id="review-request-details-template">

    <div class="wrapper">
    <div class="request-details container">
        <div class="row">
            <div class="info col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h2 class="panel-title">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            <%= title %>
                        </h2>
                    </div>
                    <div class="panel-body">
                        <p><%- details %></p>
                        <p>Group: <%= group.title %>, Author: <%= user.first_name + user.last_name%></p>
                        <p>Created at: <%= created_at %></p>
                        <p><span class="label label-success pull-left">tag, tag, tag</span></p>
                    </div>
                    <div class="panel-footer">
                        <p class="-rating">Rating:<span class="badge"><%= reputation %></span></p>
                    </div>
                </div>
                <p><a href="#" class="btn btn-default" style="width:100%" role="button">Like</a></p>
            </div>

            <div class="requestor col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <p>Requestor Info</p>
            </div>
        </div>
        <hr>
        <div class="reviewers">
            <div class="reviewer thumbnail">
                No Reviewers
            </div>
        </div>
        <hr>
        <div class="chat">
            <p>CHAT</p>
        </div>
    </div>
    </div>

</script>


{{-- Reviewer backbone template--}}

<script type="text/template" id="reviewer-card-template">
    <div class="reviewer thumbnail">
        <img src="<%= avatar %>" alt="">
        <p><%= first_name %></p>
        <p><%= last_name %></p>
    </div>
</script>


{{-- One user card backbone template--}}

<script type="text/template" id="user-card-template">

    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <%= first_name + ' ' + last_name %>
            </h3>
        </div>
        <div class="panel-body">
            <img src="<%= avatar %>" alt="">
            <div class="user-info">
                <p><%= email %></p>
                <p><%= phone %></p>
                <p>Reputation: <%= reputation %></p>
            </div>
        </div>
        <div class="panel-footer">
            <div class="text-center">
                <button class="btn btn-primary select-user">Select</button>
            </div>
        </div>
    </div>

</script>


{{-- User Profile backbone template--}}

<script type="text/template" id="user-profile-template">

    <div class="user-profile">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><%= first_name %> <%= last_name %></h3>
        </div>
        <div class="panel-body">
            <div class="photo pull-left">
                <img src="<%= avatar %>" alt="">
            </div>
            <div class="info">
                <div class="form-horizontal" role="form">
                    <div class="form-group">
                        <div class="col-md-10">
                            <p>E-mail: <%= email %></p>
                            <p>Phone: <%= phone %></p>
                            <p>Address: <%= address %></p>
                            <p>Reputation: <%= reputation %></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer text-center">
            <button class="btn btn-primary cancel-user">Cancel</button>
        </div>
    </div>
    </div>

</script>

<script src="js/vendor/underscore/underscore.js"></script>
<script src="js/vendor/jquery/jquery.js"></script>
<script src="js/vendor/backbone/backbone.js"></script>
<script src="js/vendor/bootstrap/bootstrap.js"></script>
<script src="js/app.js"></script>
<script src="js/models.js"></script>
<script src="js/collections.js"></script>
<script src="js/views.js"></script>
<script src="js/routes.js"></script>

</body>
</html>