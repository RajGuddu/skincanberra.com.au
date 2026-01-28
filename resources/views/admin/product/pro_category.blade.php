@extends('admin._layout.master')
@section('content')
@php
	use App\Models\ServiceVariantsModel;
@endphp
<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-fluid">

		<div class="row g-3 mb-4 align-items-center justify-content-between">
			<div class="col-auto">
				<h1 class="app-page-title mb-0">Product Category</h1>
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
							<a class="btn app-btn-secondary" href="{{ url('admin/product_category') }}"> Refresh </a>
						</div>
						<?php /* <div class="col-auto">
							<a class="btn app-btn-secondary" href="{{ url('admin/add_edit_testimonial') }}"> Add </a>
							<!-- <select class="form-select w-auto">
								<option selected value="option-1">All</option>
								<option value="option-2">This week</option>
								<option value="option-3">This month</option>
								<option value="option-4">Last 3 months</option>

							</select> -->
						</div> */ ?>
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

        <div class="row">
            <div class="col-md-7">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">#</th>
                                        <th class="cell">Category Name</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($records->isNotEmpty())
                                    @php $n = 1; @endphp
                                    @foreach($records as $list)
                                    @php if($list->status == 1){
                                        $status = '<span class="badge bg-success">Active</span>';
                                    }else{
                                        $status = '<span class="badge bg-danger">Inactive</span>';
                                    } 
                                    @endphp
                                    <tr>
                                        <td class="cell">{{ $n++ }}</td>
                                        <td class="cell">{{ $list->category_name }}</td>
                                        
                                        <td class="cell">{!! $status !!}</td>
                                        <td class="cell">
                                            <!-- <a class="btn-sm app-btn-secondary" href="#">View</a> -->
                                            <a class="btn-sm app-btn-secondary" href="{{ url('admin/product_category/'.$list->id) }}">Edit</a>
                                            <a class="btn-sm app-btn-secondary" onclick="return confirm('Are u sure?')" href="{{ url('admin/delete_pro_category/'.$list->id) }}">Delete</a>
                                            <?php /* <a class="btn-sm app-btn-secondary" href="{{ url('admin/variants/'.$list->id) }}">Variants</a> */ ?>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                    @else
                                    <tr><td colspan="6" class="text-danger text-center">No Record Available!</td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div><!--//table-responsive-->

                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
            <div class="col-md-5">
                <h5 class="section-title">{{ isset($record)?'Edit':'Add' }} Product Category</h5>
                <div class="app-card app-card-orders-table shadow-sm p-4">
                    <div class="app-card-body">
                        <form class="" action="{{ url('admin/add_edit_pro_category') }}" method="post" enctype="multipart/form-data">
							@csrf
                            <input type="hidden" name="id" value="{{ isset($record)?$record->id:'' }}">
							<div class="mb-3">
								<label for="category_name" class="form-label">Category Name</label>
								<input type="text" class="form-control" id="category_name" name="category_name"
									value="{{ old('category_name', $record->category_name ?? '') }}">
								@error('category_name') <span class="text-danger"> {{ $message }} </span> @enderror
							</div>
                            <div class="mb-3">
								<label for="status" class="form-label">Status</label>
								<div class="form-check form-switch mb-3">
									<input class="form-check-input" type="radio" id="status" name="status" value="1" checked>
									<label class="form-check-label" for="status">Active</label>
								</div>
								<div class="form-check form-switch mb-3">
									@php
										$status = old('status', ($record->status ?? ''));
									@endphp
									<input class="form-check-input" type="radio" id="status2" name="status" value="0" {{ $status == 0 ? 'checked' : '' }} >
									<label class="form-check-label" for="status2">Inactive</label>
								</div>
							</div>
							<button type="submit" class="btn app-btn-primary">Save Changes</button>
							<a href="{{ url('admin/product_category') }}" class="btn app-btn-secondary">Cancel</a>

                        </form>

                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
        </div>
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