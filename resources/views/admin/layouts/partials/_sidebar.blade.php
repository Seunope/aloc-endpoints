<?php
/**
 * Created by PhpStorm.
 * User: Gathem
 * Date: 6/07/2021
 * Time: 8:24 PM
 */?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{url('admin/img/profile_small.jpg')}}" />
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{auth()->user()->name}}</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class>
                <a href="{{url('admin/dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>
{{--                <ul class="nav nav-second-level">--}}
{{--                    <li><a href="{{url('admin/dashboard')}}">Dashboard</a></li>--}}
{{--                </ul>--}}
            </li>
            <li>
                <a href="{{url('admin/access-token')}}"><i class="fa fa-diamond"></i> <span class="nav-label">Access Token</span> <span class="label label-primary pull-right">NEW</span></a>
            </li>

{{--            <li>--}}
{{--                <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">Mailbox </span><span class="label label-warning pull-right">16/24</span></a>--}}
{{--                <ul class="nav nav-second-level">--}}
{{--                    <li><a href="mailbox.html">Inbox</a></li>--}}
{{--                    <li><a href="mail_detail.html">Email view</a></li>--}}
{{--                    <li><a href="mail_compose.html">Compose email</a></li>--}}
{{--                    <li><a href="email_template.html">Email templates</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
            <li>
                <a href="widgets.html"><i class="fa fa-flask"></i> <span class="nav-label">Billing</span> </a>
            </li>
            <li>
                <a href="widgets.html"><i class="fa fa-people"></i> <span class="nav-label">Profile</span> </a>
            </li>


            <li class="special_link">
                <a href="package.html"><i class="fa fa-database"></i> <span class="nav-label">Package</span></a>
            </li>
        </ul>

    </div>
</nav>
