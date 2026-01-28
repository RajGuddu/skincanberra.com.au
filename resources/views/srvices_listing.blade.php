@extends('_layouts.master')
@section('content')
  
<!-- banner panel -->
@php
    $url = url('assets/frontend/images/service-lising-banner.jpg');
    if(isset($service) && $service->banner_image != ''){
        $url = url(IMAGE_PATH.$service->banner_image);
    }
@endphp
<div class="banner title-left" style="background-image: url({{ url($url) }});">
    <div class="container">
        <h1 class="banner-title cormorant aos-init aos-animate" data-aos="fade-up">{{ $service->banner_title }}</h1>
        <!-- <p class="banner-content">From glow-boosting facials to precision haircuts and advanced skin therapies — our professional team delivers personalised treatments with care and clarity.</p> -->
    </div>
</div>
<section class="service-lising panel-space">
    <div class="container-fluid">
        <h2 class="d-none">only for html validator</h2> 
        <div class="d-flex justify-content-between align-items-center mb-5">
            <!-- Search Box -->
            <div class="search-box d-flex align-items-center">
                <input type="text" class="form-control shadow-none" placeholder="Search here">
                <button class="btn btn-light border-0">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <!-- Sort Dropdown -->
            <div class="dropdown">
                <button class="btn btn-sort dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Sort by
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Newest</a></li>
                    <li><a class="dropdown-item" href="#">Oldest</a></li>
                    <li><a class="dropdown-item" href="#">Popular</a></li>
                </ul>
            </div>
        </div>
        <div class="row g-4">
            @if(!$variants->isEmpty())
            @foreach($variants as $list)
            @if($list->photo != '')
            <div class="col-lg-3 col-md-6">
                <a href="javascript:void(0)" <?php /* data-bs-toggle="modal" data-bs-target="#appointmentModal" */ ?>>
                    <div class="product-card">
                        <div class="product-img position-relative mb-3">
                            <img src="{{ url(IMAGE_PATH.$list->photo) }}" alt="Lifting Lymphatic Drainage" class="img-fluid rounded-4">
                        </div>
                        <div class="product-info">
                            <p class="h5 fw-semibold mb-1 text-black">{{ $list->v_name }}</p>
                            <p class=" mb-3">
                                {{ substr($list->details, 0, 75) }}
                            </p>
                            <!-- <span class="discount-badge me-2">15% Off</span> -->
                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                <div class="d-flex align-items-center">
                                    <span class="mb-0 view-price text-black">${{ $list->sp }}</span>
                                    <!-- <del class="ms-2 del-price">${{ $list->mrp }}</del> -->
                                </div>
                            </div>
                            <?php /* <span class="btn add-cart-btn w-100 mt-3" onclick="book_service({{ $list->vid }})" >
                                Book Now
                            </span> */ ?>
                            @php $v_url = url('book-variant/'.$list->vid); @endphp
                            <span class="btn add-cart-btn w-100 mt-3" onclick="window.location.href='{{ $v_url }}'" >
                                Book Now
                            </span>
                            
                        </div>
                    </div>
                </a>
            </div>
            @endif
            @endforeach
            @else
                <div class="col-lg-6 col-md-12">
                    <span class="text-danger text-center">No Service Available!</span>
                </div>
            @endif
            
            <?php /* <div class="col-lg-3 col-md-6">
                <a href="#">
                    <div class="product-card">
                        <div class="product-img position-relative mb-3">
                            <img src="{{ url('assets/frontend/images/service2.png') }}" alt="Lifting Lymphatic Drainage" class="img-fluid rounded-4">
                        </div>
                        <div class="product-info">
                            <h5 class="fw-semibold mb-1 text-black">Brightening / Glow Facial</h5>
                            <p class=" mb-3">
                                Gentle cleanse, balanced skin — daily refresh without stripping.
                            </p>
                            <span class="discount-badge me-2">15% Off</span>
                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                <div class="d-flex align-items-center">
                                    <sapn class="mb-0 view-price text-black">$69</sapn>
                                    <del class="ms-2 del-price">$80</del>
                                </div>
                            </div>
                            <span class="btn add-cart-btn w-100 mt-3">
                                Book Now
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <a href="#">
                    <div class="product-card">
                        <div class="product-img position-relative mb-3">
                            <img src="{{ url('assets/frontend/images/service4.png') }}" alt="Lifting Lymphatic Drainage" class="img-fluid rounded-4">
                        </div>
                        <div class="product-info">
                            <h5 class="fw-semibold mb-1 text-black">Lifting Lymphatic Drainage</h5>
                            <p class=" mb-3">
                                Intense nourishment for dry, damaged hair — salon-grade repair at
                                home.
                            </p>
                            <span class="discount-badge me-2">15% Off</span>
                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                <div class="d-flex align-items-center">
                                    <sapn class="mb-0 view-price text-black">$69</sapn>
                                    <del class="ms-2 del-price">$80</del>
                                </div>
                            </div>
                            <span class="btn add-cart-btn w-100 mt-3">
                                Book Now
                            </span>
                        </div>
                    </div>
                </a>
            </div> */ ?>
        </div>
    </div>
</section>
<!-- Appointment Modal -->
<?php /* <div class="modal fade" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="appointmentModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content appointment-modal">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="appointmentModalLabel">Book An Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-4">Plan your visit in just a few clicks.</p>
                <form id="appointmentForm">
                    <!-- <input type="hidden" name="vid" id="vid" value=""> -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">First name*</label>
                            <input type="text" name="fname" value="" class="form-control" placeholder="First name">
                            <small id="fname-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last name*</label>
                            <input type="text" name="lname" value="" class="form-control" placeholder="Last name">
                            <small id="lname-error" class="text-danger"></small>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email (optional)</label>
                            <input type="email" name="email" value=""  class="form-control" placeholder="you@email.com">
                            <small id="email-error" class="text-danger"></small>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Phone Number*</label>
                            <div class="input-group">
                                <select class="form-select" name="country" style="max-width: 100px;">
                                    @if(!empty($countries))
                                    @foreach($countries as $list)
                                        <option value="{{ $list->countries_iso_code }}" {{($list->countries_iso_code == 'AU')?'selected':''}}>{{ $list->countries_iso_code }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <input type="text" name="phone" value="" class="form-control" placeholder="Phone Number">
                            </div>
                            <small id="phone-error" class="text-danger"></small>
                        </div>
                        @php 
                            use App\Models\Common_model;
                            $commonmodel = new Common_model;
                            $services = $commonmodel->crudOperation('RA','tbl_services_variants','',[['status','=',1],['sv_id','=',$service->sv_id]],['vid','ASC']);
                        @endphp
                        <div class="col-12">
                            <label class="form-label d-block">Preferred Service</label>
                            <select class="form-select services" id="vids" name="vids[]" multiple="multiple">
                                <!-- <option value="" selected>Select a service</option> -->
                                @if(!empty($services))
                                @foreach($services as $list)
                                    <option value="{{ $list->vid }}">{{ ucwords($list->v_name).' $'.$list->sp }}</option>
                                @endforeach
                                @endif
                            </select>
                            <small id="vids-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Preferred Date*</label>
                            <div class="input-group">
                                <input type="text" name="date" id="date" value="" class="form-control" placeholder="DD/MM/YYYY" autocomplete="off">
                                <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                            </div>
                            <small id="date-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Preferred Time*</label>
                            <div class="input-group">
                                <input type="text" name="time" id="time" value="" class="form-control" placeholder="2:30 PM" autocomplete="off">
                                <span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
                            </div>
                            <small id="time-error" class="text-danger"></small>
                        </div>
                        <div class="mt-3">
                            <label for="message2" class="form-label">Message</label>
                            <textarea class="form-control text-area-field" name="message" id="message2" placeholder="Your message..."></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-dark w-100 py-2">Book Now</button>
                        </div>
                        <?php /* <div class="col-12">
                            <button type="button" class="btn btn-light w-100 py-2 border">View Address</button>
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-light w-100 py-2 border">Call Us</button>
                        </div> *
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div> */ ?>
<script>
    /* $('#appointmentModal').on('shown.bs.modal', function () {
        $("#date").datepicker({
            dateFormat: "yy-mm-dd"
        });
        $("#time").timepicker({
            // timeFormat: "HH:mm:ss"  // 24-hour format (e.g. 21:45:30)
            timeFormat: "hh:mm tt"  // 12-hour format (e.g. 9:45:30)
        });
        $(".services").multiselect({
            header: true,
            noneSelectedText: 'Select Services',
            selectedList: 3
        });
    });
    $('#appointmentModal').on('hidden.bs.modal', function () {
        $('.ui-multiselect-menu').css('display', 'none');
    }); 
    function book_service(vid){
        // alert(vid);
        /*$("#date").datepicker({
            dateFormat: "yy-mm-dd"
        });*
        $("#fname-error, #lname-error, #email-error, #phone-error, #date-error, #time-error").html('');
        document.getElementById("appointmentForm").reset();
        document.getElementById("vids").value = vid;
        let modal = new bootstrap.Modal(document.getElementById('appointmentModal'));
        modal.show();
    }
    document.getElementById('appointmentForm').addEventListener('submit', function (e) {
        e.preventDefault();
        
        document.getElementById('fname-error').innerText = '';
        document.getElementById('lname-error').innerText = '';
        document.getElementById('email-error').innerText = '';
        document.getElementById('phone-error').innerText = '';
        document.getElementById('date-error').innerText = '';
        document.getElementById('time-error').innerText = '';
        let form = e.target;
        let formData = new FormData(form);
        let url = "<?=url('/save_appointment_service')?>";
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let reloadUrl = "<?=url('thank-you')?>";
        $("#loader").show();
        fetch(url, {
            method: 'POST',
            // headers: {
            // // 'X-CSRF-TOKEN': token
            // },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            $("#loader").hide();
            if (data.errors) {
                if (data.errors.fname) {
                    document.getElementById('fname-error').innerText = data.errors.fname;
                }
                if (data.errors.lname) {
                    document.getElementById('lname-error').innerText = data.errors.lname;
                }
                if (data.errors.email) {
                    document.getElementById('email-error').innerText = data.errors.email;
                }
                if (data.errors.phone) {
                    document.getElementById('phone-error').innerText = data.errors.phone;
                }
                if (data.errors.date) {
                    document.getElementById('date-error').innerText = data.errors.date;
                }
                if (data.errors.time) {
                    document.getElementById('time-error').innerText = data.errors.time;
                }
                return false;
            }else if(data.message == 'success'){
                window.location.href = reloadUrl;
            }
        })
        
    }); */
    
</script>
@endsection