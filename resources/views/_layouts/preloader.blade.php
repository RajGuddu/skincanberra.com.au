

<?php $seg1 = request()->segment(1);
if($seg1 == ''){ ?>
<!-- Page Preloader -->
<div id="preloader">
    <div class="preloader-content">
        <img src="{{ url('assets/frontend/images/skin-canberra-logo.png') }}" alt="Logo" class="preloader-logo">
        <!-- <div class="spinner"></div> -->
    </div>
</div>
<?php } ?>


