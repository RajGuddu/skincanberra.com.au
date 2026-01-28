
@php 
    use App\Models\Admin\SettingsModel;
    use App\Models\Common_model;
    $commonmodel = new Common_model;
    $settings = SettingsModel::where(['id'=>1])->first();
    $services = $commonmodel->getAllRecord('tbl_services',['status'=>1]);
    $segment1 = Request::segment(1);
    $segment2 = Request::segment(2);
@endphp

<header class="header">
    <div class="top-banner">
        <div class="container-fluid position-relative">
            <div class="text-top-cnt text-center">
                <div class="text-slider">
                    <div class="item">
                        <p class="mb-0 text-14 text-black">{{ ($settings->marquee1 != '') ? $settings->marquee1: 'Open 7 Days – Book Your Appointment Anytime' }}</p>
                    </div>
                    @if($settings->marquee2 != '')
                    <div class="item">
                        <p class="mb-0 text-14 text-black">{{ $settings->marquee2 }}</p>
                    </div>
                    @endif
                    @if($settings->marquee3 != '')
                    <div class="item">
                        <p class="mb-0 text-14 text-black">{{ $settings->marquee3 }}</p>
                    </div>
                    @endif
                    @if($settings->marquee4 != '')
                    <div class="item">
                        <p class="mb-0 text-14 text-black">{{ $settings->marquee4 }}</p>
                    </div>
                    @endif
                </div>
            </div>
            <a href="{{ url('contact') }}" class="contact-link text-14">Contact us</a>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg clear-fix" aria-label="Fourth navbar example">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img class="d-lg-block" src="{{ url('assets/frontend/images/skin-canberra-logo.png') }}" width="51" height="64" alt="logo">
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link py-0 active" aria-current="page" href="{{ url('/') }}">Home</a>
                        
                    </li>
                    <li class="nav-item menu-dropdown" >
                        <a class="nav-link py-0" aria-current="page" href="{{ url('services') }}">Services</a>
                        <div class="dropdown-menu">
                            <ul class="menu-icons">
                                @if(!empty($services))
                                @foreach($services as $k=>$list)
                                @php $url = url('service/'.$list->serv_url); @endphp
                                <li class="{{ ($segment2 == $list->serv_url)?'active':'' }}" onclick="window.location.href='{{ url($url) }}';">
                                    <span>{{ $list->service_name }}</span>
                                    <img src="{{ url(IMAGE_PATH.$list->thumbnail_image) }}" alt="{{ $list->service_name }}" >
                                    <div class="dot"></div>
                                </li>
                                @endforeach
                                @endif
                                <?php /* <li>
                                    <span>Facials</span>
                                    <img src="images/facials-icon.svg" alt="Facials">
                                </li>
                                <li>
                                    <span>Make Up</span>
                                    <img src="images/makeup-icon.svg" alt="Make Up">
                                </li>
                                <li>
                                    <span>Hair Cut</span>
                                    <img src="images/haircut-icon.svg" alt="Hair Cut">
                                </li>
                                <li>
                                    <span>Threading</span>
                                    <img src="images/threading-icon.svg" alt="Threading">
                                </li>
                                <li>
                                    <span>Cosmetic Tattoo</span>
                                    <img src="images/tattoo-icon.svg" alt="Cosmetic Tattoo">
                                </li>
                                <li>
                                    <span>Laser Treatment</span>
                                    <img src="images/laser-icon.svg" alt="Laser Treatment">
                                </li>
                                <li>
                                    <span>Hair Foils</span>
                                    <img src="images/foils-icon.svg" alt="Hair Foils">
                                </li> */ ?>
                            </ul>
                        </div>
                    </li>
                    <?php /*<li class="nav-item">
                        <a class="nav-link py-0" href="{{ url('courses') }}">Courses</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link py-0" href="{{ url('products') }}">Products</a>
                    </li>*/ ?>
                    <li class="nav-item">
                        <a class="nav-link py-0" href="{{ url('about-us') }}">About</a>
                    </li>
                    <!-- <li class="nav-item">
                            <a class="nav-link py-0" href="#">Scholarships</a>
                        </li> -->
                </ul>
            </div>
            <?php /* <div class="header-button">
                <a href="javascript:void(0)" class="cstm-btn" onclick="open_appoint_modal()" >book an appointment </a>
                <a href="javascript:void(0)" class="cart-icon"><img src="{{ url('assets/frontend/images/cart-icon.svg') }}"
                        alt=""></a>
                <a href="javascript:void(0)" class="user-icon"><img src="{{ url('assets/frontend/images/user-icon.svg') }}"
                        alt=""></a>
            </div> */ ?>
            <div class="header-button d-flex align-items-center gap-3">
                <!-- <a href="javascript:void(0)" class="cstm-btn" onclick="open_appoint_modal()">Book an Appointment</a> -->
                <a href="{{ url('book-appointment') }}" class="cstm-btn" >Book an Appointment</a>
                @php 
                $cart_count = cart()->getTotalQuantity();
                $checkoutUrl = 'javascript:void(0)';
                if($cart_count){    
                    $checkoutUrl = url('checkout');
                }
                @endphp
                <div class="use-for-mobile">
                    <div class="position-relative">
                    <a href="{{ $checkoutUrl }}" class="cart-icon" id="cart-icon">
                        <img src="{{ url('assets/frontend/images/cart-icon.svg') }}" alt="Cart">
                        <!-- Bootstrap 5 badge for counter -->
                        <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $cart_count }}
                            <span class="visually-hidden">items in cart</span>
                        </span>
                    </a>
                </div>
                <?php /* <a href="javascript:void(0)" class="user-icon">
                    <img src="{{ url('assets/frontend/images/user-icon.svg') }}" alt="User">
                </a> */ ?>
                <div class="dropdown">
                    <a class="dropdown-toggle d-inline-block" 
                        href="#" 
                        id="userDropdown" 
                        role="button" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                        <img src="{{ url('assets/frontend/images/user-icon.svg') }}" 
                            alt="User" 
                            style="width:30px; height:30px; cursor:pointer;">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" 
                        aria-labelledby="userDropdown" 
                        style="border:1px solid #B4903A; border-radius:10px;">
                        
                        @if(session()->has('memberLogin'))
                        <li>
                            <a class="dropdown-item" 
                            href="{{ url('member-dashboard') }}" 
                            style="color:#4A2C10; font-weight:500;">
                            <i class="bi bi-speedometer2 me-2" style="color:#B4903A;"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" 
                            href="{{ url('member-logout') }}" 
                            style="color:#4A2C10; font-weight:500;"
                            onclick="return confirm('Are u sure to logout?')">
                            <i class="bi bi-box-arrow-in-right me-2" style="color:#B4903A;"></i> Logout
                            </a>
                        </li>
                        @else
                        <li>
                            <a class="dropdown-item" 
                            href="{{ url('member-login') }}" 
                            style="color:#4A2C10; font-weight:500;">
                            <i class="bi bi-box-arrow-in-right me-2" style="color:#B4903A;"></i> Login
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" 
                            href="{{ url('member-register') }}" 
                            style="color:#4A2C10; font-weight:500;">
                            <i class="bi bi-person-plus me-2" style="color:#B4903A;"></i> Signup
                            </a>
                        </li>
                        @endif
                    </ul>
                </div> 
                </div>
            </div>
        </div>
    </nav>
</header>
