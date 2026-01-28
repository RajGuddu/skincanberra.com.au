@extends('_layouts.master')
@section('content')

<div class="w-100">
  <div class="row g-0">

    <!-- Sidebar -->
    
    @include('member.sidebar')

    <!-- Orders Content -->
    <div class="col-md-9 col-lg-10" style="background-color:#f7f4ef;">
      <div class="p-4">
        <h4 class="fw-semibold mb-4" style="color:#B4903A;">My Orders</h4>
            @if($orders->isNotEmpty())
            @foreach ($orders as $order)
            @php 
              $status = '<span class="badge rounded-pill bg-primary" >Order Placed</span>';
              if($order->status == 2)
                $status = '<span class="badge rounded-pill bg-warning" >Shipped</span>';
              elseif($order->status == 3)
                $status = '<span class="badge rounded-pill bg-success" >Delivered</span>';
              elseif($order->status == 4)
                $status = '<span class="badge rounded-pill bg-danger" >Cancel</span>';
            @endphp
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color:#F9F5F0;">
                <div>
                    <strong>Order ID:</strong> {{ $order->order_id }}<br>
                    <small class="text-muted">Order Date: {{ date('M d, Y',strtotime($order->orderdate)) }}</small>
                </div>
                <div class="text-end">
                    {!! $status !!}
                    <div class="fw-bold mt-1">${{ $order->net_total }}</div>
                </div>
                </div>

                <div class="card-body">
                @php 
                  $products = json_decode($order->product_details);
                @endphp
                @if(!empty($products))
                @foreach ($products as $product)
                <div class="row align-items-center mb-3 border-bottom pb-2">
                    <div class="col-md-2 col-3">
                    <img src="{{ url(IMAGE_PATH.$product->attributes->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                    </div>
                    <div class="col-md-6 col-9">
                    <h6 class="mb-1">{{ $product->name.' '.$product->attributes->value.$product->attributes->unit }}</h6>
                    <small class="text-muted">Rate: {{ $product->price }}</small>
                    <small class="text-muted">Qty: {{ $product->quantity }}</small>
                    </div>
                    <div class="col-md-4 text-end fw-bold">{{ $product->subtotal }}</div>
                </div>
                @endforeach
                @endif
                </div>

            </div>
            @endforeach
            @else
              <p class="text-danger text-center">No Orders!</p>
            @endif
      </div>
    </div>

  </div>
</div>

@endsection
