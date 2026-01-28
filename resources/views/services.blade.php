@extends('_layouts.master')
@section('content')
<!-- banner panel -->
@php
    $url = url('assets/frontend/images/service-banner.jpg');
    if(isset($banner) && $banner->image != '')
        $url = url(IMAGE_PATH.$banner->image);
@endphp
<div class="banner Service-banner  overflow-hidden">
<!-- <div class="banner Service-banner" style="background-image: url({{ $url }});"> -->
    <img src="{{ $url }}" alt="service-banner">
    <!-- <div class="container">
        <h1 class="banner-title cormorant aos-init aos-animate" data-aos="fade-up">{{ $banner->main_title ?? '' }}</h1>
        <p class="banner-content">{{ $banner->sub_title ?? '' }}</p>
    </div> -->
</div>
<section class="about-us-panel panel-space">
    <div class="container-fluid">
                     
        @if(!$services->isEmpty())
        @foreach($services as $key=>$list)
        @php 
            $img = 0;
            if($key%2 == 0){
                $img = 1;
            }
        @endphp
        <div class="panel-space pt-0">
            <div class="row align-items-center g-5">
                @for($i=0; $i<2; $i++)
                @if($img)
                <div class="col-lg-6">
                    <div class="canberra">
                        <img src="{{ url(IMAGE_PATH.$list->photo) }}" alt="" class="w-100">
                    </div>
                </div>
                @else
                <div class="col-lg-6">
                    <span class="cormorant">{{ $list->serv_title }}</span>
                    <h2 class="mb-4">{{ $list->service_name }}</h2>
                    {!! $list->details !!}
                    <?php /* <p class="mb-4 line-height-36">Our facial services blend calming spa rituals with corrective,
                        medical-grade options. Treatments include hydrating facials, brightening protocols, acne
                        programs, anti-ageing therapies and chemical peels — each preceded by a skin analysis and
                        tailored homecare plan.</p>
                    <h6 class="text-20">Benefits:</h6>
                    <ul class="text-18 line-height-36">
                        <li>Improves tone, texture and hydration.</li>
                        <li>Targets acne, pigmentation and fine lines.</li>
                        <li>Uses professional serums, exfoliation and LED/boosters where required.</li>
                        <li>Clear aftercare and progress checks for lasting results.</li>
                    </ul> */ ?>
                    <a href="{{ url('service/'.$list->serv_url) }}" class="cstm-btn mt-md-4">View all {{ $list->service_name }}</a>
                    <!-- <a href="javascript:void(0)" class="cstm-btn mt-md-4" onclick="open_appoint_modal()">Book an Appointment</a> -->
                    <a href="{{ url('book-appointment/'.$list->sv_id) }}" class="cstm-btn mt-md-4" >Book An Appointment</a>
                </div>
                @endif
                @php if($img) $img = 0; else $img = 1; @endphp
                @endfor
            </div>
        </div>
        @endforeach
        @endif
        <?php /* <div class="panel-space pt-0">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="cormorant">Smooth, Gentle & Professional Hair Removal</span>
                    <h2 class="mb-4">Waxing</h2>
                    <p class="mb-4 line-height-36">Precision waxing performed with gentle formulas and strict
                        hygiene to leave skin smooth with minimal irritation. We wax brows, upper lip, underarms,
                        legs and full-body areas with quick, professional technique.</p>
                    <h6 class="text-20">Benefits:</h6>
                    <ul class="text-18 line-height-36">
                        <li>Long-lasting smoothness vs shaving.</li>
                        <li>Faster regrowth that’s softer over time.</li>
                        <li>Hygienic, professional application and aftercare.</li>
                    </ul>
                    <a href="#" class="cstm-btn mt-md-4">View all Waxing services</a>
                </div>
                <div class="col-lg-6">
                    <div class="canberra">
                        <img src="{{ url('assets/frontend/images/waxing.jpg') }}" alt="" class="w-100">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-space pt-0">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="canberra">
                        <img src="{{ url('assets/frontend/images/make-up.jpg') }}" alt="" class="w-100">
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="cormorant">Bridal, Event & Everyday Glam</span>
                    <h2 class="mb-4">Make Up</h2>
                    <p class="mb-4 line-height-36">Our makeup artists create looks suited to your skin, features and
                        the occasion. Services include natural day makeup, event/party looks, and bridal packages
                        with trial sessions and day-of touch-ups.</p>
                    <h6 class="text-20">Benefits:</h6>
                    <ul class="text-18 line-height-36">
                        <li>Photo-ready, long-wear finishes.</li>
                        <li>Skin-first preparation for comfort and durability.</li>
                        <li>Trial options and on-site bridal services available.</li>
                    </ul>
                    <a href="#" class="cstm-btn mt-md-4">View all Make up services</a>
                </div>
            </div>
        </div>
        <div class="panel-space pt-0">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="cormorant">Precision Cuts & Wearable Looks</span>
                    <h2 class="mb-4">Haircut & Styling</h2>
                    <p class="mb-4 line-height-36">Precision haircuts and styling tailored to your face shape, hair
                        type and lifestyle. Includes consultation, cut, blow-dry and simple styling tips to maintain
                        the look at home.</p>
                    <h6 class="text-20">Benefits:</h6>
                    <ul class="text-18 line-height-36">
                        <li>Modern, flattering cuts and practical styling advice.</li>
                        <li>Recommendations for home care and product use.</li>
                        <li>Finish and styling included.</li>
                    </ul>
                    <a href="#" class="cstm-btn mt-md-4">View all Haircut services</a>
                </div>
                <div class="col-lg-6">
                    <div class="canberra">
                        <img src="{{ url('assets/frontend/images/hair-cut.jpg') }}" alt="" class="w-100">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-space pt-0">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="canberra">
                        <img src="{{ url('assets/frontend/images/threading.jpg') }}" alt="" class="w-100">
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="cormorant">Precise Brow & Facial Hair Shaping</span>
                    <h2 class="mb-4">Threading</h2>
                    <p class="mb-4 line-height-36">Expert eyebrow and facial threading for defined, natural results.
                        Gentle technique reduces irritation and creates a clean, long-lasting shape.</p>
                    <h6 class="text-20">Benefits:</h6>
                    <ul class="text-18 line-height-36">
                        <li>Precision shaping for brows and delicate facial areas.</li>
                        <li>Low irritation when performed by trained technicians.</li>
                        <li>Fast and consistent results.</li>
                    </ul>
                    <a href="#" class="cstm-btn mt-md-4">View all Threading services</a>
                </div>
            </div>
        </div>
        <div class="panel-space pt-0">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="cormorant">Brows, Lips & Liner</span>
                    <h2 class="mb-4">Cosmetic Tattoo</h2>
                    <p class="mb-4 line-height-36">Semi-permanent cosmetic tattoos for brows, lips and eyeliner. Our
                        technicians follow strict hygiene protocols and offer consultation, patch tests and follow-up
                        appointments to ensure natural, balanced results.</p>
                    <h6 class="text-20">Benefits:</h6>
                    <ul class="text-18 line-height-36">
                        <li>Time saved on daily makeup routines.</li>
                        <li>Natural enhancement for brows, lips or eyes.</li>
                        <li>Long-lasting results with touch-ups as needed.</li>
                    </ul>
                    <a href="#" class="cstm-btn mt-md-4">View all Tattoo services</a>
                </div>
                <div class="col-lg-6">
                    <div class="canberra">
                        <img src="{{ url('assets/frontend/images/tattoo.jpg') }}" alt="" class="w-100">
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-space pt-0">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="canberra">
                        <img src="{{ url('assets/frontend/images/laser-treatments.jpg') }}" alt="" class="w-100">
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="cormorant">Hair Reduction & Skin Rejuvenation</span>
                    <h2 class="mb-4">Laser Treatments</h2>
                    <p class="mb-4 line-height-36">Advanced laser therapies for long-term hair reduction and targeted
                        skin rejuvenation. Every laser treatment begins with a suitability assessment and patch test to
                        ensure safety and optimal results.</p>
                    <h6 class="text-20">Benefits:</h6>
                    <ul class="text-18 line-height-36">
                        <li>Significant hair reduction over a course of sessions.</li>
                        <li>Targeted skin resurfacing for texture and pigment issues.</li>
                        <li>Professional assessment and customised protocol.</li>
                    </ul>
                    <a href="#" class="cstm-btn mt-md-4">View all Laser services</a>
                </div>
            </div>
        </div>
        <div class="panel-space pt-0">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="cormorant">Dimension, Tone & Shine</span>
                    <h2 class="mb-4">Hair Foils & Colour Services</h2>
                    <p class="mb-4 line-height-36">Custom foiling and colouring to add depth, lowlights or highlights
                        while prioritising hair health. We use professional colour techniques and post-colour care to
                        maintain shine and minimise damage.</p>
                    <h6 class="text-20">Benefits:</h6>
                    <ul class="text-18 line-height-36">
                        <li>Natural-looking dimension and blended tones.</li>
                        <li>Custom colour matching and professional finishing.</li>
                        <li>Expert aftercare advice to extend colour life.</li>
                    </ul>
                    <a href="#" class="cstm-btn mt-md-4">View all Hair services</a>
                </div>
                <div class="col-lg-6">
                    <div class="canberra">
                        <img src="{{ url('assets/frontend/images/hair-foils.jpg') }}" alt="" class="w-100">
                    </div>
                </div>
            </div>
        </div> */ ?>
    </div>
</section>

@include('_layouts.real_result')
<?php /* <section class="gallery-panel panel-space overflow-hidden pt-0">
    <h2 class="text-center mb-4">Real Results — Before & After</h2>
    <p class="text-center mb-5 line-height-36 ">Real clients, real results — browse before & afters and treatment
        highlights to see what’s possible.</p>
    <div class="gallery-container">
        <!-- Each image should be inside an <a> tag for Lightbox -->
        <div class="top-curve"></div>
        <div class="gallery-slider">
            <div class="item"> <a href="{{ url('assets/frontend/images/product1.png') }}" data-lightbox="beauty-gallery" class="gallery-item">
                    <img src="{{ url('assets/frontend/images/product1.png?auto=compress&h=400') }}" alt="Makeup 1">
                </a></div>
            <div class="item"> <a href="{{ url('assets/frontend/images/product2.png') }}" data-lightbox="beauty-gallery" class="gallery-item">
                    <img src="{{ url('assets/frontend/images/product2.png?auto=compress&h=400') }}" alt="Nail Art">
                </a></div>
            <div class="item">
                <a href="{{ url('assets/frontend/images/product3.png') }}" data-lightbox="beauty-gallery" class="gallery-item">
                    <img src="{{ url('assets/frontend/images/product3.png?auto=compress&h=400') }}" alt="Makeup Look">
                </a>
            </div>
            <div class="item">
                <a href="{{ url('assets/frontend/images/product4.png') }}" data-lightbox="beauty-gallery" class="gallery-item">
                    <img src="{{ url('assets/frontend/images/product4.png?auto=compress&h=400') }}" alt="Facial">
                </a>
            </div>
            <div class="item">
                <a href="{{ url('assets/frontend/images/service1.png') }}" data-lightbox="beauty-gallery" class="gallery-item">
                    <img src="{{ url('assets/frontend/images/service1.png?auto=compress&h=400') }}" alt="Makeup Eye">
                </a>
            </div>
            <div class="item">
                <a href="{{ url('assets/frontend/images/service2.png') }}" data-lightbox="beauty-gallery" class="gallery-item">
                    <img src="{{ url('assets/frontend/images/service2.png?auto=compress&h=400') }}" alt="Salon Look">
                </a>
            </div>
            <div class="item">
                <a href="{{ url('assets/frontend/images/service3.png') }}" data-lightbox="beauty-gallery" class="gallery-item">
                    <img src="{{ url('assets/frontend/images/service3.png?auto=compress&h=400') }}" alt="Face Treatment">
                </a>
            </div>
            <div class="item">
                <a href="{{ url('assets/frontend/images/service4.png') }}" data-lightbox="beauty-gallery" class="gallery-item">
                    <img src="{{ url('assets/frontend/images/service4.png?auto=compress&h=400') }}" alt="Beauty 2">
                </a>
            </div>
            <div class="item">
                <a href="{{ url('assets/frontend/images/product1.png') }}" data-lightbox="beauty-gallery" class="gallery-item">
                    <img src="{{ url('assets/frontend/images/product1.png?auto=compress&h=400') }}" alt="Makeup 1">
                </a>
            </div>
            <div class="item">
                <a href="{{ url('assets/frontend/images/product2.png') }}" data-lightbox="beauty-gallery" class="gallery-item">
                    <img src="{{ url('assets/frontend/images/product2.png?auto=compress&h=400') }}" alt="Nail Art">
                </a>
            </div>
            <div class="item">
                <a href="{{ url('assets/frontend/images/product3.png') }}" data-lightbox="beauty-gallery" class="gallery-item">
                    <img src="{{ url('assets/frontend/images/product3.png?auto=compress&h=400') }}" alt="Makeup Look">
                </a>
            </div>
            <div class="item">
                <a href="{{ url('assets/frontend/images/product4.png') }}" data-lightbox="beauty-gallery" class="gallery-item">
                    <img src="{{ url('assets/frontend/images/product4.png?auto=compress&h=400') }}" alt="Facial">
                </a>
            </div>
            <div class="item">
                <a href="{{ url('assets/frontend/images/service1.png') }}" data-lightbox="beauty-gallery" class="gallery-item">
                    <img src="{{ url('assets/frontend/images/service1.png?auto=compress&h=400') }}" alt="Makeup Eye">
                </a>
            </div>
            <div class="item">
                <a href="{{ url('assets/frontend/images/service2.png') }}" data-lightbox="beauty-gallery" class="gallery-item">
                    <img src="{{ url('assets/frontend/images/service2.png?auto=compress&h=400') }}" alt="Salon Look">
                </a>
            </div>
            <div class="item">
                <a href="{{ url('assets/frontend/images/service3.png" data-lightbox="beauty-gallery') }}" class="gallery-item">
                    <img src="{{ url('assets/frontend/images/service3.png?auto=compress&h=400') }}" alt="Face Treatment">
                </a>
            </div>
            <div class="item">
                <a href="{{ url('assets/frontend/images/service4.png" data-lightbox="beauty-gallery') }}" class="gallery-item">
                    <img src="{{ url('assets/frontend/images/service4.png?auto=compress&h=400') }}" alt="Beauty 2">
                </a>
            </div>
        </div>
        <div class="Bottom-curve"></div>
    </div>
</section> */ ?>

@endsection