@extends('_layouts.master')
@section('content')

<div class="w-100">
  <div class="row g-0">

    <!-- Sidebar -->
    @include('member.sidebar')

    <!-- Main Content -->
    <div class="col-md-9 col-lg-10" style="background-color:#f7f4ef;">
      <div class="p-4">
        <h4 class="fw-semibold mb-4" style="color:#B4903A;">Edit Profile</h4>
        <?php if(Session::has('message')){ 
          echo alertBS(session('message')['msg'], session('message')['type']);
        } ?>

        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">

            <form action="{{ url()->current() }}" method="POST">
              @csrf
              
              <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" value="{{ old('name', $user->name ?? '') }}" >
                <input type="hidden" name="name2" value="{{ $user->name ?? '' }}">
              </div>

              <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="{{ old('email', $user->email ?? '') }}" >
                <input type="hidden" name="email2" value="{{ $user->email ?? '' }}">
                @error('email') <span class="text-danger"> {{ $message }} </span> @enderror
              </div>

              <div class="mb-3">
                <label for="phone" class="form-label fw-semibold">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your phone number" value="{{ old('phone', $user->phone ?? '') }}" >
                <input type="hidden" name="phone2" value="{{ $user->phone ?? '' }}">

              </div>

              <div class="text-end">
                <button type="submit" class="btn text-white px-4" style="background-color:#B4903A;">Save Changes</button>
              </div>
            </form>

          </div>
        </div>

      </div>
    </div>

  </div>
</div>

@endsection
