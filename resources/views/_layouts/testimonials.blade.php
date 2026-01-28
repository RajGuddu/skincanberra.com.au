    <!-- What Our Clients Say -->
     
    
    <section class="testimonial panel-space overflow-hidden">
        <div class="container-fluid">
            <h2 class="text-center mb-4">What Our Clients Say</h2>
            <p class="text-center mb-5">What Our Clients Say</p>
            <div class="testimonial-marquee">
                <!-- Top Row (Right to Left) -->
                <div class="marquee-row top-row mb-3">
                    <div class="marquee-inner">
                        <?php if(!empty($testimonials)){
                        foreach($testimonials as $list){ 
                        if($list->video != ''){ ?>
                        <div class="testimonial-card video-card" >
                            <img src="{{ url(IMAGE_PATH.$list->thumb_image) }}" alt="Facial video">
                            <div class="play-btn" onclick="put_youtube_link('{{ $list->video }}')"></div>
                        </div>
                        <?php }else{ ?>
                        <div class="testimonial-card text-card">
                            <p>{{ substr($list->description, 0, 250) }}</p>
                            <div class="profile">
                                @if($list->photo != NULL)
                                <img src="{{ url(IMAGE_PATH.$list->photo) }}" alt="">
                                @else
                                @php $firstLetter = strtoupper(substr($list->name, 0, 1)); @endphp
                                <div class="profile-pic">{{ $firstLetter }}</div>
                                @endif
                                <div>
                                    <p class="name">{{ $list->name }}</p>
                                    <p class="role">{{ $list->post }}</p>
                                </div>
                            </div>
                        </div>
                        <?php } } }  ?>
                        <?php /* <div class="testimonial-card video-card" data-bs-toggle="modal" data-bs-target="#videoModal">
                            <img src="{{ url('assets/frontend/images/service4.png') }}" alt="Facial video">
                            <div class="play-btn"></div>
                        </div>
                        <div class="testimonial-card video-card" data-bs-toggle="modal" data-bs-target="#videoModal">
                            <img src="{{ url('assets/frontend/images/service3.png') }}" alt="Facial video">
                            <div class="play-btn"></div>
                        </div>
                        <div class="testimonial-card text-card">
                            <p>The best place and AMAZING people ❤️ I just loved their work.</p>
                            <div class="profile">
                                <img src="https://i.pravatar.cc/32?img=3" alt="">
                                <div>
                                    <p class="name">Priya S.</p>
                                    <p class="role">Skin Therapy</p>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-card video-card" data-bs-toggle="modal" data-bs-target="#videoModal">
                            <img src="{{ url('assets/frontend/images/service4.png') }}" alt="Facial video">
                            <div class="play-btn"></div>
                        </div>
                        <div class="testimonial-card video-card" data-bs-toggle="modal" data-bs-target="#videoModal">
                            <img src="{{ url('assets/frontend/images/service3.png') }}" alt="Facial video">
                            <div class="play-btn"></div>
                        </div>
                        <div class="testimonial-card text-card">
                            <p>The best place and AMAZING people ❤️ I just loved their work.</p>
                            <div class="profile">
                                <img src="https://i.pravatar.cc/32?img=3" alt="">
                                <div>
                                    <p class="name">Priya S.</p>
                                    <p class="role">Skin Therapy</p>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-card video-card" data-bs-toggle="modal" data-bs-target="#videoModal">
                            <img src="{{ url('assets/frontend/images/service4.png') }}" alt="Facial video">
                            <div class="play-btn"></div>
                        </div> */ ?>
                    </div>
                </div>
                <!-- Bottom Row (Left to Right) -->
                <div class="marquee-row bottom-row">
                    <div class="marquee-inner">
                        <?php if(!empty($testimonials)){
                        foreach($testimonials as $list){ 
                        if($list->video != ''){ ?>
                        <div class="testimonial-card video-card" data-bs-toggle="modal" data-bs-target="#videoModal">
                            <img src="{{ url(IMAGE_PATH.$list->thumb_image) }}" alt="Facial video">
                            <div class="play-btn"></div>
                        </div>
                        <?php }else{ ?>
                        <div class="testimonial-card text-card">
                            <p>{{ substr($list->description, 0, 250) }}</p>
                            <div class="profile">
                                @if($list->photo != NULL)
                                <img src="{{ url(IMAGE_PATH.$list->photo) }}" alt="">
                                @else
                                @php $firstLetter = strtoupper(substr($list->name, 0, 1)); @endphp
                                <div class="profile-pic">{{ $firstLetter }}</div>
                                @endif
                                <div>
                                    <p class="name">{{ $list->name }}</p>
                                    <p class="role">{{ $list->post }}</p>
                                </div>
                            </div>
                        </div>
                        <?php } } }  ?>
                        <?php /* <div class="testimonial-card text-card">
                            <p>Thank you for a fabulous facial Shikha. Feeling so fresh again.</p>
                            <div class="profile">
                                <img src="https://i.pravatar.cc/32?img=6" alt="">
                                <div>
                                    <p class="name">Riya P.</p>
                                    <p class="role">Facial Care</p>
                                </div>
                            </div>
                        </div>
                         */ ?>
                    </div>
                </div>
            </div>
        </div>
    </section>