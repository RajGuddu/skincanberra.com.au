@extends('admin._layout.master')
@section('content')
@php
	use App\Models\ServiceVariantsModel;
@endphp
<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-fluid">

		<div class="row g-3 mb-4 align-items-center justify-content-between">
			<div class="col-auto">
				<h1 class="app-page-title mb-0">{{ isset($record)?'Update':'Add' }} Product {!! isset($record)?' - <span style="color:blue">'.$record->pro_name.'</span>':'' !!}</h1>
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
							<a class="btn app-btn-secondary" href="{{ url('admin/products') }}"> Refresh </a>
						</div> */ ?>
						<div class="col-auto">
							<a class="btn app-btn-secondary" href="{{ url('admin/products') }}"> Back </a>
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
		<div class="row g-4">
			<div class="col-12 col-md-8">
				@php 
					$active = ['active','','','']; $show = ['show','','','']; 
					if((isset($record) && $record->activeTab == 2) || (old('tab') == 'tab2')){
						$active = ['','active','','']; $show = ['','show','','']; 
					}
					if((isset($record) && $record->activeTab == 3) || (old('tab') == 'tab3')){
						$active = ['','','active','']; $show = ['','','show','']; 
					}
					if((isset($record) && $record->activeTab == 4) || (old('tab') == 'tab4')){
						$active = ['','','','active']; $show = ['','','','show']; 
					}
				@endphp
				<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
					<a class="flex-sm-fill text-sm-center nav-link {{ $active[0] }}" id="orders-all-tab" data-bs-toggle="tab"
						href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">Basic</a>
					<a class="flex-sm-fill text-sm-center nav-link {{ $active[1] }}" id="orders-paid-tab" data-bs-toggle="tab"
						href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">Details</a>
					<a class="flex-sm-fill text-sm-center nav-link {{ $active[2] }}" id="orders-pending-tab" data-bs-toggle="tab"
						href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Attributes</a>
					<a class="flex-sm-fill text-sm-center nav-link {{ $active[3] }}" id="orders-cancelled-tab" data-bs-toggle="tab"
						href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">Status</a>
				</nav>

				<div class="tab-content" id="orders-table-tab-content">
					<div class="tab-pane fade {{ $active[0].' '.$show[0] }}" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
						@include('admin.product.tab1')
					</div><!--tab-pane--> 
					<div class="tab-pane fade {{ $active[1].' '.$show[1] }}" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
						@include('admin.product.tab2')
					</div><!--tab-pane--> 
					<div class="tab-pane fade {{ $active[2].' '.$show[2] }}" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
						@include('admin.product.tab3')
					</div><!--tab-pane--> 
					<div class="tab-pane fade {{ $active[3].' '.$show[3] }}" id="orders-cancelled" role="tabpanel" aria-labelledby="orders-cancelled-tab">
						@include('admin.product.tab4')
					</div><!--tab-pane--> 
				</div>
			</div>
			<div class="col-12 col-md-4">
				<h5 class="section-title">Uploaded Images</h5>
				<div class="card ">
					<div class="card-body">
						<div class="d-flex align-content-start flex-wrap my-2">
							@php $isImage = 0; @endphp
							@if(isset($record) && $record->image1 != '')
							@php $isImage = 1; @endphp
							<div class="img-box">
								<span class="cancel-icon"
									onclick="cancel_image_('tbl_product','image1','pro_id', <?=$record->pro_id?>)"><i
										class="fa-solid fa-xmark" title="Cancel"></i>
								</span>
								<img src="{{ url(IMAGE_PATH.$record->image1) }}" class="" alt="...">
								<small class="image-title">Image 1</small>
							</div>
							@endif
							@if(isset($record) && $record->image2 != '')
							@php $isImage = 1; @endphp
							<div class="img-box">
								<span class="cancel-icon"
									onclick="cancel_image_('tbl_product','image2','pro_id', <?=$record->pro_id?>)"><i
										class="fa-solid fa-xmark" title="Cancel"></i>
								</span>
								<img src="{{ url(IMAGE_PATH.$record->image2) }}" class="" alt="...">
								<small class="image-title">Image 2</small>
							</div>
							@endif
							@if(isset($record) && $record->image3 != '')
							@php $isImage = 1; @endphp
							<div class="img-box">
								<span class="cancel-icon"
									onclick="cancel_image_('tbl_product','image3','pro_id', <?=$record->pro_id?>)"><i
										class="fa-solid fa-xmark" title="Cancel"></i>
								</span>
								<img src="{{ url(IMAGE_PATH.$record->image3) }}" class="" alt="...">
								<small class="image-title">Image 3</small>
							</div>
							@endif
							@if(isset($record) && $record->image4 != '')
							@php $isImage = 1; @endphp
							<div class="img-box">
								<span class="cancel-icon"
									onclick="cancel_image_('tbl_product','image4','pro_id', <?=$record->pro_id?>)"><i
										class="fa-solid fa-xmark" title="Cancel"></i>
								</span>
								<img src="{{ url(IMAGE_PATH.$record->image4) }}" class="" alt="...">
								<small class="image-title">Image 4</small>
							</div>
							@endif
							@if(!$isImage)
							<div class="text-center text-danger">No any image upload!</div>
							@endif
						</div>
					</div>
				</div>
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