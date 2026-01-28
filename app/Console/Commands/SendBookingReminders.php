<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Common_model;

class SendBookingReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-booking-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'booking-reminders';

    /**
     * Execute the console command.
     */
    private $commonmodel;

    public function __construct(){
        parent::__construct();
        $this->commonmodel = new Common_model;
    }
    public function handle()
    {
        // $mailto = 'test152@yopmail.com';
        // $data = [];
        // Mail::to($mailto)->send(new ThankYou($data));
        $upcommingAppointment = $this->commonmodel->get_upcomming_appointment_list();
        if($upcommingAppointment->isNotEmpty()){
            $ids = [];
            foreach($upcommingAppointment as $record){
                $mailData['bookings'][] = [
                    'client_name' => $record->name,
                    'service_name' => $record->service_name.' ('.$record->variant.')',
                    'selected_date' => Carbon::parse($record->service_date . ' ' . $record->serv_time)->format('d F Y \a\t h:i a'),
                ];
                $ids[] = $record->id;
            }
            $send = Mail::send('emailer.upcomming_booking_reminder', $mailData, function ($message){
                $message->to(ADMIN_MAIL_TO)
                        ->subject('Upcoming Booking Reminder');
            });
            if($send){
                DB::table('tbl_service_book_online')
                ->whereIn('id', $ids)
                ->update(['remind' => 1, 'update_at'=>date('Y-m-d H:i:s')]);
                $this->info("Reminder email sent successfully!");
            }
        }else{
            $this->info("No bookings found. Email not sent.");
            return 0;
        }
    }
}
