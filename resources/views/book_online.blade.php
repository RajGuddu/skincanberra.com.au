@extends('_layouts.master')
@section('content')


<section class="py-2" style="background-color:#B4903A1A;">
    <div class="container ">
        <h2 class="text-center fw-bold mb-2" style="color:#B4903A;">Schedule your service</h2>

        <div class="row">
            <!-- Left Section -->
            <div class="col-lg-8 mb-2">
                <div class="card border-0 shadow-sm p-4" style="background-color:#B4903A1A;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="h5 fw-bold mb-0" style="color:#000;">Select a Date and Time</p>
                        <!-- <small class="text-muted">Time zone: Australian Eastern Daylight Time (AEDT)</small> -->
                    </div>

                    <div class="row">
                        <!-- Calendar -->
                        <div class="col-md-6 mb-3">
                            <div class=" calendar-first" id="calendar_first">
                                <div id="container" class="calendar-container"></div>
                            </div>
                        </div>

                        <!-- Time Slots -->
                        <div class="col-md-6" id="availability-div">
                            {!! $html !!}
                            <?php /* <p class="fw-semibold mt-3">Availability for Saturday 8 November</p>
                            <div class="row g-2">
                                <div class="col-6 d-grid">
                                    <button class="btn btn-outline-dark active" >9:00 am</button>
                                </div>
                                <div class="col-6 d-grid">
                                    <button class="btn btn-outline-dark">10:00 am</button>
                                </div>
                                <div class="col-6 d-grid">
                                    <button class="btn btn-outline-dark">11:00 am</button>
                                </div>
                                <div class="col-6 d-grid">
                                    <button class="btn btn-outline-dark">12:00 pm</button>
                                </div>
                                <div class="col-6 d-grid">
                                    <button class="btn btn-outline-dark">1:00 pm</button>
                                </div>
                                <div class="col-6 d-grid">
                                    <button class="btn btn-outline-dark">2:00 pm</button>
                                </div>
                                <div class="col-6 d-grid">
                                    <button class="btn btn-outline-dark">3:00 pm</button>
                                </div>
                                <div class="col-6 d-grid">
                                    <button class="btn btn-outline-dark">4:00 pm</button>
                                </div>
                                <div class="col-6 d-grid">
                                    <button class="btn btn-outline-dark">5:00 pm</button>
                                </div>
                            </div>  */ ?>
                            <!-- When no slots available -->
                            <?php /* <div class="no-availability text-center my-4" >
                                <p class="mb-3 fw-semibold">No availability</p>
                                <div class="d-grid">
                                    <a href="javascript:void(0)" 
                                    class="btn text-white fw-semibold py-2"
                                    style="background-color:#B4903A; border:none;"
                                    id="nextAvailBtn"
                                    data-next_date="2025-11-18">
                                    Check Next Availability
                                    </a>
                                </div>
                            </div> */ ?>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4" style="background-color:#B4903A1A;">
                    <p class="h5 fw-bold mb-3" style="color:#000;">Service Details</p>
                    <form action="{{ url('book-online') }}" method="post" onsubmit="return validateForm();">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="selected_date" id="selected_date" value="{{ $firstWorkingDate }}">
                    <input type="hidden" name="selected_st_id" id="selected_st_id" value="{{ $st_id }}">
                    <div class="mb-3">
                        <label class="form-label">Select Service <span class="text-danger">*</span></label>
                        <select class="form-select border-dark " id="sv_id" name="sv_id" onchange="getVariants(this);">
                            <option value="">Select service</option>
                            @if($services->isNotEmpty())
                            @foreach($services as $service)
                            @php
                                $selected = '';
                                if(session('sv_id') == $service->sv_id) $selected = 'selected'; @endphp
                            <option value="{{ $service->sv_id }}" {{ $selected }}>{{ $service->service_name }} </option>
                            @endforeach
                            @endif
                        </select>
                        <span class="text-danger error-sv" style="display:none;">Please select service!</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select variant</label>
                        <select class="form-select border-dark" id="vid" name="vid">
                            <option value="">Please select variants!</option>
                            @if($variants->isNotEmpty())
                            @foreach($variants as $variant)
                            @php
                                $selected = '';
                                if(session('vid') == $variant->vid) $selected = 'selected'; @endphp
                            <option value="{{ $variant->vid }}" {{ $selected }}>{{ $variant->v_name.' $'.$variant->sp }} </option>
                            @endforeach
                            @endif
                        </select>
                        <span class="text-danger error-vid" style="display:none;">Please select variant!</span>
                    </div>

                    <div class="text-danger error-date" style="display:none;">Please select a date!</div>
                    <div class="text-danger error-time" style="display:none;">Please select a time slot!</div>
                    
                    <hr>

                    <?php /* <h5 class="fw-bold mb-3" style="color:#000;">Service Details</h5>
                    <p class="mb-1">Book with Shikha</p>
                    <a href="#" class="small text-decoration-none" style="color:#B4903A;">More details</a> */ ?>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn text-white py-2" style="background-color:#B4903A;">Next</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $events = json_encode($events); ?>

<script>
    window.EVENTS = <?=$events ?>;
</script>


@endsection