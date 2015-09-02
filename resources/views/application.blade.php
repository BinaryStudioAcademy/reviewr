<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="keywords" content=""/>
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="">

    <title>Reviewer - Binary Academy</title>

    <link href="{{ asset(env('APP_PREFIX', '') . '/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset(env('APP_PREFIX', '') .'/css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset(env('APP_PREFIX', '') .'/css/bootstrap-tokenfield.css')}}" rel="stylesheet">
    <link href="{{ asset(env('APP_PREFIX', '') .'/css/tokenfield-typeahead.css') }}" rel="stylesheet">
    <link href="{{ asset(env('APP_PREFIX', '') .'/js/vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset(env('APP_PREFIX', '') .'/css/bootstrap-editable.css') }}" rel="stylesheet">
    <link href="{{ asset(env('APP_PREFIX', '') .'/css/jqcloud.min.css') }}" rel="stylesheet">
    <link href="{{ asset(env('APP_PREFIX', '') .'/css/styles.css') }}" rel="stylesheet">
    <link href="http://team.binary-studio.com/app/styles/css/style.css" rel="stylesheet">
    <link href="{{ asset(env('APP_PREFIX', '') .'/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset(env('APP_PREFIX', '') .'/css/emojione.min.css') }}" rel="stylesheet">
    <link href="{{ asset(env('APP_PREFIX', '') .'/css/jquery.textcomplete.css') }}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- TEMP NAVIGATION -->
<!-- <nav class="navbar navbar-default navbar-fixed-top" id="header">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right sidebar-hidden">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>&nbsp;Main&nbsp;<span
                                class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#!/request/create">Create review request</a></li>
                        <li><a href="#!/requests/my">My review requests</a></li>
                        <li><a href="#!/requests/offered">My offers</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></span>&nbsp;Review
                        requests&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#!/requests">All</a></li>
                        <li><a href="#!/requests/popular">Popular</a></li>
                        <li><a href="#!/requests/high_rate">Hight rated</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>&nbsp;Groups&nbsp;<span
                                class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#!/requests/group/1">PHP</a></li>
                        <li><a href="#!/requests/group/3">.NET</a></li>
                        <li><a href="#!/requests/group/2">JS</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Users&nbsp;<span
                                class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#!/users">All</a></li>
                        <li><a href="#!/users/high_rep">Highest reputation</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>&nbsp;Tags&nbsp;<span
                                class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#!/tags">All</a></li>
                        <li><a href="#!/tags/popular">Popular</a></li>
                        <li><a href="#!/tags/cloud">Cloud</a></li>
                    </ul>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right"> -->
                <!-- <li>
                    <a href="#!/search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Search</a>
                </li> -->
                <!-- <li><a href="#!/notifications">
                    <span class="glyphicon glyphicon-bell" aria-hidden="true"></span>&nbsp;Notifications&nbsp;<span class="label label-primary" id="notification">0</span></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <span class="glyphicon glyphicon-user"
                              aria-hidden="true"></span>&nbsp;{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                        &nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('logout') }}"><span class="glyphicon glyphicon-off"
                                                                  aria-hidden="true"></span>&nbsp;Log Out</a></li>
                        <li><a href="{{ route('logout.binary') }}"><span class="glyphicon glyphicon-off"
                                                                  aria-hidden="true"></span>&nbsp;Log Out Binary</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav> -->
<!-- END TEMP NAVIGATION -->

<script>
    var authUserId = {{ Auth::user()->id }} ;
    window.APP_PREFIX = "{{ env('APP_PREFIX', '') }}";
</script>

<script>
    var userID = "{{ Auth::user()->id }}";
</script>

<!-- MAIN CONTAINER -->
<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR CONTAINER-->
        <!-- <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <hr>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <span class="glyphicon glyphicon-user"
                              aria-hidden="true"></span>&nbsp;{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                        &nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('logout') }}"><span class="glyphicon glyphicon-off"
                                                                  aria-hidden="true"></span>&nbsp;Log Out</a></li>
                        <li><a href="{{ route('logout.binary') }}"><span class="glyphicon glyphicon-off"
                                                                         aria-hidden="true"></span>&nbsp;Log Out Binary</a></li>
                    </ul>
                </li>
                <li class="sub-menu-label"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>&nbsp;MAIN
                </li>
                <li><a href="#!/request/create">Create review request</a></li>
                <li><a href="#!/requests/my">My review requests</a></li>
                <li><a href="#!/requests/offered">My offers</a></li>
                <li class="sub-menu-label"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;REVIEW
                    REQUESTS
                </li>
                <li><a href="#!/requests">All</a></li>
                <li><a href="#!/requests/popular">Popular</a></li>
                <li><a href="#!/requests/high_rate">Hight rated</a></li>
                <li class="sub-menu-label"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>&nbsp;GROUPS
                </li>
                <li><a href="#!/requests/group/1">PHP</a></li>
                <li><a href="#!/requests/group/3">.NET</a></li>
                <li><a href="#!/requests/group/2">JS</a></li> -->
                <!-- <li class="sub-menu-label"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;USERS
                </li>
                <li><a href="#!/users">All</a></li>
                <li><a href="#!/users/high_rep">Higest reputation</a></li> -->
                <!-- <li class="sub-menu-label"><span class="glyphicon glyphicon-tag" aria-hidden="true"></span>&nbsp;TAGS
                </li>
                <li><a href="#!/tags">All</a></li>
                <li><a href="#!/tags/popular">Popular</a></li>
                <li><a href="#!/tags/cloud">Cloud</a></li>
                <hr>
                {{--<li><a href="#!/notifications">--}}
                        {{--<span class="glyphicon glyphicon-bell" aria-hidden="true"></span>&nbsp;Notifications&nbsp;<span class="label label-primary" id="notification">0</span></a>--}}
                {{--</li>--}}
            </ul>

        </div> -->
        <!-- END SIDEBAR CONTAINER-->

        <!-- NEW SIDEBAR -->
        <nav class="navbar navbar-default sidebar" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#!/requests/my">Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Main <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a>
                            <ul class="dropdown-menu forAnimate" role="menu">
                                <li><a href="#!/request/create">Create</a></li>
                                <li><a href="#!/requests/my">My</a></li>
                                <li><a href="#!/requests/offered">Offers</a></li>
                                <li class="divider"></li>
                                <li><a href="#">LogOut</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Review requests <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-list-alt"></span></a>
                            <ul class="dropdown-menu forAnimate" role="menu">
                                <li><a href="#!/requests">All</a></li>
                                <li><a href="#!/requests/popular">Popular</a></li>
                                <li><a href="#!/requests/high_rate">Hight rating</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Groups <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-large"></span></a>
                            <ul class="dropdown-menu forAnimate" role="menu">
                                <li><a href="#!/requests/group/1">PHP</a></li>
                                <li><a href="#!/requests/group/3">.NET</a></li>
                                <li><a href="#!/requests/group/2">JS</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tags <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a>
                            <ul class="dropdown-menu forAnimate" role="menu">
                                <li><a href="#!/tags">All</a></li>
                                <li><a href="#!/tags/popular">Popular</a></li>
                                <li><a href="#!/tags/cloud">Cloud</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END NEW SIDEBAR -->

        <!-- POPUP CONTAINER -->
        <div id="popup">
            <!-- POPUP CONTENT HERE -->
        </div>
        <!-- END POPUP CONTAINER -->

        <div class="modal fade" id="confirm-modal">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <span id="header-text"></span>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Are You Sure?</h4>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-ok" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- SPINNER PRELOADER -->
        <div id="spinner">
            <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33"
                        r="30"></circle>
            </svg>
        </div>
        <!-- END SPINNER PRELOADER -->

        <!-- CONTENT CONTAINER -->
        <div class="main">
            <div class="row" id="main-content">
                <!-- MAIN CONTENT HERE -->
            </div>
        </div>
        <!-- END CONTENT CONTAINER -->

    </div>
</div>
<!-- END MAIN CONTAINER -->

{{-- One Review Request card backbone template--}}

<script type="text/template" id="request-card-template">

    <div class="panel panel-info">
        <div class="panel-heading">
            <h2 class="panel-title">
                <%- offer.title %>
                <% if (typeof(offer.pivot) != 'undefined' && offer.pivot.isAccepted == 1) { %>
                &nbsp;
                <span class="label label-success pull-right">Accepted</span>
                <% } %>
            </h2>
        </div>
        <div class="panel-body">
            <p>
                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                <%- offer.created_at %>
                &nbsp;
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <span class="badge">
                    <%- _.isEqual(offer.offers_count, 0) ? 'no' : offer.offers_count %>
                </span>
                &nbsp;
                <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                <span class="badge">
                    <%- offer.reputation %>
                </span>
            </p>

            <div class="row user-data">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 user-photo">
                    <img src="<%= offer.user.avatar %>" class="thumbnail img-responsive" alt="">
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 user-info">
                    <p><b>
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <%- offer.user.first_name + ' ' + offer.user.last_name %>
                        </b></p>

                    <p>Group: <a href="#!/requests/group/<%- offer.group_id %>"><%- offer.group.title %></a></p>

                    <p><%- offer.user.email %></p>

                    <p><%- offer.user.phone %></p>
                </div>
            </div>
        </div>
        <div class="panel-footer text-center">
            <p class="description"><%- offer.details %></p>

            <div><b>Date of review:</b> <%- offer.date_review %></div>
            <% if (status) { %>
            <button class="undo-offer-btn btn btn-info">
                <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
                Undo
            </button>
            <% } %>

            <% if (!status && offer.user.id != {{ Auth::user()->id }}) { %>
            <button class="request-offer-btn btn btn-warning">
                <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                Offer
            </button>
            <% } %>

            <button class="request-details-btn btn btn-success">Details</button>
            <% if (offer.user.id == {{ Auth::user()->id }}) { %>
            <button class="request-delete-btn btn btn-danger">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                {{--Delete--}}
            </button>
            <% } %>
        </div>
    </div>

</script>


{{-- Create Review Request Form backbone template--}}

<script type="text/template" id="create-request-form-template">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h2 class="panel-title">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            Create New Review Request
                        </h2>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="#" id="create-request-form">
                            <div class="form-group">
                                <label for="title" class="col-md-1 control-label">Title</label>

                                <div class="col-md-11">
                                    <input type="text" class="title-input form-control" name="title" id="title"
                                           placeholder="Write title of review request">
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date_review" class="col-md-1 control-label">Date</label>
                                <div class="col-md-11">
                                    <input type="text" class="form-control" bootstrap-datepicker data-date-end-date="0d"
                                           id="date_review" name="date_review" placeholder="Select date of review request">
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="details" class="col-md-1 control-label">Details</label>
                                <div class="col-md-11">
                                    <textarea id="details" name="details" class="details-input form-control" rows="6" placeholder="Enter some details about review request"></textarea>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tags-input" class="col-md-1 control-label">Tags</label>
                                <div class="col-md-11">
                                    <select multiple="true" id="tags-input" name="tags-input" class="tags-input form-control"  style="width: 100%"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-1 control-label">Group</label>
                                <div class="col-md-11">
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
                                <div class="col-md-6 col-md-offset-1">
                                    <button type="submit" class="btn btn-warning">
                                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
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
                <div class="info col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                &nbsp;
                                <a href="#" id="title"><%- title %></a>
                            </h2>
                        </div>
                        <div class="panel-body">
                            <p>
                                <small><span class="glyphicon glyphicon-time"
                                             aria-hidden="true"></span> <%- created_at %></small>
                            </p>
                            <div id="details"><%- details %></div>

                            <ul class="tags list-inline">Request Tags List</ul>
                            <b>Date of review:</b> <span id="date_review"><%= date_review %></span>
                        </div>
                        <div class="panel-footer">
                            <span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>
                            <a href="#!/requests/group/<%- group_id %>">
                                <%- group.title %>
                            </a>
                            &nbsp;
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <a href="#!/requests/user/<%- user_id %>">
                                <%- user.first_name + ' ' + user.last_name%>
                            </a>
                            &nbsp;
                            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                            <span id="reputation"><%- reputation %></span>
                            &nbsp;
                            <button class="like btn btn-default btn-sm">Like</button>
                        </div>
                    </div>

                </div>

                <div class="requestor col-lg-4 col-md-4 hidden-sm hidden-xs">
                    <p>Requestor Info</p>
                </div>
            </div>
            <hr>
            <div class="reviewers-header">
                &nbsp;
                <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
                &nbsp;
                Users who send offer to review request:
            </div>
            <div class="reviewers row">
                <div class="reviewer thumbnail">
                    No Reviewers
                </div>
            </div>
            <hr>
            <div id="chat-region" class="row">
                <!-- Chat View paste here  -->
                <div class="col-md-8">
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        Chat is not available, because you not accepted
                    </div>
                </div>
            </div>

        </div>
    </div>

</script>


{{-- Reviewer backbone template--}}

<script type="text/template" id="reviewer-card-template">
    <div class="thumbnail">
        <div class="user-inf">
            <img src="<%= offer.avatar %>" alt="offers" class="img-thumbnail">
            <p class="user-inf"><b><%- offer.first_name + ' ' + offer.last_name %></b></p>
        </div>
        <% if (author_id == userID) { %>
        <% if (offer.pivot.isAccepted) { %>
        <button class="decline btn btn-danger">
            Decline
        </button>
        <% } else { %>
        <div style="display:inline">
            <button class="accept btn btn-primary ">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                {{--Accept--}}
            </button>
            <button class="decline btn btn-danger" id="decline">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                {{--Decline--}}
            </button>
        </div>
        <% } %>
        <% } %>
    </div>
</script>


{{-- Single Comment backbone template--}}
<script type="text/template" id="single-comment-template">
    <div class="row">
        <!-- Text -->
        <div class="col-md-10">
            <strong><%- user.first_name + ' ' + user.last_name %></strong>

            <div class="comment-time pull-right text-muted">
                <small>
                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                    <%- created_at %>
                </small>
            </div>
            <div class="comment-description"><%= text %></div>
        </div>
        <!-- User info -->
        <div class="col-md-2 pull-right">
            <div class="user-info text-center">
                <img src="<%= user.avatar %>" alt="avatar" width="50" height="50" class="img-thumbnail">
            </div>
        </div>
    </div>
</script>

{{-- Comments List backbone template--}}
<script type="text/template" id="comments-list-template">
    <div class="comments-list col-md-8">

        <div class="comments-header">
            &nbsp;
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            &nbsp;
            Chat with accepted users:
        </div>

        <!-- COMMENTS LIST -->
        <div id="comments-list" class="list-group pre-scrollable">
            <!-- SINGLE COMMENT -->
            <!-- SINGLE COMMENT -->
            <!-- SINGLE COMMENT -->
        </div>

        <!-- Adding form -->
        <div class="panel panel-default new-comment">
            <div class="panel-heading">
                <h3 class="panel-title">Your comment</h3>
            </div>
            <div class="panel-body">
                <form class="form-horisontal" id="new-comment-form">
                    <div class="input-group form-group">
                        <input type="text" class="form-control" placeholder="Your message..." name="text" id="text">
                        
                        <span class="input-group-btn">
                            <input class="btn btn-success" type="submit" form="new-comment-form" value="Send">
                        </span>

                    </div>
                    <!-- /input-group -->
                </form>
                <p class="text-muted">For add smile type ':' (colon)</p>
            </div>
        </div>
    </div>
</script>

{{-- One user card backbone template--}}

<script type="text/template" id="user-card-template">

    <div class="user-card col-md-4 text-center">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    &nbsp;
                    <%- first_name + ' ' + last_name %>
                    &nbsp;
                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    <%- reputation %>
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4"><img src="<%= avatar %>" alt="avatar" class="thumbnail"></div>
                    <div class="user-info col-md-8 text-left">
                        <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                            <%- email %>
                        </p>

                        <p><span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                            <%- phone %>
                        </p>

                        <p><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            <a href="#!/requests/user/<%- id %>">His Requests</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="text-center">
                    <button class="btn btn-primary show-user">Show Details</button>
                </div>
            </div>
        </div>
    </div>

</script>

{{-- Author request backbone template--}}

<script type="text/template" id="author-card-template">

    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                &nbsp;
                <%- first_name + ' ' + last_name %>
                &nbsp;
                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                <span id="user-rep"><%- reputation %></span>
            </h3>

        </div>
        <div class="panel-body">
            <div class="thumbnail">
                <img src="<%= avatar %>" alt="avatar" width="120" height="120" class="thumbnail">

                <div class="user-info caption">
                    <p><span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                        <%- department.title %></p>

                    <p>(<%- job.position %>)</p>

                    <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                        <%- email %></p>

                    <p><span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                        <%- phone %></p>
                </div>
            </div>

        </div>
        <div class="panel-footer">
            <div class="text-center">
                <button class="btn btn-primary show-user">Show Details</button>
            </div>
        </div>
    </div>

</script>

{{-- User Profile backbone template MODAL --}}

<script type="text/template" id="user-profile-template">
    <div class="user-profile modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="User Details">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <%- first_name %> <%- last_name %>
                        &nbsp;
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <%- reputation %>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="photo col-md-4 text-center">
                            <img src="<%= avatar %>" alt="avatar" width="140" heigth="140"
                                 class="img-thumbnail img-responsive">
                        </div>
                        <div class="info col-md-8">
                            <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                                <%- email %></p>

                            <p><span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                                <%- phone %></p>

                            <p><span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                                <%- department['title'] %></p>

                            <p>(<%- job['position'] %>)</p>

                            <p><span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                                <%- address %></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/template" id="tag-template">
    <a href="#!/requests/tag/<%- id %>">
        <span class="label label-success" title="<%- requests_count %>">
            <%- title %>
        </span>
    </a>
</script>

<script type="text/template" id="tags-list-template">
    <ul class="tags list-unstyled text-center row">
    </ul>
</script>

<script type="text/template" id="new-tag-template">
    <div class="tile">
        <div class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <h3 class="tilecaption"><a href="#!/requests/tag/<%- id %>"><%- title %></a></h3>
                </div>
                <div class="item">
                    <h3 class="tilecaption"><a href="#!/requests/tag/<%- id %>"><%- requests_count %></a></h3>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/template" id="new-tags-list-template">
    <div class="container-fluid">
        <div class="row" id="tags-list">
            <!-- TAGS LIST -->
        </div>
    </div>
</script>

<script type="text/template" id="search-view-template">
    <h3 class="text-center">search page</h3>
    <hr>
    <div class="search-form text-center">
        <form>
            <div class="form-group">
                <label for="search-input">Search Form</label>
                <input type="text" class="form-control" id="search-input" placeholder="search">
            </div>
        </form>
    </div>
    <div class="search-results">Search-Results</div>
</script>

<script type="text/template" id="notification-template">
     <%- title %>
</script>

<script type="text/template" id="notifications-list-template">
    <h1>Your notifications</h1>
    <div class="notifications list-group">
    </div>
</script>

<!-- VENDOR SCRIPTS -->
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/jquery/jquery.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/bootstrap/bootstrap.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/jquery/jqueryui.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/bootstrap/bootstrap-tokenfield.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/bootstrap/typeahead.bundle.min.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/bootstrap/moment.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/bootstrap/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/underscore/underscore.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/backbone/backbone.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/backbone/backbone.validation.min.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/backbone/backbone.stickit.min.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/backbone/backbone.poller.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/select2/select2.full.min.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/bootstrap-editable.min.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/jcloud/jqcloud.min.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/emojione.min.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/jquery.textcomplete.min.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/jquery.textcomplete.emojione.js')}}"></script>
<!-- END VENDOR SCRIPTS -->
<script src="http://team.binary-studio.com/app/javascripts/header.js"></script>

<script>
    var getHeader = function() {
        var request = new XMLHttpRequest();
        request.open('GET', 'http://team.binary-studio.com/app/header', true);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState != 4) return;
            if (request.status != 200) {
                alert(request.status + ': ' + request.statusText);
            } else {
                var headerHtml = request.responseText;
                var headerContainer = document.getElementById('header');
                headerContainer.innerHTML =headerHtml;
                headerFunction();
            }
        };
    };
    getHeader();

    $(document).ready(function () {

        $(window).resize(function () {
            if (this.resizeTO) clearTimeout(this.resizeTO);
            this.resizeTO = setTimeout(function () {
                $(this).trigger('resizeEnd');
            }, 10);
        });

        $(window).bind('resizeEnd', function () {
            $(".tile").height($(".tile").width());
            $(".carousel").height($(".tile").width());
            $(".item").height($(".tile").width());
        });

        // Smiles config
        emojione.unicodeAlt = false;
        emojione.ascii = true;

    });
</script>

{{--<script data-main="js/require-config" src=" {{asset(env('APP_PREFIX', '') . '/js/vendor/require/require.min.js')}} "></script>--}}
<!-- APP SCRIPTS -->
<script src="{{asset(env('APP_PREFIX', '') .'/js/app.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/models.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/collections.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/views.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/routes.js')}}"></script>
<!-- END APP SCRIPTS -->

</body>
</html>