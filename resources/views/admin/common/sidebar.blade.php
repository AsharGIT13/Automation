            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="{{route('dashboard')}}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{asset('admin/assets/images/logo-sm.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{('admin/assets/images/logo-dark.png')}}" alt="" height="20">
                        </span>
                    </a>

                    <a href="{{route('dashboard')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset('admin/assets/images/logo-sm.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('admin/assets/images/logo-white.png')}}" alt="" height="20">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <div data-simplebar class="sidebar-menu-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="{{route('dashboard')}}">
                                    <i class="uil-home-alt"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <!--<li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-window-section"></i>
                                    <span>Layouts</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">Vertical</a>
                                        <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="layouts-dark-sidebar.html">Dark Sidebar</a></li>
                                            <li><a href="layouts-compact-sidebar.html">Compact Sidebar</a></li>
                                            <li><a href="layouts-icon-sidebar.html">Icon Sidebar</a></li>
                                            <li><a href="layouts-boxed.html">Boxed Width</a></li>
                                            <li><a href="layouts-preloader.html">Preloader</a></li>
                                            <li><a href="layouts-colored-sidebar.html">Colored Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">Horizontal</a>
                                        <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="layouts-horizontal.html">Horizontal</a></li>
                                            <li><a href="layouts-hori-topbar-dark.html">Topbar Dark</a></li>
                                            <li><a href="layouts-hori-boxed-width.html">Boxed Width</a></li>
                                            <li><a href="layouts-hori-preloader.html">Preloader</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>-->



                            <!-- <li>
                                <a href="calendar.html" class="waves-effect">
                                    <i class="uil-calender"></i>
                                    <span>Calendar</span>
                                </a>
                            </li>

                            <li>
                                <a href="chat.html" class=" waves-effect">
                                    <i class="uil-comments-alt"></i>
                                    <span>Chat</span>
                                </a>
                            </li>

                            <li>
                                <a href="file-manager.html" class=" waves-effect">
                                    <i class="uil-comments-alt"></i>
                                  
                                    <span>File Manager</span>
                                </a>
                            </li>-->



                            @if(auth()->user()->role_type == 1)
                            <li class="menu-title">Suppliers</li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-store"></i>
                                    <span>Suppliers</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('supplier.list')}}">Manage Supplier</a></li>
                                    <!-- <li><a href="ecommerce-product-detail.html">Product Detail</a></li>
                                    <li><a href="ecommerce-orders.html">Orders</a></li>
                                    <li><a href="ecommerce-customers.html">Customers</a></li>
                                    <li><a href="ecommerce-cart.html">Cart</a></li>
                                    <li><a href="ecommerce-checkout.html">Checkout</a></li>
                                    <li><a href="ecommerce-shops.html">Shops</a></li>
                                    <li><a href="ecommerce-add-product.html">Add Product</a></li> -->
                                </ul>
                            </li>
                            @endif
                            @if(session()->has('assigned_menus'))
                            @php
                            $assigned_menus = session()->get('assigned_menus');
                            @endphp

                            @if(!empty($assigned_menus))
                            @foreach($assigned_menus as $menuId => $menuItems)
                            @php
                            $menu = $menuItems->first()->menu;
                            @endphp
                            <li class="menu-title">{{ $menu->name }}</li>
                            <li>
                                <a href="javascript:void(0);" class="has-arrow waves-effect ParentMenu">
                                    <i class="uil-store"></i>
                                    <span>{{ $menu->name }}</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    @foreach($menuItems as $menuItem)
                                    <li><a href="{{ $menuItem->url }}">{{ $menuItem->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                            @endif
                            @endif
                            <!-- <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-envelope"></i>
                                    <span>Email</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="email-inbox.html">Inbox</a></li>
                                    <li><a href="email-read.html">Read Email</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-invoice"></i>
                                    <span>Invoices</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="invoices-list.html">Invoice List</a></li>
                                    <li><a href="invoices-detail.html">Invoice Detail</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-book-alt"></i>
                                    <span>Contacts</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="contacts-grid.html">User Grid</a></li>
                                    <li><a href="contacts-list.html">User List</a></li>
                                    <li><a href="contacts-profile.html">Profile</a></li>
                                </ul>
                            </li>-->

                            <!--<li class="menu-title">Pages</li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-user-circle"></i>
                                    <span>Authentication</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="auth-login.html">Login</a></li>
                                    <li><a href="auth-register.html">Register</a></li>
                                    <li><a href="auth-recoverpw.html">Recover Password</a></li>
                                    <li><a href="auth-lock-screen.html">Lock Screen</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-file-alt"></i>
                                    <span>Utility</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="pages-starter.html">Starter Page</a></li>
                                    <li><a href="pages-maintenance.html">Maintenance</a></li>
                                    <li><a href="pages-comingsoon.html">Coming Soon</a></li>
                                    <li><a href="pages-timeline.html">Timeline</a></li>
                                    <li><a href="pages-faqs.html">FAQs</a></li>
                                    <li><a href="pages-pricing.html">Pricing</a></li>
                                    <li><a href="pages-404.html">Error 404</a></li>
                                    <li><a href="pages-500.html">Error 500</a></li>
                                </ul>
                            </li>

                            <li class="menu-title">Components</li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-flask"></i>
                                    <span>UI Elements</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="ui-alerts.html">Alerts</a></li>
                                    <li><a href="ui-buttons.html">Buttons</a></li>
                                    <li><a href="ui-cards.html">Cards</a></li>
                                    <li><a href="ui-carousel.html">Carousel</a></li>
                                    <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                                    <li><a href="ui-grid.html">Grid</a></li>
                                    <li><a href="ui-images.html">Images</a></li>
                                    <li><a href="ui-lightbox.html">Lightbox</a></li>
                                    <li><a href="ui-modals.html">Modals</a></li>
                                    <li><a href="ui-offcanvas.html">Offcanvas</a></li>
                                    <li><a href="ui-rangeslider.html">Range Slider</a></li>
                                    <li><a href="ui-session-timeout.html">Session Timeout</a></li>
                                    <li><a href="ui-progressbars.html">Progress Bars</a></li>
                                    <li><a href="ui-placeholders.html">Placeholders</a></li>
                                    <li><a href="ui-sweet-alert.html">Sweet-Alert</a></li>
                                    <li><a href="ui-tabs-accordions.html">Tabs & Accordions</a></li>
                                    <li><a href="ui-typography.html">Typography</a></li>
                                    <li><a href="ui-utilities.html">Utilities<span class="badge rounded-pill bg-success float-end">New</span></a></li>
                                    <li><a href="ui-toasts.html">Toasts</a></li>
                                    <li><a href="ui-video.html">Video</a></li>
                                    <li><a href="ui-general.html">General</a></li>
                                    <li><a href="ui-colors.html">Colors</a></li>
                                    <li><a href="ui-rating.html">Rating</a></li>
                                    <li><a href="ui-notifications.html">Notifications</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="uil-shutter-alt"></i>
                                    <span class="badge rounded-pill bg-info float-end">9</span>
                                    <span>Forms</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="form-elements.html">Basic Elements</a></li>
                                    <li><a href="form-validation.html">Validation</a></li>
                                    <li><a href="form-advanced.html">Advanced Plugins</a></li>
                                    <li><a href="form-editors.html">Editors</a></li>
                                    <li><a href="form-uploads.html">File Upload</a></li>
                                    <li><a href="form-xeditable.html">Xeditable</a></li>
                                    <li><a href="form-repeater.html">Repeater</a></li>
                                    <li><a href="form-wizard.html">Wizard</a></li>
                                    <li><a href="form-mask.html">Mask</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-list-ul"></i>
                                    <span>Tables</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="tables-basic.html">Bootstrap Basic</a></li>
                                    <li><a href="tables-datatable.html">Datatables</a></li>
                                    <li><a href="tables-responsive.html">Responsive</a></li>
                                    <li><a href="tables-editable.html">Editable</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-chart"></i>
                                    <span>Charts</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="charts-apex.html">Apex</a></li>
                                    <li><a href="charts-chartjs.html">Chartjs</a></li>
                                    <li><a href="charts-flot.html">Flot</a></li>
                                    <li><a href="charts-knob.html">Jquery Knob</a></li>
                                    <li><a href="charts-sparkline.html">Sparkline</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-streering"></i>
                                    <span>Icons</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="icons-unicons.html">Unicons</a></li>
                                    <li><a href="icons-boxicons.html">Boxicons</a></li>
                                    <li><a href="icons-materialdesign.html">Material Design</a></li>
                                    <li><a href="icons-dripicons.html">Dripicons</a></li>
                                    <li><a href="icons-fontawesome.html">Font Awesome</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-location-point"></i>
                                    <span>Maps</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="maps-google.html">Google</a></li>
                                    <li><a href="maps-vector.html">Vector</a></li>
                                    <li><a href="maps-leaflet.html">Leaflet</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uil-share-alt"></i>
                                    <span>Multi Level</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="javascript: void(0);">Level 1.1</a></li>
                                    <li><a href="javascript: void(0);" class="has-arrow">Level 1.2</a>
                                        <ul class="sub-menu" aria-expanded="true">
                                            <li><a href="javascript: void(0);">Level 2.1</a></li>
                                            <li><a href="javascript: void(0);">Level 2.2</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>-->

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->