@extends('admin._layout.master')
@section('content')
<style>
    .table-fixed {
        width: 100%;
        /* table-layout: fixed;    */
        word-wrap: break-word; 
    }
</style>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-fluid">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-4">Course List</h1>
            </div>
            <div class="col-auto">
            <form action="{{ url('admin/search_course') }}" method="post" class="mb-3">
                @csrf
                <div class="input-group" style="max-width:400px;">
                    <input type="text" name="search" class="form-control" placeholder="Search by course name"
                        value="{{ old('search', session('search')) }}" required>
                    <button class="btn btn-primary" type="submit">Search</button>
                    <a href="{{ url('admin/c_search_reset') }}" class="btn btn-secondary ms-2">Reset</a>
                    <a href="{{ url('admin/courses').'?add=1' }}" class="btn btn-secondary ms-2">Add</a>
                </div>
            </form>
            </div>

        </div>
        <?php if(Session::has('message')){ 
			echo alertBS(session('message')['msg'], session('message')['type']);
		} ?>
        @php $tableCol = 12; $formCol=0; $formClass="d-none";
        if(request()->has('add') || isset($record->c_id)){
            $tableCol = 8; $formCol = 4; $formClass = '';
        }
        @endphp
        <div class="row">
            <div class="col-lg-{{ $tableCol }}">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left table-fixed">
                                <thead>
                                    <tr>
                                        <th >#</th>
                                        <th>Course Name</th>
                                        <th>Desc</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Pdf</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($listData) && $listData->isNotEmpty())
                                    @foreach($listData as $index => $item)
                                        <tr>
                                            <td class="">{{ $index + 1 }}</td>
                                            <td class="">{{ $item->course_name }}</td>
                                            <td class="" >
                                                {{ substr($item->short_desc, 0, 50) }}
                                            </td>
                                            <td class="">
                                                ${{ $item->c_price }}
                                            </td>
                                            <td class=""><img src="{{ url(IMAGE_PATH.$item->c_image) }}" alt="course-image" width="70px" height="60px"></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm viewPdfBtn" 
                                                        data-pdf="{{ route('secure.pdf', $item->c_pdf) }}">
                                                    View PDF
                                                </button>
                                            </td>
                                            
                                            <td class="">
                                                @if($item->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            @php $tdStyle = ''; 
                                                if(isset($record) && $record->c_id == $item->c_id) 
                                                    $tdStyle = "background-color:#d4edda !important;"; 
                                            @endphp
                                            <td style="{{ $tdStyle }}">
                                                <a class="btn-sm app-btn-secondary" href="{{ url('admin/courses/'.$item->c_id) }}">Edit</a>
                                               
									            <a class="btn-sm app-btn-secondary" onclick="return confirm('Are u sure?')" href="{{ url('admin/delete_course/'.$item->c_id) }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center text-danger">No records found!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div><!-- table-responsive -->
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
            <div class="col-lg-{{ $formCol }} {{ $formClass }}">
                <div class="card shadow-sm">
                    <div class="card-header bg-light fw-bold">
                        {{ (isset($record->id)) ?'Edit':'Add'}} Course
                    </div>
                    <div class="card-body">
                        <form action="{{ url()->current() }}" id="CourseForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- <input type="hidden" name="formname" value="appoint"> -->
                        <input type="hidden" name="id" value="{{ $record->id ?? '' }}">
                        <!-- <input type="hidden" name="total_amount" id="total_amount" value="{{ $record->total_amount ?? 0 }}"> -->
                        <div class="mb-3">
                            <label class="form-label">Course Name <span class="text-danger">*</span></label>
                            <input type="text" name="course_name" value="{{ old('course_name', $record->course_name ?? '') }}" id="course_name" class="form-control">
                            @error('course_name') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Short Description <span class="text-danger">*</span></label>
                            <textarea name="short_desc" id="short_desc" class="form-control" rows="4" style="height: 100px">{{ old('short_desc', $record->short_desc ?? '') }}</textarea>
                            @error('short_desc') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Course Price <span class="text-danger">*</span></label>
                            <input type="number" name="c_price" value="{{ old('c_price', $record->c_price ?? '') }}" class="form-control" id="c_price">
                            @error('c_price') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Course Image </label>
                            <input type="file" name="c_image" id="c_image" class="form-control">
                            <input type="hidden" name="old_c_image" value="{{ $record->c_image ?? '' }}" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course Pdf </label>
                            <input type="file" name="c_pdf" id="c_pdf" class="form-control">
                            <input type="hidden" name="old_c_pdf" value="{{ $record->c_pdf ?? '' }}" >
                             @error('c_pdf') <span class="text-danger"> {{ $message }} </span> @enderror
                        </div>
                        
                        <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select id="status" class="form-select" name="status">
                            <option value="1" {{ (isset($record) && $record->status == 1)?'selected':'' }}>Active</option>
                            <option value="0" {{ (isset($record) && $record->status == 0)?'selected':'' }}>Inactive</option>
                        </select>
                        <input type="hidden" name="old_status" value="{{ $record->status ?? '' }}" >
                        </div>

                        <button type="submit" class="btn btn-primary  text-white" id="">Save</button>
                        <a href="{{ url('admin/courses') }}" class="btn btn-secondary text-white" id="">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div><!--//container-fluid-->
</div><!--//app-content-->

<!-- PDF View Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">View PDF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-0">
                <iframe id="pdfFrame" src="" style="width:100%; height:80vh;"></iframe>
            </div>

        </div>
    </div>
</div>



<script>
    $(document).ready(function() {

        $('.viewPdfBtn').on('click', function() {
            var pdfUrl = $(this).data('pdf');
            //alert(pdfUrl) ; return 0;
            $('#pdfFrame').attr('src', pdfUrl); 
            $('#pdfModal').modal('show'); 
        });

        
        $('#pdfModal').on('hidden.bs.modal', function () {
            $('#pdfFrame').attr('src', '');
        });

    });
    
</script>

@endsection
