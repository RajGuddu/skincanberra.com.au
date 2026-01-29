<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

use App\Models\Admin\SettingsModel; 
use App\Mail\ThankYou;
use App\Mail\ClientBookingMail;
use App\Mail\AdminBookingMail;
use App\Models\ServiceModel;
use App\Models\ServiceVariantsModel;
use App\Models\ContactModel;
use App\Models\Common_model;
use App\Services\CartService;
use App\Traits\StripePaymentTrait;
class Home extends Controller
{
    use StripePaymentTrait;
    private $commonmodel;
    public function __construct(){
        $this->commonmodel = new Common_model;
        
    }
    public function index(Request $request){
        $data = [];
        $data['testimonials'] = $this->commonmodel->get_custom_testimonials();
        $data['services'] = $this->commonmodel->getAllRecord('tbl_services',['show_front'=>1, 'status'=>1],['sv_id','DESC'],4);
        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner',['status'=>1,'page'=>1]);
        $data['content'] = $this->commonmodel->getOneRecord('tbl_home_content',['id'=>1]);

        // $data['products'] = $this->commonmodel->get_min_value_products('', 8);
        // $data['proCategory'] = $this->commonmodel->crudOperation('RA','tbl_product_category','',['status'=>1]);
        // echo '<pre>'; print_r($data['proCategory']); exit;
        return view('home', $data);
    }
    public function services(Request $request){
        $data = [];
        $data['services'] = ServiceModel::where('status', 1)->orderBy('sv_id','asc')->get();
        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner',['status'=>1,'page'=>5]);
        return view('services', $data);
    }
    public function service_list(Request $request, $url){
        $data = [];
        $service = ServiceModel::where('serv_url', $url)->first();
        if(!$service){
            return redirect()->to('404');
        }
        $data['service'] = $service;
        $data['variants'] = ServiceVariantsModel::where([['sv_id','=',$service->sv_id],['status','=',1]])->orderBy('position','asc')->get();
        $data['countries'] = $this->commonmodel->crudOperation('RA','tbl_countries','',['status'=>1],['countries_iso_code','ASC']);
        
        return view('srvices_listing', $data);
    }
    public function contact(){
        
        $data['countries'] = $this->commonmodel->crudOperation('RA','tbl_countries','',['status'=>1],['countries_iso_code','ASC']);
        $data['content'] = $this->commonmodel->getOneRecord('tbl_home_content',['id'=>1]);
        return view('contact_us', $data);
    }
    public function about_us(){
        $data['testimonials'] = $this->commonmodel->get_custom_testimonials();
        // $data['testimonials'] = $this->commonmodel->crudOperation('RA','tbl_testimonial','',['status'=>1],['id','DESC']);
        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner',['status'=>1,'page'=>4]);
        $data['content'] = $this->commonmodel->getOneRecord('tbl_about_content',['id'=>1]);
        return view('about_us', $data);
    }
    public function cms(Request $request){
        $segment1 = $request->segment(1);
        $cms = $this->commonmodel->getOneRecord('tbl_cms',['status'=>1,'page'=>$segment1]);
        if(!empty($cms)){
           $data['cms'] = $cms;
           return view('cms', $data);
           exit;
        }else{
           return redirect()->to('/404');
        }
    }
    public function products(){
        $data['testimonials'] = $this->commonmodel->get_custom_testimonials();
        $data['products'] = $this->commonmodel->get_min_value_products();
        $data['proCategory'] = $this->commonmodel->crudOperation('RA','tbl_product_category','',['status'=>1]);
        return view('product', $data);
    }
    public function product_details(Request $request, $url){
        $data['testimonials'] = $this->commonmodel->get_custom_testimonials();
        $product = $this->commonmodel->get_min_value_products('','',$url);
        
        if(empty($product)){
            return redirect()->to('/404');
        }
        $data['product'] = $product;
        // get all attributes excepts current attributes
        $data['attributes'] = $this->commonmodel->crudOperation('RA','tbl_product_attributes','',[['attrId','!=',$product->attrId],['pro_id','=',$product->pro_id],['status','=',1]]);
        $data['simiProduct'] = $this->commonmodel->get_min_value_similar_products($url,$product->cat_id);
        // echo '<pre>'; print_r($data['simiProduct']); exit;
        return view('product_detail', $data);
    }
    public function book_variant($vid){
        // echo $url; exit;
        if($vid){
            $variant = $this->commonmodel->crudOperation('R1','tbl_services_variants','',['vid'=>$vid]);
            if(isset($variant->vid)){
                session()->put(['vid'=>$variant->vid, 'sv_id'=>$variant->sv_id]);
                session()->save();
            }
        }
        return redirect()->to(url('book-online'));
    }
    public function book_an_appointment($sv_id = null){
        if($sv_id != null){
            session()->put('sv_id', $sv_id);
            session()->save();
        }
        return redirect()->to(url('book-online'));
    }
    public function book_online(Request $request){
        if($request->isMethod('POST')){
            session()->put([
                'vid' => $request->input('vid'), 
                'sv_id' => $request->input('sv_id'),
                'selected_date' => $request->input('selected_date'),
                'selected_st_id' => $request->input('selected_st_id'),
                'isBooking' => true
            ]);
            session()->save();
            return redirect()->to(url('booking-form'));
        }

        $startDate = Carbon::today()->addDay();
        $endDate = Carbon::today()->addYear();

        $settings = SettingsModel::where(['id'=>1])->first();
        $weeklyHolidays = ($settings->weeklyHolidays != '') ? explode(',', $settings->weeklyHolidays):[]; 
        // Dynamic holidays (custom)
        /*$customHolidays = [
            '2025-12-25', // Example: Christmas
            '2026-01-26', // Example: Republic Day
        ]; */
        $customHolidays = $this->commonmodel->get_all_fully_booked_date_array();
        $holidays = $this->commonmodel->getAllHolidayDates();
        // print_r($holidays); exit;

        $events = [];
        $firstWorkingDate = null;

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $isWeekend = in_array($date->dayOfWeek, $weeklyHolidays);
            $isCustomHoliday = in_array($date->toDateString(), $customHolidays);
            $isHoliday = in_array($date->toDateString(), $holidays);

            if (! $isWeekend && ! $isCustomHoliday && ! $isHoliday) {
                if (is_null($firstWorkingDate)) {
                    $firstWorkingDate = $date->toDateString();
                }
                $events[] = [
                    'startDate' => $date->toDateString(),
                    'endDate' => $date->toDateString(),
                ];
            }
        }
        // echo '<pre>'; print_r($dates); exit;
        $result = $this->get_availability_btn_html($firstWorkingDate);
        
        $data['events'] = $events;
        $data['html'] = $result['html'];
        $data['firstWorkingDate'] = $firstWorkingDate;
        $data['st_id'] = $result['st_id'];
        $data['services'] = $this->commonmodel->crudOperation('RA','tbl_services','',['status'=>1],['sv_id','DESC']);
        $data['variants'] = $this->commonmodel->crudOperation('RA','tbl_services_variants','',[['sv_id','=',session('sv_id')],['status','=',1]],['vid','DESC']);

        return view('book_online', $data);
    }
    public function get_variants_by_ajax(Request $request){
        if($request->isMethod('POST')){
            $sv_id = $request->input('sv_id');
            $variants = $this->commonmodel->crudOperation('RA','tbl_services_variants','',[['sv_id','=',$sv_id],['status','=',1]],['vid','DESC']);
            $html = '<option value="">Please select variants!</option>';
            if($variants->isNotEmpty()){
                foreach($variants as $list){
                    $html .= '<option value="'.$list->vid.'" data-sp="'.$list->sp.'">'.$list->v_name.' $'.$list->sp.'</option>';
                }
                $result['success'] = true;
                $result['html'] = $html;

            }else{
                $result['html'] = '<option value="">-----------------------No Variants------------------</option>';
                $result['success'] = true;
            }
            return json_encode($result); exit;
        }
        return redirect()->to(url('book-online'));
    }
    public function get_available_time_by_ajax(Request $request){
        if($request->isMethod('POST')){
            $b_date = $request->input('b_date');
            $b_date = Carbon::parse($b_date)->toDateString();
            $sv_id = $request->input('sv_id');
            $vid = $request->input('vid');
            
            $res = $this->get_availability_btn_html($b_date);
            
            $result['success'] = true;
            $result['html'] = $res['html'];
            $result['selected_date'] = $b_date;
            $result['selected_st_id'] = $res['st_id'];
            return json_encode($result); exit;
        }
        return redirect()->to(url('book-online'));
    }
    public function get_availability_btn_html($date){
        $html = '';
        $st_id = '';
        if($date != null){
            $formattedDate = Carbon::parse($date)->format('l j F');
            $html = '<p class="fw-semibold mt-3">Availability for '.$formattedDate.'</p>';

            $serviceTime = $this->commonmodel->crudOperation('RA','tbl_service_time','',[['status','=',1]]); 
            if($serviceTime->isNotEmpty()) {
                $html .= '<div class="row g-2">';
                $k = 0;
                foreach($serviceTime as $list){
                    $isBooked = $this->commonmodel->crudOperation('RA','tbl_service_book_online','',[['st_id','=',$list->st_id],['service_date','=',$date]]);
                    $isClosed = $this->commonmodel->isServiceTimeSlotClosed($date, $list->st_id);
                    if((!$isBooked || $isBooked->count() == 0) && !$isClosed) {
                        $active = '';
                        if($k == 0) { $st_id=$list->st_id; $active = 'active'; }
                        $html .= '<div class="col-6 d-grid">
                            <button class="btn btn-outline-dark '.$active.'" data-st_id="'.$list->st_id.'">'.$list->serv_time.'</button>
                        </div>';
                        $k = 1;
                    }
                }
                $html .= '</div>';
            }
        }

        return $result = [
            'st_id' => $st_id,
            'html' => $html
        ];
            
    }
    public function check_next_availability_by_ajax(Request $request){
        if($request->isMethod('POST')){
            $c_date = $request->input('c_date');

            $today = Carbon::today()->addDay();
            $startDate = Carbon::today();
            $endDate = Carbon::today()->addYear();

            $settings = SettingsModel::where(['id'=>1])->first();
            $weeklyHolidays = ($settings->weeklyHolidays != '') ? explode(',', $settings->weeklyHolidays):[]; 
            // $weeklyHolidays = [1,6]; 
            // Dynamic holidays (custom)
            /*$customHolidays = [
                '2025-12-25', 
                '2026-01-26', 
            ]; */
            $customHolidays = $this->commonmodel->get_all_fully_booked_date_array();
            $holidays = $this->commonmodel->getAllHolidayDates();

            $inputDate = Carbon::parse($c_date);
            if ($inputDate->lt($today)) {
                $date = $today->copy();
            } else {
                $date = $inputDate->copy()->addDay();
            }
            while (in_array($date->dayOfWeek, $weeklyHolidays) || in_array($date->toDateString(), $customHolidays) || in_array($date->toDateString(), $holidays)) {
                $date->addDay();
            }
            $nextWorkingDate = $date->toDateString();

            $formattedDate = Carbon::parse($c_date)->format('l j F');
            $html = '<p class="fw-semibold mt-3">Availability for '.$formattedDate.'</p>'.
                    '<div class="no-availability text-center my-4" >
                        <p class="mb-3 fw-semibold">No availability</p>
                        <div class="d-grid">
                            <a href="javascript:void(0)" 
                            class="btn text-white fw-semibold py-2"
                            style="background-color:#B4903A; border:none;"
                            id="nextAvailBtn"
                            data-next_date="'.$nextWorkingDate.'">
                            Check Next Availability
                            </a>
                        </div>
                    </div>';
            return json_encode([
                'success' => true,
                'html' => $html
            ]);
        }
        return redirect()->to(url('book-online'));
    }
    /*public function booking_form(Request $request){

        if(session()->has('isBooking')){
            // dd(session()->all()); exit;
            if($request->isMethod('POST')){
                
                $rules = [
                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    // 'email' => 'required|email',
                    'phone' => 'required|numeric|digits:10',
                    
                ];
                $validated = $this->validate($request, $rules);
                if($validated){
                    // print_r($_POST); exit;
                    $post['sv_id'] = $request->input('sv_id');
                    $post['vid'] = $request->input('vid');
                    $post['st_id'] = $request->input('selected_st_id');

                    $variant = $this->commonmodel->crudOperation('R1','tbl_services_variants','',['vid'=>$post['vid']]);
                    
                    $sp = $variant->sp; //full payment 
                    $option = $request->input('book_deposit'); 
                    // $payAmount = $sp;
                    $payAmount = 50;
                    if ($option == 1) {
                        // $payAmount = $sp; 
                        $payAmount = 50; 
                    } elseif ($option == 2) {
                        $payAmount = $sp * 0.50; 
                    } elseif ($option == 3) {
                        $payAmount = $sp * 0.25; 
                    }
                    $payAmount = ceil($payAmount);
                    $dues = $sp - $payAmount;

                    $post['total_amount'] = (int)$sp;
                    $post['paid_amount'] = $payAmount;
                    $post['dues_amount'] = $dues;
                    
                    $post['service_date'] = $request->input('selected_date');
                    $post['first_name'] = $request->input('first_name');
                    $post['last_name'] = $request->input('last_name');
                    $post['email'] = $request->input('email');
                    $post['dob'] = date('Y-m-d',strtotime($request->input('dob')));
                    $post['country'] = $request->input('country');
                    $post['phone'] = $request->input('phone');
                    $post['message'] = $request->input('message');
                    $post['status'] = 1; //for new
                    $post['added_at'] = Carbon::now();

                    $this->commonmodel->crudOperation('D','tbl_service_book_log');
                    $insertId = $this->commonmodel->crudOperation('C','tbl_service_book_log',$post);

                    if($insertId){
                        
                        $service = $this->commonmodel->crudOperation('R1','tbl_services','',['sv_id'=>$post['sv_id']]);
                        $serviceTime = $this->commonmodel->crudOperation('R1','tbl_service_time','',['st_id'=>$post['st_id']]);

                        $serviceName = $service->service_name ?? '';
                        $variantName = $variant->v_name ?? '';
                        $selected_time = $serviceTime->serv_time ?? '';
                        // $amount = (int)$variant->sp;
                        $amount = $payAmount;

                        session()->forget([
                            'vid',
                            'sv_id',
                            'selected_date',
                            'selected_st_id',
                            'isBooking'
                        ]);

                        $session = $this->createStripeCheckout([
                            'amount'      => $amount * 100, // (in paise)
                            'name'        => $serviceName.' ('.$variantName.')',
                            'description' => Carbon::parse($post['service_date'] . ' ' . $selected_time)->format('d F Y \a\t h:i a'),
                            'images'      => [url(IMAGE_PATH.$variant->photo)],
                            'metadata'    => [
                                                'log_id' => $insertId,
                                                'txnId'  => 'TXN' . time() . rand(1000, 9999),
                                            ],
                            'success_url' => url('/booking-success') . '?sid={CHECKOUT_SESSION_ID}',
                            'cancel_url'  => url('/payment-cancel'),
                        ]);
                        return redirect($session->url);
                        
                    }
                }
            }
            $data['cms'] = $this->commonmodel->getOneRecord('tbl_cms',['status'=>1,'page'=>'privacy-policy']);
            $serviceTime = $this->commonmodel->crudOperation('R1','tbl_service_time','',['st_id'=>session('selected_st_id')]);
            $data['formattedDateTime'] = Carbon::parse(session('selected_date') . ' ' . $serviceTime->serv_time)->format('d F Y \a\t h:i a');
            $data['serviceDtls'] = $this->commonmodel->get_booking_service();
            $data['countries'] = $this->commonmodel->crudOperation('RA','tbl_countries','',['status'=>1],['countries_iso_code','ASC']);

            return view('booking_form', $data);
        }
        return redirect()->to(url('book-online'));
    }*/
    public function booking_success(Request $request){
        $sessionId = $request->get('sid');
        
        $result = $this->verifyStripeSuccess($sessionId);

        if($result['success'] && $result['status'] == 'succeeded'){
            // echo '<pre>'; print_r($result);
            $paymentIntentId = $result['paymentIntentId'];
            $paymentIntentExists = $this->commonmodel->isExists('tbl_service_book_online', ['paymentIntentId'=>$paymentIntentId]);
            if($paymentIntentExists){
                return redirect()->to(url('/'));
            }
            $paymentMode = $result['paymentMode'];
            $log_id = $result['meta']['log_id'];
            $txnId = $result['meta']['txnId'];

            $logData = $this->commonmodel->getOneRecordArray('tbl_service_book_log',['log_id'=>$log_id]);
            if($logData){
                unset($logData['log_id']);
                $logData['payment_mode'] = $paymentMode;
                $logData['payment_status'] = 'succeeded';
                $logData['paymentIntentId'] = $paymentIntentId;
                $logData['txnId'] = $txnId;

                $insertId = $this->commonmodel->crudOperation('C','tbl_service_book_online',$logData);
                
                if($insertId){

                    //store payment log
                    $ptData['sbo_id'] = $insertId;
                    $ptData['pay_from'] = 'service';
                    $ptData['paid_amount'] = $logData['paid_amount'];
                    $ptData['payment_mode'] = $logData['payment_mode'];
                    $ptData['payment_status'] = $logData['payment_status'];
                    $ptData['paymentIntentId'] = $logData['paymentIntentId'];
                    $ptData['txnId'] = $logData['txnId'];
                    $ptData['added_at'] = date('Y-m-d H:i:s');
                    $this->commonmodel->crudOperation('C','tbl_payment_transaction',$ptData);

                    $service = $this->commonmodel->crudOperation('R1','tbl_services','',['sv_id'=>$logData['sv_id']]);
                    $variant = $this->commonmodel->crudOperation('R1','tbl_services_variants','',['vid'=>$logData['vid']]);
                    $serviceTime = $this->commonmodel->crudOperation('R1','tbl_service_time','',['st_id'=>$logData['st_id']]);

                    $serviceName = $service->service_name ?? '';
                    $variantName = $variant->v_name ?? '';
                    $selected_time = $serviceTime->serv_time ?? '';
                    $mailData = [
                        'client_name'   => $logData['first_name'].' '.$logData['last_name'],
                        'client_email'  => $logData['email'],
                        'client_phone'  => $logData['phone'],
                        'service_name'  => $serviceName.' ('.$variantName.')',
                        'selected_date' => Carbon::parse($logData['service_date'])->format('l j F'),
                        'selected_time' => $selected_time,
                        'date_time'     => Carbon::parse($logData['service_date'] . ' ' . $selected_time)->format('d F Y \a\t h:i a'),
                        'total_amount'  => $logData['total_amount'],
                        'paid_amount'   => $logData['paid_amount'],
                        'dues_amount'   => $logData['dues_amount']
                    ];
                    Mail::to($logData['email'])->send(new ClientBookingMail($mailData));
                    // Mail::to(ADMIN_MAIL_TO)->send(new AdminBookingMail($data));
                    Mail::send('emailer.admin-booking', $mailData, function ($message) use ($mailData){
                        $message->to(ADMIN_MAIL_TO)
                                ->subject('New Booking Request Received –'.$mailData['client_name']);
                    });
                    
                }

            }
            return redirect()->to(url('payment-success'));

        }else{
            return redirect()->to(url('payment-cancel'));
        }
    }
    public function payment_success(Request $request){
        return view('payment_success');
    }
    public function payment_cancel(Request $request){
        return view('payment_cancel');
    }
    public function booking_form(Request $request){

        if(session()->has('isBooking')){
            // dd(session()->all()); exit;
            if($request->isMethod('POST')){
                
                $rules = [
                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    'email' => 'required|email',
                    'phone' => 'required|numeric|digits:10',
                    
                ];
                $validated = $this->validate($request, $rules);
                if($validated){
                    // print_r($_POST); exit;
                    $post['sv_id'] = $request->input('sv_id');
                    $post['vid'] = $request->input('vid');
                    $post['st_id'] = $request->input('selected_st_id');

                    $variant = $this->commonmodel->crudOperation('R1','tbl_services_variants','',['vid'=>$post['vid']]);
                    $sp = $variant->sp; 
                    $post['total_amount'] = (int)$sp;
                    $post['paid_amount'] = 0;
                    $post['dues_amount'] = (int)$sp;

                    $post['service_date'] = $request->input('selected_date');
                    $post['first_name'] = $request->input('first_name');
                    $post['last_name'] = $request->input('last_name');
                    $post['email'] = $request->input('email');
                    $post['dob'] = date('Y-m-d',strtotime($request->input('dob')));
                    $post['country'] = $request->input('country');
                    $post['phone'] = $request->input('phone');
                    $post['message'] = $request->input('message');
                    $post['status'] = 1; //for new
                    $post['added_at'] = Carbon::now();

                    $inserted = $this->commonmodel->crudOperation('C','tbl_service_book_online',$post);

                    if($inserted){
                        $service = $this->commonmodel->crudOperation('R1','tbl_services','',['sv_id'=>$post['sv_id']]);
                        // $variant = $this->commonmodel->crudOperation('R1','tbl_services_variants','',['vid'=>$post['vid']]);
                        $serviceTime = $this->commonmodel->crudOperation('R1','tbl_service_time','',['st_id'=>$post['st_id']]);

                        $serviceName = $service->service_name ?? '';
                        $variantName = $variant->v_name ?? '';
                        $selected_time = $serviceTime->serv_time ?? '';
                        $mailData = [
                            'client_name'   => $post['first_name'].' '.$post['last_name'],
                            'client_email'  => $post['email'],
                            'client_phone'  => $post['phone'],
                            'service_name'  => $serviceName.' ('.$variantName.')',
                            'selected_date' => Carbon::parse($post['service_date'])->format('l j F'),
                            'selected_time' => $selected_time,
                            'date_time'     => Carbon::parse($post['service_date'] . ' ' . $selected_time)->format('d F Y \a\t h:i a'),
                            'total_amount'  => $post['total_amount'],
                            'paid_amount'   => $post['paid_amount'],
                            'dues_amount'   => $post['dues_amount']
                        ];
                        Mail::to($post['email'])->send(new ClientBookingMail($mailData));
                        // Mail::to(ADMIN_MAIL_TO)->send(new AdminBookingMail($data));
                        Mail::send('emailer.admin-booking', $mailData, function ($message) use ($mailData){
                            $message->to(ADMIN_MAIL_TO)
                                    ->subject('New Booking Request Received –'.$mailData['client_name']);
                        });

                        session()->forget([
                            'vid',
                            'sv_id',
                            'selected_date',
                            'selected_st_id',
                            'isBooking'
                        ]);
                        // return json_encode([
                        //     'status' => 'success'
                        // ]);
                        // exit;
                    }
                }
                return redirect()->to(url('thank-you'));
            }
            $data['cms'] = $this->commonmodel->getOneRecord('tbl_cms',['status'=>1,'page'=>'privacy-policy']);
            $serviceTime = $this->commonmodel->crudOperation('R1','tbl_service_time','',['st_id'=>session('selected_st_id')]);
            $data['formattedDateTime'] = Carbon::parse(session('selected_date') . ' ' . $serviceTime->serv_time)->format('d F Y \a\t h:i a');
            $data['serviceDtls'] = $this->commonmodel->get_booking_service();
            $data['countries'] = $this->commonmodel->crudOperation('RA','tbl_countries','',['status'=>1],['countries_iso_code','ASC']);

            return view('booking_form', $data);
        }
        return redirect()->to(url('book-online'));
    }
    
    public function save_book_appointment_h(Request $request){
        if($request->isMethod('POST')){
            $post = array();
            $validator = Validator::make($request->all(), [
                'fname' => 'required|string',
                'lname' => 'required|string',
                'phone' => 'required', 'regex:/^[0-9]+$/', 'digits_between:10,10',
                'date' => 'required',
                'time' => 'required',
                'sv_id' => 'required|array|min:1',
            ],[
                'sv_id.required' => 'Please select any service'
            ]);
            if ($validator->fails()) {
                $formattedErrors = [];
                foreach ($validator->errors()->messages() as $field => $messages) {
                    $formattedErrors[$field] = $messages[0];
                }
                return response()->json([
                    'errors' => $formattedErrors
                ], 422);
            }elseif($validator->passes()){
                $sv_id = (!empty($_POST['sv_id']))?implode(',',$_POST['sv_id']):'';
                $post['sv_id'] = $sv_id;
                $post['submit_from'] = 'HD';
                $post['fname'] = trim($_POST['fname']);
                $post['lname'] = trim($_POST['lname']);
                $post['email'] = $_POST['email'];
                $post['country'] = $_POST['country'];
                $post['phone'] = $_POST['phone'];
                $post['date'] = date('Y-m-d',strtotime($_POST['date']));
                $post['time'] = date('H:i',strtotime($_POST['time']));
                $post['message'] = $_POST['message'];
                $post['status'] = 0;
                $post['added_at'] = date('Y-m-d H:i:s');
                if(ContactModel::create($post)){
                    $serviceName = 'N/A';
                    if($sv_id != ''){
                        $serviceName = $this->commonmodel->get_service_name($sv_id);
                    }
                    $post['service_name'] = $serviceName;
                    $post['date'] = date('d-M-Y',strtotime($_POST['date']));
                    $post['time'] = date('h:i A',strtotime($post['time']));
                    Mail::to($post['email'])->send(new ThankYou($post));
                }
                return response()->json([
                    'message' => 'success'
                ]);
            }
        }
    }
    public function save_appointment_service(Request $request){
        if($request->isMethod('POST')){
            $post = array();
            $validator = Validator::make($request->all(), [
                'fname' => 'required|string',
                'lname' => 'required|string',
                'phone' => 'required', 'regex:/^[0-9]+$/', 'digits_between:10,10',
                'date' => 'required',
                'time' => 'required',
            ]);
            if ($validator->fails()) {
                $formattedErrors = [];
                foreach ($validator->errors()->messages() as $field => $messages) {
                    $formattedErrors[$field] = $messages[0];
                }
                return response()->json([
                    'errors' => $formattedErrors
                ], 422);
            }elseif($validator->passes()){
                $vid = (!empty($_POST['vids']))?implode(',',$_POST['vids']):'';
                $post['vid'] = $vid;
                $post['fname'] = trim($_POST['fname']);
                $post['lname'] = trim($_POST['lname']);
                $post['email'] = $_POST['email'];
                $post['country'] = $_POST['country'];
                $post['phone'] = $_POST['phone'];
                $post['date'] = date('Y-m-d',strtotime($_POST['date']));
                $post['time'] = date('H:i',strtotime($_POST['time']));
                $post['message'] = $_POST['message'];
                $post['status'] = 0;
                $post['added_at'] = date('Y-m-d H:i:s');
                if(ContactModel::create($post)){
                    $variantName = 'N/A';
                    if($vid !=''){
                        $variantName = $this->commonmodel->get_variants_name($vid);
                    }
                    $post['v_name'] = $variantName;
                    $post['date'] = date('d-M-Y',strtotime($_POST['date']));
                    $post['time'] = date('h:i A',strtotime($post['time']));
                    Mail::to($post['email'])->send(new ThankYou($post));
                }
                return response()->json([
                    'message' => 'success'
                ]);
            }
        }
    }
    public function save_contact_us(Request $request){
        if($request->isMethod('POST')){
            $post = array();
            $validator = Validator::make($request->all(), [
                'fname' => 'required|string',
                'lname' => 'required|string',
                'phone' => 'required', 'regex:/^[0-9]+$/', 'digits_between:10,10',
                'pp' => 'required',
                // 'time' => 'required',
            ],[
                'pp.required' => 'Please agree with privacy policy'
            ]);
            if ($validator->fails()) {
                $formattedErrors = [];
                foreach ($validator->errors()->messages() as $field => $messages) {
                    $formattedErrors[$field] = $messages[0];
                }
                return response()->json([
                    'errors' => $formattedErrors
                ], 422);
            }elseif($validator->passes()){
                $post['submit_from'] = 'CU'; // contact us
                $post['fname'] = trim($_POST['fname']);
                $post['lname'] = trim($_POST['lname']);
                $post['email'] = $_POST['email'];
                $post['country'] = $_POST['country'];
                $post['phone'] = $_POST['phone'];
                $post['message'] = $_POST['message'];
                $post['status'] = 0;
                $post['added_at'] = date('Y-m-d H:i:s');
                if(ContactModel::create($post)){
                    Mail::to($post['email'])->send(new ThankYou($post));
                }
                return response()->json([
                    'message' => 'success'
                ]);
            }
        }
    }
    public function thank_you(){
        return view('thank_you');
    }
    public function viewmail(){
        $data = [
            'client_name'   => 'MD Raj Guddu',
            'client_email'  => 'raj@yopmail.com',
            'client_phone'  => '1234567890',
            'service_name'  => 'Waxing',
            'selected_date' => '12-11-2025',
            'selected_time' => '9:00 AM',
        ];
        $mailto = 'test152@yopmail.com';
        // Mail::to($mailto)->send(new ClientBookingMail($data));
        Mail::to($mailto)->send(new AdminBookingMail($data));
        echo "Basic Email Sent. Check your inbox.";
        // return view('emailer.admin-booking', $data);
        // return view('emailer.client-booking', $data);
    }
    public function testmail(){
        $data = array(
            'fname'=>"Raj",
            'phone' => "1234567890",
            'email' => "raj@yopmail.com",
            'msg' => "This is new test mail",
        );
        // $mailto = 'rajgudduara18@gmail.com';
        $mailto = 'test152@yopmail.com';
        $from = 'xyz@gmail.com';
        /*Mail::send('email.thankyou', $data, function($message) {
            $message->to($email, 'BALAJI Tour Package')->subject
                ('Thank You for Choosing Us!');
            $message->from($from,'BALAJI Tour Package');
        });*/
        Mail::to($mailto)->send(new ThankYou($data));
        echo "Basic Email Sent. Check your inbox.";
        //return view('email.thankyou');
    }
    public function testcart(){
        echo 'hi';
        $cart = new CartService;
        $cart->clear();
        $cart->add([
            'id'      => 1,
            'name'    => 'mango',
            'quantity'     => 1,
            'price'   => 100,
            'attributes' => ['size' => 'L', 'color' => 'Red']
        ]);
        $cart->update(1,2);
        $items = $cart->getItems();
        echo '<pre>';print_r($items);
        echo $items[1]['name'];
        echo $cart->getSubTotal();
    }
    
}
