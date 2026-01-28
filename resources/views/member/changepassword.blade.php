@extends('_layouts.master')
@section('content')

<div class="w-100">
  <div class="row g-0">

    <!-- Sidebar -->
    @include('member.sidebar')

    <!-- Main Content -->
    <div class="col-md-9 col-lg-10" style="background-color:#f7f4ef;">
      <div class="p-4">
        <h4 class="fw-semibold mb-4" style="color:#B4903A;">Change Password</h4>
        <?php if(Session::has('message')){ 
          echo alertBS(session('message')['msg'], session('message')['type']);
        } ?>
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">

            <form action="{{ url()->current() }}" method="POST">
              @csrf

              <div class="mb-3">
                <label for="current_password" class="form-label fw-semibold">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Enter your current password" value="{{ old('current_password') }}">
                @error('current_password') <span class="text-danger"> {{ $message }} </span> @enderror
              </div>

              <div class="mb-3">
                <label for="new_password" class="form-label fw-semibold">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter new password" value="{{ old('new_password') }}">
                @error('new_password') <span class="text-danger"> {{ $message }} </span> @enderror

              </div>

              <div class="mb-3">
                <label for="confirm_password" class="form-label fw-semibold">Confirm New Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Re-enter new password" value="{{ old('confirm_password') }}">
                @error('confirm_password') <span class="text-danger"> {{ $message }} </span> @enderror

              </div>

              <div class="text-end">
                <button type="submit" class="btn text-white px-4" style="background-color:#B4903A;">Update Password</button>
              </div>

            </form>

          </div>
        </div>

      </div>
    </div>

  </div>
</div>

@endsection
