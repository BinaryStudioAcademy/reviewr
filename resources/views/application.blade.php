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

    <link href="{{ asset(env('APP_PREFIX', '') . '/css/bootstrap.css') }}"  rel="stylesheet">
    <link href="{{ asset(env('APP_PREFIX', '') .'/css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset(env('APP_PREFIX', '') .'/css/bootstrap-tokenfield.css')}}" rel="stylesheet">
    <link href="{{ asset(env('APP_PREFIX', '') .'/css/tokenfield-typeahead.css') }}" rel="stylesheet">
    <link href="{{ asset(env('APP_PREFIX', '') .'/js/vendor/bootstrap-wysiwyg/index.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"> 
    <link href="{{ asset(env('APP_PREFIX', '') .'/css/bootstrap-editable.css') }}" rel="stylesheet">
    <link href="{{ asset(env('APP_PREFIX', '') .'/css/jqcloud.min.css') }}" rel="stylesheet">
    <link href="{{ asset(env('APP_PREFIX', '') .'/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset(env('APP_PREFIX', '') .'/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- TEMP NAVIGATION -->
    <nav class="navbar navbar-default navbar-fixed-top" id="temp">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right sidebar-hidden">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>&nbsp;Main&nbsp;<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#!/request/create">Create review request</a></li>
                            <li><a href="#!/requests/my">My review requests</a></li>
                            <li><a href="#!/requests/offered">My offers</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></span>&nbsp;Review requests&nbsp;<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#!/requests">All</a></li>
                            <li><a href="#!/requests/popular">Popular</a></li>
                            <li><a href="#!/requests/high_rate">Hight rated</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>&nbsp;Groups&nbsp;<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#!/requests/group/1">PHP</a></li>
                            <li><a href="#!/requests/group/3">.NET</a></li>
                            <li><a href="#!/requests/group/2">JS</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Users&nbsp;<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#!/users">All</a></li>
                            <li><a href="#!/users/high_rep">Highest reputation</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>&nbsp;Tags&nbsp;<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#!/tags">All</a></li>
                            <li><a href="#!/tags/popular">Popular</a></li>
                            <li><a href="#!/tags/cloud">Cloud</a></li>
                        </ul>
                    </li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#!/search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Search</a></li>
                     <li><a href="#!/notifications">Notifications <span class="label label-primary" id="notification">0</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}&nbsp;<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('logout') }}"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp;Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="sub-menu-label"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>&nbsp;MAIN</li>
                <li><a href="#!/request/create">Create review request</a></li>
                <li><a href="#!/requests/my">My review requests</a></li>
                <li><a href="#!/requests/offered">My offers</a></li>
                <li class="sub-menu-label"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;REVIEW REQUESTS</li>
                <li><a href="#!/requests">All</a></li>
                <li><a href="#!/requests/popular">Popular</a></li>
                <li><a href="#!/requests/high_rate">Hight rated</a></li>
                <li class="sub-menu-label"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>&nbsp;GROUPS</li>
                <li><a href="#!/requests/group/1">PHP</a></li>
                <li><a href="#!/requests/group/3">.NET</a></li>
                <li><a href="#!/requests/group/2">JS</a></li>
                <li class="sub-menu-label"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;USERS</li>
                <li><a href="#!/users">All</a></li>
                <li><a href="#!/users/high_rep">Higest reputation</a></li>
                <li class="sub-menu-label"><span class="glyphicon glyphicon-tag" aria-hidden="true"></span>&nbsp;TAGS</li>
                <li><a href="#!/tags">All</a></li>
                <li><a href="#!/tags/popular">Popular</a></li>
                <li><a href="#!/tags/cloud">Cloud</a></li>
            </ul>
            <hr>
        </div>
        <!-- END SIDEBAR CONTAINER-->

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
                <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
            </svg>
        </div>
        <!-- END SPINNER PRELOADER -->

        <!-- CONTENT CONTAINER -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
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
            </h2>
        </div>
        <div class="panel-body">
            <p>
                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                <%= offer.created_at %>
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
                        <%= offer.user.first_name + ' ' + offer.user.last_name %>
                    </b></p>
                    <p>Group: <a href="#!/requests/group/<%= offer.group_id %>"><%= offer.group.title %></a></p>
                    <p><%= offer.user.email %></p>
                    <p><%= offer.user.phone %></p>
                </div>
            </div>
        </div>
        <div class="panel-footer text-center">
            <p class="description"><%- offer.details %></p>
            <div><b>Date of review:</b> <%- offer.date_review %></div>
            <% if (status) { %>
            <button class="undo-offer-btn btn btn-primary">Undo</button>
            <% } %>

            <% if (!status && offer.user.id != {{ Auth::user()->id }}) { %>
            <button class="request-offer-btn btn btn-primary">Offer</button>
            <% } %>

            <button class="request-details-btn btn btn-info">Details</button>
            <% if (offer.user.id == {{ Auth::user()->id }}) { %>
            <button class="request-delete-btn btn btn-danger">Delete</button>
            <% } %>
        </div>
    </div>

</script>


{{-- Create Review Request Form backbone template--}}

<script type="text/template" id="create-request-form-template">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Review Request</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="#" id="create-request-form">

                            <div class="form-group">
                                <label class="col-md-1 control-label">Title</label>
                                <div class="col-md-11">
                                    <input type="text" class="title-input form-control" name="title" id="title" placeholder="Title">
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Details</label>
                                    <div class="btn-toolbar" data-role="editor-toolbar"
                                         data-target="#editor">
                                        <div class="btn-group">
                                            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a data-edit="fontSize 5" class="fs-Five">Huge</a></li>
                                                <li><a data-edit="fontSize 3" class="fs-Three">Normal</a></li>
                                                <li><a data-edit="fontSize 1" class="fs-One">Small</a></li>
                                            </ul>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-default" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                                            <a class="btn btn-default" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                                            <a class="btn btn-default" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                                            <a class="btn btn-default" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-default" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                                            <a class="btn btn-default" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-default" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                                            <a class="btn btn-default" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                                            <a class="btn btn-default" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                                            <div class="dropdown-menu input-append">
                                                <input placeholder="URL" type="text" data-edit="createLink" />
                                                <button class="btn" type="button">Add</button>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-default" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-unlink"></i></a>
						            <span class="btn btn-default" title="Insert picture (or just drag & drop)" id="pictureBtn"> <i class="fa fa-picture-o"></i>
							            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 37px; height: 30px;">
						            </span>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-default" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                                            <a class="btn btn-default" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div id="editor" class="details-input"></div>
                                </div>

                            </div> <!-- End Col-MD-10 -->

                            <div class="form-group">
                                <label class="col-md-1 control-label">Date</label>
                                <div class="col-md-11">
                                    <input type="text" class="form-control"  bootstrap-datepicker data-date-end-date="0d" id="date_review" name='date_review'/>
                                    <span class="help-block hidden"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-1 control-label">Tags</label>
                                <div class="col-md-11">
                                    <input type="text" class="tags-input form-control" id="hashtags" placeholder="use in this input regexp: #\w+">
                                    <span class="help-block hidden"></span>
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
                                             aria-hidden="true"></span> <%= created_at %></small>
                            </p>
                            <div id="details"><%= details %></div>

                            <ul class="tags list-inline">Request Tags List</ul>
                             <b>Date of review:</b> <span id="date_review"><%= date_review %></span>
                        </div>
                        <div class="panel-footer">
                            <span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>
                            <a href="#!/requests/group/<%= group_id %>">
                                <%= group.title %>
                            </a>
                            &nbsp;
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <a href="#!/requests/user/<%= user_id %>">
                                <%= user.first_name + ' ' + user.last_name%>
                            </a>
                            &nbsp;
                            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                            <span id="reputation"><%= reputation %></span>
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
                There is no comments yet. Be the first
            </div>

        </div>
    </div>

</script>


{{-- Reviewer backbone template--}}

<script type="text/template" id="reviewer-card-template">
    <div class="thumbnail">
        <img src="<%= offer.avatar %>" alt="offers" class="img-thumbnail">
        <p><b><%= offer.first_name + ' ' + offer.last_name %></b></p>
        <% if (author_id == userID) { %>
        <% if (offer.pivot.isAccepted) { %>
        <button class="decline btn btn-danger">Decline</button>
        <% } else { %>
        <button class="accept btn btn-primary">Accept</button>
        <% } %>
        <% } %>
    </div>
</script>


{{-- Single Comment backbone template--}}
<script type="text/template" id="single-comment-template">
    <div class="row">
        <!-- Text -->
        <div class="col-md-10">
            <strong><%= user.first_name + ' ' + user.last_name %></strong>
            <div class="comment-time pull-right text-muted">
                <small>
                    <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                <%= created_at %>
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
                            <input class="btn btn-success" type="submit" form="new-comment-form" value="Save">
                        </span>
                 
                    </div><!-- /input-group -->
                </form>
            </div>
            <div class="panel-footer text-center">
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
                    <%= first_name + ' ' + last_name %>
                    &nbsp;
                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    <%= reputation %>
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4"><img src="<%= avatar %>" alt="avatar" class="thumbnail"></div>
                    <div class="user-info col-md-8 text-left">
                        <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                            <%= email %>
                        </p>
                        <p><span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                            <%= phone %>
                        </p>
                        <p><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            <a href="#!/requests/user/<%= id %>">His Requests</a>
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
                <%= first_name + ' ' + last_name %>
                &nbsp;
                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                <%= reputation %>
            </h3>

        </div>
        <div class="panel-body">
            <div class="thumbnail">
                <img src="<%= avatar %>" alt="avatar" width="120" height="120" class="thumbnail">
                <div class="user-info caption">
                    <p><span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                        <%= department.title %></p>
                    <p>(<%= job.position %>)</p>
                    <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                        <%= email %></p>
                    <p><span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                        <%= phone %></p>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <%= first_name %> <%= last_name %>
                        &nbsp;
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        <%= reputation %>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="photo col-md-4 text-center">
                            <img src="<%= avatar %>" alt="avatar" width="140" heigth="140" class="img-thumbnail img-responsive">
                        </div>
                        <div class="info col-md-8">
                            <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                                <%= email %></p>
                            <p><span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                                <%= phone %></p>
                            <p><span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                                <%= department.title %></p>
                            <p>(<%= job.position %>)</p>
                            <p><span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                                <%= address %></p>
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
    <a href="#!/requests/tag/<%= id %>">
        <span class="label label-success" title="<%= requests_count %>">
            <%= title %>
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
                <h3 class="tilecaption"><%= title %></h3>
            </div>
            <div class="item">
                <h3 class="tilecaption"><%= requests_count %></h3>
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
    <ul class="notifications list-group">
    </ul>
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
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/bootstrap-wysiwyg/bootstrap-wysiwyg.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/bootstrap-wysiwyg/external/jquery.hotkeys.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/bootstrap-editable.min.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/vendor/jcloud/jqcloud.min.js')}}"></script>
<!-- END VENDOR SCRIPTS -->

<script>
$( document ).ready(function() {

    $(window).resize(function() {
    if(this.resizeTO) clearTimeout(this.resizeTO);
    this.resizeTO = setTimeout(function() {
        $(this).trigger('resizeEnd');
    }, 10);
    });
    
    $(window).bind('resizeEnd', function() {
        $(".tile").height($(".tile").width());
        $(".carousel").height($(".tile").width());
        $(".item").height($(".tile").width());
    });

});
</script>

<!-- APP SCRIPTS -->
<script src="{{asset(env('APP_PREFIX', '') .'/js/app.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/models.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/collections.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/views.js')}}"></script>
<script src="{{asset(env('APP_PREFIX', '') .'/js/routes.js')}}"></script>

<!-- END APP SCRIPTS -->

</body>
</html>