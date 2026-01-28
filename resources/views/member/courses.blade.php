@extends('_layouts.master')
@section('content')

<div class="w-100">
  <div class="row g-0">

    <!-- Sidebar -->
    @include('member.sidebar')

    <!-- Main Content -->
    <div class="col-md-9 col-lg-10" style="background-color:#f7f4ef;">
      <div class="p-4">
        <h4 class="fw-semibold mb-4" style="color:#B4903A;">My Courses</h4>
        <?php if(Session::has('message')){ 
          echo alertBS(session('message')['msg'], session('message')['type']);
        } ?>
        <div class="row g-4">
          
          <!-- Address List -->
          <div class="col-md-12">
            <div class="card border-0 shadow-sm">
              <div class="card-body p-4">
                <h5 class="fw-semibold mb-3" style="color:#B4903A;">Purchased Courses</h5>
                
                <div class="table-responsive">
                  <table class="table table-bordered align-middle">
                    <thead class="table-light">
                      <tr>
                        <th>#</th>
                        <th>Course Name</th>
                        <th>Image</th>
                        <th>Course Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if(isset($courses) && $courses->isNotEmpty())
                        @forelse($courses as $index => $list)
                        <tr>
                          <td>{{ $index + 1 }}</td>
                          <td>{{ $list->course_name }}</td>
                          <td><img src="{{ url(IMAGE_PATH.$list->c_image) }}" alt="course-image" width="60px" height="50px"></td>
                          <td>${{ $list->c_price }}</td>
                          <td>
                            @php 
                            $downloadFileName = \Illuminate\Support\Str::slug($list->course_name, '_').'.pdf';
                            @endphp
                            <a href="{{ route('course.pdf', [$list->c_pdf, $downloadFileName]) }}?v={{ time() }}" class="btn btn-sm text-white" style="background-color:#B4903A;"><i class="fas fa-download"></i> Download</a>

                            @if($list->youtube_link != '')
                            <a href="{{ url('course-video/'.$list->id) }}" class="btn btn-sm text-white" style="background-color:#B4903A;">Video</a>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center text-muted">No any course purchase</td>
                            </tr>
                        @endif
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>
</div>

@endsection
