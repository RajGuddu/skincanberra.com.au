@extends('admin._layout.master')
@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-fluid">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">
                    Variants <span class="text-danger">({{ ucwords($service->service_name)}})</span>
                </h1>
            </div>
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <form class="table-search-form row gx-1 align-items-center">
                                <div class="col-auto">
                                    <input type="text" id="search-orders" name="searchorders"
                                        class="form-control search-orders" placeholder="Search">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn app-btn-secondary">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-auto">
                            <a class="btn app-btn-secondary" href="{{ url('admin/services') }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(Session::has('message'))
        {!! alertBS(session('message')['msg'], session('message')['type']) !!}
        @endif

        <!-- ✅ 6-4-2 layout -->
        <div class="row g-4">

            <!-- 🟩 col-6: Variants Table -->
            <div class="col-12 col-md-6">
                <div class="app-card app-card-orders-table shadow-sm mb-4">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">#</th>
                                        <th class="cell">Photo</th>
                                        <th class="cell">Variant Name</th>
                                        <th class="cell">SP($)</th>
                                        <th class="cell">Duration<span class="note">(Minutes)</span></th>
                                        <th class="cell">Position</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$variants->isEmpty())
                                    @php $n=1; @endphp
                                    @foreach($variants as $list)
                                    @php
                                    $status = $list->status
                                    ? '<span class="badge bg-success">Active</span>'
                                    : '<span class="badge bg-danger">Inactive</span>';
                                    @endphp
                                    <tr>
                                        <td class="cell">{{ $n++ }}</td>
                                        <td class="cell">
                                            <img src="{{ url('assets/uploads/images/'.$list->photo) }}"
                                                width="60" height="50" alt="variant">
                                        </td>
                                        <td class="cell">{{ $list->v_name }}</td>
                                        <td class="cell">{{ '$'.$list->sp }}</td>
                                        <td class="cell">{{ $list->duration }}</td>
                                        <td class="cell">{{ $list->position }}</td>
                                        <td class="cell">{!! $status !!}</td>
                                        <td class="cell">
                                            <a class="btn-sm app-btn-secondary"
                                                href="{{ url('admin/variants/'.$list->sv_id.'/'.$list->vid) }}">Edit</a>
                                            <a class="btn-sm app-btn-secondary"
                                                onclick="return confirm('Are you sure?')"
                                                href="{{ url('admin/delete_variants/'.$list->sv_id.'/'.$list->vid) }}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="6" class="text-danger text-center">No Record Available!</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ✅ Dynamic Form Column -->
            <div class="col-12 col-md-{{ isset($variant) && !empty($variant->vid) ? '4' : '6' }}">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light py-2">
                        <h6 class="mb-0 fw-semibold">
                            {{ isset($variant) && !empty($variant->vid) ? 'Edit Variant' : 'Add Variant' }}
                        </h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Variant Name</label>
                                <input type="text" class="form-control" name="v_name" id="v_name"
                                    value="{{ old('v_name', $variant->v_name ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">URL</label>
                                <input type="text" class="form-control" name="v_url" id="v_url"
                                    value="{{ old('v_url', $variant->v_url ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Photo (629x616 px)</label>
                                <input type="file" class="form-control" name="photo" id="photo">
                                <input type="hidden" name="photo2" value="{{ $variant->photo ?? '' }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">SP ($)</label>
                                <input type="text" class="form-control" name="sp"
                                    value="{{ old('sp', $variant->sp ?? '') }}">
                            </div>

                            <!-- ✅ Service Duration -->
                            <div class="mb-3">
                                <label class="form-label">Service Duration (Minutes)</label>
                                <div class="row">
                                    <?php /* <div class="col-6">
                                        <input type="number" class="form-control" name="duration_hr" min="0" max="12"
                                            placeholder="Hours"
                                            value="{{ old('duration_hr', $variant->duration_hr ?? '') }}">
                                    </div> */ ?>
                                    <div class="col-6">
                                        <input type="number" class="form-control" name="duration_min" min="0" max="120"
                                            placeholder="Minutes"
                                            value="{{ old('duration', $variant->duration ?? '') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Position</label>
                                <input type="number" class="form-control" name="position"
                                    value="{{ old('position', $variant->position ?? $newPosition) }}">
                                <input type="hidden" name="old_position" value="{{ $variant->position ?? 0 }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Short Details</label>
                                <textarea class="form-control" name="details"
                                    rows="3">{{ old('details', $variant->details ?? '') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" value="1" {{
                                        (old('status', $variant->status ?? 1) == 1) ? 'checked' : '' }}>
                                    <label class="form-check-label">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" value="0" {{
                                        (old('status', $variant->status ?? 0) == 0) ? 'checked' : '' }}>
                                    <label class="form-check-label">Inactive</label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($variant) && !empty($variant->vid) ? 'Update Variant' : 'Add Variant' }}
                                </button>
                                <a href="{{ url('admin/variants/'.request()->segment(3)) }}" class="btn btn-secondary">Reset</a>
                                <a href="{{ url('admin/services') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ✅ Only show image column if editing -->
            @if(isset($variant) && isset($variant->vid))
            <div class="col-12 col-md-2">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light py-2">
                        <h6 class="mb-0 fw-semibold small">Uploaded Image</h6>
                    </div>

                    <div class="card-body text-center d-flex align-items-center justify-content-center">
                        @if(!empty($variant->photo) )
                            <div class="position-relative d-inline-block">
                                <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-danger"
                                    style="cursor:pointer;"
                                    onclick="cancel_image_('tbl_services_variants','photo','vid', {{ $variant->vid }})">
                                    ×
                                </span>
                                <img src="{{ url('assets/uploads/images/'.$variant->photo) }}"
                                    class="img-fluid rounded shadow-sm" alt="Variant Image">
                                <small class="text-muted d-block mt-1" style="font-size: 0.8rem;">Variant Image</small>
                            </div>
                            
                        @else
                            <div class="text-muted small">
                                <i class="bi bi-image" style="font-size: 1.5rem;"></i><br>
                                No image uploaded yet
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif



        </div> <!-- row end -->
    </div> <!-- container -->
</div> <!-- content -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const serviceInput = document.getElementById('v_name');
        const urlInput = document.getElementById('v_url');

        if (serviceInput && urlInput) {
            serviceInput.addEventListener('keyup', function () {
                let urlval = serviceInput.value;
                let newurl = urlval
                    .replace(/[_\s]+/g, '-')
                    .replace(/[^a-zA-Z-]/g, '')
                    .toLowerCase();
                urlInput.value = newurl;
            });
        }
    });
</script>
@endsection