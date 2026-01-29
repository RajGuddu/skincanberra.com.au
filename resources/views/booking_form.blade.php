@extends('_layouts.master')
@section('content')
<section class="py-2" style="background-color:#B4903A1A;">
    <div class="container">
        <h2 class="fw-bold mb-4 text-center" style="color:#B4903A;">Booking Form</h2>

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm p-4" style="background-color:#B4903A1A;">
                    <h5 class="fw-bold mb-3" style="color:#000;">Client Details</h5>

                    <form action="{{ url()->current() }}" id="bookingClientForm" method="post">
                        @csrf
                        <input type="hidden" name="sv_id" value="{{ session('sv_id') }}">
                        <input type="hidden" name="vid" value="{{ session('vid') }}">
                        <input type="hidden" name="selected_date" value="{{ session('selected_date') }}">
                        <input type="hidden" name="selected_st_id" value="{{ session('selected_st_id') }}">
                        <input type="hidden" name="book_deposit" id="book_deposit" value="1">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control border-dark" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="Enter first name">
                                <span class="text-danger error-first_name" style="display:none;">Please enter your first name!</span>
                                @error('first_name') <span class="text-danger"> {{ $message }} </span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control border-dark" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Enter last name">
                                <span class="text-danger error-last_name" style="display:none;">Please enter your last name!</span>
                                @error('last_name') <span class="text-danger"> {{ $message }} </span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Email </label>
                                <input type="email" class="form-control border-dark" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email">
                                <span class="text-danger error-email" style="display:none;">Please enter a valid email!</span>
                                @error('email') <span class="text-danger"> {{ $message }} </span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">DOB </label>
                                <input type="date" class="form-control border-dark" id="dob" name="dob" value="{{ old('dob') }}" placeholder="Enter your date of birth">
                                <span class="text-danger error-dob" style="display:none;">Please enter your date of birth!</span>
                                @error('dob') <span class="text-danger"> {{ $message }} </span> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select class="form-select border-dark" name="country" style="max-width: 100px;">
                                    @if(!empty($countries))
                                    @foreach($countries as $list)
                                        <option value="{{ $list->countries_iso_code }}" {{($list->countries_iso_code == 'AU')?'selected':''}}>{{ $list->countries_iso_code }}</option>
                                    @endforeach
                                    @endif
                                    
                                </select>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control border-dark " placeholder="Phone Number">
                            </div>
                            <span class="text-danger error-phone" style="display:none;">Please enter phone number!</span>
                            @error('phone') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Add Your Message</label>
                            <textarea class="form-control border-dark" id="message" name="message" rows="3" placeholder="Write your message here...">{{ old('message') }}</textarea>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4" style="background-color:#B4903A1A;">
                    <h5 class="fw-bold mb-3" style="color:#000;">Booking Details</h5>
                    <p class="mb-1 fw-semibold text-uppercase">
                        {{ $serviceDtls->service_name ?? '' }}
                        <span class="text-muted text-capitalize">({{ $serviceDtls->v_name ?? '' }})</span>
                    </p>
                    <!-- <p class="small text-muted mb-2">12 November 2025 at 10:00 am</p> -->
                    <p class="small text-muted mb-2">{{ $formattedDateTime }}</p>
                    <!-- <a href="#" class="small text-decoration-none" style="color:#B4903A;">More details</a> -->

                    <?php /* <div class="mb-3">
                        <label class="form-label">Select Booking Deposit</label>
                        <input type="hidden" name="sp" id="sp" value="{{ $serviceDtls->sp }}">
                        <select class="form-control" name="booking_deposit" id="booking_deposit" onchange="calculate_price()">
                            <option value="1">$50 Deposit</option>
                            <option value="2">50% Deposit</option>
                            <option value="3">25% Deposit</option>
                        </select>
                    </div> */ ?>
                    <hr>

                    <a href="#" data-bs-toggle="modal" data-bs-target="#policyModal" class="small text-decoration-none" style="color:#B4903A;">View Policy</a>

                    <div class="d-grid mt-4">
                        <!-- <button class="btn btn-outline-dark py-2 mb-2">Add to Cart</button> -->
                        <?php /* <button id="bookNowBtn" class="btn text-white py-2" style="background-color:#000;">Pay Now($50)</button> */ ?>
                        <?php /* <button id="bookNowBtn" class="btn text-white py-2" style="background-color:#000;">Pay Now(${{ $serviceDtls->sp }})</button>*/ ?>
                        <button id="bookNowBtn" class="btn text-white py-2" style="background-color:#000;">Book Now</button> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Privacy Policy Modal -->
<div class="modal fade" id="policyModal" tabindex="-1" aria-labelledby="policyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="policyModalLabel">Privacy Policy</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4" style="line-height:1.7; font-size:14px;">
        {!! $cms->description ?? '' !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@endsection