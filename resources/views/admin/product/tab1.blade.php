<div class="app-card app-card-orders-table shadow-sm p-4">
    <div class="app-card-body">
        <form class="" action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="tab" value="tab1">
            <div class="mb-3">
                <label for="pro_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="pro_name" name="pro_name"
                    value="{{ old('pro_name', $record->pro_name ?? '') }}">
                @error('pro_name') <span class="text-danger"> {{ $message }} </span> @enderror
            </div>
            <div class="mb-3">
                <label for="sub_title" class="form-label">Product Sub-Title</label>
                <input type="text" class="form-control" id="sub_title" name="sub_title"
                    value="{{ old('sub_title', $record->sub_title ?? '') }}">
                @error('sub_title') <span class="text-danger"> {{ $message }} </span> @enderror
            </div>
            <div class="mb-3">
                <label for="pro_url" class="form-label">Product Url</label>
                <input type="text" class="form-control" id="pro_url" name="pro_url"
                    value="{{ old('pro_url', $record->pro_url ?? '') }}">
                @error('pro_url') <span class="text-danger"> {{ $message }} </span> @enderror
            </div>
            <div class="mb-3">
                <label for="post" class="form-label">Product Category</label>
                <select name="cat_id" id="cat_id" class="form-control">
                    <option value="">Select One</option>
                    @if($proCategory->isNotEmpty())
                    @foreach($proCategory as $list)
                    @php $sel = '';
                    if(isset($record) && $record->cat_id == $list->id)
                        $sel = 'selected'; 
                    @endphp
                    <option value="{{ $list->id }}" {{ $sel }}>{{ $list->category_name }}</option>
                    @endforeach
                    @endif
                </select>
                @error('cat_id') <span class="text-danger"> {{ $message }} </span> @enderror
            </div>
            <p style="color:blue"><strong>Images (1000 X 1000 px)</strong></p>
            
            <div class="mb-3">
                <label for="image1" class="form-label">Image 1 </label>
                <input type="file" class="form-control" id="image1" name="image1">
                <input type="hidden" class="form-control" id="image1D" name="image1D" value="{{ $record->image1 ?? '' }}">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="alt1" class="form-label">Alt Text 1 </label>
                        <input type="text" class="form-control" id="alt1" name="alt1" value="{{ old('alt1', $record->alt1 ?? '') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="imgTitle1" class="form-label">Title Text 1 </label>
                        <input type="text" class="form-control" id="imgTitle1" name="imgTitle1" value="{{ old('imgTitle1', $record->imgTitle1 ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="image2" class="form-label">Image 2 </label>
                <input type="file" class="form-control" id="image2" name="image2">
                <input type="hidden" class="form-control" id="image2D" name="image2D" value="{{ $record->image2 ?? '' }}">

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="alt2" class="form-label">Alt Text 2 </label>
                        <input type="text" class="form-control" id="alt2" name="alt2" value="{{ old('alt2', $record->alt2 ?? '') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="imgTitle2" class="form-label">Title Text 2 </label>
                        <input type="text" class="form-control" id="imgTitle2" name="imgTitle2" value="{{ old('imgTitle2', $record->imgTitle2 ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="image3" class="form-label">Image 3 </label>
                <input type="file" class="form-control" id="image3" name="image3">
                <input type="hidden" class="form-control" id="image3D" name="image3D" value="{{ $record->image3 ?? '' }}">

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="alt3" class="form-label">Alt Text 3 </label>
                        <input type="text" class="form-control" id="alt3" name="alt3" value="{{ old('alt3', $record->alt3 ?? '') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="imgTitle3" class="form-label">Title Text 3 </label>
                        <input type="text" class="form-control" id="imgTitle3" name="imgTitle3" value="{{ old('imgTitle3', $record->imgTitle3 ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="image4" class="form-label">Image 4 </label>
                <input type="file" class="form-control" id="image4" name="image4">
                <input type="hidden" class="form-control" id="image4D" name="image4D" value="{{ $record->image4 ?? '' }}">

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="alt4" class="form-label">Alt Text 4 </label>
                        <input type="text" class="form-control" id="alt4" name="alt4" value="{{ old('alt4', $record->alt4 ?? '') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="imgTitle4" class="form-label">Title Text 4 </label>
                        <input type="text" class="form-control" id="imgTitle4" name="imgTitle4" value="{{ old('imgTitle4', $record->imgTitle4 ?? '') }}">
                    </div>
                </div>
            </div>
            
            <?php /* <div class="mb-3">
                <label for="serv_url" class="form-label">Url</label>
                <input type="text" class="form-control" id="serv_url" name="serv_url"
                    value="{{ old('serv_url', $record->serv_url ?? '') }}">
                @error('serv_url') <span class="text-danger"> {{ $message }} </span> @enderror
            </div>
            <div class="mb-3">
                <label for="serv_title" class="form-label">Small Title(for above line of record
                    name)</label>
                <input type="text" class="form-control" id="serv_title" name="serv_title"
                    value="{{ old('serv_title', $record->serv_title ?? '') }}">
            </div> 
            
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="radio" id="status" name="status" value="1" checked>
                    <label class="form-check-label" for="status">Active</label>
                </div>
                <div class="form-check form-switch mb-3">
                    @php
                        $status = old('status', ($record->status ?? 0));
                    @endphp
                    <input class="form-check-input" type="radio" id="status2" name="status" value="0" {{ $status == 0 ? 'checked' : '' }} >
                    <label class="form-check-label" for="status2">Inactive</label>
                </div>
            </div>*/ ?>
            <button type="submit" class="btn app-btn-primary">Save Changes</button>
            <a href="{{ url('admin/products') }}" class="btn app-btn-secondary">Cancel</a>
        </form>

    </div><!--//app-card-body-->
</div><!--app-card-->

<script>
    document.addEventListener('DOMContentLoaded', function () {
		const proNameInput = document.getElementById('pro_name');
		const urlInput = document.getElementById('pro_url');

		if (proNameInput && urlInput) {
			proNameInput.addEventListener('keyup', function () {
				let urlval = proNameInput.value;
				let newurl = urlval
					.replace(/[_\s]+/g, '-')
					.replace(/[^a-zA-Z-]/g, '')
					.toLowerCase();

				urlInput.value = newurl;
			});
		}
	});
</script>