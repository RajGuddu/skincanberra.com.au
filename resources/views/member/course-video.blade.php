@extends('_layouts.master')
@section('content')

<div class="w-100">
  <div class="row g-0">

    <!-- Sidebar -->
    @include('member.sidebar')

    <!-- Main Content -->
    <div class="col-md-9 col-lg-10" style="background-color:#f7f4ef;">
      <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h4 class="fw-semibold mb-4" style="color:#B4903A;">Course Video</h4>
          <a href="{{ url()->previous() }}" class="text-decoration-none fw-semibold" style="color:#B4903A;">
            ← Back
          </a>
        </div>

        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">

            <h5 class="fw-semibold mb-3" style="color:#B4903A;">
              {{ $course->course_name }}
            </h5>

            @php
              // YouTube Link को ID में convert करना
              // preg_match('/(?:youtu\.be\/|youtube\.com\/.*v=)([^&]+)/', $course->youtube_link, $match);
              // $youtubeId = $match[1] ?? '';
              $youtubeId = $course->youtube_link;
            @endphp

            @if($youtubeId)
              <div class="ratio ratio-16x9 mx-auto" style="max-width:800px;">

                <iframe 
                  src="https://www.youtube.com/embed/{{ $youtubeId }}?controls=0&modestbranding=1&rel=0&showinfo=0&disablekb=1"
                  title="YouTube video"
                  frameborder="0"
                  allow="autoplay; encrypted-media"
                  allowfullscreen
                  >
                </iframe>

              </div>
            @else
              <p class="text-danger">Invalid YouTube URL.</p>
            @endif

          </div>
        </div>

      </div>
    </div>

  </div>
</div>

@endsection
