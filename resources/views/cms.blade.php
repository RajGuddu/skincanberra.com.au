@extends('_layouts.master')
@section('content')
    @php
        $url = url('assets/frontend/images/course-banner.jpg');
        if(isset($cms) && $cms->cms_banner != ''){
            $url = url(IMAGE_PATH.$cms->cms_banner);
        }
    @endphp
    <div class="banner" style="background-image: url({{ $url }});">
        <div class="container">
            <h1 class="banner-title cormorant aos-init aos-animate" data-aos="fade-up">{{ $cms->banner_title??'' }}</h1>
        </div>
    </div>
    <section class="about-us-panel panel-space">
        <div class="container-fluid">

            <h2 class="text-center mb-4">{{ $cms->banner_title??'' }}</h2>
            <div class="row g-md-5 g-4 align-items-center">
                <div class="col-lg-12">
                    {!! $cms->description??'' !!}
                </div>
            </div>
        </div>
    </section>

@endsection()