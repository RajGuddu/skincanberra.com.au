@extends('admin._layout.master')
@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-xl">
		<h1 class="app-page-title">Settings</h1>
		<?php if(Session::has('message')){ 
			echo alertBS(session('message')['msg'], session('message')['type']);
		} ?>
		<hr class="mb-4">
		<div class="row g-4 settings-section">
			<div class="col-12 col-md-4">
				<h3 class="section-title">Personal Contact</h3>

				<!-- <div class="section-intro">Settings section intro goes here. Lorem ipsum dolor sit amet,
					consectetur adipiscing elit. <a href="help.html">Learn more</a></div> -->
			</div>
			<div class="col-12 col-md-8">
				<div class="app-card app-card-settings shadow-sm p-4">

					<div class="app-card-body">
						<form class="settings-form" autocomplete="off" action="{{ url()->current() }}" method="post">
							@csrf
							<div class="row">
								<div class="col-md-6">
									<div class="mb-3">
										<label for="setting-input-1" class="form-label">Business Name
											<?php /* <span class="ms-2"
											data-bs-container="body" data-bs-toggle="popover" data-bs-trigger="hover focus"
											data-bs-placement="top"
											data-bs-content="This is a Bootstrap popover example. You can use popover to provide extra info."><svg
												width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
												fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd"
													d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
												<path
													d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z" />
												<circle cx="8" cy="4.5" r="1" />
											</svg></span> */ ?>
										</label>
										<input type="text" class="form-control" id="name" name="name"
											value="{{ old('name', $settings->name ?? '') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label for="setting-input-2" class="form-label">Email</label>
										<input type="email" class="form-control" id="email" name="email"
											value="{{ old('email', $settings->email ?? '') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label for="setting-input-3" class="form-label">Phone</label>
										<input type="tel" class="form-control" id="phone" name="phone"
											value="{{ old('phone', $settings->phone ?? '') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label for="setting-input-3" class="form-label">Address</label>
										<input type="text" class="form-control" id="address" name="address"
											value="{{ old('address', $settings->address ?? '') }}">
									</div>
								</div>
								<div class="col-md-6">
									<button type="submit" class="btn app-btn-primary">Save Changes</button>
								</div>
							</div>
						</form>
					</div><!--//app-card-body-->

				</div><!--//app-card-->
			</div>
		</div><!--//row-->
		<hr class="my-4">
		<div class="row g-4 settings-section">
			<div class="col-12 col-md-4">
				<h3 class="section-title">Social Media</h3>
				<!-- <div class="section-intro">Settings section intro goes here. Lorem ipsum dolor sit amet,
					consectetur adipiscing elit. <a href="help.html">Learn more</a></div> -->
			</div>
			<div class="col-12 col-md-8">
				<div class="app-card app-card-settings shadow-sm p-4">

					<div class="app-card-body">
						<form class="settings-form" autocomplete="off" action="{{ url()->current() }}" method="post">
							@csrf
							<div class="row">
								<div class="col-md-6">
									<div class="mb-3">
										<label for="setting-input-1" class="form-label">Facebook link
											<?php /* <span class="ms-2"
											data-bs-container="body" data-bs-toggle="popover" data-bs-trigger="hover focus"
											data-bs-placement="top"
											data-bs-content="This is a Bootstrap popover example. You can use popover to provide extra info."><svg
												width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
												fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd"
													d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
												<path
													d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z" />
												<circle cx="8" cy="4.5" r="1" />
											</svg></span> */ ?>
										</label>
										<input type="text" class="form-control" id="facebook_link" name="facebook_link"
											value="{{ old('facebook_link', $settings->facebook_link ?? '') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label for="setting-input-2" class="form-label">Youtube link</label>
										<input type="text" class="form-control" id="youtube_link" name="youtube_link"
											value="{{ old('youtube_link', $settings->youtube_link ?? '') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label for="setting-input-3" class="form-label">Twitter link</label>
										<input type="text" class="form-control" id="twitter_link" name="twitter_link"
											value="{{ old('twitter_link', $settings->twitter_link ?? '') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label for="setting-input-3" class="form-label">Linkedin link</label>
										<input type="text" class="form-control" id="linkedin_link" name="linkedin_link"
											value="{{ old('linkedin_link', $settings->linkedin_link ?? '') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label for="setting-input-3" class="form-label">Google link</label>
										<input type="text" class="form-control" id="google_link" name="google_link"
											value="{{ old('google_link', $settings->google_link ?? '') }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label for="setting-input-3" class="form-label">Instagram link</label>
										<input type="text" class="form-control" id="instagram_link"
											name="instagram_link"
											value="{{ old('instagram_link', $settings->instagram_link ?? '') }}">
									</div>
								</div>
								<div class="col-md-6">
									<button type="submit" class="btn app-btn-primary">Save Changes</button>
								</div>
							</div>
						</form>

					</div><!--//app-card-body-->

				</div><!--//app-card-->
			</div>
		</div><!--//row-->
		<hr class="my-4">
		<div class="row g-4 settings-section">
			<div class="col-12 col-md-4">
				<h3 class="section-title">Opening Hours</h3>

			</div>
			<div class="col-12 col-md-8">
				<div class="app-card app-card-settings shadow-sm p-4">
					<div class="app-card-body">
						<form class="settings-form" autocomplete="off" action="{{ url()->current() }}" method="post">
							@csrf
							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label for="opening_hours" class="form-label">Opening Hours</label>
										<textarea class="form-control" id="opening_hours" name="opening_hours">
											{{ old('opening_hours', $settings->opening_hours ?? '') }}</textarea>
									</div>
								</div>
								
								
								<div class="col-md-12">
									<button type="submit" class="btn app-btn-primary">Save Changes</button>
								</div>
							</div>
						</form>
					</div><!--//app-card-body-->
				</div><!--//app-card-->
			</div>
		</div><!--//row-->
		<hr class="my-4">
		<div class="row g-4 settings-section">
			<div class="col-12 col-md-4">
				<h3 class="section-title">Marquee</h3>
				
			</div>
			<div class="col-12 col-md-8">
				<div class="app-card app-card-settings shadow-sm p-4">
					<div class="app-card-body">
						<form class="settings-form" autocomplete="off" action="{{ url()->current() }}" method="post">
							@csrf
							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label for="marquee1" class="form-label">Marquee 1</label>
										<input type="text" class="form-control" id="marquee1" name="marquee1"
											value="{{ old('marquee1', $settings->marquee1 ?? '') }}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="marquee2" class="form-label">Marquee 2</label>
										<input type="text" class="form-control" id="marquee2" name="marquee2"
											value="{{ old('marquee2', $settings->marquee2 ?? '') }}">
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label for="marquee3" class="form-label">Marquee 3</label>
										<input type="text" class="form-control" id="marquee3" name="marquee3"
											value="{{ old('marquee3', $settings->marquee3 ?? '') }}">
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="mb-3">
										<label for="marquee4" class="form-label">Marquee 4</label>
										<input type="text" class="form-control" id="marquee4" name="marquee4"
											value="{{ old('marquee4', $settings->marquee4 ?? '') }}">
									</div>
								</div>
								
								<div class="col-md-12">
									<button type="submit" class="btn app-btn-primary">Save Changes</button>
								</div>
							</div>
						</form>
					</div><!--//app-card-body-->
				</div><!--//app-card-->
			</div>
		</div><!--//row-->
		<hr class="my-4">
		<div class="row g-4 settings-section">
			<div class="col-12 col-md-4">
				<h3 class="section-title">Weekly Holidays</h3>
			</div>
			<div class="col-12 col-md-8">
				<div class="app-card app-card-settings shadow-sm p-4">
					<div class="app-card-body">
						<form class="settings-form" autocomplete="off" action="{{ url()->current() }}" method="post">
							@csrf

							<div class="mb-3">
								<label for="weeklyHolidays" class="form-label">Select Weekly Holidays</label>
								<select id="weeklyHolidays" name="weeklyHolidays[]"
										class="form-control" multiple>

									<option value="0" {{ !empty($settings->weeklyHolidays) && in_array(0, explode(',', $settings->weeklyHolidays)) ? 'selected' : '' }}>Sunday</option>
									<option value="1" {{ !empty($settings->weeklyHolidays) && in_array(1, explode(',', $settings->weeklyHolidays)) ? 'selected' : '' }}>Monday</option>
									<option value="2" {{ !empty($settings->weeklyHolidays) && in_array(2, explode(',', $settings->weeklyHolidays)) ? 'selected' : '' }}>Tuesday</option>
									<option value="3" {{ !empty($settings->weeklyHolidays) && in_array(3, explode(',', $settings->weeklyHolidays)) ? 'selected' : '' }}>Wednesday</option>
									<option value="4" {{ !empty($settings->weeklyHolidays) && in_array(4, explode(',', $settings->weeklyHolidays)) ? 'selected' : '' }}>Thursday</option>
									<option value="5" {{ !empty($settings->weeklyHolidays) && in_array(5, explode(',', $settings->weeklyHolidays)) ? 'selected' : '' }}>Friday</option>
									<option value="6" {{ !empty($settings->weeklyHolidays) && in_array(6, explode(',', $settings->weeklyHolidays)) ? 'selected' : '' }}>Saturday</option>

								</select>
								<small class="text-muted">You can select multiple holidays</small>
							</div>

							<button type="submit" class="btn app-btn-primary">Save Changes</button>
						</form>
					</div><!--//app-card-body-->
				</div><!--//app-card-->
			</div>
		</div><!--//row-->

	</div><!--//container-fluid-->
</div><!--//app-content-->
<script>

	$(document).ready(function () {
		$("#weeklyHolidays").multiselect({
			header: true,
			noneSelectedText: 'Select Weekly Holidays',
			selectedList: 3
		});
		$('.ui-multiselect-menu').css('display', 'none');

	});
	tinymce.init({
		selector: '#opening_hours',
		height: 300,
		plugins: 'advlist autolink lists link image charmap preview anchor ' +
               'searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
		toolbar: 'undo redo | formatselect | ' +
				'bold italic underline strikethrough | ' +
				'alignleft aligncenter alignright alignjustify | ' +
				'bullist numlist outdent indent | code removeformat | link image | ' +
				'forecolor backcolor | help',
		branding: false,
		block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Preformatted=pre'
	});

	
</script>
@endsection