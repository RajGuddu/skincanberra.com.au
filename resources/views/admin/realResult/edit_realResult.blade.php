@extends('admin._layout.master')
@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-fluid">
		<div class="d-flex align-items-center justify-content-between">
			<h1 class="app-page-title">Edit Image for Real Result</h1>
			<div class="">
				<a class="btn app-btn-secondary" href="{{ url('admin/realResult') }}"> Back </a>
			</div>
		</div>
		<hr class="mb-4">
		<div class="row g-4">
			<div class="col-12 col-md-7">
				<div class="app-card app-card-settings shadow-sm p-4">

					<div class="app-card-body">
						<form class="" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="main-sec">
								<div class="single-sec">
									<div class="mb-3">
										<label for="image" class="form-label">Image(1000 X 1500 px)</label>
										<input type="file" class="form-control" id="image" name="image">
										<input type="hidden" class="form-control" id="image2" name="image2" value="{{ old('alt', $record->image ?? '') }}">
										@error('image') <span class="text-danger"> {{ $message }} </span> @enderror
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="mb-3">
												<label for="alt" class="form-label">Alt Text</label>
												<input type="text" class="form-control" id="alt" name="alt" value="{{ old('alt', $record->alt ?? '') }}">
											</div>
										</div>
										<div class="col-md-6">
											<div class="mb-3">
												<label for="title" class="form-label">Title Text</label>
												<input type="text" class="form-control" id="title" name="title" value="{{ old('title', $record->title ?? '') }}">
											</div>
										</div>
									</div>
									
								</div>
							</div>
							
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
							<a href="{{ url('admin/realResult') }}" class="btn app-btn-secondary">Cancel</a>
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
							@if(isset($record) && $record->image != '')
							@php $isImage = 1; @endphp
							<div class="img-box">
								<span class="cancel-icon"
									onclick="cancel_image_('tbl_realresult','image','id', <?=$record->id?>)"><i
										class="fa-solid fa-xmark" title="Cancel"></i>
								</span>
								<img src="{{ url(IMAGE_PATH.$record->image) }}" class="" alt="...">
								<small class="image-title">Banner Image</small>
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
	var secno = 2;
	function add_section(){
		var sectionHtml = '<div class="single-sec">'+
			'<div class="mb-3">'+
				'<label for="images'+secno+'" class="form-label">Image</label>'+
				'<input type="file" class="form-control" id="images'+secno+'" name="images[]">'+
			'</div>'+
			'<div class="row">'+
				'<div class="col-md-6">'+
					'<div class="mb-3">'+
						'<label for="alt'+secno+'" class="form-label">Alt Text</label>'+
						'<input type="text" class="form-control" id="alt'+secno+'" name="alt[]" value="">'+
					'</div>'+
				'</div>'+
				'<div class="col-md-6">'+
					'<div class="mb-3">'+
						'<label for="title'+secno+'" class="form-label">Title Text</label>'+
						'<input type="text" class="form-control" id="title'+secno+'" name="title[]" value="">'+
					'</div>'+
				'</div>'+
			'</div>'+
			'<div class="d-flex justify-content-end mb-3 ">'+
				'<button type="button" class="btn app-btn-primary text-light me-2" onclick="add_section()">Add</button>'+
				'<button type="button" class="btn btn-danger text-light removesection" >Remove</button>'+
			'</div>'+
		'</div>';
		$(".main-sec").append(sectionHtml);
		secno++;
	}
	$(".main-sec").on("click", ".removesection", function() {
		var isConfirmed = confirm("Are you sure?");
		if (isConfirmed) {
			$(this).closest(".single-sec").remove();
		}
	});
</script>
<?php /* <script>
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
</script> */?>


@endsection