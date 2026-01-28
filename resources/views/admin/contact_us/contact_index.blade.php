@extends('admin._layout.master')
@section('content')
@php
	use App\Models\Common_model;
    $commonmodel = new Common_model;
@endphp
<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-fluid">
		<div class="row g-3 mb-4 align-items-center justify-content-between">
			<div class="col-auto">
				<h1 class="app-page-title mb-0">Contact Us</h1>
			</div>
			<div class="col-auto">
				<div class="page-utilities">
					<div class="row g-2 justify-content-start justify-content-md-end align-items-center">
						<?php /* <div class="col-auto">
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
							<a class="btn app-btn-secondary" href="{{ url('admin/contact_us') }}"> Refresh </a>
						</div>
						<div class="col-auto">
							<a class="btn app-btn-secondary" href="{{ url('admin/add_service') }}"> Add </a>
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
		<div class="app-card app-card-orders-table shadow-sm mb-5">
			<div class="app-card-body">
				<div class="table-responsive">
					<table class="table app-table-hover mb-0 text-left">
						<thead>
							<tr>
								<th class="cell">#</th>
								<th class="cell"><span>Appointment Date</span><span class="note">Time</span></th>
								<th class="cell">First Name</th>
								<th class="cell">Last Name</th>
								<th class="cell">Email</th>
								<th class="cell">Phone</th>
								<th class="cell">For</th>
								<th class="cell">Submit From</th>
								<th class="cell">Status</th>
								<th class="cell">Action</th>
							</tr>
						</thead>
						<tbody>
							@if(!empty($contactList))
							@php $n = 1; @endphp
							@foreach($contactList as $list)
							@php 
							$status = '<span class="badge bg-primary">New</span>';
							if($list->status == 1){
								$status = '<span class="badge bg-success">Approve</span>';
							}elseif($list->status == 2){
								$status = '<span class="badge bg-warning">Disapprove</span>';
							}elseif($list->status == 3) {
								$status = '<span class="badge bg-danger">Cancel</span>';
							}
                            $for = '--';
                            if($list->vid != NULL){
                                $for = $commonmodel->get_variants_name($list->vid);
                            }elseif($list->sv_id != NULL){
                                $for = $commonmodel->get_service_name($list->sv_id);
                            }
                            if($list->submit_from == 'BA')
                                $sfrom = 'Book Appointment';
                            elseif($list->submit_from == 'HD')
                                $sfrom = 'Header Button';
                            else
                                $sfrom = 'Contact Us';
                            @endphp
							<tr>
								<td class="cell">{{ $n++ }}</td>
								<td class="cell"><span>{{ date('d-M Y',strtotime($list->date)) }}</span><span class="note">{{ date('h:m a',strtotime($list->time)) }}</span> </td>
								<td class="cell">{{ $list->fname }}</td>
								<td class="cell">{{ $list->lname }}</td>
								<td class="cell">{{ $list->email }}</td>
								<td class="cell">{{ $list->country.' '.$list->phone }}</td>
								<td class="cell">{{ $for }}</td>
								<td class="cell">{{ $sfrom }}</td>
								<td class="cell">{!! $status !!}</td>
								<td class="cell">
									<!-- <a class="btn-sm app-btn-secondary" href="#">View</a> -->
									<a class="btn-sm app-btn-secondary" href="javascript:void(0)" onclick="change_status(<?=$list->id.','.$list->status?>);">Change Status</a>
									<?php /* <a class="btn-sm app-btn-secondary" onclick="return confirm('Are u sure?')" href="{{ url('admin/delete_service/'.$list->sv_id) }}">Delete</a>
									<a class="btn-sm app-btn-secondary" href="{{ url('admin/variants/'.$list->sv_id) }}">Variants</a> */ ?>
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

	<!-- Modal -->
    <div class="modal fade" id="change-status-modal" tabindex="-1" data-bs-backdrop="false" style="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success text-light">
            <h5 class="modal-title">Change Status</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{ url()->current() }}" method="post">
            @csrf
          <input type="hidden" name="id" id="c_id" value="">
          <div class="modal-body">
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status0" value="0" >
                        <label class="form-check-label" for="status0">
                        New
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status1" value="1" >
                        <label class="form-check-label" for="status1">
                        Approve
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status2" value="2" >
                        <label class="form-check-label" for="status2">
                        Disapprove
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status3" value="3" >
                        <label class="form-check-label" for="status3">
                        Cancel
                        </label>
                    </div>
                    <span class="text-danger"></span>
                    
                </div>
            </fieldset>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>

<script>
	function change_status(id, status){
		$("#c_id").val(id);
		$("#status"+status).prop("checked", true);
		$("#change-status-modal").modal('show');
	}
</script>
@endsection