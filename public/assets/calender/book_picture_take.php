<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:300,400,700"> -->
    <!-- <link rel="stylesheet" href="http://weloveiconfonts.com/api/?family=fontawesome"> -->
    <link rel="stylesheet" href="<?=base_url('assets/event_calender/css/style-personal.css')?>">
    <!-- <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"> -->
    
    <?php $this->load->view('rtheader/dlstep3header'); ?>

    <div id="banner-grid" class="py-3 px-2 bg-red online-red-banner mb-5"> 
        <div class="container">
            <h3 class="text-center text-uppercase text-white"> <?=$title?></h3>    
        </div>
    </div>
    <div class="container mb-5">
        <div class="row pro-steps dlstep-six">
            <div class="col-2">
                <a href="javascript:void(0);" class="stepActive">
                    <span>
                        <strong>1</strong>
                        <i class="fa fa-check" aria-hidden="true"></i>
                    </span>
                    <label>Driver's Information</label>
                </a>
            </div>
            <div class="col-2">
                <a href="javascript:void(0);" class="stepActive">
                    <span>
                        <strong>2</strong>
                        <i class="fa fa-check" aria-hidden="true"></i>
                    </span>
                    <label>Upload Documents</label>
                </a>
            </div>
            <div class="col-2">
                <a href="javascript:void(0);" class="stepProcess">
                    <span>
                        <strong>3</strong>
                    </span>
                    <label>Booking for Picture Taking</label>
                </a>
            </div>
            <div class="col-2">
                <a href="javascript:void(0);">
                    <span>
                        <strong>4</strong>
                    </span>
                    <label>Payment</label>
                </a>
            </div>
            <div class="col-2">
                <a href="#" class="">
                    <span>
                        <strong>5</strong>
                    </span>
                    <label>Picture Taking Pass</label>
                </a>
            </div>
            <div class="col-2">
                <a href="javascript:void(0);">
                    <span>
                        <strong>6</strong>
                    </span>
                    <!--<label>Digital License</label>-->
                    <label>Driver's License Card</label>
                </a>
            </div>
        </div>
    </div>
    <?php //print_r($details); exit; ?>
    <div class="bg-light py-4">
        <div class="col-md-8 mx-auto form-heigte">
            <div class="my-0">
                <!-- <h4 class="mb-4 text-uppercase text-center"><?php echo $title; ?></h4> -->
                <?php echo $this->session->flashdata('message'); ?>
                <!--  id="personalFormsData" -->
                <?php /*if(!$this->session->userdata('userlogin')){
                    echo '<p class="text-center">Please login for Learner\'s Permit Application <a href="'.base_url('auth/login').'">Click to Login</a></p>';
                }else{ */?>
                <form action="" onsubmit="return validatestep1();" enctype="multipart/form-data" method="post" id="lpapplicationform" name="lpapplicationform">
                    <span id="form-error" class="w-100 p-1 text-center alert alert-danger" style="display: none;"></span>
                    <h5 class="text-uppercase p-2 text-center mb-4"><?=$page_title?></h5>
                    <!-- <div class="row">-->
                        <div class="text-center"> 
                            <div class="calendar hidden-print">
                            <header>
                                <h2 class="month"></h2>
                                <a class="btn-prev fontawesome-angle-left" href="javascript:void(0);"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                                <a class="btn-next fontawesome-angle-right" href="javascript:void(0);"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </header>
                            <table>
                                <thead class="event-days">
                                <tr></tr>
                                </thead>
                                <tbody class="event-calendar">
                                <tr class="1"></tr>
                                <tr class="2"></tr>
                                <tr class="3"></tr>
                                <tr class="4"></tr>
                                <tr class="5"></tr>
                                <tr class="6"></tr>
                                </tbody>
                            </table>
                            <div class="list">
                                <!-- <div class="day-event" date-day="2" date-month="2" date-year="2016"  data-number="1">
                                <a href="#" class="close fontawesome-remove"></a>
                                <h2 class="title">Lorem ipsum 1</h2>
                                <p>Lorem Ipsum är en utfyllnadstext från tryck- och förlagsindustrin. Lorem ipsum har varit standard ända sedan 1500-talet, när en okänd boksättare tog att antal bokstäver och blandade dem för att göra ett provexemplar av en bok.</p>
                                <label class="check-btn">
                                <input type="checkbox" class="save" id="save" name="" value=""/>
                                <span>Save to personal list!</span>
                                </label>
                                </div> -->
                            </div>
                        </div>
                        <!-- </div> -->
                        <!-- <div class="col-md-6">
                            <label class="print pull-right">
                            <span class="print-btn hidden-print">Print your list!</span>
                            </label>
                            <h2>Personal list</h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            <div class="person-list"></div>
                        </div> -->
                    </div>

                    
                    

                </form>
               <?php //} ?>
            </div>
        </div>
    </div>
    <div id="loader"></div>

    <div class="modal fade" id="bookedSlot" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-center">
                    <h5 class="modal-title text-white " id="title"></h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                    
                </div>
                <div class="modal-body">
                    <div id="wdyes">
                        <div class="form-group">
                            <div id="venue"></div>
                            <div id="regstdate"></div>
                            <div id="regendate"></div>
                            
                        </div>
                        <div class="form-group">
                            <table class="table">
                                <tbody id="timeschedule">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="wdno" style="display:none">
                        <div class="form-group">
                            <div id="holiday"></div>
                            <div id="others"></div>
                        </div>
                    </div>
                    <input type="hidden" name="es_id" id="es_id" value="">
                    <!-- <button type="button" class="btn btn-info" onclick="goToNext();">Book Schedule</button> -->
                    <button type="button" class="btn btn-danger float-right" data-dismiss="modal" aria-label="Close">Cancel</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmSlot" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmSlotLabel">Booking for Picture Taking</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                    
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p id="success_exam_content">Your have selected this schedule : </p>
                        <div id="exam_name"></div>
                        <div id="exam_date"></div>
                        <div id="exam_time"></div>
                        <div id="venue2"></div>
                        <input type="hidden" name="c_es_id" value="" id="c_es_id">
                        <input type="hidden" name="c_es_id2" value="" id="c_es_id2">
                        <!-- <a href="" id="pay-btn" class="btn btn-danger">Pay Now</a> -->
                    </div>
                    <button type="button" class="btn btn-success" onclick="booking_confirm();" id="continuebtn">Continue</button>
                    <button type="button" class="btn btn-danger" onclick="hide_popup();">Cancel</button>
                </div>

            </div>
        </div>
    </div>

<script src="<?=base_url('assets/event_calender/js/simplecalender2.js')?>" type="text/javascript"></script>
<script>
    var BASEURL = '<?=base_url()?>';
    /*function goToNext() {
        var es_id = $("#es_id").val();
        //window.location.href = "<?php echo base_url('graduates/graduates/exam_payment/') ?>" + grad_id;
        window.location.href = "<?php echo base_url('driver/book_picture_taking_schedule/') ?>" + es_id;
    } */
    $(document).ready(function() {
        //alert('hi'); return 0;
        var url = BASEURL+'driver/get_examination_schedule_rt/PT/DL';
        calendar.init('ajax',url);

    });
    function booknow(es_id,es_id2){
        if(es_id){
            $.ajax({
                type: 'POST',
                url: BASEURL+'driver/get_selected_schedule',
                data: {es_id : es_id, es_id2 : es_id2},
                dataType: 'json',
                success: function(result){
                    //console.log(result);
                    $("#bookedSlot").modal("hide");
                    $("#exam_name").html(result.exam_name);
                    $("#exam_date").html(result.exam_date);
                    $("#exam_time").html(result.exam_time);
                    $("#venue2").html(result.venue);
                    $("#c_es_id").val(result.es_id, true);
                    $("#c_es_id2").val(result.es_id2, true);
                    $("#confirmSlot").modal("show"); 
                    return 0;
                }
            });
        }
    }
    function booking_confirm(){
        var es_id = $("#c_es_id").val();
        var es_id2 = $("#c_es_id2").val();
        //alert(es_id+es_id2);return 0;
        if(es_id){
            $("#bookedSlot").modal("hide");
           $.ajax({
            type: 'POST',
            url: BASEURL+'driver/book_picture_taking_schedule',
            data: {es_id : es_id, es_id2 : es_id2},
            dataType: 'json',
            beforeSend: function() {
                $(".loding-main").show();
            },
            success: function(result){
                //console.log(result); return 0;
                if(result.msg == 'success'){
                    window.location.href = "<?php echo base_url('driver/picture_taking_payment/') ?>";
                }
                if(result.error == '1'){
                    window.location.href = "<?php echo base_url('driver/book_picture_taking_schedule/') ?>";
                }
            }
           }); 
        }
    }
    function hide_popup(){
	    $('#confirmSlot').modal('hide'); 
    }
    function closeMMpopup(){
	    $('#graduteDataNotMatch').modal('hide'); 
    }
    function hidepopup(){
        $('#birthday').focus();
        $('#staticBackdrop').modal('hide');
    }

    
    
    
    
</script>