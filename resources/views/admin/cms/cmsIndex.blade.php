@extends('admin._layout.master')
@section('content')
@php
	use App\Models\ServiceVariantsModel;
@endphp
<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-fluid">

		<div class="row g-3 mb-4 align-items-center justify-content-between">
			<div class="col-auto">
				<h1 class="app-page-title mb-0">CMS</h1>
			</div>
			<div class="col-auto">
				<div class="page-utilities">
					<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
						<div class="col-auto">
							<form action="{{ url()->current() }}" method="post" class="table-search-form row gx-1 align-items-center" >
								@csrf
								<div class="col-auto">
									<input type="text" id="search-orders" name="search" value="{{ $_POST['search'] ?? '' }}"
										class="form-control search-orders" placeholder="Search">
								</div>
								<div class="col-auto">
									<button type="submit" class="btn app-btn-secondary">Search</button>
								</div>
							</form>

						</div><!--//col-->
						<div class="col-auto">
							<a class="btn app-btn-secondary" href="{{ url('admin/cms') }}"> Refresh </a>
						</div>
						<div class="col-auto">
							<a class="btn app-btn-secondary" href="{{ url('admin/add_edit_cms') }}"> Add </a>
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
								<th class="cell">Page</th>
								<th class="cell">Banner Title</th>
								<th class="cell">Description</th>
								<th class="cell">CMS Banner</th>
								<!-- <th class="cell">Date</th> -->
								<th class="cell">Status</th>
								<th class="cell">Action</th>
							</tr>
						</thead>
						<tbody>
							@if(!empty($cms))
							@php $n = 1; @endphp
							@foreach($cms as $list)
							@php if($list->status == 1){
								$status = '<span class="badge bg-success">Active</span>';
							}else{
								$status = '<span class="badge bg-danger">Inactive</span>';
							} 
							$img = ''; 
							if($list->cms_banner != '')
								$img = $list->cms_banner;
							@endphp
							<tr>
								<td class="cell">{{ $n++ }}</td>
								<td class="cell">{{ $list->page }}</td>
								<td class="cell">{{ $list->banner_title }}</td>
								<td class="cell">{{ substr(strip_tags($list->description),0,50).'...' }}</td>
								<td class="cell">
									@if($img != '')
									<img src="{{ url(IMAGE_PATH.$img) }}" alt="cms-banner" width="100px" height="60px">
									@else
										{{ '--' }}
									@endif
								</td>
								<td class="cell">{!! $status !!}</td>
								<td class="cell">
									<!-- <a class="btn-sm app-btn-secondary" href="#">View</a> -->
									<a class="btn-sm app-btn-secondary" href="{{ url('admin/add_edit_cms/'.$list->id) }}">Edit</a>
									<a class="btn-sm app-btn-secondary" onclick="return confirm('Are u sure?')" href="{{ url('admin/delete_cms/'.$list->id) }}">Delete</a>
									<?php /* <a class="btn-sm app-btn-secondary" href="{{ url('admin/variants/'.$list->id) }}">Variants</a> */ ?>
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

	</div><!--//container-fluid-->
</div><!--//app-content-->
@endsection