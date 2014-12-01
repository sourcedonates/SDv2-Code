 <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{{File::exists(public_path() . '/uploads/userimages/'. $user->id . '-avatar.png') ? asset("uploads/userimages/".$user->id."-avatar.png") : asset("uploads/userimages/default.png")}}}" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, {{{isset($username) ? $username : ''}}}</p>

                            <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
                        </div>
                    </div>
                    <!-- search form
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="{{url('user/dashboard')}}">
                                <i class="fa fa-globe"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-sitemap"></i>
                                <span>Items</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('items/bought')}}"><i class="fa fa-angle-double-right"></i> Bought Items</a></li>
                                <li><a href="{{url('items/available')}}"><i class="fa fa-angle-double-right"></i> Available Items</a></li>
                                <li><a href="{{url('items/create')}}"><i class="fa fa-angle-double-right"></i> Create new Item</a></li>
                                <li><a href="{{url('items/assign')}}"><i class="fa fa-angle-double-right"></i> Assign Item to User</a></li>
                                <li><a href="{{url('items/show_provider')}}"><i class="fa fa-angle-double-right"></i> Available IPs</a></li>
                                <li><a href="{{url('items/create_provider')}}"><i class="fa fa-angle-double-right"></i> Create new IP</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-eur"></i>
                                <span>Payment</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('payment/show_provider')}}"><i class="fa fa-angle-double-right"></i> Available PPs</a></li>
                                <li><a href="{{url('payment/create_provider')}}"><i class="fa fa-angle-double-right"></i> Create new PP</a></li>
                                <li><a href="{{url('payment/show_transactions')}}"><i class="fa fa-angle-double-right"></i> Show Transactions</a></li>
                                <li><a href="{{url('payment/create_transaction')}}"><i class="fa fa-angle-double-right"></i> Add a manual transaction</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Users</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('users/show_users')}}"><i class="fa fa-angle-double-right"></i> Show Users</a></li>
                                <li><a href="{{url('users/create_user')}}"><i class="fa fa-angle-double-right"></i> Create new User</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-tachometer"></i>
                                <span>Stats / Info</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('stats/item')}}"><i class="fa fa-angle-double-right"></i> Item Stats</a></li>
                                <li><a href="{{url('stats/payment')}}"><i class="fa fa-angle-double-right"></i> Payment Stats</a></li>
                                <li><a href="{{url('stats/user')}}"><i class="fa fa-angle-double-right"></i> User Stats</a></li>
                                <li><a href="{{url('stats/failed_jobs')}}"><i class="fa fa-angle-double-right"></i> Failed Jobs</a></li>
                            </ul>
                        </li>
                        @if($user->hasAccess(['default.view'])))
                        <li>
                            <a href="pages/widgets.html">
                                <i class="fa fa-th"></i> <span>Widgets</span> <small class="badge pull-right bg-green">new</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Charts</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/charts/morris.html"><i class="fa fa-angle-double-right"></i> Morris</a></li>
                                <li><a href="pages/charts/flot.html"><i class="fa fa-angle-double-right"></i> Flot</a></li>
                                <li><a href="pages/charts/inline.html"><i class="fa fa-angle-double-right"></i> Inline charts</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>UI Elements</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/UI/general.html"><i class="fa fa-angle-double-right"></i> General</a></li>
                                <li><a href="pages/UI/icons.html"><i class="fa fa-angle-double-right"></i> Icons</a></li>
                                <li><a href="pages/UI/buttons.html"><i class="fa fa-angle-double-right"></i> Buttons</a></li>
                                <li><a href="pages/UI/sliders.html"><i class="fa fa-angle-double-right"></i> Sliders</a></li>
                                <li><a href="pages/UI/timeline.html"><i class="fa fa-angle-double-right"></i> Timeline</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Forms</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/forms/general.html"><i class="fa fa-angle-double-right"></i> General Elements</a></li>
                                <li><a href="pages/forms/advanced.html"><i class="fa fa-angle-double-right"></i> Advanced Elements</a></li>
                                <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> Editors</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Tables</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/tables/simple.html"><i class="fa fa-angle-double-right"></i> Simple tables</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> Data tables</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="pages/calendar.html">
                                <i class="fa fa-calendar"></i> <span>Calendar</span>
                                <small class="badge pull-right bg-red">3</small>
                            </a>
                        </li>
                        <li>
                            <a href="pages/mailbox.html">
                                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                                <small class="badge pull-right bg-yellow">12</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>Examples</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/examples/invoice.html"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                <li><a href="pages/examples/login.html"><i class="fa fa-angle-double-right"></i> Login</a></li>
                                <li><a href="pages/examples/register.html"><i class="fa fa-angle-double-right"></i> Register</a></li>
                                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-angle-double-right"></i> Lockscreen</a></li>
                                <li><a href="pages/examples/404.html"><i class="fa fa-angle-double-right"></i> 404 Error</a></li>
                                <li><a href="pages/examples/500.html"><i class="fa fa-angle-double-right"></i> 500 Error</a></li>
                                <li><a href="pages/examples/blank.html"><i class="fa fa-angle-double-right"></i> Blank Page</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>