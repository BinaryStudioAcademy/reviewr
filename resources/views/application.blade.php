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
    <link href="css/jquery-ui.css" rel="stylesheet">
    <link href="css/bootstrap-tokenfield.css" rel="stylesheet">
    <link href="css/tokenfield-typeahead.css" rel="stylesheet">
    <link href="js/vendor/bootstrap-wysiwyg/index.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">

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
            <a class="navbar-brand" href="#"></a>
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
                    </a>
                </li>
                <li><a href="#!/badges">
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        Badges
                    </a>
                </li>
                {{--<li><a href="#!/popular">--}}
                        {{--<span class="glyphicon glyphicon-fire" aria-hidden="true"></span>--}}
                        {{--Popular--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li><a href="#!/request/create">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        Create request
                    </a>
                </li>
                <li><a href="#!/requests/my">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        My Request
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
                        <li><a href="{{ route('logout') }}">Log Out</a></li>
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
    <script>
        var userID = "{{ Auth::user()->id }}";
    </script>


{{-- One Review Request card backbone template--}}

<script type="text/template" id="request-card-template">

        <div class="panel panel-info">
            <div class="panel-heading">
                <h2 class="panel-title">
                    <%- title %>
                    <span class="badge"><%- (offers_count == 0) ? 'no offers' : offers_count %></span>
                </h2>
            </div>
            <div class="panel-body">
                <p>Created at: <%= created_at %></p>
                <div class="row user-data">
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 user-photo">
                        <img src="<%= user.avatar %>" class="img-responsive" alt="">
                    </div>
                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 user-info">
                        <p><%= user.first_name + ' ' + user.last_name%></p>
                        <p><%= user.email %></p>
                        <p><%= user.phone %></p>
                        <p>Group: <%= group.title %></p>
                    </div>
                </div>
            </div>
            <div class="panel-footer text-center">
                <p class="description"><%- details %></p>
                <% if (user.id != {{ Auth::user()->id }}) { %>
                    <button class="request-offer-btn btn btn-primary">Offer</button>
                <% } %>
                <button class="request-details-btn btn btn-info">Details</button>
                <% if (user.id == {{ Auth::user()->id }}) { %>
                    <button class="request-delete-btn btn btn-danger">Delete</button>
                <% } %>
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
                        <form class="form-horizontal" role="form" method="POST" action="#" id="create-request-form">

                            <div class="form-group">
                                <label class="col-md-1 control-label">Title</label>
                                <div class="col-md-11">
                                    <input type="text" class="title-input form-control" name="title" placeholder="Title">
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

                                <a class="btn btn-default" data-edit="formatblock pre" title="Code">Code</a>

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
                        <p><%= details %></p>
                        <p>Group: <%= group.title %>, Author: <%= user.first_name + user.last_name%></p>
                        <p>Created at: <%= created_at %></p>
                        <div class="tags">Request Tags List</div>
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
        <p class='id'><%= id %></p>
        <p><%= first_name %></p>
        <p><%= last_name %></p>
        <div class="buttons">
            <button class="accept btn btn-primary">Accept</button>
            <button class="decline btn btn-info">Decline</button>
        </div>
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

<script type="text/template" id="tag-template">
<p>id: <%= id %></p>
<p>title: <%= title %></p>
</script>

<script src="js/vendor/jquery/jquery.js"></script>
<script src="js/vendor/bootstrap/bootstrap.js"></script>
<script src="js/vendor/jquery/jqueryui.js"></script>
<script src="js/vendor/bootstrap/bootstrap-tokenfield.js"></script>
<script src="js/vendor/bootstrap/typeahead.bundle.min.js"></script>
<script src="js/vendor/underscore/underscore.js"></script>
<script src="js/vendor/backbone/backbone.js"></script>
<script src="js/vendor/bootstrap-wysiwyg/bootstrap-wysiwyg.js"></script>
<script src="js/vendor/bootstrap-wysiwyg/external/jquery.hotkeys.js"></script>
<script src="js/vendor/bootstrap-wysiwyg/external/google-code-prettify/prettify.js"></script>

<script src="js/app.js"></script>
<script src="js/models.js"></script>
<script src="js/collections.js"></script>
<script src="js/views.js"></script>
<script src="js/routes.js"></script>

</body>
</html>