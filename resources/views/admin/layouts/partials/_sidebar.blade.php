<?php
/**
 * Created by PhpStorm.
 * User: Gathem
 * Date: 2/24/2019
 * Time: 7:24 PM
 */?>
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{url('/assets/img/admin-avatar.png')}}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">Mama</div><small>Administrator</small></div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="{{url('admin/dashboard')}}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">FEATURES</li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Manage Users</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{url('admin/users')}}">List Users</a>
                    </li>
                    <li>
                        <a href="{{url('admin/users/devices')}}">User Devices</a>
                    </li>
                    <li>
                        <a href="{{url('admin/users/devices/more')}}">User Devices More</a>
                    </li>
                    <li>
                        <a href="{{url('admin/user-avatar')}}">User Avatar</a>
                    </li>
                     <li>
                        <a href="{{url('admin/profile')}}">Profile</a>
                    </li>

                    <!--    <li>
                        <a href="buttons.html">Buttons</a>
                    </li>
                    <li>
                        <a href="tabs.html">Tabs</a>
                    </li>
                    <li>
                        <a href="alerts_tooltips.html">Alerts &amp; Tooltips</a>
                    </li>
                    <li>
                        <a href="badges_progress.html">Badges &amp; Progress</a>
                    </li>
                    <li>
                        <a href="lists.html">List</a>
                    </li>
                    <li>
                        <a href="cards.html">Card</a>
                    </li> -->
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-bar-chart"></i>
                    <span class="nav-label">Quiz</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{url('admin/quiz')}}">Quiz</a>
                    </li>
                    <li>
                        <a href="{{url('admin/quiz/results')}}">Results</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-table"></i>
                    <span class="nav-label">Wallet</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{url('admin/wallet/list')}}">List Wallet</a>
                    </li>
                    <li>
                        <a href="{{url('admin/wallet/tracker')}}">Wallet Tacker</a>
                    </li>
                    <li>
                        <a href="{{url('admin/wallet/transactions')}}">Wallet Transaction</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-table"></i>
                    <span class="nav-label">Earnings</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{url('admin/earnings/list')}}">List Earning</a>
                    </li>
                    <li>
                        <a href="{{url('admin/earnings/trans')}}">Earning Transaction</a>
                    </li>
                    <li>
                        <a href="{{url('admin/earnings/recharge')}}">Phone Recharge</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-bar-chart"></i>
                    <span class="nav-label">Transactions</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">

                    <li>
                        <a href="{{url('admin/wallet/transactions/paystack')}}">Paystack Transaction</a>
                    </li>
                    <li>
                        <a href="{{url('admin/wallet/transactions/payant')}}">Payant Transaction</a>
                    </li>
                    <li>
                        <a href="{{url('admin/transfer-cards')}}">Card Transfer</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-table"></i>
                    <span class="nav-label">Token Management</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{url('admin/tokens')}}">List Tokens</a>
                    </li>
                    <li>
                        <a href="{{url('admin/token/create')}}">Create Promo Token</a>
                    </li>
                    <li>
                        <a href="{{url('admin/token/usage')}}">Token Usage Tracker</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-table"></i>
                    <span class="nav-label">Market Place</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{url('admin/mkt/merchants')}}">Merchants</a>
                    </li>
                    <li>
                        <a href="{{url('admin/mkt/merchant-transactions')}}">Merchant Transactions</a>
                    </li>
                    <li>
                        <a href="{{url('admin/mkt/clients')}}">Admin Clients</a>
                    </li>

                    {{--                <li>--}}
                    {{--                    <a href="{{url('admin/earnings/recharge')}}">Phone Recharge</a>--}}
                    {{--                </li>--}}
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-map"></i>
                    <span class="nav-label">Manage Posts</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{url('admin/posts')}}">List Posts</a>
                    </li>
                    {{--                    <li>--}}
                    {{--                        <a href="{{url('admin/posts')}}">List Posts</a>--}}
                    {{--                    </li>--}}

                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-bar-chart"></i>
                    <span class="nav-label">Mobile Slider</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{url('admin/image-slider/create')}}">Add Image</a>
                    </li>
                    <li>
                        <a href="{{url('admin/image-slider')}}">List Images</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-bar-chart"></i>
                    <span class="nav-label">Funny Images</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{url('admin/funny-image/create')}}">Add Image</a>
                    </li>
                    <li>
                        <a href="{{url('admin/funny-image')}}">List Images</a>
                    </li>
                    <li>
                        <a href="{{url('admin/funny-share-metrics')}}">Images Metrics</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-map"></i>
                    <span class="nav-label">Faqs</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{url('admin/faqs/create')}}">Create Faqs</a>
                    </li>
                    <li>
                        <a href="{{url('admin/faqs')}}">List Faqs</a>
                    </li>

                </ul>
            </li>

        <li>
            <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
                <span class="nav-label">Vault</span><i class="fa fa-angle-left arrow"></i></a>
            <ul class="nav-2-level collapse">
                <li>
                    <a href="{{url('admin/vault/create')}}">Fund Vault</a>
                </li>
                <li>
                    <a href="{{url('admin/vault/1/edit')}}">Withdraw form Vault</a>
                </li>
                <li>
                    <a href="{{url('admin/vault')}}">Vault Transactions</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;"><i class="sidebar-item-icon fa fa-bar-chart"></i>
                <span class="nav-label">Advert Expenses</span><i class="fa fa-angle-left arrow"></i></a>
            <ul class="nav-2-level collapse">
                <li>
                    <a href="{{url('admin/advert/create')}}">Add Advert</a>
                </li>
                <li>
                    <a href="{{url('admin/advert')}}">List Advert Expenses</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{url('admin/status')}}"><i class="sidebar-item-icon fa fa-calendar"></i>
                <span class="nav-label">Status</span>
            </a>
        </li>
            <!--   <li>
               <a href="javascript:;"><i class="sidebar-item-icon fa fa-map"></i>
                   <span class="nav-label">Maps</span><i class="fa fa-angle-left arrow"></i></a>
               <ul class="nav-2-level collapse">
                   <li>
                       <a href="maps_vector.html">Vector maps</a>
                   </li>
               </ul>
           </li>
           <li>
               <a href="icons.html"><i class="sidebar-item-icon fa fa-smile-o"></i>
                   <span class="nav-label">Icons</span>
               </a>
           </li>
           <li class="heading">PAGES</li>
           <li>
               <a href="javascript:;"><i class="sidebar-item-icon fa fa-envelope"></i>
                   <span class="nav-label">Mailbox</span><i class="fa fa-angle-left arrow"></i></a>
               <ul class="nav-2-level collapse">
                   <li>
                       <a href="mailbox.html">Inbox</a>
                   </li>
                   <li>
                       <a href="mail_view.html">Mail view</a>
                   </li>
                   <li>
                       <a href="mail_compose.html">Compose mail</a>
                   </li>
               </ul>
           </li>
           <li>
               <a href="calendar.html"><i class="sidebar-item-icon fa fa-calendar"></i>
                   <span class="nav-label">Calendar</span>
               </a>
           </li>
           <li>
               <a href="javascript:;"><i class="sidebar-item-icon fa fa-file-text"></i>
                   <span class="nav-label">Pages</span><i class="fa fa-angle-left arrow"></i></a>
               <ul class="nav-2-level collapse">
                   <li>
                       <a href="invoice.html">Invoice</a>
                   </li>
                   <li>
                       <a href="profile.html">Profile</a>
                   </li>
                   <li>
                       <a href="login.html">Login</a>
                   </li>
                   <li>
                       <a href="register.html">Register</a>
                   </li>
                   <li>
                       <a href="lockscreen.html">Lockscreen</a>
                   </li>
                   <li>
                       <a href="forgot_password.html">Forgot password</a>
                   </li>
                   <li>
                       <a href="error_404.html">404 error</a>
                   </li>
                   <li>
                       <a href="error_500.html">500 error</a>
                   </li>
               </ul>
           </li>
           <li>
               <a href="javascript:;"><i class="sidebar-item-icon fa fa-sitemap"></i>
                   <span class="nav-label">Menu Levels</span><i class="fa fa-angle-left arrow"></i></a>
               <ul class="nav-2-level collapse">
                   <li>
                       <a href="javascript:;">Level 2</a>
                   </li>
                   <li>
                       <a href="javascript:;">
                           <span class="nav-label">Level 2</span><i class="fa fa-angle-left arrow"></i></a>
                       <ul class="nav-3-level collapse">
                           <li>
                               <a href="javascript:;">Level 3</a>
                           </li>
                           <li>
                               <a href="javascript:;">Level 3</a>
                           </li>
                       </ul>
                   </li>
               </ul>
           </li> -->
        </ul>
    </div>
</nav>

