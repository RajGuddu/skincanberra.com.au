<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

use App\Models\Common_model;

class Test extends Controller
{
    private $commonmodel;
    public function __construct(){
        $this->commonmodel = new Common_model;
    }
    public function book48(){
        $upcommingAppointment = $this->commonmodel->get_upcomming_appointment_list();
        if($upcommingAppointment->isNotEmpty()){
            foreach($upcommingAppointment as $record){
                $mailData['bookings'][] = [
                    'client_name' => $record->name,
                    'service_name' => $record->service_name.' ('.$record->variant.')',
                    'selected_date' => Carbon::parse($record->service_date . ' ' . $record->serv_time)->format('d F Y \a\t h:i a'),
                ];
                
            }
            $send = Mail::send('emailer.upcomming_booking_reminder', $mailData, function ($message){
                $message->to(ADMIN_MAIL_TO)
                        ->subject('Upcoming Booking Reminder');
            });
            if($send){
                echo 'Mail Send<br>';
            }
        }
        echo '<pre>'; print_r($upcommingAppointment);
    }
}