@extends('_layouts.master')
@section('content')
<?php /* <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title> Product Detail page </title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media-query.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&display=swap"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
</head>

<body>

    <header class="header">
        <div class="top-banner">
            <div class="container-fluid position-relative">
                <div class="text-top-cnt text-center">
                    <div class="text-slider">
                        <div class="item">
                            <p class="mb-0 text-14 text-black">Open 7 Days – Book Your Appointment Anytime</p>
                        </div>
                    </div>
                </div>
                <a href="#" class="contact-link text-14">Contact us</a>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg clear-fix" aria-label="Fourth navbar example">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img class="d-lg-block" src="images/skin-canberra.svg" alt="logo">
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
                            <a class="nav-link py-0 active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item nav-dropdown">
                            <a class="nav-link py-0" href="#">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-0" href="#">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-0" href="#">About</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link py-0" href="#">Scholarships</a>
                        </li> -->
                    </ul>

                </div>
                <div class="header-button">
                    <a href="#" class="cstm-btn" data-bs-toggle="modal" data-bs-target="#appointmentModal">book an
                        appointment </a>
                    <a href="#" class="cart-icon"><img src="images/cart-icon.svg" alt=""></a>
                    <a href="#" class="user-icon"><img src="images/user-icon.svg" alt=""></a>
                </div>

            </div>
        </nav>
    </header> */ ?>

    <section class="product-list-panel pt-5">
        <div class="container-fluid">
            <div class="product-tabs">
                <div class="row g-4">

                    <div class="col-lg-6">
                        <div class="d-flex">
                            <div class="thumbnails">
                                <img src="{{ url(IMAGE_PATH.$product->image1) }}" onclick="changeImage(this)" class="active" alt="{{$product->alt1 ?? ''}}">
                                @if($product->image2 != '')
                                    <img src="{{ url(IMAGE_PATH.$product->image2) }}" onclick="changeImage(this)" class="" alt="{{$product->alt2 ?? ''}}">
                                @endif
                                @if($product->image3 != '')
                                <img src="{{ url(IMAGE_PATH.$product->image3) }}" onclick="changeImage(this)" class="" alt="{{$product->alt3 ?? ''}}">
                                @endif
                                @if($product->image4 != '')
                                <img src="{{ url(IMAGE_PATH.$product->image4) }}" onclick="changeImage(this)" class="" alt="{{$product->alt4 ?? ''}}">
                                @endif
                            </div>

                            <div class="main-image">
                                <img id="main" src="{{ url(IMAGE_PATH.$product->image1) }}"
                                    alt="{{$product->alt1 ?? ''}}">
                            </div>
                        </div>




                        <div class="review-section panel-space pb-0">

                            <!-- Tabs -->
                            <div class="tabs" id="productTab" role="tablist">
                                <span role="presentation">
                                    <button class="tab active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc"
                                        type="button" role="tab">Description</button>
                                </span>
                                <span role="presentation">
                                    <button class="tab " id="app-tab" data-bs-toggle="tab" data-bs-target="#app"
                                        type="button" role="tab">Application</button>
                                </span>
                                <?php /* 
                                <span role="presentation">
                                    <button class="tab" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                                        type="button" role="tab">Reviews <span class="count">157</span></button>
                                </span>
                                */ ?>
                            </div>


                            <!-- Reviews -->
                            <div class="reviews-container">

                                <!-- Tab Contents -->
                                <div class="tab-content" id="productTabContent">
                                    <!-- Description Tab -->
                                    <div class="tab-pane fade show active pt-3" id="desc" role="tabpanel">
                                        {!! $product->description !!}
                                        <?php /* <p class="mb-4">Reveal your skin’s natural luminosity with Radiance Glow Serum —
                                            a lightweight, fast-absorbing formula designed to hydrate, brighten, and
                                            smooth your complexion. Enriched with Vitamin C, Hyaluronic Acid, and
                                            Botanical Extracts, it works to diminish dullness, improve skin texture, and
                                            lock in lasting moisture.</p>

                                        <p>Gentle enough for daily use, this serum delivers an instant lit-from-within
                                            glow while supporting long-term skin health. Perfect for all skin types,
                                            including sensitive skin.</p> */ ?>
                                    </div>
                                    <!-- Application Tab -->
                                    <div class="tab-pane fade  pt-3" id="app" role="tabpanel">
                                        {!! $product->application !!}
                                        <?php /* <p class="mb-4">Reveal your skin’s natural luminosity with Radiance Glow Serum —
                                            a lightweight, fast-absorbing formula designed to hydrate, brighten, and
                                            smooth your complexion. Enriched with Vitamin C, Hyaluronic Acid, and
                                            Botanical Extracts, it works to diminish dullness, improve skin texture, and
                                            lock in lasting moisture.</p>

                                        <p>Gentle enough for daily use, this serum delivers an instant lit-from-within
                                            glow while supporting long-term skin health. Perfect for all skin types,
                                            including sensitive skin.</p> */ ?>
                                    </div>

                                    <?php /* 
                                    <!-- Reviews Tab -->
                                    <div class="tab-pane fade" id="reviews" role="tabpanel">

                                        <div class="reviews-container">

                                            <div class="review">
                                                <img src="https://i.pravatar.cc/60?img=47" alt="User" class="avatar">
                                                <div class="review-content">
                                                    <div class="stars">★★★★★</div>
                                                    <p class="text">
                                                        Absolutely love this serum! My skin feels plump and hydrated,
                                                        and the glow is unreal.
                                                        I’ve been using it for two weeks and already see a big
                                                        difference.
                                                    </p>
                                                    <p class="author"><strong>Sofia Mehta</strong></p>
                                                    <p class="date">March 14, 2021</p>
                                                </div>
                                            </div>

                                            <div class="review">
                                                <img src="https://i.pravatar.cc/60?img=12" alt="User" class="avatar">
                                                <div class="review-content">
                                                    <div class="stars">★★★★★</div>
                                                    <p class="text">
                                                        You made it so simple. My new site is so much faster and easier
                                                        to work with than my old site.
                                                        I just choose the page, make the changes.
                                                    </p>
                                                    <p class="author"><strong>Jenny Wilson</strong></p>
                                                    <p class="date">January 28, 2021</p>
                                                </div>
                                            </div>

                                            <div class="review">
                                                <img src="https://i.pravatar.cc/60?img=30" alt="User" class="avatar">
                                                <div class="review-content">
                                                    <div class="stars">★★★★☆</div>
                                                    <p class="text">
                                                        You made it so simple. My new site is so much faster and easier
                                                        to work with than my old site.
                                                        I just choose the page, make the changes.
                                                    </p>
                                                    <p class="author"><strong>Bessie Cooper</strong></p>
                                                    <p class="date">January 11, 2021</p>
                                                </div>
                                            </div>

                                            <!-- Hidden Reviews (for Load More) -->
                                            <div class="review hidden">
                                                <img src="https://i.pravatar.cc/60?img=32" alt="User" class="avatar">
                                                <div class="review-content">
                                                    <div class="stars">★★★★★</div>
                                                    <p class="text">
                                                        This serum is incredible! My skin feels softer and looks more
                                                        radiant after just a few uses.
                                                    </p>
                                                    <p class="author"><strong>Emily Carter</strong></p>
                                                    <p class="date">December 20, 2020</p>
                                                </div>
                                            </div>

                                            <div class="review hidden">
                                                <img src="https://i.pravatar.cc/60?img=54" alt="User" class="avatar">
                                                <div class="review-content">
                                                    <div class="stars">★★★★★</div>
                                                    <p class="text">
                                                        Great value for the price. It has become an essential part of my
                                                        daily routine!
                                                    </p>
                                                    <p class="author"><strong>Olivia Brown</strong></p>
                                                    <p class="date">November 10, 2020</p>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Load More Button -->
                                        <button class="load-more"><i class="fa-solid fa-rotate"></i> LOAD MORE
                                            REVIEWS</button>

                                    </div>
                                    */ ?>
                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="product-page">
                            <div class="product-card">
                                <h2 class="Roboto text-30 line-height-36 weight-700">{{ ucwords($product->pro_name) }}</h2>
                                <p class="Roboto ">{{ $product->sub_title }}</p>
                                <?php /* <div class="rating">
                                    <span class="stars">★★★★★</span>
                                    <span class="reviews">157 Reviews</span>
                                </div>*/ ?>

                                <div class="price-section">
                                    <span class="new-price" id="priceDisplay">${{ $product->sp }}</span>
                                    <!-- <span class="old-price">$80</span> -->
                                </div>

                                <p class="discount"><i class="fa-solid fa-tag"></i> Save 15% right now</p>

                                <div class="features">
                                    <h3>Key Ingredients :</h3>
                                    {!! $product->keyIngred !!}
                                    <?php /* <ul>
                                        <li> Lactic Acid (3%)</li>
                                        <li>Sodium Citrate (.5%)</li>
                                        <li>Yeast Protein </li>
                                        <li>Horse chestnut seed oil (.5%)  </li>
                                        <li>Peppermint (5%)   </li>
                                        <li> Anti-bacterial and anti-inflammatory </li>
                                    </ul> */ ?>
                                </div>
                                

                                <div class="size-section">
                                    <h3 class="mb-3">Size</h3>
                                    <div class="sizes">
                                        <button class="size active" 
                                            data-price="{{ $product->sp }}"
                                            data-attrid="{{ $product->attrId }}" >
                                            {{ $product->value.' '.$product->unit }}
                                        </button>
                                        @if($attributes->isNotEmpty())
                                        @foreach($attributes as $list)
                                        <button class="size"
                                            data-price="{{ $list->sp }}"
                                            data-attrid="{{ $list->attrId }}">
                                            {{$list->value.' '.$list->unit}} 
                                        </button>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>

                                <span class="add-cart-btn w-50 mt-4 mb-5 addToCart" id="detailCartBtn" data-pro_id="{{ $product->pro_id }}" data-attrid="{{ $product->attrId }}">
                                    <img src="{{ url('assets/frontend/images/add-to-cart.svg') }}"  alt="Cart" class="cart-icon me-2 " >
                                    Add To Cart
                                </span>

                                <div class="extras">
                                    <p><i class="fa-solid fa-globe"></i> Free shipping worldwide</p>
                                    <p><i class="fa-solid fa-lock"></i> 100% Secured Payment</p>
                                    <p><i class="fa-solid fa-user-tie"></i> Made by the Professionals</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



            </div>
        </div>
    </section>

    <!-- Similar Products -->

    <section class="similar-products panel-space">
        <div class="container-fluid">
            <h2 class="mb-5">Similar Products</h2>
            <div class="row g-4">
                @if(isset($simiProduct) && $simiProduct->isNotEmpty())
                @foreach($simiProduct as $list)
                <div class="col-lg-3 col-md-6">
                    
                    <div class="product-card">
                        <a href="{{ url('product/'.$list->pro_url) }}">
                        <div class="product-img position-relative mb-3">
                            <img src="{{ url(IMAGE_PATH.$list->image1) }}" alt="{{ $list->alt1 }}" class="img-fluid rounded-4">
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
                                    <span class="mb-0 view-price text-black">${{ $list->sp }}</span>
                                    <!-- <del class="ms-2 del-price">$80</del> -->
                                </div>
                                <span class="ms-auto ml-size">Size: {{ $list->value }} {{ $list->unit }}</span>
                            </div>

                            <span class="btn add-cart-btn w-100 mt-3 addToCart" data-pro_id="{{ $list->pro_id }}" data-attrid="{{ $list->attrId }}">
                                <img src="{{ url('assets/frontend/images/add-to-cart.svg') }}" alt="Cart" class="cart-icon me-2" data-pro_id="" data-attrid="">
                                Add To Cart
                            </span>
                        </div>
                    </div>

                </div>
                @endforeach
                @else
                    <p class="text-danger">No Product Available.</p>
                @endif
                <?php /* <div class="col-lg-3 col-md-6">
                    <a href="#">
                        <div class="product-card">
                            <div class="product-img position-relative mb-3">
                                <img src="images/product2.png" alt="Silk Repair Hair Mask" class="img-fluid rounded-4">
                                <span class="badge bg-light text-dark hair-mask-badge">Face Wash</span>
                            </div>

                            <div class="product-info">
                                <h5 class="fw-semibold mb-1 text-black">Pure Balance Face Wash</h5>
                                <p class=" mb-3">
                                    Gentle cleanse, balanced skin — daily refresh without stripping.
                                </p>

                                <span class="discount-badge me-2">15% Off</span>
                                <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                    <div class="d-flex align-items-center">
                                        <span class="mb-0 view-price text-black">$69</span>
                                        <del class="ms-2 del-price">$80</del>
                                    </div>
                                    <span class="ms-auto ml-size">Size: 30 ml</span>
                                </div>

                                <span class="btn add-cart-btn w-100 mt-3">
                                    <img src="images/add-to-cart.svg" alt="Cart" class="cart-icon me-2">
                                    Add To Cart
                                </span>
                            </div>
                        </div>
                    </a>

                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#">
                        <div class="product-card">
                            <div class="product-img position-relative mb-3">
                                <img src="images/product3.png" alt="Silk Repair Hair Mask" class="img-fluid rounded-4">
                                <span class="badge bg-light text-dark hair-mask-badge">Sunscreen</span>
                            </div>

                            <div class="product-info">
                                <h5 class="fw-semibold mb-1 text-black">HydraShield Power SPF 50</h5>
                                <p class=" mb-3">
                                    Lightweight SPF with broad-spectrum protection and a dewy finish.
                                </p>

                                <span class="discount-badge me-2">15% Off</span>
                                <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                    <div class="d-flex align-items-center">
                                        <span class="mb-0 view-price text-black">$69</span>
                                        <del class="ms-2 del-price">$80</del>
                                    </div>
                                    <span class="ms-auto ml-size">Size: 30 ml</span>
                                </div>

                                <span class="btn add-cart-btn w-100 mt-3">
                                    <img src="images/add-to-cart.svg" alt="Cart" class="cart-icon me-2">
                                    Add To Cart
                                </span>
                            </div>
                        </div>
                    </a>

                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#">
                        <div class="product-card">
                            <div class="product-img position-relative mb-3">
                                <img src="images/product3.png" alt="Silk Repair Hair Mask" class="img-fluid rounded-4">
                                <span class="badge bg-light text-dark hair-mask-badge">Sunscreen</span>
                            </div>

                            <div class="product-info">
                                <h5 class="fw-semibold mb-1 text-black">HydraShield Power SPF 50</h5>
                                <p class=" mb-3">
                                    Lightweight SPF with broad-spectrum protection and a dewy finish.
                                </p>

                                <span class="discount-badge me-2">15% Off</span>
                                <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                    <div class="d-flex align-items-center">
                                        <span class="mb-0 view-price text-black">$69</span>
                                        <del class="ms-2 del-price">$80</del>
                                    </div>
                                    <span class="ms-auto ml-size">Size: 30 ml</span>
                                </div>

                                <span class="btn add-cart-btn w-100 mt-3">
                                    <img src="images/add-to-cart.svg" alt="Cart" class="cart-icon me-2">
                                    Add To Cart
                                </span>
                            </div>
                        </div>
                    </a>

                </div> */ ?>

            </div>
        </div>
    </section>

    <script>
        $(document).on('click', '.size', function() {
            $('.size').removeClass('active');
            
            $(this).addClass('active');
            
            let selectedPrice = $(this).data('price');
            let selectedAttrid = $(this).data('attrid');
            $('#detailCartBtn').data('attrid', selectedAttrid).attr('data-attrid', selectedAttrid);
            $('#priceDisplay').text('$'+selectedPrice);
        });
    </script>
    <script>
        const videoModal = document.getElementById('videoModal');
        const myVideo = document.getElementById('myVideo');

        videoModal.addEventListener('hidden.bs.modal', () => {
            myVideo.pause();
        });


        // detail page gallery script

        function changeImage(element) {
            document.getElementById('main').src = element.src;

            // Remove active class from all thumbnails
            const thumbnails = document.querySelectorAll('.thumbnails img');
            thumbnails.forEach(img => img.classList.remove('active'));

            // Add active class to clicked thumbnail
            element.classList.add('active');
        }


        // comment load more script

        const loadMoreBtn = document.querySelector('.load-more');
        const hiddenReviews = document.querySelectorAll('.review.hidden');
        let visible = 0;

        loadMoreBtn.addEventListener('click', () => {
            for (let i = visible; i < visible + 2 && i < hiddenReviews.length; i++) {
                hiddenReviews[i].classList.remove('hidden');
            }
            visible += 2;
            if (visible >= hiddenReviews.length) {
                loadMoreBtn.style.display = 'none';
            }
        });

    </script>



    <?php /* <!-- footer panel section  -->

    <footer class="footer panel-space pb-4" style="background-image: url(images/footer-bg-img.png);">
        <div class="container-fluid">
            <div class="row g-5">
                <div class="col-lg-4 pe-lg-5">
                    <a href="#" class="footer-logo mb-4 d-block"><img src="images/skin-canberra.svg" alt=""></a>
                    <p class="text-black mb-4">Personalised, evidence-led skin and hair care that helps you feel
                        confident —
                        naturally.</p>
                    <h5 class="mb-3">Follow us </h5>
                    <div class="social-links">
                        <a href="#" class="d-block"><img src="images/instagram.svg" alt=""></a>
                        <a href="#" class="d-block"><img src="images/facebook.svg" alt=""></a>
                        <a href="#" class="d-block"><img src="images/twitter.svg" alt=""></a>
                        <a href="#" class="d-block"><img src="images/youtube.svg" alt=""></a>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="row g-4">
                        <div class="col-md-3 col-6">
                            <div class="footer-menu-link">
                                <h6>Quick links (labels)</h6>
                                <ul>
                                    <li><a href="#">Services</a></li>
                                    <li><a href="#">Packages & Offers</a></li>
                                    <li><a href="#">Gallery</a></li>
                                    <li><a href="#">Testimonials</a></li>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Bookings</a></li>
                                    <li><a href="#">FAQs</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="footer-menu-link">
                                <h6>Services</h6>
                                <ul>
                                    <li><a href="#">Make up</a></li>
                                    <li><a href="#">Skin Care</a></li>
                                    <li><a href="#">Hair</a></li>
                                    <li><a href="#">Facials </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="footer-menu-link">
                                <h6>Courses</h6>
                                <ul>
                                    <li><a href="#">Trumpet Basics</a></li>
                                    <li><a href="#">Modern Ballet</a></li>
                                    <li><a href="#">Arts & Crafts</a></li>
                                    <li><a href="#">Tennis</a></li>
                                    <li><a href="#">Baking for Beginners</a></li>
                                    <li><a href="#">Pottery Workshop</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div class="footer-menu-link">
                                <h6>Contact</h6>
                                <ul>
                                    <li><a href="#"><strong>Phone / WhatsApp:</strong> +61 X XXXX XXXX</a></li>
                                    <li><a href="#"><strong>Email:</strong> hello@skincanberra.com</a></li>
                                    <li><span><strong>Address:</strong> [Street address], Canberra ACT</span></li>
                                </ul>
                            </div>
                            <div class="footer-menu-link mt-5">
                                <h6>Opening hours</h6>
                                <ul>
                                    <li><span><strong>Address:</strong> [Street address], Canberra ACT</span></li>
                                    <li><span><strong>Mon-Fri:</strong> 9:00 AM - 6:00 PM</span></li>
                                    <li><span><strong>Sat:</strong> 9:00 AM - 4:00 PM</span></li>
                                    <li><span><strong>Sun:</strong> Closed / By appointment</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark border-0">
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <div class="ratio ratio-16x9">
                            <video id="myVideo" controls>
                                <source src="images/doctor.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
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
    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content appointment-modal">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-40" id="appointmentModalLabel">Book An Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="text-muted mb-4">Plan your visit in just a few clicks.</p>

                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First name</label>
                                <input type="text" class="form-control" placeholder="First name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last name</label>
                                <input type="text" class="form-control" placeholder="Last name">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email (optional)</label>
                                <input type="email" class="form-control" placeholder="you@email.com">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Phone number</label>
                                <div class="input-group">
                                    <select class="form-select border-0" style="max-width: 100px;">
                                        <option selected="">US</option>
                                        <option>IN</option>
                                        <option>UK</option>
                                    </select>
                                    <input type="text" class="form-control border-start border-0"
                                        placeholder="+1 (555) 000-0000">
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Preferred Service</label>
                                <select class="form-select">
                                    <option selected>Select a service</option>
                                    <option>Hair Cut</option>
                                    <option>Massage</option>
                                    <option>Facial</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Preferred Date*</label>
                                <div class="input-group">
                                    <input type="text" class="form-control border-0" placeholder="DD/MM/YYYY">
                                    <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Preferred Time*</label>
                                <div class="input-group">
                                    <input type="text" class="form-control border-0" placeholder="2:30 PM">
                                    <span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn add-cart-btn w-100 py-2">Book Now</button>
                            </div>

                            <div class="col-12">
                                <button type="button" class="btn w-100 py-2 border view-btn">View Address</button>
                            </div>

                            <div class="col-12">
                                <button type="button" class="btn w-100 py-2 border view-btn">Call Us</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Lightbox2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

    <script>
        AOS.init();
    </script>

    <script>
        const videoModal = document.getElementById('videoModal');
        const myVideo = document.getElementById('myVideo');

        videoModal.addEventListener('hidden.bs.modal', () => {
            myVideo.pause();
        });


        // detail page gallery script

        function changeImage(element) {
            document.getElementById('main').src = element.src;

            // Remove active class from all thumbnails
            const thumbnails = document.querySelectorAll('.thumbnails img');
            thumbnails.forEach(img => img.classList.remove('active'));

            // Add active class to clicked thumbnail
            element.classList.add('active');
        }


        // comment load more script

        const loadMoreBtn = document.querySelector('.load-more');
        const hiddenReviews = document.querySelectorAll('.review.hidden');
        let visible = 0;

        loadMoreBtn.addEventListener('click', () => {
            for (let i = visible; i < visible + 2 && i < hiddenReviews.length; i++) {
                hiddenReviews[i].classList.remove('hidden');
            }
            visible += 2;
            if (visible >= hiddenReviews.length) {
                loadMoreBtn.style.display = 'none';
            }
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




        // $('.nav-tab-slider').owlCarousel({
        //     loop: true,
        //     margin: 10,
        //     nav: true,
        //     dots: false,
        //     smartSpeed: 1000,
        //     autoplayTimeout: 2000,
        //     autoplayHoverPause: true,
        //     responsive: {
        //         0: {
        //             items: 3
        //         },
        //         600: {
        //             items: 4
        //         },
        //         768: {
        //             items: 5
        //         },
        //         1200: {
        //             items: 5
        //         }
        //     }
        // });

        $('.review-slider').owlCarousel({
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
                    items: 3
                },
                1200: {
                    items: 3
                }
            }
        });

    </script>



</body>

</html> */ ?>
@endsection