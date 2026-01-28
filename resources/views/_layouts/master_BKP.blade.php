<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title> Skin Canberra </title>
    <link rel="icon" type="image/png" href="{{ url('assets/frontend/images/skin-canberra.svg') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/frontend/css/media-query.css') }}">
    <!-- for datepicker and timepicker -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Multiselect CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-ui-multiselect-widget@3.0.0/jquery.multiselect.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <!-- Multiselect plugin JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-ui-multiselect-widget@3.0.0/src/jquery.multiselect.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
    <!-- end -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
    .ui-datepicker {
        position: absolute;
        z-index: 9999 !important;
    }
    .ui-multiselect-menu{
        position: absolute !important;
        width: 350px !important;
        z-index: 9999 !important;
        font-family: 'Segoe UI', sans-serif;
    }
    .ui-multiselect-checkboxes input[type="checkbox"] {
        margin-right: 8px;
    }
    .ui-multiselect-checkboxes label {
        padding: 5px 10px;
        width: 100%;
        background-color: transparent !important;
    }
    .ui-multiselect-header {
        background-color: #f5f5f5;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }
    .ui-multiselect {
        width: 300px !important;
    }
    .ui-multiselect {
        width: 100% !important;
        border: 1px solid #ced4da;
        background-color: transparent !important;
        padding: 15px 13px;
        border-radius: 8px;
    }
    
    </style>
</head>
<body>
    @include('_layouts.preloader')
    @include('_layouts.ajaxloader')
    
    @include('_layouts.header')
    @yield('content')
    <!-- footer panel section  -->
    @include('_layouts.footer')

    
    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark border-0">
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <div class="ratio ratio-16x9">
                            <!-- <video id="myVideo" controls>
                                <source src="{{ url('assets/frontend/images/doctor.mp4') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video> -->
                            <iframe id="youtubeVideo" width="600" height="500" src="" title="Skin Canberra" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment Modal -->
    <div class="modal fade" id="appointmentModalH" tabindex="-1" aria-labelledby="appointmentModalHLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content appointment-modal">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-40" id="appointmentModalHLabel">Book An Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted mb-4">Plan your visit in just a few clicks.</p>
                    <form id="appointmentFormH">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First name</label>
                                <input type="text" name="fname" value="" class="form-control" placeholder="First name">
                                <small id="fnameH-error" class="text-danger"></small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last name</label>
                                <input type="text" name="lname" value="" class="form-control" placeholder="Last name">
                                <small id="lnameH-error" class="text-danger"></small>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email (optional)</label>
                                <input type="email" name="email" value="" class="form-control" placeholder="you@email.com">
                                <small id="emailH-error" class="text-danger"></small>
                            </div>
                            @php 
                                use App\Models\Common_model;
                                $commonmodel = new Common_model;
                                $services = $commonmodel->crudOperation('RA','tbl_services','',['status'=>1],['sv_id','DESC']);
                                $countries = $commonmodel->crudOperation('RA','tbl_countries','',['status'=>1],['countries_iso_code','ASC']);
                            @endphp
                            <div class="col-12">
                                <label class="form-label">Phone number</label>
                                <div class="input-group">
                                    <select class="form-select border-0" name="country" style="max-width: 100px;">
                                        @if(!empty($countries))
                                        @foreach($countries as $list)
                                            <option value="{{ $list->countries_iso_code }}" {{($list->countries_iso_code == 'AU')?'selected':''}}>{{ $list->countries_iso_code }}</option>
                                        @endforeach
                                        @endif
                                        <!-- <option value="IN">IN</option>
                                        <option value="UK">UK</option> -->
                                    </select>
                                    <input type="text" name="phone" value="" class="form-control border-start border-0" placeholder="Phone Number">
                                </div>
                                <small id="phoneH-error" class="text-danger"></small>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label d-block">Preferred Service</label>
                                <select class="form-select services" id="services" name="sv_id[]" multiple="multiple">
                                    <!-- <option value="" selected>Select a service</option> -->
                                    @if(!empty($services))
                                    @foreach($services as $list)
                                        <option value="{{ $list->sv_id }}">{{ ucwords($list->service_name)}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <small id="svH-error" class="text-danger"></small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Preferred Date*</label>
                                <div class="input-group">
                                    <input type="text" name="date" id="dateH" value="" class="form-control border-0" placeholder="DD/MM/YYYY">
                                    <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                                </div>
                                <small id="dateH-error" class="text-danger"></small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Preferred Time*</label>
                                <div class="input-group">
                                    <input type="text" name="time" id="timeH" value="" class="form-control border-0" placeholder="2:30 PM">
                                    <span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
                                </div>
                                <small id="timeH-error" class="text-danger"></small>
                            </div>
                            <div class="mt-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control text-area-field" name="message" id="message" placeholder="Your message..."></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn add-cart-btn w-100 py-2">Book Now</button>
                            </div>
                            <?php /* <div class="col-12">
                                <button type="button" class="btn w-100 py-2 border view-btn">View Address</button>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn w-100 py-2 border view-btn">Call Us</button>
                            </div> */ ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
    
    <script src="{{ url('assets/frontend/js/custom.js') }}"></script>
    <script src="{{ url('assets/frontend/js/owl.carousel.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Lightbox2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

    <?php /* <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> */ ?>
    
    
    <script>
        AOS.init();
    </script>
    <script>
        toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right", // top-left, bottom-right etc.
        "timeOut": "3000"
        };
        $(".addToCart").click(function(){
            let pro_id = $(this).data('pro_id');
            let attrid = $(this).data('attrid');
            // console.log(pro_id +' '+ attrid);
            $.ajax({
                url: "{{ url('add_to_cart') }}",
                type: "POST",
                dataType: "json",
                
                data: {
                    _token: "{{ csrf_token() }}",
                    pro_id: pro_id,
                    attrid: attrid,
                    
                },
                success: function(response) {
                    if (response.success) {
                        $('#cart-count').text(response.cart_count);
                        $("#cart-icon").attr('href',response.checkoutUrl);
                        toastr.success("Product added into cart");
                    }else{
                        toastr.error("Soory, Something went wrong!");
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
    <script>
        function open_appoint_modal(){
            $("#appointmentFormH").find("small").html('');
            $("#appointmentModalH").modal("show");
        }
        function put_youtube_link(video){
            // alert(video);
            var url = "https://www.youtube.com/embed/";
            $("#youtubeVideo").attr('src', url+video);
            $("#videoModal").modal('show');
        }
        $('#videoModal').on('hidden.bs.modal', function () {
            $("#youtubeVideo").attr("src", $("#youtubeVideo").attr("src"));
        });
        $('#appointmentModalH').on('shown.bs.modal', function () {
            $("#dateH").datepicker({
                dateFormat: "yy-mm-dd"
            });
            $("#timeH").timepicker({
                // timeFormat: "HH:mm:ss"  // 24-hour format (e.g. 21:45:30)
                timeFormat: "hh:mm tt"  // 12-hour format (e.g. 9:45:30)
            });
            
            $(".services").multiselect({
                header: true,
                noneSelectedText: 'Select Services',
                selectedList: 3
            });
        });
        $('#appointmentModalH').on('hidden.bs.modal', function () {
            $('.ui-multiselect-menu').css('display', 'none');
        });
        document.getElementById('appointmentFormH').addEventListener('submit', function (e) {
            e.preventDefault();
            
            $("#appointmentFormH").find("small").html('');
            let form = e.target;
            let formData = new FormData(form);
            let url = "<?=url('/save_book_appointment_h')?>";
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let reloadUrl = "<?=url('thank-you')?>";
            $("#loader").show();
            fetch(url, {
                method: 'POST',
                // headers: {
                // 'X-CSRF-TOKEN': token
                // },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                $("#loader").hide();
                if (data.errors) {
                    if (data.errors.fname) {
                        document.getElementById('fnameH-error').innerText = data.errors.fname;
                    }
                    if (data.errors.lname) {
                        document.getElementById('lnameH-error').innerText = data.errors.lname;
                    }
                    if (data.errors.email) {
                        document.getElementById('emailH-error').innerText = data.errors.email;
                    }
                    if (data.errors.phone) {
                        document.getElementById('phoneH-error').innerText = data.errors.phone;
                    }
                    if (data.errors.sv_id) {
                        document.getElementById('svH-error').innerText = data.errors.sv_id;
                    }
                    if (data.errors.date) {
                        document.getElementById('dateH-error').innerText = data.errors.date;
                    }
                    if (data.errors.time) {
                        document.getElementById('timeH-error').innerText = data.errors.time;
                    }
                    return false;
                }else if(data.message == 'success'){
                    window.location.href = reloadUrl;
                }
            })
            
        });
    </script>
    <script>
        const videoModal = document.getElementById('videoModal');
        const myVideo = document.getElementById('myVideo');
        videoModal.addEventListener('hidden.bs.modal', () => {
            myVideo.pause();
        });
    </script>
    <script>
        
        $('.text-slider').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            dots: false,
            smartSpeed: 1000,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                768: {
                    items: 1
                },
                1200: {
                    items: 1
                }
            }
        });
        $('.gallery-slider').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: false,
            smartSpeed: 1000,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                768: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        });
        $('.testimonial-slider').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            dots: false,
            smartSpeed: 1000,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                768: {
                    items: 2
                },
                1200: {
                    items: 2.5
                }
            }
        });
        $(document).ready(function () {
            var owl = $('.nav-tab-slider');

            owl.owlCarousel({
                loop: false, // Loop false rakho warna hide/show kaam nahi karega
                margin: 10,
                nav: true,
                dots: false,
                smartSpeed: 800,
                autoplayHoverPause: true,
                responsive: {
                    0: { items: 2 },
                    600: { items: 4 },
                    768: { items: 5 },
                    1200: { items: 7 }
                }
            });

            // Default hide prev arrow
            $('.nav-tab-slider .owl-prev').hide();

            // Jab next ya prev click ho tab trigger hoga
            owl.on('changed.owl.carousel', function (event) {
                var totalItems = event.item.count;
                var currentIndex = event.item.index;
                var visibleItems = event.page.size;

                // 1️⃣ Agar first slide pe ho → prev hide
                if (currentIndex === 0) {
                    $('.nav-tab-slider .owl-prev').hide();
                }
                // 2️⃣ Agar first se aage chale gaye → prev show
                else {
                    $('.nav-tab-slider .owl-prev').show();
                }

                // 3️⃣ Agar last slide tak pahunch gaye → next hide
                if (currentIndex + visibleItems >= totalItems) {
                    $('.nav-tab-slider .owl-next').hide();
                }
                // 4️⃣ Agar last se pehle ho → next show
                else {
                    $('.nav-tab-slider .owl-next').show();
                }
            });

            // Jab next click ho, turant prev show ho jaaye
            $('.owl-next').on('click', function () {
                $('.nav-tab-slider .owl-prev').show();
            });
        });
    </script>
</body>
</html>