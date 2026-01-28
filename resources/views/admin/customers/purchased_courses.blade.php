@extends('admin._layout.master')

@section('content')
@php use App\Models\Common_model;
$commonmodel = new Common_model;
@endphp
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-fluid">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Purchased Courses</h1>
                <p class="text-muted">Course Purchased by <strong>{{ $customer->name }}</strong></p>
            </div>
            <div class="col-auto">
                <a class="btn app-btn-secondary" href="{{ url('admin/customers') }}">← Back to Customers</a>
            </div>
        </div><!--//row-->

        {{-- Flash Message --}}
        @if(Session::has('message'))
        {!! alertBS(session('message')['msg'], session('message')['type']) !!}
        @endif

        <div class="app-card shadow-sm mb-4">

            <div class="app-card-body p-3">

                <div class="table-responsive">
                    <table class="table app-table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Purchased Date</th>
                                <th>Image</th>
                                <th>Course Name</th>
                                <th>Course Price</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($Pcourses) && $Pcourses->isNotEmpty())
                            @php $sn=1; @endphp
                            @foreach($Pcourses as $list)
                            <tr>
                                <td>{{ $sn++; }}</td>
                                <td>{{ date('d M, Y',strtotime($list->purchase_date)) }}</td>
                                <td>
                                    <img src="{{ url(IMAGE_PATH.$list->c_image) }}"
                                        alt="{{ $list->course_name }}" class="img-fluid rounded"
                                        style="width:60px; height:60px;">
                                </td>
                                <td>{{ $list->course_name }}</td>
                                <td class="fw-bold">${{ $list->c_price }}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="text-danger text-center">No Course Found for this Customer!</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


    </div><!--//container-fluid-->
</div><!--//app-content-->
@endsection