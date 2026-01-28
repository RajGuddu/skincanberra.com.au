@extends('_layouts.master')
@section('content')
<!-- banner panel -->

<div style="text-align: center; padding: 50px; min-height: 500px;">
    <h1>Oops! Payment Cancelled</h1>
    <h2>The payment process was cancelled.<br> You have not been charged.</h2>
    <a href="{{ url('/') }}" class="cstm-btn mt-md-4">Go back to Home</a>
</div>
@endsection