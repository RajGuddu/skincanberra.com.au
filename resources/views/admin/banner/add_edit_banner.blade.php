@extends('admin._layout.master')
@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-fluid">
		<div class="d-flex align-items-center justify-content-between">
			<h1 class="app-page-title">{{ (isset($solo))?'Edit':'Add' }} Banner</h1>
			<div class="">
				<a class="btn app-btn-secondary" href="{{ url('admin/banner') }}"> Back </a>
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
								<label for="page" class="form-label">Select Page</label>
								<select name="page" id="page" class="form-control">
                                    <option value="">Select Page</option>
                                    @if(!empty($pages))
                                        @foreach($pages as $list)
                                            <option value="{{ $list->id }}" {{ (isset($solo) && $solo->page == $list->id) || (old('page') == $list->id)?'selected':'' }}>{{ $list->page_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
								@error('page') <span class="text-danger"> {{ $message }} </span> @enderror
							</div>
							<div class="mb-3">
								<label for="main_title" class="form-label">Banner Title</label>
								<input type="text" class="form-control" id="main_title" name="main_title" value="{{ old('main_title', isset($solo)?$solo->main_title:'') }}">
                                @error('main_title')<span class="text-danger">{{ $message }}</span>@enderror
							</div>
							<div class="mb-3">
								<label for="sub_title" class="form-label">Sub Title</label>
								<input type="text" class="form-control" id="sub_title" name="sub_title" value="{{ old('sub_title', isset($solo)?$solo->sub_title:'') }}">
                                @error('sub_title')<span class="text-danger">{{ $message }}</span>@enderror
							</div>
							<div class="mb-3">
								<label for="image" class="form-label">Image (1513 X 400 px)</label>
								<input type="file" class="form-control" id="image" name="image">
								<input type="hidden" name="image2" value="{{ $solo->image ?? '' }}">
							</div>
							
							<div class="mb-3">
								<label for="status" class="form-label">Status</label>
								<div class="form-check form-switch mb-3">
									<input class="form-check-input" type="radio" id="status" name="status" value="1" checked>
									<label class="form-check-label" for="status">Active</label>
								</div>
								<div class="form-check form-switch mb-3">
									@php
										$status = old('status', ($solo->status ?? 0));
									@endphp
									<input class="form-check-input" type="radio" id="status2" name="status" value="0" {{ $status == 0 ? 'checked' : '' }} >
									<label class="form-check-label" for="status2">Inactive</label>
								</div>
							</div>
							<button type="submit" class="btn app-btn-primary">Save Changes</button>
							<a href="{{ url('admin/banner') }}" class="btn app-btn-secondary">Cancel</a>
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
							@if(isset($solo) && $solo->image != '')
							@php $isImage = 1; @endphp
							<div class="img-box">
								<span class="cancel-icon"
									onclick="cancel_image_('tbl_banner','image','id', <?=$solo->id?>)"><i
										class="fa-solid fa-xmark" title="Cancel"></i>
								</span>
								<img src="{{ url(IMAGE_PATH.$solo->image) }}" class="" alt="...">
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