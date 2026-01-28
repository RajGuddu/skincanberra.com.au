@extends('admin._layout.master')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-fluid">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Customers</h1>
            </div>
            <?php /* <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="{{ url('admin/add_customer') }}">Add Customer</a>
                        </div>
                    </div><!--//row-->
                </div><!--//page-utilities-->
            </div><!--//col-auto--> */ ?>
        </div><!--//row-->

        {{-- Flash Message --}}
        @if(Session::has('message'))
            {!! alertBS(session('message')['msg'], session('message')['type']) !!}
        @endif

        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">#</th>
                                <th class="cell">Name</th>
                                <th class="cell">Email</th>
                                <th class="cell">Phone</th>
                                <th class="cell">Status</th>
                                <th class="cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers as $index => $customer)
                                @php 
                                    $status = $customer->status == 1 
                                        ? '<span class="badge bg-success">Active</span>' 
                                        : '<span class="badge bg-danger">Inactive</span>';
                                @endphp
                                <tr>
                                    <td class="cell">{{ $index + 1 }}</td>
                                    <td class="cell">{{ $customer->name }}</td>
                                    <td class="cell">{{ $customer->email }}</td>
                                    <td class="cell">{{ $customer->phone }}</td>
                                    <td class="cell">{!! $status !!}</td>
                                    <td class="cell">
                                        <?php /* <a class="btn-sm app-btn-secondary" href="{{ url('admin/edit_customer/'.$customer->m_id) }}">Edit</a>
                                        <a class="btn-sm app-btn-secondary" 
                                           onclick="return confirm('Are you sure you want to delete this customer?')" 
                                           href="{{ url('admin/delete_customer/'.$customer->m_id) }}">
                                           Delete
                                        </a> */ ?>
                                        <a class="btn-sm app-btn-secondary" href="{{ url('admin/customer_orders/'.$customer->m_id) }}">
                                            Orders
                                        </a>
                                        <a class="btn-sm app-btn-secondary" href="{{ url('admin/purchased_courses/'.$customer->m_id) }}">
                                            Purcahsed Courses
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-danger text-center">No Customers Found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--//table-responsive-->
            </div><!--//app-card-body-->
        </div><!--//app-card-->

    </div><!--//container-fluid-->
</div><!--//app-content-->
@endsection
