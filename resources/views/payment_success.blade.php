@extends('_layouts.master')
@section('content')
<!-- banner panel -->

<div style="text-align: center; padding: 50px; min-height: 500px;">
    <h1>Thank You</h1>
    <h2>Payment completed successfully.<br> Thank you for choosing our service.</h2>
    <a href="{{ url('/') }}" class="cstm-btn mt-md-4">Go back to Home</a>
</div>
@endsection