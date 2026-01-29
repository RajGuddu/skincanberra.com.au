    document.addEventListener('DOMContentLoaded', function () {
        const contactForm = document.getElementById('contactForm');

        if (!contactForm) return;

        contactForm.addEventListener('submit', function (e) {
        e.preventDefault();
        
            $("#contactForm").find("small").html('');
            let form = e.target;
            let formData = new FormData(form);
            let url = window.APP_URL + "/save_contact_us";
            let reloadUrl = window.APP_URL + "/thank-you";

            $('#ajax-loader').show();
            
            fetch(url, {
                method: 'POST',
                // headers: {
                // 'X-CSRF-TOKEN': token
                // },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                $('#ajax-loader').hide();
                if (data.errors) {
                    if (data.errors.fname) {
                        document.getElementById('fname-error').innerText = data.errors.fname;
                    }
                    if (data.errors.lname) {
                        document.getElementById('lname-error').innerText = data.errors.lname;
                    }
                    // if (data.errors.email) {
                    //     document.getElementById('email-error').innerText = data.errors.email;
                    // }
                    if (data.errors.phone) {
                        document.getElementById('phone-error').innerText = data.errors.phone;
                    }
                    if (data.errors.pp) {
                        document.getElementById('agree-error').innerText = data.errors.pp;
                    }
                    // if (data.errors.time) {
                    //     document.getElementById('time-error').innerText = data.errors.time;
                    // }
                    return false;
                }else if(data.message == 'success'){
                    window.location.href = reloadUrl;
                }
            });
        });
        
    });
/*************booking-form**************************** */

    function calculate_price() {
        var sp = parseFloat($("#sp").val());

        var option = $("#booking_deposit").val();
        $("#book_deposit").val(option);

        // var payAmount = sp; // Default 100%
        var payAmount = 50; // Default $50

        // Calculate logic
        if(option == "1"){ 
            // payAmount = sp; // 100%
            payAmount = 50; // $50
        } 
        else if(option == "2"){ 
            payAmount = sp * 0.50; // 50%
        } 
        else if(option == "3"){ 
            payAmount = sp * 0.25; // 25%
        }

        payAmount = Math.ceil(payAmount);

        // Button update
        $("#bookNowBtn").text("Pay Now ($" + payAmount + ")");
    }
    $(document).ready(function() {
        
        $('#bookNowBtn').on('click', function(e) {
            e.preventDefault();

            // Hide old errors
            $('.text-danger').hide();
            $('#ajax-loader').show();

            let isValid = true;

            // Simple validation rules
            let firstName = $('#first_name').val().trim();
            let lastName  = $('#last_name').val().trim();
            let email     = $('#email').val().trim();
            let phone     = $('input[name="phone"]').val().trim();

            if (firstName == "") {
                $('.error-first_name').show();
                isValid = false;
            }

            if (lastName === "") {
                $('.error-last_name').show();
                isValid = false;
            }

            /*if (email === "") {
                $('.error-email').text("Email is required!").show();
                isValid = false;
            } else if (!validateEmail(email)) {
                $('.error-email').text("Invalid email format!").show();
                isValid = false;
            }*/

            if (phone === "") {
                $('.error-phone').show();
                isValid = false;
            }
            $('#ajax-loader').hide();
            // If validation fails → stop here

            if (!isValid) {
                
                return;
            }

            // Disable button while submitting
            $('#bookNowBtn').prop('disabled', true).text('Processing...');

            // Submit the form 
            $('#bookingClientForm').submit();
        });
        function validateEmail(email) {
            let re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
        /* $('#bookNowBtn').on('click', function(e) {
            e.preventDefault();

            // Clear previous errors
            $('.text-danger').hide();

            let form = $('#bookingClientForm');
            let formData = form.serialize();

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',

                beforeSend: function() {
                    $('#bookNowBtn').prop('disabled', true).text('Booking...');
                    $('#ajax-loader').show();
                },
                success: function(response) {
                    $('#bookNowBtn').prop('disabled', false).text('Book Now');

                    if (response.status === 'success') {
                        // alert('Booking successful!');
                        window.location.href = "{{ url('thank-you') }}";
                    } else {
                        alert(response.message || 'Something went wrong!');
                    }
                },
                error: function(xhr) {
                    $('#bookNowBtn').prop('disabled', false).text('Book Now');
                    if (xhr.status === 422) { // Laravel validation error
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('.error-' + key).text(value[0]).show();
                        });
                    } else {
                        alert('Server error, please try again.');
                    }
                },
                complete: function() {
                    $('#ajax-loader').hide();
                }
            });
        }); */
    });
/*************book-online***************************** */
    var $calendar;
    $(document).ready(function () {
        if ($("#container").length && $.fn.simpleCalendar) {
            let container = $("#container").simpleCalendar({
                fixedStartDay: 0, // begin weeks by sunday
                disableEmptyDetails: true,
                events:  window.EVENTS,
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
        }

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
            url:  window.APP_URL + "/get_available_time_by_ajax",
            dataType: "json",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
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
                url: window.APP_URL + "/check_next_availability_by_ajax",
                type: "POST",
                dataType: "json",
                
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
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
    

/* **************************calendra end************************/
    
$(document).on('click', '#availability-div button', function() { // event for button click
    $('#availability-div button').removeClass('active');
    $(this).addClass('active');
    var selectedId = $(this).data('st_id');
    $('#selected_st_id').val(selectedId);
});
function getVariants(obj){
    // alert(obj.value);
    var sv_id = obj.value;
    if(sv_id){
        $.ajax({
            url: window.APP_URL + "/get_variants_by_ajax",
            type: "POST",
            dataType: "json",
            
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
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

//preloader
window.addEventListener("load", function() {
    const preloader = document.getElementById('preloader');

    if (!preloader) return;
    
    setTimeout(() => {
        preloader.style.opacity = '0';
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 300); 
    }, 200); 
});

$(document).ready(function () {
    $('.tab-header a').on('click', function () {
        $('.tab-header a.event_active').removeClass('event_active');
        $(this).addClass('event_active');
    });
    $(window).scroll(function () {
        if ($(window).scrollTop() >= 10) {
            $('.header').addClass('fixed-header');
        } else {
            $('.header').removeClass('fixed-header');
        }
    });
    // $(window).scroll(function () {
    //     if ($(window).scrollTop() >= 10) {
    //         $('.tab-header').addClass('fixed-tab-header');
    //     } else {
    //         $('.tab-header').removeClass('fixed-tab-header');
    //     }
    // });
});
