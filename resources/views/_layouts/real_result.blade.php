    
    <section class="gallery-panel panel-space overflow-hidden pt-0">
        <h2 class="text-center mb-4">Real Results — Before & After</h2>
        <p class="text-center mb-5 line-height-36 ">Real clients, real results — browse before & afters and treatment
            highlights to see what’s possible.</p>

        <div class="gallery-container">
            <!-- Each image should be inside an <a> tag for Lightbox -->
            <div class="top-curve"></div>
            <div class="gallery-slider">
                @php 
                    use App\Models\Common_model;
                    $commonmodel = new Common_model;
                    $images = $commonmodel->crudOperation('RA','tbl_realresult','',[['status','=',1]],['id','DESC']);
                
                @endphp
                @if($images->isNotEmpty())
                @foreach($images as $list)
                <div class="item"> 
                    <a href="{{ url(IMAGE_PATH.$list->image) }}" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="{{ url(IMAGE_PATH.$list->image.'?auto=compress&h=400') }}" alt="{{ $list->alt }}">
                    </a>
                </div>
                @endforeach
                @endif
                <?php /* <div class="item"> <a href="{{ url('assets/frontend/images/product2.png') }}" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="{{ url('assets/frontend/images/product2.png?auto=compress&h=400') }}" alt="Nail Art">
                    </a></div>
               
                <div class="item">
                    <a href="{{ url('assets/frontend/images/service4.png') }}" data-lightbox="beauty-gallery" class="gallery-item">
                        <img src="{{ url('assets/frontend/images/service4.png?auto=compress&h=400') }}" alt="Beauty 2">
                    </a>
                </div> */ ?>
            </div>
            <div class="Bottom-curve"></div>

        </div>
    </section>