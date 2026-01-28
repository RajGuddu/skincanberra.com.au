    <div class="col-md-3 col-lg-2 d-flex flex-column justify-content-between" style="background-color:#B4903A; min-height:100vh;">
      <div class="p-4 text-center text-white">
        <h5 class="fw-semibold mb-1">Welcome, {{ ucwords(session('name')) }}</h5>
        @if(session('phone') != '')
        <p class="small mb-4 text-light">{{ session('phone') }}</p>
        @endif

        <div class="d-grid gap-2 py-4">
          <a href="{{ url('member-dashboard') }}" class="btn btn-light btn-sm fw-semibold">Dashboard</a>
          <a href="{{ url('member-orders') }}" class="btn btn-light btn-sm fw-semibold ">My Orders</a>
          <a href="{{ url('member-courses') }}" class="btn btn-light btn-sm fw-semibold ">My Courses</a>
          <a href="{{ url('member-addresses') }}" class="btn btn-light btn-sm fw-semibold ">My Addresses</a>
          <a href="{{ url('member-profile') }}" class="btn btn-light btn-sm fw-semibold">Profile</a>
          <a href="{{ url('member-changepassword') }}" class="btn btn-light btn-sm fw-semibold">Change Password</a>
          <a href="{{ url('member-logout') }}" class="btn btn-danger btn-sm fw-semibold w-100" onclick="return confirm('Are you sure?')">Logout</a>
        </div>
      </div>
    </div>