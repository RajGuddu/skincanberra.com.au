@extends('_layouts.master')
@section('content')
<div class="container py-5">
  <div class="row align-items-center">
    <!-- Left side image -->
    <div class="col-md-6 mb-4 mb-md-0 text-center">
      <img src="{{ url('assets/frontend/images/our-vision.jpg') }}" 
           alt="Product Image" 
           class="img-fluid rounded shadow">
    </div>

    <!-- Right side login form -->
    <div class="col-md-6">
      <div class="card shadow border-0">
        <div class="card-body p-4">
          <h3 class="text-center mb-4" style="color: #B4903A;">Sign up</h3>
            <?php if(Session::has('err')){ 
                echo alertBS(session('err'), 'danger');
            } ?>
          <form action="{{ url()->current() }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Full Name </label>
              <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
              @error('name') <span class="text-danger"> {{ $message }} </span> @enderror
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
              @error('email') <span class="text-danger"> {{ $message }} </span> @enderror
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
              @error('password') <span class="text-danger"> {{ $message }} </span> @enderror

            </div>
            <div class="mb-3">
              <label for="cpassword" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="cpassword" name="cpassword" value="{{ old('cpassword') }}">
              @error('cpassword') <span class="text-danger"> {{ $message }} </span> @enderror

            </div>

            <?php /* <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember">
                  Remember me
                </label>
              </div>
              <a href="{{ url('forgot-password') }}" class="text-decoration-none" style="color: #B4903A;">Forgot Password?</a>
            </div> */ ?>

            <div class="d-grid">
              <button type="submit" class="btn" style="background-color: #B4903A; color: white;">
                Sign up
              </button>
            </div>

            <p class="text-center mt-3 mb-0">
              Already have an account? 
              <a href="{{ url('member-login') }}" class="text-decoration-none" style="color: #B4903A;">Login</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
