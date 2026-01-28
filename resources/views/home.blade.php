@extends('_layouts.master')
@section('content')
<!-- banner panel -->
@php
use App\Models\Common_model;

$url = url('assets/frontend/images/hero-banner.jpg');
if(isset($banner) && $banner->image != '')
$url = url(IMAGE_PATH.$banner->image);
$commonmodel = new Common_model;
@endphp

<div class="banner home-banner position-relative">
    <img src="{{ $url }}" class="w-100" alt="home-banner" loading="lazy">
    <div class="container">
        <h1 class="banner-title cormorant aos-init aos-animate" data-aos="fade-up">{{ $banner->main_title ?? '' }}</h1>
        <p class="banner-content">{{ $banner->sub_title ?? '' }}</p>
    </div>
</div>
<!-- Explore Our Signature Services -->
<section class="signature-services panel-space">
    <div class="container-fluid">
        <h2 class="text-center mb-4">Explore Our Signature Services</h2>
        <p class="text-center">Discover personalised treatments designed to refresh, enhance, and care for every
            part of you.</p>
        <div class="mt-5">
            <div class="row g-4">
                @if(!empty($services))
                @foreach($services as $list)
                <div class="col-lg-3 col-md-6">
                    <a href="{{ url('service/'.$list->serv_url) }}" class="d-block w-100">
                        <div class="service-card position-relative overflow-hidden">
                            <img src="{{ url(IMAGE_PATH.$list->photo) }}" alt="Make Up" class="img-fluid w-100" loading="lazy">
                            <div class="overlay d-flex align-items-center justify-content-center">
                                <h3 class="text-white fw-bold text-uppercase mb-0">{{ $list->service_name }}</h3>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                @endif
                <?php /* <div class="col-lg-3 col-md-6">
                        <a href="#">
                            <div class="service-card position-relative overflow-hidden">
                                <img src="{{ url('assets/frontend/images/service2.png') }}" alt="Skin Care" class="img-fluid w-100">
                                <div class="overlay d-flex align-items-center justify-content-center">
                                    <h3 class="text-white fw-bold text-uppercase mb-0">Skin Care</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="#">
                            <div class="service-card position-relative overflow-hidden">
                                <img src="{{ url('assets/frontend/images/service3.png') }}" alt="Hair Care" class="img-fluid w-100">
                                <div class="overlay d-flex align-items-center justify-content-center">
                                    <h3 class="text-white fw-bold text-uppercase mb-0">Hair Care</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="#">
                            <div class="service-card position-relative overflow-hidden">
                                <img src="{{ url('assets/frontend/images/service4.png') }}" alt="Facials" class="img-fluid w-100">
                                <div class="overlay d-flex align-items-center justify-content-center">
                                    <h3 class="text-white fw-bold text-uppercase mb-0">Facials</h3>
                                </div>
                            </div>
                        </a>
                    </div> */ ?>
            </div>
        </div>
    </div>
</section>
<!-- About Skin Canberra -->
<section class="about-skin-canberra panel-space" style="background-color: #FEFFF5;">
    <div class="container-fluid">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h2 class="mb-4">{{ $content->about_title ?? '' }}</h2>
                {!! $content->about_details ?? '' !!}
                <?php /* <p>At Skin Canberra, we believe beauty begins with healthy skin and confidence from within.</p>
                    <p>Our certified therapists combine gentle techniques with advanced products to deliver skin care,
                        hair
                        treatments, makeup, and nail services tailored to you.</p>
                    <p>Whether you’re preparing for a special day or simply want a moment of calm, we’re here to help
                        you feel
                        radiant and renewed.</p> */ ?>
            </div>
            <div class="col-lg-6">
                <div class="canberra">
                    @php
                    $sec1Image = url('assets/frontend/images/canberra.png');
                    if($content->about_image != '')
                    $sec1Image = url(IMAGE_PATH.$content->about_image);
                    @endphp
                    <img src="{{ $sec1Image }}" alt="" class="w-100" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Our Products -->
<?php /* <section class="shop-products panel-space">
        <div class="container-fluid">
            <h2 class="text-center mb-4">Shop Our Products</h2>
            <p class="text-center w-75 mx-auto line-height-36 mb-5">Take the glow beyond your appointment! Explore our
                handpicked range of professional skincare, haircare, and beauty products — the same trusted formulas we
                use in our studio.</p>
            <div class="accordinga-panel">
                <!-- 🖥️ DESKTOP TABS -->
                <div class="desktop-tabs">
                    <ul class="nav nav-tabs flex-wrap border-0" id="myTab" role="tablist">
                        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#all"
                                type="button">All</button></li>
                        <div class="nav-tab-slider">
                        @if(isset($proCategory) && $proCategory->isNotEmpty())
                        @foreach($proCategory as $k=>$categ)
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab{{ $k }}"
                                type="button">{{ $categ->category_name }}</button></li>
                        @endforeach
                        @endif
                        <?php /* <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#facemasks"
                                type="button">Face Masks</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#shampoos"
                                type="button">Shampoos & Conditioners</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#serums"
                                type="button">Serums</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#primers"
                                type="button">Primers</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#lipsticks"
                                type="button">Lipsticks</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#sprays"
                                type="button">Setting Sprays</button></li> *
                        </div>
                    </ul>
                    <div class="tab-content mt-5">
                        <div class="tab-pane fade show active" id="all">
                            <div class="row g-4">
                                @if(isset($products) && $products->isNotEmpty())
                                @foreach($products as $list)
                                <div class="col-lg-3 col-md-6">
                                    
                                    <div class="product-card">
                                        <a href="{{ url('product/'.$list->pro_url) }}">
                                        <div class="product-img position-relative mb-3">
                                            <img src="{{ url(IMAGE_PATH.$list->image1) }}" alt="{{ $list->alt1 }}"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">{{ $list->category_name }}</span>
                                        </div>
                                        </a>
                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">{{ ucwords($list->pro_name) }}</h5>
                                            <p class=" mb-3">
                                                {{ substr(strip_tags($list->description),0,50).'...' }}
                                            </p>
                                            <!-- <span class="discount-badge me-2">15% Off</span> -->
                                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                <div class="d-flex align-items-center">
                                                    <sapn class="mb-0 view-price text-black">${{ $list->sp }}</sapn>
                                                    <!-- <del class="ms-2 del-price">$80</del> -->
                                                </div>
                                                <span class="ms-auto ml-size">Size: {{ $list->value }} {{ $list->unit }}</span>
                                            </div>
                                            <span class="btn add-cart-btn w-100 mt-3 addToCart" data-pro_id="{{ $list->pro_id }}" data-attrid="{{ $list->attrId }}">
                                                <img src="{{ url('assets/frontend/images/add-to-cart.svg') }}" alt="Cart" class="cart-icon me-2">
                                                Add To Cart
                                            </span>
                                        </div>
                                    </div>
                                    
                                </div>
                                @endforeach
                                @else
                                    <p class="text-danger">No Product Available.</p>
                                @endif
                                
                            </div>
                        </div>
                        @if(isset($proCategory) && $proCategory->isNotEmpty())
                        @foreach($proCategory as $k=>$categ)
                        <div class="tab-pane fade" id="tab{{ $k }}">
                            <div class="row g-4">
                                @php 
                                $categProduct = $commonmodel->get_min_value_products($categ->id, 8);
                                @endphp
                                @if($categProduct->isNotEmpty())
                                @foreach($categProduct as $list)
                                <div class="col-lg-3 col-md-6">
                                    <div class="product-card">
                                        <a href="{{ url('product/'.$list->pro_url) }}">
                                        <div class="product-img position-relative mb-3">
                                            <img src="{{ url(IMAGE_PATH.$list->image1) }}" alt="{{ $list->alt1 }}"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">{{ $list->category_name }}</span>
                                        </div>
                                        </a>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">{{ ucwords($list->pro_name) }}</h5>
                                            <p class=" mb-3">
                                                {{ substr(strip_tags($list->description),0,50).'...' }}
                                            </p>
                                            <!-- <span class="discount-badge me-2">15% Off</span> -->
                                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                <div class="d-flex align-items-center">
                                                    <sapn class="mb-0 view-price text-black">${{ $list->sp }}</sapn>
                                                    <!-- <del class="ms-2 del-price">$80</del> -->
                                                </div>
                                                <span class="ms-auto ml-size">Size: {{ $list->value }} {{ $list->unit }}</span>
                                            </div>
                                            <span class="btn add-cart-btn w-100 mt-3 addToCart" data-pro_id="{{ $list->pro_id }}" data-attrid="{{ $list->attrId }}">
                                                <img src="{{ url('assets/frontend/images/add-to-cart.svg') }}" alt="Cart" class="cart-icon me-2">
                                                Add To Cart
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                    <p class="text-danger">No Product Available.</p>
                                @endif
                                
                            </div>
                        </div>
                        @endforeach
                        @endif
                        
                    </div>
                </div>
                <!-- 📱 MOBILE ACCORDION -->
                <div class="mobile-accordion accordion mt-3" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" data-bs-toggle="collapse"
                                data-bs-target="#collapseAll">All</button>
                        </h2>
                        <div id="collapseAll" class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row g-4">
                                    @if(isset($products) && $products->isNotEmpty())
                                    @foreach($products as $list)
                                    <div class="col-lg-3 col-md-6">
                                        <div class="product-card">
                                            <a href="{{ url('product/'.$list->pro_url) }}">
                                            <div class="product-img position-relative mb-3">
                                                <img src="{{ url(IMAGE_PATH.$list->image1) }}" alt="{{ $list->alt1 }}"
                                                    class="img-fluid rounded-4">
                                                <span class="badge bg-light text-dark hair-mask-badge">{{ $list->category_name }}</span>
                                            </div>
                                            </a>

                                            <div class="product-info">
                                                <h5 class="fw-semibold mb-1 text-black">{{ ucwords($list->pro_name) }}</h5>
                                                <p class=" mb-3">
                                                    {{ substr(strip_tags($list->description),0,50).'...' }}
                                                </p>
                                                <!-- <span class="discount-badge me-2">15% Off</span> -->
                                                <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                    <div class="d-flex align-items-center">
                                                        <sapn class="mb-0 view-price text-black">${{ $list->sp }}</sapn>
                                                        <!-- <del class="ms-2 del-price">$80</del> -->
                                                    </div>
                                                    <span class="ms-auto ml-size">Size: {{ $list->value }} {{ $list->unit }}</span>
                                                </div>
                                                <span class="btn add-cart-btn w-100 mt-3 addToCart" data-pro_id="{{ $list->pro_id }}" data-attrid="{{ $list->attrId }}">
                                                    <img src="{{ url('assets/frontend/images/add-to-cart.svg') }}" alt="Cart"
                                                        class="cart-icon me-2">
                                                    Add To Cart
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                        <p class="text-danger">No Product Available.</p>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(isset($proCategory) && $proCategory->isNotEmpty())
                    @foreach($proCategory as $k=>$categ)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{$k}}">{{ $categ->category_name }}</button>
                        </h2>
                        <div id="collapse{{$k}}" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row g-4">
                                    @php 
                                    $categProduct = $commonmodel->get_min_value_products($categ->id, 8);
                                    @endphp
                                    @if($categProduct->isNotEmpty())
                                    @foreach($categProduct as $list)
                                    <div class="col-lg-3 col-md-6">
                                        
                                        <div class="product-card">
                                            <a href="{{ url('product/'.$list->pro_url) }}">
                                            <div class="product-img position-relative mb-3">
                                                <img src="{{ url(IMAGE_PATH.$list->image1) }}" alt="{{ $list->alt1 }}"
                                                    class="img-fluid rounded-4">
                                                <span class="badge bg-light text-dark hair-mask-badge">{{ $list->category_name }}</span>
                                            </div>
                                            </a>
                                            <div class="product-info">
                                                <h5 class="fw-semibold mb-1 text-black">{{ ucwords($list->pro_name) }}</h5>
                                                <p class=" mb-3">
                                                    {{ substr(strip_tags($list->description),0,50).'...' }}
                                                </p>
                                                <!-- <span class="discount-badge me-2">15% Off</span> -->
                                                <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                    <div class="d-flex align-items-center">
                                                        <sapn class="mb-0 view-price text-black">${{ $list->sp }}</sapn>
                                                        <!-- <del class="ms-2 del-price">$80</del> -->
                                                    </div>
                                                    <span class="ms-auto ml-size">Size: {{ $list->value }} {{ $list->unit }}</span>
                                                </div>
                                                <span class="btn add-cart-btn w-100 mt-3 addToCart" data-pro_id="{{ $list->pro_id }}" data-attrid="{{ $list->attrId }}">
                                                    <img src="{{ url('assets/frontend/images/add-to-cart.svg') }}" alt="Cart"
                                                        class="cart-icon me-2">
                                                    Add To Cart
                                                </span>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    @endforeach
                                    @else
                                        <p class="text-danger">No Product Available.</p>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Discover the Full Collection -->
    <section class="discover-panel pb-4 overflow-hidden" style="background-color: #F3F3F3;">
        <div class="container-fluid">
            <div class="row align-items-center g-4">
                <div class="col-md-7 text-center">
                    <h2 class="text-center mb-4">Discover the Full Collection</h2>
                    <p class="text-center">Find every skincare, hair, makeup, and nail essential in one place.</p>
                    <a href="#" class="cstm-btn mt-md-5">View All Products</a>
                </div>
                <div class="col-md-5">
                    <img src="{{ url('assets/frontend/images/discover.png') }}" alt="">
                </div>
            </div>
        </div>
    </section> */ ?>
<!-- about us -->
<section class="about-us-panel panel-space">
    <div class="container-fluid">
        <?php /* <h2 class="text-center mb-4">{{ $content->sec5_title ?? '' }}</h2>
            {!! $content->sec5_description !!} */ ?>
        <?php /* <p class="text-center">At Shikha Beauty Studio, we believe beauty starts with confidence —
                and confidence
                begins with great care. Our studio blends professional expertise, gentle techniques, and premium
                products to create treatments that bring out your natural glow. From rejuvenating facials to flawless
                makeup and elegant nails, everything we do is designed to help you feel radiant inside and out.</p> */ ?>
        <div class="panel-space">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h2 class="mb-4">{{ $content->sec5_content_title1 ?? '' }}</h2>
                    {!! $content->sec5_content_details1 ?? '' !!}
                    <?php /* <p class="mb-4 line-height-36">Our certified therapists, stylists, and artists bring years of
                            hands-on
                            experience
                            to every appointment. With advanced skills and a passion for beauty, they take the time to
                            understand your goals, ensuring you leave feeling refreshed, confident, and completely
                            looked
                            after.</p> */?>
                    <!-- <a href="javascript:void(0)" class="cstm-btn mt-md-4" onclick="open_appoint_modal()">Book An Appointment</a> -->
                    <a href="{{ url('book-appointment') }}" class="cstm-btn mt-md-4">Book An Appointment</a>
                </div>
                <div class="col-lg-6">
                    <div class="canberra">
                        @php $sec5Image1 = url('assets/frontend/images/expert-care.jpg');
                        if($content->sec5_content_image1 != '')
                        $sec5Image1 = url(IMAGE_PATH.$content->sec5_content_image1);
                        @endphp
                        <img src="{{ $sec5Image1 }}" alt="" class="w-100" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
        <?php /* <div class="panel-space pt-0">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <div class="canberra">
                            @php $sec5Image2 = url('assets/frontend/images/premium-products.jpg');
                            if($content->sec5_content_image2 != '')
                                $sec5Image2 = url(IMAGE_PATH.$content->sec5_content_image2);
                            @endphp
                            <img src="{{ $sec5Image2 }}" alt="" class="w-100">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h2 class="mb-4">{{ $content->sec5_content_title2 ?? '' }}</h2>
                        {!! $content->sec5_content_details2 ?? '' !!}
                        <?php /* <p class="mb-4 line-height-36">We believe results come from quality. That’s why we use carefully
                            chosen, skin-friendly formulas and professional-grade tools. Whether it’s a soothing serum
                            or a high-performance hair treatment, every product is selected to nurture your skin, hair,
                            and nails safely and effectively.</p> *
                        <a href="#" class="cstm-btn mt-md-4">View all Products</a>
                    </div>
                </div>
            </div> */ ?>
        <div class="panel-space pt-0">
            <div class="row align-items-center g-5">

                <div class="col-lg-6">
                    <div class="canberra">
                        @php $sec5Image3 = url('assets/frontend/images/personalized-experience.jpg');
                        if($content->sec5_content_image3 != '')
                        $sec5Image3 = url(IMAGE_PATH.$content->sec5_content_image3);
                        @endphp
                        <img src="{{ $sec5Image3 }}" alt="" class="w-100"loading="lazy">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="mb-4">{{ $content->sec5_content_title3 ?? '' }}</h2>
                    {!! $content->sec5_content_details3 ?? '' !!}
                    <?php /* <p class="mb-4 line-height-36">No two clients are the same — and neither are our services. From
                            the moment you step in, we tailor each treatment to your needs, lifestyle, and comfort
                            level. Our warm, welcoming environment makes every visit a little moment of self-care you’ll
                            look forward to.</p> */ ?>
                    <!-- <a href="javascript:void(0)" class="cstm-btn mt-md-4" onclick="open_appoint_modal()">Book An Appointment</a> -->
                    <a href="{{ url('services') }}" class="cstm-btn mt-md-4">View All Services</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Our Most Loved Treatments -->
<section class="leve-treatment panel-space" style="background-color: #F2F2F2;">
    <h2 class="text-center mb-4">{{ $content->sec6_title ?? '' }}</h2>
    <p class="text-center">{!! $content->sec6_description ?? '' !!}</p>
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-md-12">
                @php $pic1 = url('assets/frontend/images/treatment.jpg');
                if($content->pic1 != '')
                $pic1 = url(IMAGE_PATH.$content->pic1);
                @endphp
                <div class="mt-5 panel-space img-radius bg-img position-relative overflow-hidden">
                    <img src="{{ $pic1 }}" alt="leve-treatment" class="leve-treatment-img w-100" loading="lazy">
                    <div class="leve-treatment-iner-box">
                        <div class="row">
                            <div class="col-lg-7"></div>
                            <div class="col-lg-5">
                                <div class="px-lg-0 px-4">
                                    <h2 class="text-white fst-italic">{{ $content->pic_title1 ?? '' }}</h2>
                                    <p class="line-height-36 text-white">{!! $content->pic_details1 ?? '' !!}</p>
                                    <!-- <a href="javascript:void(0)" class="cstm-btn mt-md-4" onclick="open_appoint_modal()">Book An Appointment</a> -->
                                    <a href="{{ url('book-appointment') }}" class="cstm-btn mt-md-4">Book An
                                        Appointment</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-treatment" role="group" aria-label="Signature Glow Facial card">
                    <!-- use your own image path if needed -->
                    @php $pic2 = url('assets/frontend/images/treatment.jpg');
                    if($content->pic2 != '')
                    $pic2 = url(IMAGE_PATH.$content->pic2);
                    @endphp
                    <img src="{{ $pic2 }}" alt="Signature Glow Facial" loading="lazy">
                    <div class="card-content">
                        <h3 class="card-title">{{ $content->pic_title2 ?? '' }}</h3>
                        <p class="card-sub text-white">{!! $content->pic_details2 ?? '' !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-treatment" role="group" aria-label="Signature Glow Facial card">
                    <!-- use your own image path if needed -->
                    @php $pic3 = url('assets/frontend/images/hair-therepy.jpg');
                    if($content->pic3 != '')
                    $pic3 = url(IMAGE_PATH.$content->pic3);
                    @endphp
                    <img src="{{ $pic3 }}" alt="Signature Glow Facial" loading="lazy">
                    <div class="card-content">
                        <h3 class="card-title">{{ $content->pic_title3 ?? '' }}</h3>
                        <p class="card-sub text-white">{!! $content->pic_details3 ?? '' !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-treatment" role="group" aria-label="Signature Glow Facial card">
                    <!-- use your own image path if needed -->
                    @php $pic4 = url('assets/frontend/images/chemical-peeling.jpg');
                    if($content->pic4 != '')
                    $pic4 = url(IMAGE_PATH.$content->pic4);
                    @endphp
                    <img src="{{ $pic4 }}" alt="Signature Glow Facial" loading="lazy">
                    <div class="card-content">
                        <h3 class="card-title">{{ $content->pic_title4 ?? '' }}</h3>
                        <p class="card-sub text-white">{!! $content->pic_details4 ?? '' !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('_layouts.testimonials')

@include('_layouts.real_result')

@endsection