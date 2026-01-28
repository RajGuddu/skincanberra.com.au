@extends('admin._layout.master')
@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-fluid">
		<div class="d-flex align-items-center justify-content-between">
			<h1 class="app-page-title">{{ (isset($service))?'Edit':'Add' }} Service</h1>
			<div class="">
				<a class="btn app-btn-secondary" href="{{ url('admin/services') }}"> Back </a>
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
								<label for="banner_title" class="form-label">Banner Title</label>
								<input type="text" class="form-control" id="banner_title" name="banner_title"
									value="{{ old('banner_title', $service->banner_title ?? '') }}">
								@error('banner_title') <span class="text-danger"> {{ $message }} </span> @enderror
							</div>
							<div class="mb-3">
								<label for="banner_image" class="form-label">Banner Image (1513 X 400 px)</label>
								<input type="file" class="form-control" id="banner_image" name="banner_image">
								<input type="hidden" name="banner_image2" value="{{ $service->banner_image ?? '' }}">
							</div>
							<div class="mb-3">
								<label for="thumbnail_image" class="form-label">Thumbnail Image (80 X 80 px)</label>
								<input type="file" class="form-control" id="thumbnail_image" name="thumbnail_image">
								<input type="hidden" name="thumbnail_image2" value="{{ $service->thumbnail_image ?? '' }}">
							</div>
							<div class="mb-3">
								<label for="service_name" class="form-label">Service Name</label>
								<input type="text" class="form-control" id="service_name" name="service_name"
									value="{{ old('service_name', $service->service_name ?? '') }}">
								@error('service_name') <span class="text-danger"> {{ $message }} </span> @enderror
							</div>
							<div class="mb-3">
								<label for="serv_url" class="form-label">Url</label>
								<input type="text" class="form-control" id="serv_url" name="serv_url"
									value="{{ old('serv_url', $service->serv_url ?? '') }}">
								@error('serv_url') <span class="text-danger"> {{ $message }} </span> @enderror
							</div>
							<div class="mb-3">
								<label for="serv_title" class="form-label">Small Title(for above line of service
									name)</label>
								<input type="text" class="form-control" id="serv_title" name="serv_title"
									value="{{ old('serv_title', $service->serv_title ?? '') }}">
							</div>
							<div class="mb-3">
								<label for="photo" class="form-label">Photo (629 X 616 px)</label>
								<input type="file" class="form-control" id="photo" name="photo">
								<input type="hidden" name="photo2" value="{{ $service->photo ?? '' }}">
							</div>
							<div class="mb-3">
								<label for="details" class="form-label">Details</label>
								<textarea class="form-control" id="details" name="details" rows="4" cols="30"
									style="height: auto;">{{ old('details', $service->details ?? '') }}</textarea>
							</div>
							<div class="mb-3">
								<label for="show_front" class="form-label">Show on Front</label>
								<div class="form-check form-switch mb-3">
									<input class="form-check-input" type="radio" id="show_front1" name="show_front" value="1" checked>
									<label class="form-check-label" for="show_front1">Yes</label>
								</div>
								<div class="form-check form-switch mb-3">
									@php
										$show_front = old('show_front', ($service->show_front ?? 0));
									@endphp
									<input class="form-check-input" type="radio" id="show_front0" name="show_front" value="0" {{ $show_front == 0 ? 'checked' : '' }} >
									<label class="form-check-label" for="show_front0">No</label>
								</div>
							</div>
							<div class="mb-3">
								<label for="details" class="form-label">Status</label>
								<div class="form-check form-switch mb-3">
									<input class="form-check-input" type="radio" id="status" name="status" value="1" checked>
									<label class="form-check-label" for="status">Active</label>
								</div>
								<div class="form-check form-switch mb-3">
									@php
										$status = old('status', ($service->status ?? 0));
									@endphp
									<input class="form-check-input" type="radio" id="status2" name="status" value="0" {{ $status == 0 ? 'checked' : '' }} >
									<label class="form-check-label" for="status2">Inactive</label>
								</div>
							</div>
							<button type="submit" class="btn app-btn-primary">Save Changes</button>
							<a href="{{ url('admin/services') }}" class="btn app-btn-secondary">Cancel</a>
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
							@if(isset($service) && $service->photo != '')
							@php $isImage = 1; @endphp
							<div class="img-box">
								<span class="cancel-icon"
									onclick="cancel_image_('tbl_services','photo','sv_id', <?=$service->sv_id?>)"><i
										class="fa-solid fa-xmark" title="Cancel"></i>
								</span>
								<img src="{{ url(IMAGE_PATH.$service->photo) }}" class="" alt="...">
								<small class="image-title">Service Image</small>
							</div>
							@endif
							@if(isset($service) && $service->banner_image != '')
							@php $isImage = 1; @endphp
							<div class="img-box">
								<span class="cancel-icon"
									onclick="cancel_image('tbl_services','banner_image','sv_id', <?=$service->sv_id?>);"><i
										class="fa-solid fa-xmark" title="Cancel"></i></span>
								<img src="{{ url(IMAGE_PATH.$service->banner_image) }}"
									class="" alt="...">
								<small class="image-title">Banner Image</small>
							</div>
							@endif
							@if(isset($service) && $service->thumbnail_image != '')
							@php $isImage = 1; @endphp
							<div class="img-box">
								<span class="cancel-icon"
									onclick="cancel_image('tbl_services','thumbnail_image','sv_id', <?=$service->sv_id?>);"><i
										class="fa-solid fa-xmark" title="Cancel"></i></span>
								<img src="{{ url(IMAGE_PATH.$service->thumbnail_image) }}"
									class="" alt="...">
								<small class="image-title">Thumbnail Image</small>
							</div>
							@endif
							
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
		selector: '#details',
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