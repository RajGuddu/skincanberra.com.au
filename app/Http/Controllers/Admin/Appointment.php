<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;


// use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

use App\Models\Common_model;
use App\Models\Admin\SettingsModel;


class Appointment extends Controller
{
    private $commonmodel;
    public function __construct(){
        $this->commonmodel = new Common_model;
    }
    public function index(Request $request, $id=null){
        if($request->isMethod('POST')){
            // print_r($_POST); exit;

            $post['service_date'] = $_POST['service_date'];
            $post['st_id'] = $_POST['st_id'];
            $post['status'] = $_POST['status'];
            $post['update_at'] = date('Y-m-d H:i:s');
            $updated = $this->commonmodel->crudOperation('U','tbl_service_book_online',$post,['id'=>$id]);

            $record = $this->commonmodel->get_one_appointment_data($_POST['id']);
            $mailTo = $record->email;
            
            $mailData = [
                'client_name' => $record->name,
                'service_name' => $record->service_name.' ('.$record->variant.')',
                'selected_date' => Carbon::parse($record->service_date . ' ' . $record->serv_time)->format('d F Y \a\t h:i a'),
            ];

            if($updated){

                if($_POST['old_status'] != $_POST['status']){
                    if($_POST['status'] == 2){ // approved
                        Mail::send('emailer.approve_appoint', $mailData, function ($message) use ($mailTo){
                            $message->to($mailTo)
                                    ->subject('Your Appointment is Confirmed – Skin Canberra');
                        });
                        Mail::send('emailer.approve_appoint_admin', $mailData, function ($message) use ($mailData){
                            $message->to(ADMIN_MAIL_TO)
                                    ->subject('Booking Approved –'.$mailData['client_name']);
                        });
                    }else if($_POST['status'] == 3){ // Declined
                        Mail::send('emailer.declined_appoint', $mailData, function ($message) use ($mailTo){
                            $message->to($mailTo)
                                    ->subject('Update on Your Booking Request – Skin Canberra');
                        });
                        Mail::send('emailer.declined_appoint_admin', $mailData, function ($message) use ($mailData){
                            $message->to(ADMIN_MAIL_TO)
                                    ->subject('Booking Declined –'.$mailData['client_name']);
                        });
                    }

                }
                if($_POST['service_date'] != $_POST['old_service_date'] || $_POST['st_id'] != $_POST['old_st_id']){
                    Mail::send('emailer.reschedule_appoint', $mailData, function ($message) use ($mailTo){
                        $message->to($mailTo)
                                ->subject('Your Appointment Has Been Rescheduled – Skin Canberra');
                    });

                    $oldTime = $this->commonmodel->crudOperation('R1','tbl_service_time','',['st_id'=>$_POST['old_st_id']]);
                    $mailData['old_date'] = Carbon::parse($_POST['old_service_date'] . ' ' . $oldTime->serv_time)->format('d F Y \a\t h:i a');
                    Mail::send('emailer.reschedule_appoint_admin', $mailData, function ($message) use ($mailData){
                        $message->to(ADMIN_MAIL_TO)
                                ->subject('Reschedule Approved –'.$mailData['client_name']);
                    });
                }
                $request->session()->flash('message',['msg'=> 'Schedule updated successfully!','type'=>'success']);
            }else{
                $request->session()->flash('message',['msg'=>'Something went wrong. try again...','type'=>'danger']);
            }
            return redirect()->to('admin/appointment/'.$id);
        }

        if($id != null){
            $record = $this->commonmodel->get_one_appointment_data($id);
            if($record){
                $data['availableTimes'] = $this->commonmodel->get_available_times($record->st_id, $record->service_date);
                $data['record'] = $record;
            }
            
        }
        $data['settings'] = SettingsModel::where(['id'=>1])->first();
        // echo $data['settings']->weeklyHolidays; exit;
        $data['appointments'] = $this->commonmodel->get_appointments_data();
        // echo '<pre>';print_r($data['appointments']); exit;
        return view('admin.appointment.app_index', $data);
    }
    public function get_times_by_date(){
        $selectedDate = $_GET['date'] ?? '';
        $html = '';
        if($selectedDate){
            // Check if selected day is holiday
            $settings = SettingsModel::where('id', 1)->first();
            $weeklyHolidays = explode(',', $settings->weeklyHolidays);
            $weeklyHolidays = array_map('intval', $weeklyHolidays);
            $dayNumber = date('w', strtotime($selectedDate));
            if (in_array($dayNumber, $weeklyHolidays)) {
                echo '<option value="">No slots available (Weekly Holiday)</option>';
                exit;
            }
            $isHoliday = $this->commonmodel->isFullDayHoliday($selectedDate);
            if($isHoliday){
                echo '<option value="">No slots available (Holiday)</option>';
                exit;
            }

            // Normal available time fetch
            $availableTimes = $this->commonmodel->get_times_by_date($selectedDate);
            
            if($availableTimes->isNotEmpty()){
                foreach($availableTimes as $list){
                    $isClosed = $this->commonmodel->isServiceTimeSlotClosed($selectedDate, $list->st_id);
                    if(!$isClosed)
                        $html .= '<option value="'.$list->st_id.'">'.$list->serv_time.'</option>';
                }
            }else{
                $html = '<option>No slots available</option>';
            }

        }
        echo $html; exit;
    }
    // ==========================Appointment List==============================
    public function appointment_list(Request $request, $id=null){
        if($request->isMethod('POST')){
            if($request->formname == 'dues'){
                // print_r($_POST); exit;
                $bookId = $request->id;
                $damount = $request->damount;
                $record = $this->commonmodel->crudOperation('R1','tbl_service_book_online','',['id'=>$bookId]);
                if($record){
                    $paid_amount = (int)$record->paid_amount + (int)$damount;
                    $dues_amount = (int)$record->dues_amount - (int)$damount;
                    $upData['paid_amount'] = $paid_amount;
                    $upData['dues_amount'] = $dues_amount;
                    $upData['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->crudOperation('U','tbl_service_book_online',$upData,['id'=>$bookId]);

                    if(isset($updated)){
                        //store payment log
                        $ptData['sbo_id'] = $bookId;
                        $ptData['pay_from'] = 'service Dues';
                        $ptData['paid_amount'] = $damount;
                        $ptData['payment_mode'] = 'Admin';
                        $ptData['payment_status'] = 'Dues Received';
                        // $ptData['paymentIntentId'] = $logData['paymentIntentId'];
                        // $ptData['txnId'] = $logData['txnId'];
                        $ptData['added_at'] = date('Y-m-d H:i:s');
                        $this->commonmodel->crudOperation('C','tbl_payment_transaction',$ptData);
                        $request->session()->flash('message',['msg'=>'Dues Received successfully!','type'=>'success']);
                    }else{
                        $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
                    }
                }
            }
            if($request->formname == 'appoint'){
                // echo '<pre>'; print_r($_POST); exit;
                $post['sv_id'] = $_POST['sv_id'];
                $post['vid'] = $_POST['vid'];
                $post['st_id'] = $_POST['st_id'];
                $post['service_date'] = $_POST['service_date'];
                $post['first_name'] = $_POST['first_name'];
                $post['last_name'] = $_POST['last_name'];
                $post['email'] = $_POST['email'];
                $post['dob'] = date('Y-m-d',strtotime($_POST['dob']));
                $post['country'] = 'AU';
                $post['phone'] = $_POST['phone'];
                $post['status'] = $_POST['status'];
                $post['added_at'] = date('Y-m-d H:i:s');

                
                $record = $this->commonmodel->crudOperation('R1','tbl_services_variants','',['vid'=>$request->vid]);
                if(!$id){
                    $post['total_amount'] = $record->sp ?? '';
                }
                $post['paid_amount'] = $request->paid_amount;
                if(!$id && isset($record->sp)){
                    $post['dues_amount'] = (int)$record->sp - (int)$request->paid_amount;
                }else{
                    $post['dues_amount'] = (int)$request->total_amount - (int)$request->paid_amount;
                }
                

                if(!$id){
                    $post['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->crudOperation('C','tbl_service_book_online',$post);
                }else{
                    $post['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->crudOperation('U','tbl_service_book_online',$post,['id'=>$id]);
                }
                if(isset($inserted)){
                    $request->session()->flash('message',['msg'=>'Record added successfully!','type'=>'success']);
                }elseif(isset($updated)){
                    $request->session()->flash('message',['msg'=>'Record updated successfully!','type'=>'success']);
                }else{
                    $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
                }

                //mail
                $bookedId = (isset($inserted))?$inserted:$id;

                //insert payment log
                if($request->paid_amount != $request->old_paid_amount){
                    $paid_amount = (int)$request->paid_amount - (int)$request->old_paid_amount;
                    $ptData['sbo_id'] = $bookedId;
                    $ptData['pay_from'] = 'service';
                    $ptData['paid_amount'] = $paid_amount;
                    $ptData['payment_mode'] = 'Admin';
                    $ptData['payment_status'] = ($id)?'Edit Appointment':'Add Appointment';
                    // $ptData['paymentIntentId'] = $logData['paymentIntentId'];
                    // $ptData['txnId'] = $logData['txnId'];
                    $ptData['added_at'] = date('Y-m-d H:i:s');
                    $this->commonmodel->crudOperation('C','tbl_payment_transaction',$ptData);
                }

                $record = $this->commonmodel->get_one_appointment_data($bookedId);
                $mailTo = $record->email;

                $mailData = [
                    'client_name' => $record->name,
                    'service_name' => $record->service_name.' ('.$record->variant.')',
                    'selected_date' => Carbon::parse($record->service_date . ' ' . $record->serv_time)->format('d F Y \a\t h:i a'),
                ];

                if($_POST['status'] != $_POST['old_status']){
                    if($_POST['status'] == 2){ // approved
                        Mail::send('emailer.approve_appoint', $mailData, function ($message) use ($mailTo){
                            $message->to($mailTo)
                                    ->subject('Your Appointment is Confirmed – Skin Canberra');
                        });
                        Mail::send('emailer.approve_appoint_admin', $mailData, function ($message) use ($mailData){
                            $message->to(ADMIN_MAIL_TO)
                                    ->subject('Booking Approved –'.$mailData['client_name']);
                        });
                    }else if($_POST['status'] == 3){ // Declined
                        Mail::send('emailer.declined_appoint', $mailData, function ($message) use ($mailTo){
                            $message->to($mailTo)
                                    ->subject('Update on Your Booking Request – Skin Canberra');
                        });
                        Mail::send('emailer.declined_appoint_admin', $mailData, function ($message) use ($mailData){
                            $message->to(ADMIN_MAIL_TO)
                                    ->subject('Booking Declined –'.$mailData['client_name']);
                        });
                    }
                }
                if($id && ($_POST['service_date'] != $_POST['old_service_date'] || $_POST['st_id'] != $_POST['old_st_id'] || $_POST['sv_id'] != $_POST['old_sv_id'] || $_POST['vid'] != $_POST['old_vid'])){
                    Mail::send('emailer.reschedule_appoint', $mailData, function ($message) use ($mailTo){
                        $message->to($mailTo)
                                ->subject('Your Appointment Has Been Rescheduled – Skin Canberra');
                    });

                    $oldTime = $this->commonmodel->crudOperation('R1','tbl_service_time','',['st_id'=>$_POST['old_st_id']]);
                    $mailData['old_date'] = Carbon::parse($_POST['old_service_date'] . ' ' . $oldTime->serv_time)->format('d F Y \a\t h:i a');
                    Mail::send('emailer.reschedule_appoint_admin', $mailData, function ($message) use ($mailData){
                        $message->to(ADMIN_MAIL_TO)
                                ->subject('Reschedule Approved –'.$mailData['client_name']);
                    });
                }
                
            }
            if($id){
                $redirect = url('admin/appointment-list/'.$id);
            }else{
                $redirect = url('admin/appointment-list');
            }
            return redirect()->to($redirect);
        }
        if($id){
            $record = $this->commonmodel->get_one_appointment_data($id);
            if($record){
                $data['availableTimes'] = $this->commonmodel->get_available_times($record->st_id, $record->service_date);
                $data['variants'] = $this->commonmodel->crudOperation('RA','tbl_services_variants','',[['sv_id','=',$record->sv_id],['status','=',1]],['vid','DESC']);
                $data['record'] = $record;
            }
        }
        $data['listData'] = $this->commonmodel->get_appointment_list();
        $data['services'] = $this->commonmodel->crudOperation('RA','tbl_services','',['status'=>1],['sv_id','DESC']);
        return view('admin.appointment.appointment_list', $data);

    }
    public function delete_appointment(Request $request, $id=null){
        if($id){
            
            if($this->commonmodel->crudOperation('D','tbl_service_book_online','',['id'=>$id])){
                $request->session()->flash('message',['msg'=>'Record Deleted.','type'=>'success']);
            }else{
                $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
            }
        }
        return redirect()->to('admin/appointment-list');
    }
    public function search_appointment(Request $request){
        if($request->isMethod('POST')){
            session([
                'search' => $request->search,
                // 'search_email' => $request->email,
            ]);
        }
        return redirect()->to('admin/appointment-list');
    }
    public function search_reset(Request $request){
        if(session()->has('search')){
            session()->remove('search');
        }
        return redirect()->to('admin/appointment-list');
    }
}