@extends('admin._layout.master')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-fluid">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">{{ $pageTitle }}</h1>
                <p class="text-muted">View all customer orders with details</p>
            </div>
        </div><!--//row-->

        {{-- Flash Message --}}
        @if(Session::has('message'))
            {!! alertBS(session('message')['msg'], session('message')['type']) !!}
        @endif

        @if($orders->isNotEmpty())
            @foreach($orders as $order)
                @php 
                    $status = '<span class="badge bg-primary">Order Placed</span>';
                    if($order->status == 2)
                        $status = '<span class="badge bg-warning text-dark">Shipped</span>';
                    elseif($order->status == 3)
                        $status = '<span class="badge bg-success">Delivered</span>';
                    elseif($order->status == 4)
                        $status = '<span class="badge bg-danger">Cancelled</span>';
                @endphp

                <div class="app-card shadow-sm mb-4">
                    {{-- Header --}}
                    <div class="app-card-header p-3 d-flex justify-content-between align-items-center" style="background:#E8DFD0;">
                        <div>
                            <strong>Order ID:</strong> {{ $order->order_id }} <br>
                            <small class="text-muted">Order Date: {{ date('M d, Y', strtotime($order->orderdate)) }}</small>
                        </div>
                        <div class="text-end">
                            {!! $status !!}
                            <div class="fw-bold mt-1">${{ $order->net_total }}</div>
                            <!-- Change Status Button -->
                            <button type="button" 
                                    class="btn btn-sm btn-link p-0 text-primary ms-1" 
                                    onclick="changeStatus({{ $order->id }})">
                                Change Status
                            </button>
                        </div>
                    </div>

                    {{-- Customer Details --}}
                    <div class="app-card-body p-3 border-bottom" style="background:#fafafa;">
                        <h6 class="fw-bold mb-2 text-secondary">Customer Details</h6>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="mb-1"><strong>Name:</strong> {{ $order->name }}</p>
                            </div>
                            <div class="col-md-3">
                                <p class="mb-1"><strong>Phone:</strong> {{ $order->phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Address:</strong> {{ $order->address }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Products Table --}}
                    <div class="app-card-body p-3">
                        @php 
                            $products = json_decode($order->product_details);
                        @endphp

                        @if(!empty($products))
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Rate</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td>
                                                    <img src="{{ url(IMAGE_PATH.$product->attributes->image) }}" 
                                                         alt="{{ $product->name }}" 
                                                         class="img-fluid rounded" 
                                                         style="width:60px; height:60px;">
                                                </td>
                                                <td>{{ $product->name.' '.$product->attributes->value.$product->attributes->unit }}</td>
                                                <td>${{ $product->price }}</td>
                                                <td>{{ $product->quantity }}</td>
                                                <td class="fw-bold">${{ $product->subtotal }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-danger text-center">No Orders Found!</p>
        @endif

    </div><!--//container-fluid-->
</div><!--//app-content-->

<!-- Change Status Modal -->
<div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="changeStatusLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="changeStatusLabel">Change Order Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ url('admin/change_order_status') }}" method="POST">
        @csrf
        <input type="hidden" id="orderid" name="orderid" value="">
        <div class="modal-body">
          <div class="mb-3">
            <label for="statusSelect" class="form-label">Select New Status</label>
            <select class="form-select" id="statusSelect" name="status" required>
              <option value="">-- Choose Status --</option>
              <option value="2">Shipped</option>
              <option value="3">Delivered</option>
              <option value="4">Cancelled</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>

    </div>
  </div>
</div>

<script>
    function changeStatus(id){
        $("#orderid").val(id);
        $("#changeStatusModal").modal('show');
    }
</script>

@endsection
