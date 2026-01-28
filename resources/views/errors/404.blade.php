@extends('_layouts.master')
@section('content')
<div style="text-align: center; padding: 50px; min-height: 500px;">
    <h1>404</h1>
    <h2>Oops! Page Not Found</h2>
    <p>The page you are looking for doesn’t exist or has been moved.</p>
    <a href="{{ url('/') }}">Go back to Home</a>
</div>
@endsection