@extends('_layouts.master')
@section('content')

<div class="w-100">
  <div class="row g-0">

    <!-- Sidebar -->
    @include('member.sidebar')

    <!-- Main Content -->
    <div class="col-md-9 col-lg-10" style="background-color:#f7f4ef;">
      <div class="p-4">
        <h4 class="fw-semibold mb-4" style="color:#B4903A;">My Addresses</h4>
        <?php if(Session::has('message')){ 
          echo alertBS(session('message')['msg'], session('message')['type']);
        } ?>
        <div class="row g-4">
          
          <!-- Address List -->
          <div class="col-md-6">
            <div class="card border-0 shadow-sm">
              <div class="card-body p-4">
                <h5 class="fw-semibold mb-3" style="color:#B4903A;">Saved Addresses</h5>
                
                <div class="table-responsive">
                  <table class="table table-bordered align-middle">
                    <thead class="table-light">
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($addresses as $index => $addr)
                        <tr>
                          <td>{{ $index + 1 }}</td>
                          <td>{{ $addr->name }}</td>
                          <td>{{ $addr->phone }}</td>
                          <td>{{ $addr->address }}</td>
                          <td>
                            <a href="{{ url('member-addresses/'.$addr->add_id) }}" class="btn btn-sm text-white" style="background-color:#B4903A;">Edit</a>
                            <a href="{{ url('member-deladdress/'.$addr->add_id) }}" class="btn btn-sm text-white" style="background-color:#B4903A;" onclick="return confirm('Delete this address?')">Delete</a>
                            
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="5" class="text-center text-muted">No address found</td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>

          <!-- Add New Address -->
          <div class="col-md-6">
            <div class="card border-0 shadow-sm">
              <div class="card-body p-4">
                <h5 class="fw-semibold mb-3" style="color:#B4903A;">Add New Address</h5>

                <form action="{{ url()->current() }}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" value="{{ old('name', $record->name ?? '') }}">
                    @error('name') <span class="text-danger"> {{ $message }} </span> @enderror
                  </div>

                  <div class="mb-3">
                    <label for="phone" class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone number" value="{{ old('phone', $record->phone ?? '') }}">
                    @error('phone') <span class="text-danger"> {{ $message }} </span> @enderror
                  </div>

                  <div class="mb-3">
                    <label for="address" class="form-label fw-semibold">Address</label>
                    <textarea name="address" id="address" rows="3" class="form-control" placeholder="Enter full address" >{{ old('address', $record->address ?? '') }}</textarea>
                    @error('address') <span class="text-danger"> {{ $message }} </span> @enderror
                  </div>

                  <div class="text-end">
                    <button type="submit" class="btn text-white px-4" style="background-color:#B4903A;">Save Address</button>
                  </div>
                </form>

              </div>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>
</div>

@endsection
