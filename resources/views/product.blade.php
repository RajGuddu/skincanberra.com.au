@extends('_layouts.master')
@section('content')
@php
    use App\Models\Common_model;
    $commonmodel = new Common_model;
@endphp
<?php /* <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title> Product Page </title>

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

    <!-- banner panel -->

    <div class="banner" style="background-image: url({{ url('assets/frontend/images/product-banner.jpg')}});">
        <div class="container">
            <h1 class="banner-title cormorant aos-init aos-animate" data-aos="fade-up">All Products</h1>
            <p class="banner-content mt-3 text-black">Browse our complete collection of skincare, haircare, makeup, and
                nail essentials — carefully curated for radiant results.</p>
        </div>
    </div>


    <section class="product-list-panel panel-space">
        <div class="container-fluid">
            <div class="product-tabs">
                <div class="row g-4">
                    <div class="col-md-12">

                        <div class="d-md-flex justify-content-between align-items-center product-list-box gap-3">

                            <!-- Search Box -->
                            <div class="search-box d-flex align-items-center mb-md-0 mb-3">
                                <input type="text" class="form-control shadow-none" placeholder="Search here">
                                <button class="btn btn-light border-0">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                            <div class="d-flex align-items-center gap-4">
                                <!-- fliter button -->
                                <button class="filter-btn">
                                    <img src="{{ url('assets/frontend/images/filter-icon.svg') }}" alt="">
                                    Filters
                                </button>
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
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="nav-tabs d-flex align-items-center border-0" id="myTab" role="tablist">
                            <div class="nav-item active-all"><button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#all" type="button">All</button></div>
                            <div class="nav-tab-slider">
                                @if(isset($proCategory) && $proCategory->isNotEmpty())
                                @foreach($proCategory as $k=>$categ)
                                <div class="item">
                                    <div class="nav-item"><button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#tab{{ $k }}" type="button">{{ $categ->category_name }}</button></div>
                                </div>
                                @endforeach
                                @endif
                                <?php /* <div class="item">
                                    <div class="nav-item"><button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#facemasks" type="button">Face Masks</button></div>
                                </div>
                                <div class="item">
                                    <div class="nav-item"><button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#shampoos" type="button">Shampoos & Conditioners</button>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="nav-item"><button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#serums" type="button">Serums</button></div>
                                </div>
                                <div class="item">
                                    <div class="nav-item"><button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#primers" type="button">Primers</button></div>
                                </div>
                                <div class="item">
                                    <div class="nav-item"><button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#lipsticks" type="button">Lipsticks</button></div>
                                </div>
                                <div class="item">

                                    <div class="nav-item"><button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#sprays" type="button">Setting Sprays</button></div>
                                </div> */ ?>
                            </div>

                        </div>
                    </div>

                </div>


                <div class="tab-content mt-5">
                    <div class="tab-pane fade show active" id="all">
                        <div class="row g-4">
                            @if(isset($products) && $products->isNotEmpty())
                            @foreach($products as $list)
                            <div class="col-lg-3 col-md-6">
                                
                                <div class="product-card">
                                    <a href="{{ url('product/'.$list->pro_url) }}" class="d-block">
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
                            <?php /* <div class="col-lg-3 col-md-6">
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="{{ url('assets/frontend/images/product2.png') }}" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
                                                    <del class="ms-2 del-price">$80</del>
                                                </div>
                                                <span class="ms-auto ml-size">Size: 30 ml</span>
                                            </div>

                                            <span class="btn add-cart-btn w-100 mt-3">
                                                <img src="{{ url('assets/frontend/images/add-to-cart.svg') }}" alt="Cart" class="cart-icon me-2">
                                                Add To Cart
                                            </span>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="{{ url('assets/frontend/images/product3.png') }}" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
                                                    <del class="ms-2 del-price">$80</del>
                                                </div>
                                                <span class="ms-auto ml-size">Size: 30 ml</span>
                                            </div>

                                            <span class="btn add-cart-btn w-100 mt-3">
                                                <img src="{{ url('assets/frontend/images/add-to-cart.svg') }}" alt="Cart" class="cart-icon me-2">
                                                Add To Cart
                                            </span>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="{{ url('assets/frontend/images/product4.png') }}" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Hair Mask</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Silk Repair Hair Mask</h5>
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
                                                <span class="ms-auto ml-size">Size: 30 ml</span>
                                            </div>

                                            <span class="btn add-cart-btn w-100 mt-3">
                                                <img src="{{ url('assets/frontend/images/add-to-cart.svg') }}" alt="Cart" class="cart-icon me-2">
                                                Add To Cart
                                            </span>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="{{ url('assets/frontend/images/product1.png') }}" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Serum</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Radiance Glow Serum</h5>
                                            <p class=" mb-3">
                                                Brighten and deeply hydrate your skin for a soft, radiant,
                                                lit-from-within glow.
                                            </p>

                                            <span class="discount-badge me-2">15% Off</span>
                                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                <div class="d-flex align-items-center">
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
                                                    <del class="ms-2 del-price">$80</del>
                                                </div>
                                                <span class="ms-auto ml-size">Size: 30 ml</span>
                                            </div>

                                            <span class="btn add-cart-btn w-100 mt-3">
                                                <img src="{{ url('assets/frontend/images/add-to-cart.svg') }}" alt="Cart" class="cart-icon me-2">
                                                Add To Cart
                                            </span>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="{{ url('assets/frontend/images/product2.png') }}" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
                                                    <del class="ms-2 del-price">$80</del>
                                                </div>
                                                <span class="ms-auto ml-size">Size: 30 ml</span>
                                            </div>

                                            <span class="btn add-cart-btn w-100 mt-3">
                                                <img src="{{ url('assets/frontend/images/add-to-cart.svg') }}" alt="Cart" class="cart-icon me-2">
                                                Add To Cart
                                            </span>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="{{ url('assets/frontend/images/product3.png') }}" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
                                                    <del class="ms-2 del-price">$80</del>
                                                </div>
                                                <span class="ms-auto ml-size">Size: 30 ml</span>
                                            </div>

                                            <span class="btn add-cart-btn w-100 mt-3">
                                                <img src="{{ url('assets/frontend/images/add-to-cart.svg') }}" alt="Cart" class="cart-icon me-2">
                                                Add To Cart
                                            </span>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="{{ url('assets/frontend/images/product4.png') }}" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Hair Mask</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Silk Repair Hair Mask</h5>
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
                                                <span class="ms-auto ml-size">Size: 30 ml</span>
                                            </div>

                                            <span class="btn add-cart-btn w-100 mt-3">
                                                <img src="{{ url('assets/frontend/images/add-to-cart.svg') }}" alt="Cart" class="cart-icon me-2">
                                                Add To Cart
                                            </span>
                                        </div>
                                    </div>
                                </a>

                            </div> */ ?>
                        </div>
                        <?php /* <div class="pagination-container">
                            <button class="page-btn prev">
                                <span>&larr;</span> <span class="previous">Previous</span>
                            </button>

                            <ul class="pagination">
                                <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><span>...</span></li>
                                <li><a href="#">8</a></li>
                                <li><a href="#">9</a></li>
                                <li><a href="#">10</a></li>
                            </ul>

                            <button class="page-btn next">
                                <span class="pag-next">Next</span> <span>&rarr;</span>
                            </button>
                        </div> */ ?>

                    </div>
                    @if(isset($proCategory) && $proCategory->isNotEmpty())
                    @foreach($proCategory as $k=>$categ)
                    <div class="tab-pane fade" id="tab{{ $k }}">
                        <div class="row g-4">
                            @php 
                            $categProduct = $commonmodel->get_min_value_products($categ->id);
                            @endphp
                            @if($categProduct->isNotEmpty())
                            @foreach($categProduct as $list)
                            <div class="col-lg-3 col-md-6">
                                
                                <div class="product-card">
                                    <a href="{{ url('product/'.$list->pro_url) }}" class="d-block">
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
                            <?php /* <div class="col-lg-3 col-md-6">
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product2.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product3.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product4.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Hair Mask</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Silk Repair Hair Mask</h5>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product1.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Serum</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Radiance Glow Serum</h5>
                                            <p class=" mb-3">
                                                Brighten and deeply hydrate your skin for a soft, radiant,
                                                lit-from-within glow.
                                            </p>

                                            <span class="discount-badge me-2">15% Off</span>
                                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                <div class="d-flex align-items-center">
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product2.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product3.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product4.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Hair Mask</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Silk Repair Hair Mask</h5>
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
                        <?php /* <div class="pagination-container">
                            <button class="page-btn prev">
                                <span>&larr;</span> <span class="previous">Previous</span>
                            </button>

                            <ul class="pagination">
                                <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><span>...</span></li>
                                <li><a href="#">8</a></li>
                                <li><a href="#">9</a></li>
                                <li><a href="#">10</a></li>
                            </ul>

                            <button class="page-btn next">
                                <span class="pag-next">Next</span> <span>&rarr;</span>
                            </button>
                        </div> */ ?>
                    </div>
                    @endforeach
                    @endif
                    <?php /* <div class="tab-pane fade" id="facemasks">
                        <div class="row g-4">
                            <div class="col-lg-3 col-md-6">
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product1.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Serum</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Radiance Glow Serum</h5>
                                            <p class=" mb-3">
                                                Brighten and deeply hydrate your skin for a soft, radiant,
                                                lit-from-within glow.
                                            </p>

                                            <span class="discount-badge me-2">15% Off</span>
                                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                <div class="d-flex align-items-center">
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product2.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product3.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product4.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Hair Mask</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Silk Repair Hair Mask</h5>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product1.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Serum</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Radiance Glow Serum</h5>
                                            <p class=" mb-3">
                                                Brighten and deeply hydrate your skin for a soft, radiant,
                                                lit-from-within glow.
                                            </p>

                                            <span class="discount-badge me-2">15% Off</span>
                                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                <div class="d-flex align-items-center">
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product2.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product3.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product4.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Hair Mask</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Silk Repair Hair Mask</h5>
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
                        </div>
                        <!-- pagination -->
                        <div class="pagination-container">
                            <button class="page-btn prev">
                                <span>&larr;</span> <span class="previous">Previous</span>
                            </button>

                            <ul class="pagination">
                                <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><span>...</span></li>
                                <li><a href="#">8</a></li>
                                <li><a href="#">9</a></li>
                                <li><a href="#">10</a></li>
                            </ul>

                            <button class="page-btn next">
                                <span class="pag-next">Next</span> <span>&rarr;</span>
                            </button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="shampoos">
                        <div class="row g-4">
                            <div class="col-lg-3 col-md-6">
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product1.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Serum</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Radiance Glow Serum</h5>
                                            <p class=" mb-3">
                                                Brighten and deeply hydrate your skin for a soft, radiant,
                                                lit-from-within glow.
                                            </p>

                                            <span class="discount-badge me-2">15% Off</span>
                                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                <div class="d-flex align-items-center">
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product2.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product3.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product4.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Hair Mask</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Silk Repair Hair Mask</h5>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product1.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Serum</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Radiance Glow Serum</h5>
                                            <p class=" mb-3">
                                                Brighten and deeply hydrate your skin for a soft, radiant,
                                                lit-from-within glow.
                                            </p>

                                            <span class="discount-badge me-2">15% Off</span>
                                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                <div class="d-flex align-items-center">
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product2.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product3.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product4.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Hair Mask</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Silk Repair Hair Mask</h5>
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
                        </div>
                        <!-- pagination -->
                        <div class="pagination-container">
                            <button class="page-btn prev">
                                <span>&larr;</span> <span class="previous">Previous</span>
                            </button>

                            <ul class="pagination">
                                <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><span>...</span></li>
                                <li><a href="#">8</a></li>
                                <li><a href="#">9</a></li>
                                <li><a href="#">10</a></li>
                            </ul>

                            <button class="page-btn next">
                                <span class="pag-next">Next</span> <span>&rarr;</span>
                            </button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="serums">
                        <div class="row g-4">
                            <div class="col-lg-3 col-md-6">
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product1.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Serum</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Radiance Glow Serum</h5>
                                            <p class=" mb-3">
                                                Brighten and deeply hydrate your skin for a soft, radiant,
                                                lit-from-within glow.
                                            </p>

                                            <span class="discount-badge me-2">15% Off</span>
                                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                <div class="d-flex align-items-center">
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product2.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product3.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product4.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Hair Mask</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Silk Repair Hair Mask</h5>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product1.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Serum</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Radiance Glow Serum</h5>
                                            <p class=" mb-3">
                                                Brighten and deeply hydrate your skin for a soft, radiant,
                                                lit-from-within glow.
                                            </p>

                                            <span class="discount-badge me-2">15% Off</span>
                                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                <div class="d-flex align-items-center">
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product2.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product3.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product4.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Hair Mask</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Silk Repair Hair Mask</h5>
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
                        </div>
                        <!-- pagination -->
                        <div class="pagination-container">
                            <button class="page-btn prev">
                                <span>&larr;</span> <span class="previous">Previous</span>
                            </button>

                            <ul class="pagination">
                                <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><span>...</span></li>
                                <li><a href="#">8</a></li>
                                <li><a href="#">9</a></li>
                                <li><a href="#">10</a></li>
                            </ul>

                            <button class="page-btn next">
                                <span class="pag-next">Next</span> <span>&rarr;</span>
                            </button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="primers">
                        <div class="row g-4">
                            <div class="col-lg-3 col-md-6">
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product1.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Serum</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Radiance Glow Serum</h5>
                                            <p class=" mb-3">
                                                Brighten and deeply hydrate your skin for a soft, radiant,
                                                lit-from-within glow.
                                            </p>

                                            <span class="discount-badge me-2">15% Off</span>
                                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                <div class="d-flex align-items-center">
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product2.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product3.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product4.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Hair Mask</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Silk Repair Hair Mask</h5>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product1.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Serum</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Radiance Glow Serum</h5>
                                            <p class=" mb-3">
                                                Brighten and deeply hydrate your skin for a soft, radiant,
                                                lit-from-within glow.
                                            </p>

                                            <span class="discount-badge me-2">15% Off</span>
                                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                <div class="d-flex align-items-center">
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product2.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product3.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product4.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Hair Mask</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Silk Repair Hair Mask</h5>
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
                        </div>
                        <!-- pagination -->
                        <div class="pagination-container">
                            <button class="page-btn prev">
                                <span>&larr;</span> <span class="previous">Previous</span>
                            </button>

                            <ul class="pagination">
                                <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><span>...</span></li>
                                <li><a href="#">8</a></li>
                                <li><a href="#">9</a></li>
                                <li><a href="#">10</a></li>
                            </ul>

                            <button class="page-btn next">
                                <span class="pag-next">Next</span> <span>&rarr;</span>
                            </button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="lipsticks">
                        <div class="row g-4">
                            <div class="col-lg-3 col-md-6">
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product1.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Serum</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Radiance Glow Serum</h5>
                                            <p class=" mb-3">
                                                Brighten and deeply hydrate your skin for a soft, radiant,
                                                lit-from-within glow.
                                            </p>

                                            <span class="discount-badge me-2">15% Off</span>
                                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                <div class="d-flex align-items-center">
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product2.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product3.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product4.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Hair Mask</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Silk Repair Hair Mask</h5>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product1.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Serum</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Radiance Glow Serum</h5>
                                            <p class=" mb-3">
                                                Brighten and deeply hydrate your skin for a soft, radiant,
                                                lit-from-within glow.
                                            </p>

                                            <span class="discount-badge me-2">15% Off</span>
                                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                <div class="d-flex align-items-center">
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product2.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product3.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product4.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Hair Mask</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Silk Repair Hair Mask</h5>
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
                        </div>
                        <!-- pagination -->
                        <div class="pagination-container">
                            <button class="page-btn prev">
                                <span>&larr;</span> <span class="previous">Previous</span>
                            </button>

                            <ul class="pagination">
                                <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><span>...</span></li>
                                <li><a href="#">8</a></li>
                                <li><a href="#">9</a></li>
                                <li><a href="#">10</a></li>
                            </ul>

                            <button class="page-btn next">
                                <span class="pag-next">Next</span> <span>&rarr;</span>
                            </button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sprays">
                        <div class="row g-4">
                            <div class="col-lg-3 col-md-6">
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product1.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Serum</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Radiance Glow Serum</h5>
                                            <p class=" mb-3">
                                                Brighten and deeply hydrate your skin for a soft, radiant,
                                                lit-from-within glow.
                                            </p>

                                            <span class="discount-badge me-2">15% Off</span>
                                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                <div class="d-flex align-items-center">
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product2.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product3.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product4.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Hair Mask</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Silk Repair Hair Mask</h5>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product1.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Serum</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Radiance Glow Serum</h5>
                                            <p class=" mb-3">
                                                Brighten and deeply hydrate your skin for a soft, radiant,
                                                lit-from-within glow.
                                            </p>

                                            <span class="discount-badge me-2">15% Off</span>
                                            <div class="d-flex align-items-center mb-2 weight-500 text-18">
                                                <div class="d-flex align-items-center">
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product2.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product3.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
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
                                                    <sapn class="mb-0 view-price text-black">$69</sapn>
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
                                <a href="#" class="d-block">
                                    <div class="product-card">
                                        <div class="product-img position-relative mb-3">
                                            <img src="images/product4.png" alt="Silk Repair Hair Mask"
                                                class="img-fluid rounded-4">
                                            <span class="badge bg-light text-dark hair-mask-badge">Hair Mask</span>
                                        </div>

                                        <div class="product-info">
                                            <h5 class="fw-semibold mb-1 text-black">Silk Repair Hair Mask</h5>
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
                        </div>
                        <!-- pagination -->
                        <div class="pagination-container">
                            <button class="page-btn prev">
                                <span>&larr;</span> <span class="previous">Previous</span>
                            </button>

                            <ul class="pagination">
                                <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><span>...</span></li>
                                <li><a href="#">8</a></li>
                                <li><a href="#">9</a></li>
                                <li><a href="#">10</a></li>
                            </ul>

                            <button class="page-btn next">
                                <span class="pag-next">Next</span> <span>&rarr;</span>
                            </button>
                        </div>
                    </div> */ ?>
                </div>
            </div>
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
                <div class="item"> <a href="images/product1.png" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="images/product1.png?auto=compress&h=400" alt="Makeup 1">
                    </a></div>
                <div class="item"> <a href="images/product2.png" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="images/product2.png?auto=compress&h=400" alt="Nail Art">
                    </a></div>
                <div class="item">
                    <a href="images/product3.png" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="images/product3.png?auto=compress&h=400" alt="Makeup Look">
                    </a>
                </div>
                <div class="item">
                    <a href="images/product4.png" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="images/product4.png?auto=compress&h=400" alt="Facial">
                    </a>
                </div>
                <div class="item">
                    <a href="images/service1.png" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="images/service1.png?auto=compress&h=400" alt="Makeup Eye">
                    </a>
                </div>
                <div class="item">
                    <a href="images/service2.png" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="images/service2.png?auto=compress&h=400" alt="Salon Look">
                    </a>
                </div>
                <div class="item">
                    <a href="images/service3.png" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="images/service3.png?auto=compress&h=400" alt="Face Treatment">
                    </a>
                </div>
                <div class="item">
                    <a href="images/service4.png" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="images/service4.png?auto=compress&h=400" alt="Beauty 2">
                    </a>
                </div>
                <div class="item">
                    <a href="images/product1.png" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="images/product1.png?auto=compress&h=400" alt="Makeup 1">
                    </a>
                </div>
                <div class="item">
                    <a href="images/product2.png" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="images/product2.png?auto=compress&h=400" alt="Nail Art">
                    </a>
                </div>
                <div class="item">
                    <a href="images/product3.png" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="images/product3.png?auto=compress&h=400" alt="Makeup Look">
                    </a>
                </div>
                <div class="item">
                    <a href="images/product4.png" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="images/product4.png?auto=compress&h=400" alt="Facial">
                    </a>
                </div>
                <div class="item">
                    <a href="images/service1.png" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="images/service1.png?auto=compress&h=400" alt="Makeup Eye">
                    </a>
                </div>
                <div class="item">
                    <a href="images/service2.png" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="images/service2.png?auto=compress&h=400" alt="Salon Look">
                    </a>
                </div>
                <div class="item">
                    <a href="images/service3.png" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="images/service3.png?auto=compress&h=400" alt="Face Treatment">
                    </a>
                </div>
                <div class="item">
                    <a href="images/service4.png" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="images/service4.png?auto=compress&h=400" alt="Beauty 2">
                    </a>
                </div>
            </div>
            <div class="Bottom-curve"></div>

        </div>
    </section>

    <!-- footer panel section  -->

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
