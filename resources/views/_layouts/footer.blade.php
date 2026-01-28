
@php 
    use App\Models\Admin\SettingsModel; 
    use App\Models\Common_model;
    $commonmodel = new Common_model;
    $settings = SettingsModel::where(['id'=>1])->first();
    $services = $commonmodel->crudOperation('RA','tbl_services','',['status'=>1],['sv_id','DESC']);
@endphp
<footer class="footer panel-space pb-4"
    style="background-image: url({{ url('assets/frontend/images/footer-bg-img.png') }});">
    <div class="container-fluid">
        <div class="row g-5">
            <div class="col-lg-4 pe-lg-5">
                <a href="{{ url('/') }}" class="footer-logo mb-4 d-block"><img
                        src="{{ url('assets/frontend/images/skin-canberra-logo.png') }}" alt=""></a>
                <p class="text-black mb-4">Personalised, evidence-led skin and hair care that helps you feel
                    confident —
                    naturally.</p>
                <h3 class="d-none">only for html validator</h3> 
                <h4 class="d-none">only for html validator</h4> 
                <h5 class="mb-3">Follow us </h5>
                <div class="social-links">
                    <a href="{{ $settings->instagram_link }}" target="blank"><img src="{{ url('assets/frontend/images/instagram.svg') }}" alt="instagram"></a>
                    <a href="{{ $settings->facebook_link }}" target="blank"><img src="{{ url('assets/frontend/images/facebook.svg') }}" alt="facebook"></a>
                    <a href="http://tiktok.com/@shikhabeautystudio" target="blank"><img src="{{ url('assets/frontend/images/tiktok.svg') }}" alt="tiktok"></a>
                    <?php /* <?php /* <a href="{{ $settings->youtube_link }}" target="blank"><img src="{{ url('assets/frontend/images/youtube.svg') }}" alt="youtube"></a> 
                    <a href="{{ $settings->twitter_link }}" target="blank"><img src="{{ url('assets/frontend/images/twitter.svg') }}" alt="twitter"></a>*/ ?>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row g-4">
                    <div class="col-md-3 col-6">
                        <div class="footer-menu-link">
                            <h6>Quick links (labels)</h6>
                            <ul>
                                <li><a href="{{ url('services') }}">Services</a></li>
                                <!-- <li><a href="{{ url('products') }}">Products</a></li> -->
                                <!-- <li><a href="#">Gallery</a></li> -->
                                <!-- <li><a href="#">Testimonials</a></li> -->
                                <li><a href="{{ url('about-us') }}">About Us</a></li>
                                <!-- <li><a href="#">Bookings</a></li> -->
                                <!-- <li><a href="#">FAQs</a></li> -->
                                <li><a href="{{ url('contact') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-6">
                        <div class="footer-menu-link">
                            <h6>Services</h6>
                            <ul>
                                @if(!empty($services))
                                @foreach($services as $list)
                                <li><a href="{{ url('service/'.$list->serv_url) }}">{{ ucwords($list->service_name) }}</a></li>
                                @endforeach
                                @endif
                                <!-- <li><a href="#">Skin Care</a></li>
                                <li><a href="#">Hair</a></li>
                                <li><a href="#">Facials </a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="footer-menu-link">
                            <h6>Courses</h6>
                            <ul>
                                <li><a href="javascript:void(0)">Hydrafacial</a></li>
                                <li><a href="javascript:void(0)">Skin needling </a></li>
                                <li><a href="javascript:void(0)">All about brows</a></li>
                                <li><a href="javascript:void(0)">Chemical peels</a></li>
                                <li><a href="javascript:void(0)">Hair cut </a></li>
                                <li><a href="javascript:void(0)">All about hair</a></li>
                                <li><a href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
                                <li><a href="{{ url('terms-condition') }}">Terms Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <div class="footer-menu-link">
                            <h6>Contact</h6>
                            <ul>
                                <li><a href="#"><strong>Phone / WhatsApp:</strong>{{ $settings->phone }}</a></li>
                                <li><a href="#"><strong>Email:</strong> {{ $settings->email }}</a></li>
                                <li><span><strong>Address:</strong>{{ $settings->address }}</span></li>
                            </ul>
                        </div>
                        <div class="footer-menu-link mt-5">
                            <h6>Opening hours</h6>
                            {!! $settings->opening_hours !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>