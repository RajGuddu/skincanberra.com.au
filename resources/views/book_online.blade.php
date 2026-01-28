@extends('_layouts.master')
@section('content')

<link rel="stylesheet" href="{{ url('assets/calender/assets/simple-calendar.css') }}">
<script src="{{ url('assets/calender/assets/jquery.simple-calendar.js') }}"></script>


<section class="py-2" style="background-color:#B4903A1A;">
    <div class="container">
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
    var $calendar;
    $(document).ready(function () {
        let container = $("#container").simpleCalendar({
            fixedStartDay: 0, // begin weeks by sunday
            disableEmptyDetails: true,
            events:  <?= $events;?>,
            /*events: [
              // generate new event after tomorrow for one hour
              // {
              //   startDate: new Date(new Date().setHours(new Date().getHours() + 24)).toDateString(),
              //   endDate: new Date(new Date().setHours(new Date().getHours() + 25)).toISOString(),
              //   summary: 'Visit of the Eiffel Tower'
              // },
              // generate new event for yesterday at noon
              {
                startDate: new Date(new Date().setHours(new Date().getHours() - new Date().getHours() - 12, 0)).toISOString(),
                endDate: new Date(new Date().setHours(new Date().getHours() - new Date().getHours() - 11)).getTime(),
                summary: 'Restaurant'
              },
              // generate new event for the last two days
              {
                startDate: new Date(new Date().setHours(new Date().getHours() - 48)).toISOString(),
                endDate: new Date(new Date().setHours(new Date().getHours() - 24)).getTime(),
                summary: 'Visit of the Louvre'
              }
            ],*/

        });
        $calendar = container.data('plugin_simpleCalendar')

        /*$(".services").multiselect({
            header: true,
            noneSelectedText: 'Select Services',
            selectedList: 3
        });*/
    });
    function get_available_time(el) { //click on calender button
        $('.text-danger').hide();
        $('.day').removeClass('selected-day');
        $(el).addClass('selected-day');
        const b_date = el.getAttribute('data-date');
        const sv_id = $('#sv_id').val(); // selected service
        const vid = $('#vid').val(); 
        if (!sv_id || !vid) {
            alert("Please select service and variant first!");
            return;
        }
        $.ajax({
            type: "POST",
            url: "<?=url('/get_available_time_by_ajax')?>",
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}",
                b_date: b_date,
                sv_id: sv_id,
                vid: vid
            },
            beforeSend: function() {
                $('#ajax-loader').show();
            },
            success: function (response) {
                if (response.success) {
                    console.log(response.html);
                    $('#availability-div').html(response.html);
                    $('#selected_date').val(response.selected_date);
                    $('#selected_st_id').val(response.selected_st_id);
                }

            },
            complete: function() {
                $('#ajax-loader').hide();
            }
        });
        
    }
    // Check Availability button click event
    // $('#nextAvailBtn').on('click', function() {
    $(document).on('click', '#nextAvailBtn', function() {
        var nextDate = $(this).data('next_date'); // data-next_date ka value lena
        var $targetDay = $('.day[data-date="' + nextDate + '"]'); // calendar me matching date find karna

        if ($targetDay.length) {
            $targetDay.trigger('click'); // programmatically click karna
        } else {
            toastr.error('No matching date found in calendar:');
        }
    });
    /*function change_color() {
        $(".book-now-btn").css({
            "background-color": "#bf7524",
            "color": "black",
            "border": "1px solid black"
        });
    }*/
    function check_next_availability(el){
        $('.text-danger').hide();
        $('.day').removeClass('selected-day');
        const c_date = el.getAttribute('data-date');
        if(c_date){
            $.ajax({
                url: "{{ url('check_next_availability_by_ajax') }}",
                type: "POST",
                dataType: "json",
                
                data: {
                    _token: "{{ csrf_token() }}",
                    c_date: c_date,
                    
                },
                beforeSend: function() {
                    $('#ajax-loader').show();
                },
                success: function(response) {
                    if (response.success) {
                        console.log(response.html);
                        $('#availability-div').html(response.html);
                        $('#selected_date').val('');
                        $('#selected_st_id').val('');
                    }else{
                        toastr.error("Soory, Something went wrong!");
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                },
                complete: function() {
                    $('#ajax-loader').hide();
                }
            });
        }
        // alert(c_date);
    }
    $(document).on('click', '#availability-div button', function() { // event for button click
        $('#availability-div button').removeClass('active');
        $(this).addClass('active');
        var selectedId = $(this).data('st_id');
        $('#selected_st_id').val(selectedId);
    });

    /* **************************calendra end************************/
    function getVariants(obj){
        // alert(obj.value);
        var sv_id = obj.value;
        if(sv_id){
            $.ajax({
                url: "{{ url('get_variants_by_ajax') }}",
                type: "POST",
                dataType: "json",
                
                data: {
                    _token: "{{ csrf_token() }}",
                    sv_id: sv_id,
                    
                },
                beforeSend: function() {
                    $('#ajax-loader').show();
                },
                success: function(response) {
                    if (response.success) {
                        console.log(response.html);
                        $('#vid').html(response.html);
                        // toastr.success("Product added into cart");
                    }else{
                        toastr.error("Soory, Something went wrong!");
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                },
                complete: function() {
                    $('#ajax-loader').hide();
                }
            });
        }
    }
</script>
<script>
    function validateForm() {
        let isValid = true;

        // hide all previous errors
        $('.text-danger').hide();

        // read field values
        let selected_date = $('#selected_date').val().trim();
        let selected_st_id = $('#selected_st_id').val().trim();
        let sv_id = $('#sv_id').val().trim();
        let vid = $('#vid').val().trim();

        // validate hidden fields
        if (selected_date === '') {
            $('.error-date').show();
            isValid = false;
        }
        if (selected_st_id === '') {
            $('.error-time').show();
            isValid = false;
        }

        // validate service
        if (sv_id === '') {
            $('.error-sv').show();
            isValid = false;
        }

        // validate variant
        if (vid === '') {
            $('.error-vid').show();
            isValid = false;
        }

        // scroll to top and stop submit if invalid
        if (!isValid) {
            $('html, body').animate({ scrollTop: 0 }, 'slow');
            return false; // stop form submission
        }

        return true; // allow form to submit
    }
</script>

@endsection