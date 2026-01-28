@extends('admin._layout.master')
@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-xl">
		<h1 class="app-page-title">About Page Content</h1>
		<?php if(Session::has('message')){ 
			echo alertBS(session('message')['msg'], session('message')['type']);
		} ?>
		<hr class="mb-4">
		<div class="row g-4 settings-section">
			
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
			<div class="col-12 col-md-2">
				<h3 class="section-title">Section 1</h3>

				<div class="">
					<div class="img-box">
						<span class="cancel-icon"
							onclick="cancel_image_('tbl_about_content','about_image','id', <?=$settings->id?>)"><i
								class="fa-solid fa-xmark" title="Cancel"></i>
						</span>
						<img src="{{ url(IMAGE_PATH.$settings->about_image) }}" class="" alt="...">
						<small class="image-title">About Image</small>
					</div>
				</div>
			</div>
		</div><!--//row-->
		<hr class="my-4">
		<div class="row g-4 settings-section">
			
			<div class="col-12 col-md-10">
				<div class="app-card app-card-settings shadow-sm p-4">

					<div class="app-card-body">
						<form class="settings-form" autocomplete="off" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="submit" value="sec-2">

							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec2_title" class="form-label">Title</label>
										<input type="text" class="form-control" id="sec2_title" name="sec2_title"
											value="{{ old('sec2_title', $settings->sec2_title ?? '') }}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec2_description" class="form-label">Description</label>
										<textarea  class="form-control" id="sec2_description" name="sec2_description" rows="4" cols="30">{{ old('sec2_description', $settings->sec2_description ?? '') }}</textarea>
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
			<div class="col-12 col-md-2">
				<h3 class="section-title">Section 2</h3>
				<?php /* <div class="">
					<div class="img-box">
						<span class="cancel-icon"
							onclick="cancel_image_('tbl_home_content','sec5_content_image1','id', <?=$settings->id?>)"><i
								class="fa-solid fa-xmark" title="Cancel"></i>
						</span>
						<img src="{{ url(IMAGE_PATH.$settings->sec5_content_image1) }}" class="" alt="...">
						<small class="image-title">Content Image1</small>
					</div>
					
				</div> */ ?>
			</div>
		</div><!--//row-->
		<hr class="my-4">
		<div class="row g-4 settings-section">
			
			<div class="col-12 col-md-10">
				<div class="app-card app-card-settings shadow-sm p-4">
					<div class="app-card-body">
						<form class="settings-form" autocomplete="off" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="submit" value="sec-3">
							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec3_title1" class="form-label">Title 1</label>
										<input type="text" class="form-control" id="sec3_title1" name="sec3_title1"
											value="{{ old('sec3_title1', $settings->sec3_title1 ?? '') }}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec3_details1" class="form-label">Description 1</label>
										<textarea  class="form-control" id="sec3_details1" name="sec3_details1" style="height: 150px !important;">{{ old('sec3_details1', $settings->sec3_details1 ?? '') }}</textarea>
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec3_image1" class="form-label">Image 1 (1000 X 705 px)</label>
										<input type="file" class="form-control" id="sec3_image1" name="sec3_image1" value="">
										<input type="hidden" class="form-control" name="sec3_image1_2" value="{{ $settings->sec3_image1 ?? '' }}">
									</div>
								</div>
								<!-- pic2 -->
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec3_title2" class="form-label">Title 2</label>
										<input type="text" class="form-control" id="sec3_title2" name="sec3_title2"
											value="{{ old('sec3_title2', $settings->sec3_title2 ?? '') }}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec3_details2" class="form-label">Description 2</label>
										<textarea class="form-control" id="sec3_details2" name="sec3_details2" style="height: 150px !important;">{{ old('sec3_details2', $settings->sec3_details2 ?? '') }} </textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="sec3_image2" class="form-label">Image 2 (1000 X 705 px)</label>
										<input type="file" class="form-control" id="sec3_image2" name="sec3_image2" value="">
										<input type="hidden" class="form-control" name="sec3_image2_2" value="{{ $settings->sec3_image2 ?? '' }}">
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
			<div class="col-12 col-md-2">
				<h3 class="section-title">Section 3</h3>
				<div class="">
					<div class="img-box">
						<span class="cancel-icon"
							onclick="cancel_image_('tbl_home_content','sec3_image1','id', <?=$settings->id?>)"><i
								class="fa-solid fa-xmark" title="Cancel"></i>
						</span>
						<img src="{{ url(IMAGE_PATH.$settings->sec3_image1) }}" class="" alt="...">
						<small class="image-title">Image1</small>
					</div>
					<div class="img-box">
						<span class="cancel-icon"
							onclick="cancel_image_('tbl_home_content','sec3_image2','id', <?=$settings->id?>)"><i
								class="fa-solid fa-xmark" title="Cancel"></i>
						</span>
						<img src="{{ url(IMAGE_PATH.$settings->sec3_image2) }}" class="" alt="...">
						<small class="image-title">Image2</small>
					</div>
					
				</div>

			</div>
		</div><!--//row-->
		
	</div><!--//container-fluid-->
</div><!--//app-content-->
<script>
	tinymce.init({
		selector: '#about_details, #sec2_description',
		height: 300,
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