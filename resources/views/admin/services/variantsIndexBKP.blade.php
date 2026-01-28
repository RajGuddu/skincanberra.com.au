@extends('admin._layout.master')
@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-fluid">

		<div class="row g-3 mb-4 align-items-center justify-content-between">
			<div class="col-auto">
				<h1 class="app-page-title mb-0">Variants <span class="text-danger">({{ ucwords($service->service_name)}})</span></h1>
			</div>
			<div class="col-auto">
				<div class="page-utilities">
					<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
						<div class="col-auto">
							<form class="table-search-form row gx-1 align-items-center">
								<div class="col-auto">
									<input type="text" id="search-orders" name="searchorders"
										class="form-control search-orders" placeholder="Search">
								</div>
								<div class="col-auto">
									<button type="submit" class="btn app-btn-secondary">Search</button>
								</div>
							</form>

						</div><!--//col-->
						<div class="col-auto">
							<a class="btn app-btn-secondary" href="{{ url('admin/services') }}"> Back </a>
							<!-- <select class="form-select w-auto">
								<option selected value="option-1">All</option>
								<option value="option-2">This week</option>
								<option value="option-3">This month</option>
								<option value="option-4">Last 3 months</option>

							</select> -->
						</div>
						<?php /* <div class="col-auto">
							<a class="btn app-btn-secondary" href="#">
								<!-- <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1"
									fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd"
										d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
									<path fill-rule="evenodd"
										d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
								</svg> -->
								Back
							</a>
						</div> */ ?>
					</div><!--//row-->
				</div><!--//table-utilities-->
			</div><!--//col-auto-->
		</div><!--//row-->
		<?php if(Session::has('message')){ 
			echo alertBS(session('message')['msg'], session('message')['type']);
		} ?>

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


		<div class="app-card app-card-orders-table shadow-sm mb-5">
			<div class="app-card-body">
				<div class="table-responsive">
					<table class="table app-table-hover mb-0 text-left">
						<thead>
							<tr>
								<th class="cell">#</th>
								<th class="cell">Photo</th>
								<th class="cell">Variants Name</th>
								<!-- <th class="cell">MRP</th> -->
								<th class="cell">SP($)</th>
								<th class="cell">Status</th>
								<!-- <th class="cell">Total Variants</th> -->
								<th class="cell">Action</th>
							</tr>
						</thead>
						<tbody>
							@if(!$variants->isEmpty())
							@php $n = 1; @endphp
							@foreach($variants as $list)
							@php if($list->status){
								$status = '<span class="badge bg-success">Active</span>';
							}else{
								$status = '<span class="badge bg-danger">Inactive</span>';
							} @endphp
							<tr>
								<td class="cell">{{ $n++ }}</td>
								<td class="cell"><img src="{{ url('public/assets/uploads/images/'.$list->photo) }}" alt="service-image" width="70px" height="60px"></td>
								<td class="cell">{{ $list->v_name }}</td>
								<!-- <td class="cell">{{ $list->mrp }}</td> -->
								<td class="cell">{{ '$'.$list->sp }}</td>
								<td class="cell">{!! $status !!}</td>
								<!-- <td class="cell"></td> -->
								<td class="cell">
									<!-- <a class="btn-sm app-btn-secondary" href="#">View</a> -->
									<a class="btn-sm app-btn-secondary" href="{{ url('admin/variants/'.$list->sv_id.'/'.$list->vid) }}">Edit</a>
									<a class="btn-sm app-btn-secondary" onclick="return confirm('Are u sure?')" href="{{ url('admin/delete_variants/'.$list->sv_id.'/'.$list->vid) }}">Delete</a>
									<!-- <a class="btn-sm app-btn-secondary" href="{{ url('admin/variants/'.$list->sv_id) }}">Variants</a> -->
								</td>
							</tr>
							@endforeach
							
							@else
							<tr><td colspan="6" class="text-danger text-center">No Record Available!</td></tr>
							@endif
							<!-- <tr>
								<td class="cell">#15346</td>
								<td class="cell"><span class="truncate">Lorem ipsum dolor sit amet eget
										volutpat erat</span></td>
								<td class="cell">John Sanders</td>
								<td class="cell"><span>17 Oct</span><span class="note">2:16 PM</span>
								</td>
								<td class="cell"><span class="badge bg-success">Paid</span></td>
								<td class="cell">$259.35</td>
								<td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a>
								</td>
							</tr> -->

						</tbody>
					</table>
				</div><!--//table-responsive-->

			</div><!--//app-card-body-->
		</div><!--//app-card-->
		<?php /* <nav class="app-pagination">
			<ul class="pagination justify-content-center">
				<li class="page-item disabled">
					<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
				</li>
				<li class="page-item active"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item">
					<a class="page-link" href="#">Next</a>
				</li>
			</ul>
		</nav><!--//app-pagination--> */ ?>

		<div class="row g-4">
			<div class="col-12 col-md-7">
				<div class="app-card app-card-settings shadow-sm p-4">

					<div class="app-card-body">
						<form class="" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="mb-3">
								<label for="v_name" class="form-label">Variants Name</label>
								<input type="text" class="form-control" id="v_name" name="v_name"
									value="{{ old('v_name', $variant->v_name ?? '') }}">
								@error('v_name') <span class="text-danger"> {{ $message }} </span> @enderror
							</div>
							<div class="mb-3">
								<label for="v_url" class="form-label">Url</label>
								<input type="text" class="form-control" id="v_url" name="v_url"
									value="{{ old('v_url', $variant->v_url ?? '') }}">
								@error('v_url') <span class="text-danger"> {{ $message }} </span> @enderror
							</div>
							<div class="mb-3">
								<label for="photo" class="form-label">Photo (629 X 616 px)</label>
								<input type="file" class="form-control" id="photo" name="photo">
								<input type="hidden" name="photo2" value="{{ $variant->photo ?? '' }}">
							</div>
							<?php /* <div class="mb-3">
								<label for="mrp" class="form-label">MRP</label>
								<input type="text" class="form-control" id="mrp" name="mrp"
									value="{{ old('mrp', $variant->mrp ?? '') }}">
								@error('mrp') <span class="text-danger"> {{ $message }} </span> @enderror
							</div> */ ?>
							<div class="mb-3">
								<label for="sp" class="form-label">SP($)</label>
								<input type="text" class="form-control" id="sp" name="sp"
									value="{{ old('sp', $variant->sp ?? '') }}">
								@error('sp') <span class="text-danger"> {{ $message }} </span> @enderror
							</div>
							
							<div class="mb-3">
								<label for="details" class="form-label">Short Details</label>
								<textarea class="form-control" id="details" name="details" rows="4" cols="30"
									style="height: auto;">{{ old('details', $variant->details ?? '') }}</textarea>
							</div>
							<div class="mb-3">
								<label for="details" class="form-label">Status</label>
								<div class="form-check form-switch mb-3">
									<input class="form-check-input" type="radio" id="status" name="status" value="1" checked>
									<label class="form-check-label" for="status">Active</label>
								</div>
								<div class="form-check form-switch mb-3">
									@php
										$status = old('status', ($variant->status ?? 0));
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
			@if(isset($variant))
			<div class="col-12 col-md-5">
				<h3 class="section-title">Uploaded Images</h3>
				<div class="card ">
					<div class="card-body">
						<div class="d-flex align-content-start flex-wrap my-2">
							@php $isImage = 0; @endphp
							@if(isset($variant) && $variant->photo != '')
							@php $isImage = 1; @endphp
							<div class="img-box">
								<span class="cancel-icon"
									onclick="cancel_image_('tbl_services_variants','photo','vid', <?=$variant->vid?>)"><i
										class="fa-solid fa-xmark" title="Cancel"></i>
								</span>
								<img src="{{ url(IMAGE_PATH.$variant->photo) }}" class="" alt="...">
								<small class="image-title">Variant Image</small>
							</div>
							@endif
							<?php /* <div class="img-box">
								<span class="cancel-icon"
									onclick="cancel_image('tbl_products','thumb_image','p_id');"><i
										class="fa-solid fa-xmark" title="Cancel"></i></span>
								<img src="http://localhost/ci4/greatcars/public/assets/upload/images/thumb_imageyhrceaywhy.webp"
									class="" alt="...">
								<small class="image-title">Thumbnail Image</small>
							</div>
							<div class="img-box">
								<span class="cancel-icon"
									onclick="cancel_image('tbl_products','thumb_image','p_id');"><i
										class="fa-solid fa-xmark" title="Cancel"></i></span>
								<img src="http://localhost/ci4/greatcars/public/assets/upload/images/thumb_imageyhrceaywhy.webp"
									class="" alt="...">
								<small class="image-title">Thumbnail Image</small>
							</div> */ ?>
							@if(!$isImage)
							<div class="text-center text-danger">No any image upload!</div>
							@endif
						</div>
					</div>
				</div>
			</div>
			@endif

		</div><!--//row-->

	</div><!--//container-fluid-->
</div><!--//app-content-->

<script>
	document.addEventListener('DOMContentLoaded', function () {
		const serviceInput = document.getElementById('v_name');
		const urlInput = document.getElementById('v_url');

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