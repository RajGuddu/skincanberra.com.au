@extends('_layouts.master')
@section('content')

<div class="w-100">
  <div class="row g-0">

    <!-- Sidebar -->
    
    @include('member.sidebar')

    <!-- Main Content -->
    <div class="col-md-9 col-lg-10" style="background-color:#f7f4ef;">
      <div class="p-4">
        <h4 class="fw-semibold mb-4" style="color:#B4903A;">Dashboard Overview</h4>

        <div class="row g-4">
          <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm text-center py-3">
              <div class="card-body">
                <h6 class="text-muted mb-2">Placed Orders</h6>
                <h4 class="fw-bold" style="color:#B4903A;">{{ $ODplaced }}</h4>
              </div>
            </div>
          </div>

          <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm text-center py-3">
              <div class="card-body">
                <h6 class="text-muted mb-2">Shipped Orders</h6>
                <h4 class="fw-bold" style="color:#B4903A;">{{ $ODshipped }}</h4>
              </div>
            </div>
          </div>

          <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm text-center py-3">
              <div class="card-body">
                <h6 class="text-muted mb-2">Delivered Orders</h6>
                <h4 class="fw-bold" style="color:#B4903A;">{{ $ODdlvd }} </h4>
              </div>
            </div>
          </div>

          <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm text-center py-3">
              <div class="card-body">
                <h6 class="text-muted mb-2">Cancelled Orders</h6>
                <h4 class="fw-bold" style="color:#B4903A;">{{ $ODcanceled }}</h4>
              </div>
            </div>
          </div>

          <div class="col-6 col-lg-3">
            <div class="card border-0 shadow-sm text-center py-3">
              <div class="card-body">
                <h6 class="text-muted mb-2">Purchased Course</h6>
                <h4 class="fw-bold" style="color:#B4903A;">{{ $PCourses }}</h4>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>
</div>

@endsection
