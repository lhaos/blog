<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adimin - <?=$pagTitle?></title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-reorder"></span>
        </button>
        <a class="navbar-brand" href="index.html">Awesome.</a>
    </div>
    <div class="hidden-xs">
        <ul class="nav navbar-nav pull-right">
            <li class="hidden-phone"><a href="#" role="button">Settings</a></li>
            <li id="fat-menu" class="dropdown">
                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-user"></i> Jack Smith
                    <i class="icon-caret-down"></i>
                </a>

                <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">My Account</a></li>
                    <li class="divider"></li>
                    <li><a tabindex="-1" class="visible-phone" href="#">Settings</a></li>
                    <li class="divider visible-phone"></li>
                    <li><a tabindex="-1" href="sign-in.html">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div><!--/.navbar-collapse -->
</div>

<div class="navbar-collapse collapse">
    <div id="main-menu">

        <div id="phone-navigation" class="visible-xs">
            <ul id="dashboard-menu" class="nav nav-list">
                <li class="active "><a rel="tooltip" data-placement="right" data-original-title="Dashboard" href="index.html"><i class="icon-home"></i> <span class="caption">Dashboard</span></a></li>

                <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Reports" href="reports.html"><i class="icon-bar-chart"></i> <span class="caption">Reports</span></a></li>

                <li class=" "><a rel="tooltip" data-placement="right" data-original-title="UI Features" href="components.html"><i class="icon-briefcase"></i> <span class="caption">UI Features</span></a></li>

                <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Pricing" href="pricing.html"><i class="icon-magic"></i> <span class="caption">Pricing</span></a></li>

                <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Media" href="media.html"><i class="icon-film"></i> <span class="caption">Media</span></a></li>

                <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Blog" href="blog.html"><i class="icon-beaker"></i> <span class="caption">Blog</span></a></li>

                <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Blog Entry" href="blog-item.html"><i class="icon-coffee"></i> <span class="caption">Blog Entry</span></a></li>

                <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Help" href="help.html"><i class="icon-question-sign"></i> <span class="caption">Help</span></a></li>

                <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Faq" href="faq.html"><i class="icon-book"></i> <span class="caption">Faq</span></a></li>

                <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Calendar" href="calendar.html"><i class="icon-calendar"></i> <span class="caption">Calendar</span></a></li>

                <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Forms" href="forms.html"><i class="icon-tasks"></i> <span class="caption">Forms</span></a></li>

                <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Tables" href="tables.html"><i class="icon-table"></i> <span class="caption">Tables</span></a></li>


                <li class=" theme-mobile-hack hidden-xs"><a rel="tooltip" data-placement="right" data-original-title="Mobile" href="mobile.html"><i class="icon-comment-alt"></i> <span class="caption">Mobile</span></a></li>
                <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Icons" href="icons.html"><i class="icon-heart"></i> <span class="caption">Icons</span></a></li>

            </ul>
        </div>

        <ul class="nav nav-tabs hidden-xs">
            <li class="active"><a href="index.html"><i class="icon-dashboard"></i> <span>Dashboard</span></a></li>
            <li ><a href="reports.html" ><i class="icon-bar-chart"></i> <span>Reports</span></a></li>
            <li ><a href="components.html" ><i class="icon-cogs"></i> <span>Components</span></a></li>
            <li ><a href="pricing.html"><i class="icon-magic"></i> <span>Pricing</span></a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i> Settings <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="sign-in.html"><span>Sign-in Page</span></a></li>
                    <li><a href="sign-up.html"><span>Sign-up Page</span></a></li>
                    <li><a href="reset-password.html"><span>Forgot Password Page</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<div id="sidebar-nav" class="hidden-xs">
    <ul id="dashboard-menu" class="nav nav-list">
        <li class="active "><a rel="tooltip" data-placement="right" data-original-title="Dashboard" href="index.html"><i class="icon-home"></i> <span class="caption">Dashboard</span></a></li>

        <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Reports" href="reports.html"><i class="icon-bar-chart"></i> <span class="caption">Reports</span></a></li>

        <li class=" "><a rel="tooltip" data-placement="right" data-original-title="UI Features" href="components.html"><i class="icon-briefcase"></i> <span class="caption">UI Features</span></a></li>

        <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Pricing" href="pricing.html"><i class="icon-magic"></i> <span class="caption">Pricing</span></a></li>

        <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Media" href="media.html"><i class="icon-film"></i> <span class="caption">Media</span></a></li>

        <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Blog" href="blog.html"><i class="icon-beaker"></i> <span class="caption">Blog</span></a></li>

        <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Blog Entry" href="blog-item.html"><i class="icon-coffee"></i> <span class="caption">Blog Entry</span></a></li>

        <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Help" href="help.html"><i class="icon-question-sign"></i> <span class="caption">Help</span></a></li>

        <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Faq" href="faq.html"><i class="icon-book"></i> <span class="caption">Faq</span></a></li>

        <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Calendar" href="calendar.html"><i class="icon-calendar"></i> <span class="caption">Calendar</span></a></li>

        <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Forms" href="forms.html"><i class="icon-tasks"></i> <span class="caption">Forms</span></a></li>

        <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Tables" href="tables.html"><i class="icon-table"></i> <span class="caption">Tables</span></a></li>


        <li class=" theme-mobile-hack"><a rel="tooltip" data-placement="right" data-original-title="Mobile" href="mobile.html"><i class="icon-comment-alt"></i> <span class="caption">Mobile</span></a></li>
        <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Icons" href="icons.html"><i class="icon-heart"></i> <span class="caption">Icons</span></a></li>

    </ul>
</div>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>