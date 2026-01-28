@extends('_layouts.master')
@section('content')
<div class="container py-5">
  <div class="row align-items-center">
    <!-- Left side image -->
    <div class="col-md-6 mb-4 mb-md-0 text-center">
      <img src="{{ url('assets/frontend/images/our-mission.jpg') }}" 
           alt="Product Image" 
           class="img-fluid rounded shadow">
    </div>

    <!-- Right side login form -->
    <div class="col-md-6">
      <div class="card shadow border-0">
        <div class="card-body p-4">
          <h3 class="text-center mb-4" style="color: #B4903A;">Login</h3>
            <?php if(Session::has('err')){ 
                echo alertBS(session('err'), 'danger');
            } ?>
            <?php if(Session::has('msg')){ 
                echo alertBS(session('msg'), 'success');
            } ?>
          <form action="{{ url()->current() }}" method="POST">
            @csrf
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
                Login
              </button>
            </div>

            <p class="text-center mt-3 mb-0">
              Don't have an account? 
              <a href="{{ url('member-register') }}" class="text-decoration-none" style="color: #B4903A;">Sign up</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
