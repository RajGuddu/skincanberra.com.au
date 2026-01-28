@php
$segment1 = Request::segment(1);
$segment2 = Request::segment(2);
use App\Models\Common_model;
$commonmodel = new Common_model;
$newOrdersCount = $commonmodel->get_all_new_product_order(1)->count();
$allOrdersCount = $commonmodel->get_all_new_product_order()->count();
@endphp
<div id="app-sidepanel" class="app-sidepanel">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding">
            <a class="app-logo" href="{{ url('admin/dashboard') }}"><img class="logo-icon me-2"
                    src="{{ url('assets/frontend/images/skin-canberra.svg') }}" alt="logo"><span
                    class="logo-text">Skin Canberra</span></a>
        </div><!--//app-branding-->
        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                <li class="nav-item has-submenu">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#dashboard"
                        aria-expanded="{{ ($segment2 == 'dashboard' || $segment2 == 'cms' || $segment2 == 'add_edit_cms')?'true':'false' }}" aria-controls="dashboard">
                        <span class="nav-icon">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <!-- Product box -->
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                                <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                            </svg>

                        </span>
                        <span class="nav-link-text">Dashboard</span>
                        <span class="submenu-arrow">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </span><!--//submenu-arrow-->
                    </a><!--//nav-link-->
                    <div id="dashboard" class="collapse submenu dashboard {{ ($segment2 == 'dashboard' || $segment2 == 'cms' || $segment2 == 'add_edit_cms')?'show':'' }}" data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a class="submenu-link {{ ($segment2 == 'dashboard')?'active':'' }}" href="{{ url('admin/dashboard') }}">Overview</a>
                            </li>
                            <li class="submenu-item"><a class="submenu-link {{ ($segment2 == 'cms' || $segment2 == 'add_edit_cms')?'active':'' }}" href="{{ url('admin/cms') }}">CMS</a>
                            </li>
                            
                        </ul>
                    </div>
                </li><!--//nav-item-->
                <li class="nav-item has-submenu">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#content"
                        aria-expanded="{{ ($segment2 == 'banner' || $segment2 == 'add_edit_banner' || $segment2 == 'homeContent' || $segment2 == 'aboutContent')?'true':'false' }}" aria-controls="content">
                        <span class="nav-icon">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <!-- Product box -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.793.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674  0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291a1.873 1.873 0 0 0-1.116-2.693l-.318-.094c-.835-.246-.835-1.428  0-1.674l.319-.094a1.873 1.873 0 0 0 1.115-2.692l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.291.159a1.873 1.873 0 0 0 2.693-1.115l.094-.319z" />
                            </svg>

                        </span>
                        <span class="nav-link-text">Content Management</span>
                        <span class="submenu-arrow">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </span><!--//submenu-arrow-->
                    </a><!--//nav-link-->
                    <div id="content" class="collapse submenu content {{ ($segment2 == 'banner' || $segment2 == 'add_edit_banner' || $segment2 == 'homeContent' || $segment2 == 'aboutContent')?'show':'' }}" data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a class="submenu-link {{ ($segment2 == 'banner' || $segment2 == 'add_edit_banner')?'active':'' }}" href="{{ url('admin/banner') }}">Manage Banner</a>
                            </li>
                            <li class="submenu-item"><a class="submenu-link {{ ($segment2 == 'homeContent')?'active':'' }}" href="{{ url('admin/homeContent') }}">Home/Contact Content</a>
                            <li class="submenu-item"><a class="submenu-link {{ ($segment2 == 'aboutContent')?'active':'' }}" href="{{ url('admin/aboutContent') }}">About Content</a>
                            </li>
                            
                        </ul>
                    </div>
                </li><!--//nav-item-->
                <li class="nav-item has-submenu">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#Customer"
                        aria-expanded="{{ ($segment2 == 'testimonials' || $segment2 == 'add_edit_testimonial' || $segment2 == 'contact_us')?'true':'false' }}" aria-controls="content">
                        <span class="nav-icon">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <!-- Product box -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 1-.707-.293l-3.414-3.414A1 1 0 0 1 0 10.586V4zm2-1a1 1 0 0 0-1 1v6.586L3.414 12H14a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H2z"/>
                            </svg>
                        </span>
                        <span class="nav-link-text">Customer Interaction</span>
                        <span class="submenu-arrow">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </span><!--//submenu-arrow-->
                    </a><!--//nav-link-->
                    <div id="Customer" class="collapse submenu Customer {{ ($segment2 == 'appointment' || $segment2 == 'appointment-list' || $segment2 == 'customers' || $segment2 == 'customer_orders' || $segment2 == 'new_orders' || $segment2 == 'testimonials' || $segment2 == 'add_edit_testimonial' || $segment2 == 'contact_us' || $segment2 == 'purchased_courses' || $segment2 == 'all_orders')?'show':'' }}" data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a class="submenu-link {{ ($segment2 == 'customers' || $segment2 == 'customer_orders' || $segment2 == 'purchased_courses')?'active':'' }}" href="{{ url('admin/customers') }}">Customers</a>
                            </li>
                            <li class="submenu-item">
                                <a class="submenu-link {{ ($segment2 == 'new_orders')?'active':'' }}" href="{{ url('admin/new_orders') }}">New Orders
                                <span class="badge bg-danger ms-2">{{ $newOrdersCount ?? 0 }}</span>
                                </a>
                            </li>
                            <li class="submenu-item">
                                <a class="submenu-link {{ ($segment2 == 'all_orders')?'active':'' }}" href="{{ url('admin/all_orders') }}">All Orders
                                <span class="badge bg-danger ms-2">{{ $allOrdersCount ?? 0 }}</span>
                                </a>
                            </li>
                            <li class="submenu-item"><a class="submenu-link {{ ($segment2 == 'appointment')?'active':'' }}" href="{{ url('admin/appointment') }}">Appointment Weekly</a>
                            </li>
                            <li class="submenu-item"><a class="submenu-link {{ ($segment2 == 'appointment-list')?'active':'' }}" href="{{ url('admin/appointment-list') }}">Appointment List</a>
                            </li>
                            <li class="submenu-item"><a class="submenu-link {{ ($segment2 == 'testimonials' || $segment2 == 'add_edit_testimonial')?'active':'' }}" href="{{ url('admin/testimonials') }}">Testimonial</a>
                            </li>
                            <li class="submenu-item"><a class="submenu-link {{ ($segment2 == 'contact_us')?'active':'' }}" href="{{ url('admin/contact_us') }}">Contact Us</a>
                            
                        </ul>
                    </div>
                </li><!--//nav-item-->
                <li class="nav-item has-submenu">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#Services"
                        aria-expanded="{{ ($segment2 == 'services' || $segment2 == 'add_service' || $segment2 == 'edit_service' || $segment2 == 'variants' || $segment2 == 'realResult' || $segment2 == 'add_realResult')?'true':'false' }}" aria-controls="content">
                        <span class="nav-icon">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <!-- Product box -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M4 4V3a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v1h2.5A1.5 1.5 0 0 1 16 5.5v2.5H0V5.5A1.5 1.5 0 0 1 1.5 4H4zm1-1v1h6V3a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1z"/>
                                <path d="M0 9h16v3.5A1.5 1.5 0 0 1 14.5 14h-13A1.5 1.5 0 0 1 0 12.5V9z"/>
                            </svg>
                        </span>
                        <span class="nav-link-text">Services & Results</span>
                        <span class="submenu-arrow">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </span><!--//submenu-arrow-->
                    </a><!--//nav-link-->
                    <div id="Services" class="collapse submenu Services {{ ($segment2 == 'services' || $segment2 == 'add_service' || $segment2 == 'edit_service' || $segment2 == 'variants' || $segment2 == 'realResult' || $segment2 == 'add_realResult')?'show':'' }}" data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a class="submenu-link {{ ($segment2 == 'services' || $segment2 == 'add_service' || $segment2 == 'edit_service' || $segment2 == 'variants')?'active':'' }}" href="{{ url('admin/services') }}">Service</a>
                            </li>
                            <li class="submenu-item"><a class="submenu-link {{ ($segment2 == 'realResult' || $segment2 == 'add_realResult')?'active':'' }}" href="{{ url('admin/realResult') }}">Real Result (Image Upload)</a>
                            
                        </ul>
                    </div>
                </li><!--//nav-item-->
                
                <li class="nav-item has-submenu">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1"
                        aria-expanded="{{ ($segment2 == 'product_category' || $segment2 == 'products' || $segment2 == 'add_edit_product')?'true':'false' }}" aria-controls="submenu-1">
                        <span class="nav-icon">
                            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                            <!-- Product box -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <title>Product</title>
                            <path d="M21 16V8a1 1 0 0 0-.5-.87l-8-4.5a1 1 0 0 0-1 0L3.5 7.13A1 1 0 0 0 3 8v8a1 1 0 0 0 .5.87l8 4.5a1 1 0 0 0 1 0l8-4.5A1 1 0 0 0 21 16z"/>
                            <path d="M12 2v7"/>
                            <path d="M3.5 7.13l8 4.5 8-4.5"/>
                            </svg>

                        </span>
                        <span class="nav-link-text">Products</span>
                        <span class="submenu-arrow">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </span><!--//submenu-arrow-->
                    </a><!--//nav-link-->
                    <div id="submenu-1" class="collapse submenu submenu-1 {{ ($segment2 == 'product_category' || $segment2 == 'products' || $segment2 == 'add_edit_product')?'show':'' }}" data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="submenu-item"><a class="submenu-link {{ ($segment2 == 'product_category')?'active':'' }}" href="{{ url('admin/product_category') }}">Product Category</a>
                            </li>
                            <li class="submenu-item"><a class="submenu-link {{ ($segment2 == 'products' || $segment2 == 'add_edit_product')?'active':'' }}" href="{{ url('admin/products') }}">Products</a>
                            </li>
                            
                        </ul>
                    </div>
                </li><!--//nav-item-->
                
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ ($segment2 == 'courses')?'active':'' }}"
                        href="{{ url('admin/courses') }}">
                        <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-book"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 2.828c.885-.37 2.154-.828 4-.828 1.846 0 3.115.458 4 .828v9.344c-.885-.37-2.154-.828-4-.828-1.846 0-3.115.458-4 .828V2.828z"/>
                                <path d="M9 2.828c.885-.37 2.154-.828 4-.828 1.846 0 3.115.458 4 .828v9.344c-.885-.37-2.154-.828-4-.828-1.846 0-3.115.458-4 .828V2.828z"/>
                            </svg>

                        </span>
                        <span class="nav-link-text">Courses</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ ($segment2 == 'holidays')?'active':'' }}"
                        href="{{ url('admin/holidays') }}">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" class="bi bi-book" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M12 2C10.343 2 9 3.343 9 5s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 6c-1.654 0-3 1.346-3 3 0 1.309.835 2.418 2 2.828V18h2v-6.172c1.165-.41 2-1.519 2-2.828 0-1.654-1.346-3-3-3z"/>
                            </svg>


                        </span>
                        <span class="nav-link-text">Holidays</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link {{ ($segment2 == 'settings')?'active':'' }}"
                        href="{{ url('admin/settings') }}">
                        <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z" />
                                <path fill-rule="evenodd"
                                    d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z" />
                            </svg>
                        </span>
                        <span class="nav-link-text">Settings</span>
                    </a><!--//nav-link-->
                </li><!--//nav-item-->
                
            </ul><!--//app-menu-->
        </nav><!--//app-nav-->
        <?php /* <div class="app-sidepanel-footer">
            <nav class="app-nav app-nav-footer">
                <ul class="app-menu footer-menu list-unstyled">
                    
                    
                </ul><!--//footer-menu-->
            </nav>
        </div><!--//app-sidepanel-footer--> */ ?>
    </div><!--//sidepanel-inner-->
</div><!--//app-sidepanel-->