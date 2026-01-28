@extends('admin._layout.master')
@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-xl">
		<h1 class="app-page-title">Home Page Content</h1>
		<?php if(Session::has('message')){ 
			echo alertBS(session('message')['msg'], session('message')['type']);
		} ?>
		<hr class="mb-4">
		<div class="row g-4 settings-section">
			<div class="col-12 col-md-2">
				<h3 class="section-title">Section 2</h3>

				<div class="">
					<div class="img-box">
						<span class="cancel-icon"
							onclick="cancel_image_('tbl_home_content','about_image','id', <?=$settings->id?>)"><i
								class="fa-solid fa-xmark" title="Cancel"></i>
						</span>
						<img src="{{ url(IMAGE_PATH.$settings->about_image) }}" class="" alt="...">
						<small class="image-title">About Image</small>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-10">
				<div class="app-card app-card-settings shadow-sm p-4">

					<div class="app-card-body">
						<form class="settings-form" autocomplete="off" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="submit" value="about">
							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label for="about_title" class="form-label">Title</label>
										<input type="text" class="form-control" id="about_title" name="about_title"
											value="{{ old('about_title', $settings->about_title ?? '') }}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="about_details" class="form-label">Details</label>
										<textarea class="form-control" id="about_details" name="about_details">{{ old('about_details', $settings->about_details ?? '') }}</textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="about_image" class="form-label">Image (1066 X 673 px)</label>
										<input type="file" class="form-control" id="about_image" name="about_image" value="">
										<input type="hidden" class="form-control" id="about_image2" name="about_image2" value="{{ $settings->about_image ?? '' }}">
									</div>
								</div>
								
								<div class="col-md-6">
									<button type="submit" class="btn app-btn-primary">Save Changes</button>
								</div>
							</div>
						</form>
					</div><!--//app-card-body-->

				</div><!--//app-card-->
			</div>
		</div><!--//row-->
		<hr class="my-4">
		<div class="row g-4 settings-section">
			<div class="col-12 col-md-2">
				<h3 class="section-title">Section 5</h3>
				<div class="">
					<div class="img-box">
						<span class="cancel-icon"
							onclick="cancel_image_('tbl_home_content','sec5_content_image1','id', <?=$settings->id?>)"><i
								class="fa-solid fa-xmark" title="Cancel"></i>
						</span>
						<img src="{{ url(IMAGE_PATH.$settings->sec5_content_image1) }}" class="" alt="...">
						<small class="image-title">Content Image1</small>
					</div>
					<div class="img-box">
						<span class="cancel-icon"
							onclick="cancel_image_('tbl_home_content','sec5_content_image2','id', <?=$settings->id?>)"><i
								class="fa-solid fa-xmark" title="Cancel"></i>
						</span>
						<img src="{{ url(IMAGE_PATH.$settings->sec5_content_image2) }}" class="" alt="...">
						<small class="image-title">Content Image2</small>
					</div>
					<div class="img-box">
						<span class="cancel-icon"
							onclick="cancel_image_('tbl_home_content','sec5_content_image3','id', <?=$settings->id?>)"><i
								class="fa-solid fa-xmark" title="Cancel"></i>
						</span>
						<img src="{{ url(IMAGE_PATH.$settings->sec5_content_image3) }}" class="" alt="...">
						<small class="image-title">Content Image3</small>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-10">
				<div class="app-card app-card-settings shadow-sm p-4">

					<div class="app-card-body">
						<form class="settings-form" autocomplete="off" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="submit" value="sec-5">

							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec5_title" class="form-label">Title</label>
										<input type="text" class="form-control" id="sec5_title" name="sec5_title"
											value="{{ old('sec5_title', $settings->sec5_title ?? '') }}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec5_description" class="form-label">Description</label>
										<textarea  class="form-control" id="sec5_description" name="sec5_description" rows="4" cols="30">{{ old('sec5_description', $settings->sec5_description ?? '') }}</textarea>
									</div>
								</div>
								<!--Content 1 -->
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec5_content_title1" class="form-label">Content Title1</label>
										<input type="text" class="form-control" id="sec5_content_title1" name="sec5_content_title1"
											value="{{ old('sec5_content_title1', $settings->sec5_content_title1 ?? '') }}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec5_content_details1" class="form-label">Content Details1</label>
										<textarea class="form-control" id="sec5_content_details1" name="sec5_content_details1">
											{{ old('sec5_content_details1', $settings->sec5_content_details1 ?? '') }} </textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec5_content_image1" class="form-label">Content Image1 (4096 X 2304 px)</label>
										<input type="file" class="form-control" id="sec5_content_image1" name="sec5_content_image1" value="">
										<input type="hidden" class="form-control" name="sec5_content_image1_2" value="{{ $settings->sec5_content_image1 ?? '' }}">
									</div>
								</div>
								<!--Content 2 -->
								<hr class="my-4 text-danger">
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec5_content_title2" class="form-label">Content Title2</label>
										<input type="text" class="form-control" id="sec5_content_title2" name="sec5_content_title2"
											value="{{ old('sec5_content_title2', $settings->sec5_content_title2 ?? '') }}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec5_content_details2" class="form-label">Content Details2</label>
										<textarea class="form-control" id="sec5_content_details2" name="sec5_content_details2">
											{{ old('sec5_content_details2', $settings->sec5_content_details2 ?? '') }} </textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec5_content_image2" class="form-label">Content Image2 (4096 X 2304 px)</label>
										<input type="file" class="form-control" id="sec5_content_image2" name="sec5_content_image2" value="">
										<input type="hidden" class="form-control" name="sec5_content_image2_2" value="{{ $settings->sec5_content_image2 ?? '' }}">
									</div>
								</div>
								<!--Content 3 -->
								<hr class="my-4 text-danger">
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec5_content_title3" class="form-label">Content Title3</label>
										<input type="text" class="form-control" id="sec5_content_title3" name="sec5_content_title3"
											value="{{ old('sec5_content_title3', $settings->sec5_content_title3 ?? '') }}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec5_content_details3" class="form-label">Content Details3</label>
										<textarea class="form-control" id="sec5_content_details3" name="sec5_content_details3">
											{{ old('sec5_content_details3', $settings->sec5_content_details3 ?? '') }} </textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec5_content_image3" class="form-label">Content Image3 (4096 X 2304 px)</label>
										<input type="file" class="form-control" id="sec5_content_image3" name="sec5_content_image3" value="">
										<input type="hidden" class="form-control" name="sec5_content_image3_2" value="{{ $settings->sec5_content_image3 ?? '' }}">
									</div>
								</div>
								
								<div class="col-md-6">
									<button type="submit" class="btn app-btn-primary">Save Changes</button>
								</div>
							</div>
						</form>

					</div><!--//app-card-body-->

				</div><!--//app-card-->
			</div>
		</div><!--//row-->
		<hr class="my-4">
		<div class="row g-4 settings-section">
			<div class="col-12 col-md-2">
				<h3 class="section-title">Section 6</h3>
				<div class="">
					<div class="img-box">
						<span class="cancel-icon"
							onclick="cancel_image_('tbl_home_content','pic1','id', <?=$settings->id?>)"><i
								class="fa-solid fa-xmark" title="Cancel"></i>
						</span>
						<img src="{{ url(IMAGE_PATH.$settings->pic1) }}" class="" alt="...">
						<small class="image-title">Image1</small>
					</div>
					<div class="img-box">
						<span class="cancel-icon"
							onclick="cancel_image_('tbl_home_content','pic2','id', <?=$settings->id?>)"><i
								class="fa-solid fa-xmark" title="Cancel"></i>
						</span>
						<img src="{{ url(IMAGE_PATH.$settings->pic2) }}" class="" alt="...">
						<small class="image-title">Image2</small>
					</div>
					<div class="img-box">
						<span class="cancel-icon"
							onclick="cancel_image_('tbl_home_content','pic3','id', <?=$settings->id?>)"><i
								class="fa-solid fa-xmark" title="Cancel"></i>
						</span>
						<img src="{{ url(IMAGE_PATH.$settings->pic3) }}" class="" alt="...">
						<small class="image-title">Image3</small>
					</div>
					<div class="img-box">
						<span class="cancel-icon"
							onclick="cancel_image_('tbl_home_content','pic4','id', <?=$settings->id?>)"><i
								class="fa-solid fa-xmark" title="Cancel"></i>
						</span>
						<img src="{{ url(IMAGE_PATH.$settings->pic4) }}" class="" alt="...">
						<small class="image-title">Image4</small>
					</div>
				</div>

			</div>
			<div class="col-12 col-md-10">
				<div class="app-card app-card-settings shadow-sm p-4">
					<div class="app-card-body">
						<form class="settings-form" autocomplete="off" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="submit" value="sec-6">
							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec6_title" class="form-label">Title</label>
										<input type="text" class="form-control" id="sec6_title" name="sec6_title"
											value="{{ old('sec6_title', $settings->sec6_title ?? '') }}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec6_description" class="form-label">Description</label>
										<textarea  class="form-control" id="sec6_description" name="sec6_description" style="height: 100px !important;">{{ old('sec6_description', $settings->sec6_description ?? '') }}</textarea>
									</div>
								</div>
								<!-- pic1 -->
								<div class="col-md-12">
									<div class="mb-3">
										<label for="pic_title1" class="form-label">Pic Title1</label>
										<input type="text" class="form-control" id="pic_title1" name="pic_title1"
											value="{{ old('pic_title1', $settings->pic_title1 ?? '') }}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="pic_details1" class="form-label">Pic Details1</label>
										<textarea class="form-control" id="pic_details1" name="pic_details1" style="height: 100px !important;">{{ old('pic_details1', $settings->pic_details1 ?? '') }} </textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="pic1" class="form-label">Pic1 (1432 X 400 px)</label>
										<input type="file" class="form-control" id="pic1" name="pic1" value="">
										<input type="hidden" class="form-control" name="pic1_2" value="{{ $settings->pic1 ?? '' }}">
									</div>
								</div>
								<!-- pic2 -->
								<div class="col-md-12">
									<div class="mb-3">
										<label for="pic_title2" class="form-label">Pic Title2</label>
										<input type="text" class="form-control" id="pic_title2" name="pic_title2"
											value="{{ old('pic_title2', $settings->pic_title2 ?? '') }}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="pic_details2" class="form-label">Pic Details2</label>
										<textarea class="form-control" id="pic_details2" name="pic_details2" style="height: 100px !important;">{{ old('pic_details2', $settings->pic_details2 ?? '') }} </textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="pic2" class="form-label">Pic2 (1000 X 1500 px)</label>
										<input type="file" class="form-control" id="pic2" name="pic2" value="">
										<input type="hidden" class="form-control" name="pic2_2" value="{{ $settings->pic2 ?? '' }}">
									</div>
								</div>
								<!-- pic3 -->
								<div class="col-md-12">
									<div class="mb-3">
										<label for="pic_title3" class="form-label">Pic Title3</label>
										<input type="text" class="form-control" id="pic_title3" name="pic_title3"
											value="{{ old('pic_title3', $settings->pic_title3 ?? '') }}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="pic_details3" class="form-label">Pic Details3</label>
										<textarea class="form-control" id="pic_details3" name="pic_details3" style="height: 100px !important;">{{ old('pic_details3', $settings->pic_details3 ?? '') }} </textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="pic3" class="form-label">Pic3 (1000 X 1500 px)</label>
										<input type="file" class="form-control" id="pic3" name="pic3" value="">
										<input type="hidden" class="form-control" name="pic3_2" value="{{ $settings->pic3 ?? '' }}">
									</div>
								</div>
								<!-- pic4 -->
								<div class="col-md-12">
									<div class="mb-3">
										<label for="pic_title4" class="form-label">Pic Title4</label>
										<input type="text" class="form-control" id="pic_title4" name="pic_title4"
											value="{{ old('pic_title4', $settings->pic_title4 ?? '') }}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="pic_details4" class="form-label">Pic Details4</label>
										<textarea class="form-control" id="pic_details4" name="pic_details4" style="height: 100px !important;">{{ old('pic_details4', $settings->pic_details4 ?? '') }} </textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="pic4" class="form-label">Pic4 (1000 X 1500 px)</label>
										<input type="file" class="form-control" id="pic4" name="pic4" value="">
										<input type="hidden" class="form-control" name="pic4_2" value="{{ $settings->pic4 ?? '' }}">
									</div>
								</div>
								
								<div class="col-md-12">
									<button type="submit" class="btn app-btn-primary">Save Changes</button>
								</div>
							</div>
						</form>
					</div><!--//app-card-body-->
				</div><!--//app-card-->
			</div>
		</div><!--//row-->
		<hr class="my-4">
		<div class="row g-4 settings-section">
			<div class="col-12 col-md-2">
				<h3 class="section-title">Contact Page Image</h3>
				<div class="">
					<div class="img-box">
						<span class="cancel-icon"
							onclick="cancel_image_('tbl_home_content','contact_page_image','id', <?=$settings->id?>)"><i
								class="fa-solid fa-xmark" title="Cancel"></i>
						</span>
						<img src="{{ url(IMAGE_PATH.$settings->contact_page_image) }}" class="" alt="...">
						<small class="image-title">Image</small>
					</div>
				</div>
				
			</div>
			<div class="col-12 col-md-10">
				<div class="app-card app-card-settings shadow-sm p-4">
					<div class="app-card-body">
						<form class="settings-form" autocomplete="off" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="submit" value="contact-page">
							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label for="contact_page_image" class="form-label">Image (1000 X 1500 px)</label>
										<input type="file" class="form-control" id="contact_page_image" name="contact_page_image" value="">
										<input type="hidden" class="form-control" name="contact_page_image2" value="{{ $settings->contact_page_image ?? '' }}">
									</div>
								</div>
								
								<div class="col-md-12">
									<button type="submit" class="btn app-btn-primary">Save Changes</button>
								</div>
							</div>
						</form>
					</div><!--//app-card-body-->
				</div><!--//app-card-->
			</div>
		</div><!--//row-->
		<hr class="my-4">
	</div><!--//container-fluid-->
</div><!--//app-content-->
<script>
	tinymce.init({
		selector: '#opening_hours, #about_details, #sec5_description, #sec5_content_details1, #sec5_content_details2, #sec5_content_details3',
		plugins: 'advlist autolink lists link image charmap preview anchor ' +
               'searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
		toolbar: 'undo redo | formatselect | ' +
				'bold italic underline strikethrough | ' +
				'alignleft aligncenter alignright alignjustify | ' +
				'bullist numlist outdent indent | code removeformat | link image | ' +
				'forecolor backcolor | help',
		branding: false,
		block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Preformatted=pre'
	});
</script>
@endsection