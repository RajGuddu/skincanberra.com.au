<!DOCTYPE html>
<html lang="en">

<head>
	<title>Skin Canberra</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="description" content="Skin Canberra">
	<meta name="author" content="Xiaoying Riley at 3rd Wave Media">
	<link rel="shortcut icon" href="{{ url('assets/frontend/images/skin-canberra.svg') }}">

	<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<!-- Multiselect CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-ui-multiselect-widget@3.0.0/jquery.multiselect.css">

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

	<!-- Multiselect plugin JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-ui-multiselect-widget@3.0.0/src/jquery.multiselect.min.js"></script>

	<!-- FontAwesome JS-->
	<script defer src="{{ url('assets/admin/plugins/fontawesome/js/all.min.js') }} "></script>

	<!-- App CSS -->
	<link id="theme-style" rel="stylesheet" href="{{ url('assets/admin/css/portal.css') }}">
	<!-- Font Awesome CDN -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<!-- Multiselect -->
    <!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script> -->



	<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.2/tinymce.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<style>
      .img-box{
          position: relative;
          height: 180px;
          width: 160px;
		  background-color: #e6f0ff;
		  margin: 10px;
		  padding: 8px;
		  box-sizing: border-box;
      }
      .img-box img{
          height: 150px;
          width: 140px;
      }
      .img-box .image-title{
          width: 100%;
          text-align: center;
      }
      .img-box span.cancel-icon{
        position: absolute;
        float: right;
        color: red;
        cursor: pointer;
        top: -6px;
        right: 23px;
      }
	  .tox-promotion {
		display: none !important;
	}
	</style>
	<style>
    
    .ui-multiselect-menu{
        position: absolute !important;
        width: 350px !important;
        z-index: 9999 !important;
        font-family: 'Segoe UI', sans-serif;
    }
    .ui-multiselect-checkboxes input[type="checkbox"] {
        margin-right: 8px;
    }
    .ui-multiselect-checkboxes label {
        padding: 5px 10px;
        width: 100%;
        background-color: transparent !important;
    }
    .ui-multiselect-header {
        background-color: #f5f5f5;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }
    .ui-multiselect {
        width: 300px !important;
    }
    .ui-multiselect {
        width: 100% !important;
        border: 1px solid #ced4da;
        background-color: transparent !important;
        padding: 15px 13px;
        border-radius: 8px;
    }
    
    </style>

</head>

<body class="app">
	<header class="app-header fixed-top">
		@include('admin._layout.navbar')
		
		@include('admin._layout.sidebar')
	</header><!--//app-header-->

	<div class="app-wrapper">

		@yield('content')

		<footer class="app-footer">
			<div class="container text-center py-3">
				<!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
				<small class="copyright">Developed <span class="sr-only">love</span><i class="fas fa-heart"
						style="color: #fb866a;"></i> by <a class="app-link" href="https://webpanelsolutions.com/"
						target="_blank">Web Panel Solutions</a></small>

			</div>
		</footer><!--//app-footer-->

	</div><!--//app-wrapper-->


	<!-- Javascript -->
	<script src="{{ url('assets/admin/plugins/popper.min.js') }}"></script>
	<script src="{{ url('assets/admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

	<!-- Charts JS -->
	<script src="{{ url('assets/admin/plugins/chart.js/chart.min.js') }}"></script>
	<script src="{{ url('assets/admin/js/index-charts.js') }}"></script>

	<!-- Page Specific JS -->
	<script src="{{ url('assets/admin/js/app.js') }}"></script>
	
	<script>
		function cancel_image_(table, field, pkey, id) {
			if (confirm('Are you sure?')) {
				const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
				const url = "<?=url('admin/remove_image')?>";

				fetch(url, {
					method: 'POST',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded',
						// 'X-CSRF-TOKEN': csrfToken
					},
					body: new URLSearchParams({
						table: table,
						field: field,
						pkey: pkey,
						id: id
					})
				})
				.then(response => {
					if (!response.ok) throw new Error('Network error');
					return response.text();
				})
				.then(data => {
					// success
					console.log('JSON data:', data);
					window.location.reload();
				})
				.catch(error => {
					alert('Error: ' + error.message);
				});
			}
		}
	</script>
	

</body>

</html>