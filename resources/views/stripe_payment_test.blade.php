@extends('_layouts.master')
@section('content')
<!-- banner panel -->

<div style="text-align: center; padding: 50px; min-height: 500px;">
    <form action="{{ url('stripe-payment') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Pay Now</button>
    </form>

</div>
@endsection