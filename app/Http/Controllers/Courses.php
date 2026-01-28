<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

use App\Models\Common_model;
use App\Traits\StripePaymentTrait;

class Courses extends Controller
{
    use StripePaymentTrait;
    private $commonmodel;
    public function __construct(){
        $this->commonmodel = new Common_model;
        
    }
    public function index(Request $request){
        $data['banner'] = $this->commonmodel->getOneRecord('tbl_banner',['status'=>1,'page'=>6]);
        $data['courses'] = $this->commonmodel->get_courses($status = 1);
        return view('course', $data);
    }
    public function buy_course($c_id){
        $course = $this->commonmodel->crudOperation('R1','tbl_courses','',['c_id'=>$c_id]);
        if($course){
            $amount = ceil($course->c_price);
            $session = $this->createStripeCheckout([
                'amount'      => $amount * 100, // (in paise)
                'name'        => $course->course_name,
                'description' => $course->short_desc,
                'images'      => [url(IMAGE_PATH.$course->c_image)],
                'metadata'    => [
                                    'c_id' => $course->c_id,
                                    'txnId'  => 'TXN' . time() . rand(1000, 9999),
                                ],
                'success_url' => url('course-payment-success') . '?sid={CHECKOUT_SESSION_ID}',
                'cancel_url'  => url('/payment-cancel'),
            ]);
            return redirect($session->url);
        }
        return redirect()->to(url('/'));
    }
    public function course_payment_success(Request $request){
        $sessionId = $request->get('sid');
        
        $result = $this->verifyStripeSuccess($sessionId);
        // echo '<pre>'; print_r($result); 
        if($result['success'] && $result['status'] == 'succeeded'){
            // echo '<pre>'; print_r($result);
            $paymentIntentId = $result['paymentIntentId'];
            $paymentIntentExists = $this->commonmodel->isExists('tbl_purchased_course', ['paymentIntentId'=>$paymentIntentId]);
            if($paymentIntentExists){
                return redirect()->to(url('/'));
            }
            $paymentMode = $result['paymentMode'];
            $c_id = $result['meta']['c_id'];
            $txnId = $result['meta']['txnId'];

            $course = $this->commonmodel->crudOperation('R1','tbl_courses','',['c_id'=>$c_id]);
            if($course){
                $m_id = session('m_id');
                $purchaseData = array(
                    'm_id'=> $m_id,
                    'c_id' => $c_id,
                    'c_price' => $course->c_price,
                    'payment_mode' => $paymentMode,
                    'payment_status' => 'succeeded',
                    'paymentIntentId' => $paymentIntentId,
                    'txnId' => $txnId,
                    'purchase_date' => date('Y-m-d H:i:s'),
                );
                $insertId = $this->commonmodel->crudOperation('C','tbl_purchased_course',$purchaseData);
                
                if($insertId){
                    //store payment log
                    $ptData['pay_from'] = 'Course';
                    $ptData['c_id'] = $purchaseData['c_id'];
                    $ptData['paid_amount'] = $purchaseData['c_price'];
                    $ptData['payment_mode'] = $purchaseData['payment_mode'];
                    $ptData['payment_status'] = $purchaseData['payment_status'];
                    $ptData['paymentIntentId'] = $purchaseData['paymentIntentId'];
                    $ptData['txnId'] = $purchaseData['txnId'];
                    $ptData['added_at'] = date('Y-m-d H:i:s');
                    $this->commonmodel->crudOperation('C','tbl_payment_transaction',$ptData);

                    $mailData = [
                        'client_name'   => session('name'),
                        'course_name'   => $course->course_name,
                        'course_price'  => $course->c_price,
                        'purchase_date' =>  Carbon::parse($purchaseData['purchase_date'])->format('l j F'),
                    ];
                    $mailTo = session('email');
                    $pdfPath = storage_path('app/pdf/'.$course->c_pdf);
                    Mail::send('emailer.course_purchase_user', $mailData, function ($message) use ($mailTo, $pdfPath){
                        $message->to($mailTo)
                                ->subject('Your Course Purchase is Successful!')
                                ->attach($pdfPath);
                    });
                    Mail::send('emailer.course_purchase_admin', $mailData, function ($message) use ($mailData){
                        $message->to(ADMIN_MAIL_TO)
                                ->subject('New Course Purchased –'.$mailData['client_name']);
                    });
                    
                }

            }
            return redirect()->to(url('payment-success'));

        }else{
            return redirect()->to(url('payment-cancel'));
        }
    }
    public function course_detail(Request $request){
        return view('course-detail');
    }
}