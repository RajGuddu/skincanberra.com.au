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


class Holidays extends Controller
{
    private $commonmodel;
    public function __construct(){
        $this->commonmodel = new Common_model;
    }
    public function index(Request $request, $id=null){
        $data = [];
        if($request->isMethod('POST')){
            // print_r($_POST); exit;
            $rules = [
                'occasion_name' => 'required',
                'date_from' => 'required',
                'date_to' => 'required',
                'time_slot' => 'required|array|min:1',
                'time_slot.*' => 'required',
                'status' => 'required',
            ];
            $validated = $this->validate($request, $rules);
            
            if($validated){
                
                $post['h_name'] = $request->input('occasion_name');
                $post['date_from'] = date('Y-m-d', strtotime($request->input('date_from')));
                $post['date_to'] = date('Y-m-d', strtotime($request->input('date_to')));
                if(isset($request->alltime)){
                    $post['alltime'] = $request->alltime;
                    $post['time_slot'] = null;
                }else{
                    $post['time_slot'] = implode(',', $request->time_slot);
                    $post['alltime'] = null;
                    // print_r($post); exit;
                }

                $post['status'] = $request->input('status');
                $post['added_at'] = date('Y-m-d H:i:s');
                
                if(!$id){
                    $inserted = $this->commonmodel->crudOperation('C','tbl_holiday',$post);
                }else{
                    $updated = $this->commonmodel->updateRecord('tbl_holiday',$post,['id'=>$id]);
                }
                if(isset($inserted)){
                    $request->session()->flash('message',['msg'=>'Record added successfully!','type'=>'success']);
                }elseif(isset($updated)){
                    $request->session()->flash('message',['msg'=>'Record updated successfully!','type'=>'success']);
                }else{
                    $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
                }

                return redirect()->to('admin/holidays');
            }
        }
        if($id){
            $data['record'] = $this->commonmodel->crudOperation('R1','tbl_holiday','',['id'=>$id]);
        }
        $data['listData'] = $this->commonmodel->crudOperation('RA','tbl_holiday','','',['date_from','ASC']);
        $data['serviceTime'] = $this->commonmodel->crudOperation('RA','tbl_service_time','',[['status','=',1]]); 
        return view('admin.holidays.holidays_index', $data);
    }
    public function delete_holiday(Request $request, $id=null){
        if($id){
            $record = $this->commonmodel->crudOperation('R1','tbl_holiday','',['id'=>$id]);
            if(!empty($record)){
                
                if($this->commonmodel->crudOperation('D','tbl_holiday','',['id'=>$id])){
                    $request->session()->flash('message',['msg'=>'Record Deleted.','type'=>'success']);
                }else{
                    $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
                }
            }
        }
        return redirect()->to('admin/holidays');
    }
    /*public function search_course(Request $request){
        if($request->isMethod('POST')){
            session([
                'search' => $request->search,
                // 'search_email' => $request->email,
            ]);
        }
        return redirect()->to('admin/courses');
    }
    public function search_reset(Request $request){
        if(session()->has('search')){
            session()->remove('search');
        }
        return redirect()->to('admin/courses');
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

            // Normal available time fetch
            $availableTimes = $this->commonmodel->get_times_by_date($selectedDate);
            
            if($availableTimes->isNotEmpty()){
                foreach($availableTimes as $list){
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

    } */
   
}