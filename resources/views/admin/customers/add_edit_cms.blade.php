@extends('admin._layout.master')
@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-fluid">
		<div class="d-flex align-items-center justify-content-between">
			<h1 class="app-page-title">{{(isset($record))?'Edit':'Add'}} CMS</h1>
			<div class="">
				<a class="btn app-btn-secondary" href="{{ url('admin/cms') }}"> Back </a>
			</div>
		</div>
		<hr class="mb-4">
		<div class="row g-4">
			<div class="col-12 col-md-7">
				<div class="app-card app-card-settings shadow-sm p-4">

					<div class="app-card-body">
						<form class="" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="mb-3">
								<label for="name" class="form-label">Select Page</label>
								<select name="page" id="page" class="form-control">
                                    <option value="">Select Page</option>
                                    <option value="privacy-policy" {{ (isset($record) && $record->page == 'privacy-policy') || (old('page') == 'privacy-policy')?'selected':'' }}>Privacy Policy</option>
                                    <option value="terms-condition" {{ (isset($record) && $record->page == 'terms-condition') || (old('page') == 'terms-condition')?'selected':'' }}>Terms & Condition</option>
                                </select>
								@error('page') <span class="text-danger"> {{ $message }} </span> @enderror
							</div>
							<div class="mb-3">
								<label for="banner_title" class="form-label">Banner Title</label>
								<input type="text" class="form-control" id="banner_title" name="banner_title"
									value="{{ old('banner_title', $record->banner_title ?? '') }}">
								@error('banner_title') <span class="text-danger"> {{ $message }} </span> @enderror
							</div>
							<div class="mb-3">
								<label for="description" class="form-label">Description</label>
								<textarea class="form-control" id="description" name="description" rows="4" cols="30"
									style="height: auto;">{{ old('description', $record->description ?? '') }}</textarea>
							</div>
							<div class="mb-3">
								<label for="cms_banner" class="form-label">Banner Image (1513 X 400 px)</label>
								<input type="file" class="form-control" id="cms_banner" name="cms_banner">
								<input type="hidden" name="cms_banner2" value="{{ $record->cms_banner ?? '' }}">
							</div>
							<?php /* <div class="mb-3">
								<label for="serv_url" class="form-label">Url</label>
								<input type="text" class="form-control" id="serv_url" name="serv_url"
									value="{{ old('serv_url', $record->serv_url ?? '') }}">
								@error('serv_url') <span class="text-danger"> {{ $message }} </span> @enderror
							</div>
							<div class="mb-3">
								<label for="serv_title" class="form-label">Small Title(for above line of record
									name)</label>
								<input type="text" class="form-control" id="serv_title" name="serv_title"
									value="{{ old('serv_title', $record->serv_title ?? '') }}">
							</div> 
							
							<hr>
							<p class="text-danger text-center"><strong>Or</strong></p>
							<div class="mb-3">
								<label for="thumb_image" class="form-label">Thumbnail Image</label>
								<input type="file" class="form-control" id="thumb_image" name="thumb_image">
								<input type="hidden" name="thumb_image2" value="{{ $record->thumb_image ?? '' }}">
								@error('thumb_image') <span class="text-danger"> {{ $message }} </span> @enderror
							</div>
							<div class="mb-3">
								<label for="video" class="form-label">Video (only Youtube video ID)</label>
								<input type="text" class="form-control" id="video" name="video" value="{{ old('video', $record->video ?? '') }}">
								<!-- <input type="hidden" name="video2" value="{{ $record->video ?? '' }}"> -->
								@error('video') <span class="text-danger"> {{ $message }} </span> @enderror
							</div>*/ ?>
							<div class="mb-3">
								<label for="status" class="form-label">Status</label>
								<div class="form-check form-switch mb-3">
									<input class="form-check-input" type="radio" id="status" name="status" value="1" checked>
									<label class="form-check-label" for="status">Active</label>
								</div>
								<div class="form-check form-switch mb-3">
									@php
										$status = old('status', ($record->status ?? 0));
									@endphp
									<input class="form-check-input" type="radio" id="status2" name="status" value="0" {{ $status == 0 ? 'checked' : '' }} >
									<label class="form-check-label" for="status2">Inactive</label>
								</div>
							</div>
							<button type="submit" class="btn app-btn-primary">Save Changes</button>
							<a href="{{ url('admin/cms') }}" class="btn app-btn-secondary">Cancel</a>
						</form>
					</div><!--//app-card-body-->

				</div><!--//app-card-->
			</div>
			<div class="col-12 col-md-5">
				<h3 class="section-title">Uploaded Images</h3>
				<div class="card ">
					<div class="card-body">
						<div class="d-flex align-content-start flex-wrap my-2">
							@php $isImage = 0; @endphp
							@if(isset($record) && $record->cms_banner != '')
							@php $isImage = 1; @endphp
							<div class="img-box">
								<span class="cancel-icon"
									onclick="cancel_image_('tbl_cms','cms_banner','id', <?=$record->id?>)"><i
										class="fa-solid fa-xmark" title="Cancel"></i>
								</span>
								<img src="{{ url(IMAGE_PATH.$record->cms_banner) }}" class="" alt="...">
								<small class="image-title">CMS Banner</small>
							</div>
							@endif
							<?php /* @if(isset($record) && $record->thumb_image != '')
							@php $isImage = 1; @endphp
							<div class="img-box">
								<span class="cancel-icon"
									onclick="cancel_image_('tbl_testimonial','thumb_image','id', <?=$record->id?>)"><i
										class="fa-solid fa-xmark" title="Cancel"></i>
								</span>
								<img src="{{ url(IMAGE_PATH.$record->thumb_image) }}" class="" alt="...">
								<small class="image-title">Thumbnail</small>
							</div>
							@endif
							@if(isset($record) && $record->video != '')
							@php $isImage = 1; @endphp
							<div class="img-box">
								<span class="cancel-icon"
									onclick="cancel_image_('tbl_testimonial','video','id', <?=$record->id?>)"><i
										class="fa-solid fa-xmark" title="Cancel"></i>
								</span>
								<!-- <img src="{{ url(IMAGE_PATH.$record->video) }}" class="" alt="..."> -->
								<iframe width="140" height="140" src="{{ 'https://www.youtube.com/embed/'.$record->video }}" frameborder="0" allow="accelerometer; autoplay;"></iframe>

								<small class="image-title">Youtube Video</small>
							</div>
							@endif */ ?>
							
							@if(!$isImage)
							<div class="text-center text-danger">No any image upload!</div>
							@endif
						</div>
					</div>
				</div>
			</div>

		</div><!--//row-->

		<!-- <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
			<a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab"
				href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
			<a class="flex-sm-fill text-sm-center nav-link" id="orders-paid-tab" data-bs-toggle="tab"
				href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">Paid</a>
			<a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab"
				href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Pending</a>
			<a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab"
				href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">Cancelled</a>
		</nav> -->

	</div><!--//container-fluid-->
</div><!--//app-content-->
<script>
	tinymce.init({
		selector: '#description',
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
	document.addEventListener('DOMContentLoaded', function () {
		const serviceInput = document.getElementById('service_name');
		const urlInput = document.getElementById('serv_url');

		if (serviceInput && urlInput) {
			serviceInput.addEventListener('keyup', function () {
				let urlval = serviceInput.value;
				let newurl = urlval
					.replace(/[_\s]+/g, '-')
					.replace(/[^a-zA-Z-]/g, '')
					.toLowerCase();

				urlInput.value = newurl;
			});
		}
	});
</script>


@endsection