@extends('_layouts.master')
@section('content')
<section class="contact-us-panel panel-space">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 pe-lg-5">
                <h2 class="Roboto text-40">Get in touch</h2>
                <p class="mb-5">Our friendly team would love to hear from you.</p>
                <form  id="contactForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">First name</label>
                            <input type="text" name="fname" value="" class="form-control" placeholder="First name">
                            <small id="fname-error" class="text-danger"></small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last name</label>
                            <input type="text" name="lname" value="" class="form-control" placeholder="Last name">
                            <small id="lname-error" class="text-danger"></small>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="" class="form-control" placeholder="you@email.com">
                            <small id="email-error" class="text-danger"></small>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Phone number</label>
                            <div class="input-group">
                                <select class="form-select border-0" name="country" style="max-width: 100px;">
                                    @if(!empty($countries))
                                    @foreach($countries as $list)
                                        <option value="{{ $list->countries_iso_code }}" {{($list->countries_iso_code == 'AU')?'selected':''}}>{{ $list->countries_iso_code }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <input type="text" name="phone" value="" class="form-control border-start border-0" placeholder="Phone Number">
                            </div>
                            <small id="phone-error" class="text-danger"></small>
                        </div>
                        <div class="mt-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control text-area-field" name="message" id="message" placeholder="Your message..."></textarea>
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input" name="pp" value="1" type="checkbox" id="agree" />
                            <label class="form-check-label" for="agree">
                                You agree to our friendly <a href="{{ url('privacy-policy') }}">privacy policy</a>.
                            </label>
                            <small id="agree-error" class="text-danger"></small>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="add-cart-btn w-100">Send message</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6">
                <div class="contact-img">
                    @php
                        $Image = url('assets/frontend/images/contact-makup.jpg');
                        if($content->contact_page_image != '')
                            $Image = url(IMAGE_PATH.$content->contact_page_image);
                    @endphp
                    <img src="{{ $Image }}" alt="" class="w-100">
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d208364.40665883434!2d148.96497187434196!3d-35.31358776272115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b164ca3b20b34bb%3A0x400ea6ea7695970!2sCanberra%20ACT%2C%20Australia!5e0!3m2!1sen!2sin!4v1760189435442!5m2!1sen!2sin"
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>
<section class="about-skin-canberra panel-space" style="background-color: #FEFFF5;">
    <div class="container-fluid">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h2 class="mb-4">{{ $content->about_title ?? '' }}</h2>
                {!! $content->about_details ?? '' !!}
                <?php /* <p>At Skin Canberra, we believe beauty begins with healthy skin and confidence from within.</p>
                <p>Our certified therapists combine gentle techniques with advanced products to deliver skin care,
                    hair treatments, makeup, and nail services tailored to you.</p>
                <p>Whether you’re preparing for a special day or simply want a moment of calm, we’re here to help
                    you feel
                    radiant and renewed.</p> */ ?>
            </div>
            <div class="col-lg-6">
                <div class="canberra">
                    @php
                        $sec1Image = url('assets/frontend/images/canberra.png');
                        if($content->about_image != '')
                            $sec1Image = url(IMAGE_PATH.$content->about_image);
                    @endphp
                    <img src="{{ $sec1Image }}" alt="" class="w-100">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <div class="loader" id="loader" style="display:none;"></div> -->

@endsection