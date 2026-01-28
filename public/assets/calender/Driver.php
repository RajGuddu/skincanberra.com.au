<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//ob_start();
class Driver extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	var $data = array();
	//var $tbl_user_certificate  = 'tbl_user_certificate';

	public function __construct(){
		parent::__construct();
		//$this->load->model('Landing_model','landing');
		$this->load->model('driver/driver_model');	
		$this->load->library('upload');
		$this->load->library('Variablebilling'); 
		$this->load->library('paypal_lib');
		$this->load->library('custom_paypal_lib');
		$this->load->library('ciqrcode');
		
		$subscription = $this->common_model->get_admin_subscription_details();
		if($subscription->rb_sub_key == ""){
			//go to contcat for admin with form details
			$this->session->set_flashdata('item', array('message' => 'Please Contact to Administrator.','class' => 'alert-warning'));
			redirect(base_url('contactus'), 'refresh');		
		}

		if($subscription->no_of_application == 0 && $subscription->subscription_id == 6){
			$this->subs_status = 'y';
		}else{
			if($subscription->total_application <= $this->common_model->get_online_application_count()){	
				$this->subs_status = 'n';
			}else{
				$this->subs_status = 'y';
			}
		}
	}
	public function index(){
		$this->data = array(
			'title'=> "Theoretical Examination (Driver's License)"
		);
		if($this->session->userdata('userlogin')){
			$details = $this->driver_model->getRows($this->session->userdata('user_id'));
			if($details->dl_redirect != 0.0){
				//print_r($details);exit;
				dl_redirect_url($details->dl_redirect);
			}
			$data['details'] = $this->driver_model->fetch_user_details($this->session->userdata('user_id'));

		}else{
			$currentURL = current_url();
			$this->session->set_tempdata('currenturl', $currentURL, 300);
		}
		//$data['countries'] = $this->profexam->get_countries();
		//$data['profession'] = $this->profexam->get_profession();
		//$data['university'] = $this->profexam->get_university();
	
		$this->load->view('include/header',$this->data);
		$this->load->view('step1/application_form',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function verify_learner_permit(){
		$output = array('error' => false);	
		$msg = 0;	
		//echo '<pre>'; print_r($_POST); exit;
		//if($this->input->post('submit')=='submit'){
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lname', 'Middle Name', 'trim|required');
		$this->form_validation->set_rules('name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('birthday', 'Birthday', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('learner_permit_no', 'Learner Permit No', 'trim|required');			
		//$this->form_validation->set_rules('college_logo', 'college logo', 'required');
		if($this->form_validation->run() == TRUE){
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$birthday = $this->input->post('birthday');
			$gender = $this->input->post('gender');
			$learner_permit_no = $this->input->post('learner_permit_no');
			$usersdetailsarr = $this->driver_model->verify_learner_permit($fname,$lname,$name,$email,$birthday,$gender,$learner_permit_no);
			if(!empty($usersdetailsarr)){
				/* $graducatedata = array(						
					'grad_id'  			=> $graducatedetailsarr->user_ID,
					'graduate_name'  	=> $graducatedetailsarr->fname,
					'graduate_email'  	=> $graducatedetailsarr->email,
					'graduate_stepone' 	=> TRUE
				);
				$this->session->set_userdata($graducatedata);*/
				echo json_encode(['error'=>'','msg'=>'1','userdetails'=>$usersdetailsarr]); exit;
			}else{
				echo json_encode(['error'=>'','msg'=>'2']); exit;
			}
		}else{
			//validation_errors();
			$errors = array(
				'fname' => form_error('fname', '<p class="mt-3 text-danger">', '</p>'),
				'lname' => form_error('lname', '<p class="mt-3 text-danger">', '</p>'),
				'name' => form_error('name', '<p class="mt-3 text-danger">', '</p>'),
				'email' => form_error('email', '<p class="mt-3 text-danger">', '</p>'),
				'birthday' => form_error('birthday', '<p class="mt-3 text-danger">', '</p>'),
				'gender' => form_error('gender', '<p class="mt-3 text-danger">', '</p>'),
				'learner_permit_no' => form_error('learner_permit_no', '<p class="mt-3 text-danger">', '</p>'),
			);
			//$errors = validation_errors();
			echo json_encode(['error'=>$errors,'msg'=>'0']); exit;
		}
		//}		
	}
	public function upload_document(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->getRows($user_id);
		if($details->dl_redirect == 0.0){
			$this->driver_model->updateuser(array('dl_redirect'=>0.1), $user_id);
			$details = $this->driver_model->get_user_Rows($user_id);
		}
		if($details->dl_redirect != 0.1){
			dl_redirect_url($details->dl_redirect);
		}
		
		$this->data = array('title'=> 'Upload Documents');
		$data['details'] = $details;
		$data['doc'] = $this->driver_model->get_doc_data($this->session->userdata('user_id')); 
		$this->load->view('include/header',$this->data);
		$this->load->view('step1/upload_documents',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function add_documents(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		if($this->input->method() == 'post'){
			$add = array();
			$pd_id = $this->input->post('pd_id');
			$this->load->library('upload');
			if(isset($_FILES["diploma"]) && !empty($_FILES["diploma"]['name'])){
				$config1['upload_path'] = './assets/uploads/document/';	
				$config1['allowed_types'] = 'gif|jpg|png|jpeg';       
				$ext = explode('.',$_FILES["diploma"]["name"]);        
				$imageName = 'docd_'.time().'.'.end($ext);
				$config1['file_name'] = $imageName;
				$this->upload->initialize($config1);

				if ( ! $this->upload->do_upload('diploma')) { 
					$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} 
				$add['diploma'] = $imageName; 
			}
			if(isset($_FILES["ot_record"]) && !empty($_FILES["ot_record"]['name'])){
				$config2['upload_path'] = './assets/uploads/document/';	
				$config2['allowed_types'] = 'gif|jpg|png|jpeg';       
				$ext = explode('.',$_FILES["ot_record"]["name"]);        
				$imageName = 'doco_'.time().'.'.end($ext);
				$config2['file_name'] = $imageName;
				$this->upload->initialize($config2);
	
				if ( ! $this->upload->do_upload('ot_record')) { 
					$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} 
					$add['ot_record'] = $imageName; 
			}
			if(isset($_FILES["charecter"]) && !empty($_FILES["charecter"]['name'])){
				$config3['upload_path'] = './assets/uploads/document/';	
				$config3['allowed_types'] = 'gif|jpg|png|jpeg';       
				$ext = explode('.',$_FILES["charecter"]["name"]);        
				$imageName = 'docc_'.time().'.'.end($ext);
				$config3['file_name'] = $imageName;
				$this->upload->initialize($config3);
	
				if ( ! $this->upload->do_upload('charecter')) { 
					$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} 
				$add['charecter'] = $imageName; 
			}
			if(isset($_FILES["medical"]) && !empty($_FILES["medical"]['name'])){
				$config6['upload_path'] = './assets/uploads/document/';	
				$config6['allowed_types'] = 'gif|jpg|png|jpeg';       
				$ext = explode('.',$_FILES["medical"]["name"]);        
				$imageName = 'docm_'.time().'.'.end($ext);
				$config6['file_name'] = $imageName;
				$this->upload->initialize($config6);
	
				if ( ! $this->upload->do_upload('medical')) { 
					$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} 
					$add['medical'] = $imageName; 
			}
			$add['doc_for'] = 'DL';
			if($pd_id > 0){
				$add['updated_at'] = date('Y-m-d H:i:s');
				$result = $this->driver_model->update_document($add, array('pd_id'=>$pd_id));
			}else{
				$add['user_id'] = $user_id;
				$add['added_on'] = date('Y-m-d H:i:s');
				$add['updated_at'] = date('Y-m-d H:i:s');
				$result = $this->driver_model->insert_document($add);
			}
			
			if($result){
				$details = $this->driver_model->getRows($user_id);
				if($details->dl_redirect == 0.1){
					$this->driver_model->updateuser(array('dl_redirect'=>0.2), $user_id);
				}
				$this->session->set_flashdata('response','<div class="alert alert-success">Documents Uploaded successfully.</div>');
				redirect('driver/exam_payment', 'refresh');
			}else{
				$this->session->set_flashdata('response','<div class="alert alert-danger">Something went wrong, Plesae try again.</div>');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}
		}
	}
	public function exam_payment(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->getRows($user_id);
		if($details->dl_redirect != 0.2){
			dl_redirect_url($details->dl_redirect);
		}
		$this->load->model('professional/Profexam_model','profexam');
		$this->data = array('title'=> 'Payment');
		$data['driver_cash_pay'] = $this->profexam->get_last_record_driver_cash_payment($user_id, ['payment_for'=>'DL','application_for'=>'EDL']);
		$this->load->view('include/header',$this->data);
		$this->load->view('step1/payment',$data);
		$this->load->view('include/footer',$this->data);
	}
	function getprice(){
		$chargeid = $_POST['chargeid'];
		$charges_for = $_POST['charges_for'];
		$data['chargesarr'] = $this->common_model->getcharges($chargeid,$charges_for);
		$charge = $data['chargesarr']->charge; 
		// $tax = $data['chargesarr']->tax; 
		$settingarr = $this->common_model->get_setting('1');
		$tax = $settingarr->tax;
		$tax_amount = $charge*$tax/100; 
		echo json_encode(array('charge'=>$charge,'tax'=>$tax,'tax_amount'=>$tax_amount,'total'=>number_format($charge+$tax_amount,2)));
		exit;
	}
	public function exam_paypal_payment(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$post = $this->input->post();
		// Set variables for paypal form
		$returnURL = base_url().'driver/exam_paymentsuccess'; //payment success url
		$cancelURL = base_url().'driver/exam_paymentcancel'; //payment cancel url
		$notifyURL = base_url().'driver/exam_ipn'; //ipn url
		
		// Get document data from the database
		$doc = $this->driver_model->get_doc(array('user_id'=>$user_id,'document_for'=>'n','doc_for'=>'DL'));
		
		$paymentdata 					= array();
		$paymentdata['user_id'] 		= $user_id;
		$paymentdata['doc_refrence_id'] = $doc->pd_id;
		$paymentdata['txn_id'] 			= '';
		$paymentdata['payment_amout'] 	= $post['amount'];
		$paymentdata['payment_tax'] 	= $post['taxamt'];
		$paymentdata['payment_gross'] 	= $post['total'];			
		$paymentdata['payer_email'] 	= '';
		$paymentdata['payment_status'] 	= '';
		$paymentdata['currency_code'] 	= 'USD';
		$paymentdata['payment_for'] 	= 'DL';
		$paymentdata['application_for'] = 'EDL';
		$paymentdata['payment_type'] 	= 'N';
		$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
		$lastpaymentid = $this->common_model->insert_payment($paymentdata);
		
		// Add fields to paypal form
		$paypaldata = array(
			'return' => $returnURL,
			'cancel_return' => $cancelURL,
			'notify_url' => $notifyURL,
			'item_name' => 'Application for Road Traffic Examination (Driver\'s License)',
			'item_number' => $lastpaymentid,
			'on1' => '',
			'amount' => $post['total'],
			'custom' => '',
		);
		$this->custom_paypal_lib->paypal_pay(json_encode($paypaldata));
	}
	public function exam_paymentsuccess(){
		// Get the transaction data
		$paypalInfo = $this->input->post();
		//print_r($paypalInfo);die;
		$data['txn_id'] 		= $paypalInfo["txn_id"];
		//$data['payment_amt'] 	= $paypalInfo["payment_gross"];
		$data['currency_code'] 	= $paypalInfo["mc_currency"];
		$data['payer_email'] 	= $paypalInfo["payer_email"];
		$data['payment_status'] = $paypalInfo["payment_status"];
		$item_number = isset($paypalInfo['item_number1'])?$paypalInfo['item_number1']:$paypalInfo['item_number'];		
		$this->common_model->update_payment($data,$item_number);

		$this->exam_paymentsuccess_(json_encode(['item_number'=>$item_number]));

		$getuserid = $this->common_model->getuserids($item_number);
		$this->data = array('title'=> 'Review of Documents');
		$data['profes_details'] = $this->driver_model->get_dl_document_details($getuserid->user_id);
		$this->load->view('include/header',$this->data);
		$this->load->view('step1/review_doc',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function exam_paymentsuccess_($json_data){
		$item_number = json_decode($json_data)->item_number;
		$data['details'] = $this->common_model->get_one_receipt_details($item_number);
		$bodycontentforCodeemail=$this->load->view('receipt_view_email', $data, TRUE);

		$getuserid = $this->common_model->getuserids($item_number);	
		//print_r($getuserid);die;
		// update application count
		$logs = array(
			'application_id'	=>	$getuserid->doc_refrence_id,
			'res_id'			=>	'8',
			'subscription'		=>	$this->subs_status,
			'added_at'			=>	date('Y-m-d H:i:s')
		);
		$this->common_model->insert_onlineapplication_log($logs);
		//$this->session->sess_destroy();
		// Update and send mail

		$userid     = $getuserid->user_id;
					$bytes 		= random_bytes(3); 
					$refcode 	= bin2hex($bytes);
					$proRefCode = 'DLR-'.$userid.$refcode.'-'.date('Y');
					$refcodearr = array();
					$refcodearr['dl_refrence_code'] = $proRefCode;
					$refcodearr['account_type'] = 'P';
					$refcodearr['dl_status'] = 1;
					$refcodearr['dl_redirect'] = 0.3;
					$updaterefencecode = $this->driver_model->updatereferencecode($refcodearr,$userid);
					$docdata = array();
					$docdata['dl_refrence_code'] = $proRefCode;
					$docdata['updated_at'] = date('Y-m-d H:i:s');
					$this->driver_model->updateprofdoc($docdata,$getuserid->doc_refrence_id);
					$codedata = array();
					$codedata['dl_refrence_code'] = $proRefCode;
					$this->driver_model->update_code($codedata, array('user_id'=>$userid));
					$serachlink = '<a href="'.base_url('license/search').'">Click here</a>';
					$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your APPLICATION FOR ROAD TRAFFIC EXAMINATION (Driver\'s License) was successfully submitted.<br><br>Provide us some time to review your documents. '.$serachlink.' to check application status and enter the <br>Refrence Code : <strong>'.$proRefCode.'</strong><br><br>Should you have questions just message us and we would Be happy to assist you.</p>';
					$config = Array(
						'protocol' => 'smtp',
						'smtp_host' => SMTP_HOSTNAME,
						'smtp_port' => SMTP_PORT,
						'smtp_user' => SENT_EMAIL_FROM,
						'smtp_pass' => SENT_EMAIL_PASSWORD,
						'mailtype'  => 'html', 
						'newline'   => "\r\n",
						'AuthType'   => "XOAUTH2",
						'charset'   => 'iso-8859-1',
						
					);  
					$this->load->library('email');
					if($updaterefencecode){
						//send refrence code 
						$settingarr = $this->common_model->get_setting('1');
						$userdetails = $this->driver_model->fetch_user_details($getuserid->user_id);
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
						$this->email->to($userdetails->email);
						$this->email->subject('Application submitted successfully (Driver\'s License)');
						$emailbody = array();
						$emailbody['name'] 			= $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name;
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 	= $bodycontentforCode;
						$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						$this->email->send();

						//2nd email
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
						$this->email->to($userdetails->email);
						$this->email->subject('Payment_Receipt');
						$emailbody = array();
						$emailbody['name'] 			= $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name;
						$emailbody['thanksname'] 	= $settingarr->signature_name;
						$emailbody['thanks2'] 		= '';
						$emailbody['thanks3'] 		= $settingarr->position;
						$emailbody['body_msg'] 	= $bodycontentforCodeemail;
						$emailmessage = $this->load->view('emailer_receipt', $emailbody,  TRUE);
						//$this->email->message('Testing the email class.');
						$this->email->message($emailmessage);
						$this->email->send();

						//insert notification
						$updatenotification 				= array();
						$updatenotification['user_id'] 		= $userdetails->user_ID;
						$updatenotification['subject'] 		= 'Application submitted successfully (Driver\'s License)';
						$updatenotification['message'] 		= $bodycontentforCode;
						$updatenotification['from'] 		= SENDER_NAME;
						$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
						$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
						$this->driver_model->insertnotifications($updatenotification); 
					}
 
		$prof = $this->driver_model->fetch_user_details($getuserid->user_id);
		$loginitems = array(						
			'user_id'  		=> $prof->user_ID,
			'fname'  		=> $prof->fname,
			'lname'  		=> $prof->lname,
			'name'  		=> $prof->name,
			'email'  		=> $prof->email,
			'image' 		=> $prof->image,
			'userlogin'		=> TRUE
		);
		$this->session->set_userdata($loginitems);

	}
	public function exam_paymentcancel(){
		return redirect(base_url());
	}
	public function exam_ipn(){
		return redirect(base_url());
	}
	public function cash_payment_EDL(){
        if($this->input->method() == 'post'){
            $cash_payment_data = array(
                'user_id' => $this->input->post('uid'),
                'payment_for' => 'DL',
                'application_for' => 'EDL',
                'payment_amout' => $this->input->post('amount'),
                'payment_tax' => $this->input->post('taxamt'),
                'payment_gross' => $this->input->post('total'),
                'payment_status' => 0,
                'payment_type' => 'N',
            );
            $insertID = $this->driver_model->insert_record('tbl_driver_cash_payment', $cash_payment_data);
            if($insertID){
                return redirect(base_url('driver/exam_payment'));
            }

        }else{
            return redirect(base_url('driver/exam_payment'));
        }
    }
	public function updateuser_DL_EDL(){
		if($this->session->userdata('userlogin')){
			$user_id = $this->session->userdata('user_id');
			$this->driver_model->updatereferencecode(['dl_redirect'=>0.3], $user_id);
			return redirect(base_url('driver/review_document'));
		}else{
			return redirect('/');
		}
	}
	public function review_document(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->getRows($user_id);
		if($details->dl_redirect != 0.3){
			dl_redirect_url($details->dl_redirect);
		}
	
		$this->data = array('title'=> 'Review of Documents');
		$data['profes_details'] = $this->driver_model->get_dl_document_details($user_id);
		$this->load->view('include/header',$this->data);
		$this->load->view('step1/review_doc',$data);
		$this->load->view('include/footer',$this->data);
	}
	public function exam_code(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->getRows($user_id);
		$doc = $this->driver_model->get_doc(array('user_id'=>$user_id,'document_for'=>'n','doc_for'=>'DL'));
		if($doc->reviewer_status == 1 && $details->dl_redirect == 0.3){
			$this->driver_model->update('tbl_users',array('dl_redirect'=> 0.4),'user_ID',$user_id);
			$details = $this->driver_model->getRows($user_id);
		}
		if($details->dl_redirect != 0.4){
			
			dl_redirect_url($details->dl_redirect);
		}
		
		$this->data = array('title'=> 'Examination Code');
		$data['profes_details'] = $this->driver_model->get_dl_document_details($user_id);
		$this->load->view('include/header',$this->data);
		$this->load->view('step1/exam_code',$data);
		$this->load->view('include/footer',$this->data);
	}
	/*public function step2(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->get_user_Rows($user_id);
		if($details->dl_redirect == 0.4){
			$this->driver_model->updateuser(array('dl_redirect'=>1), $user_id);
			$details = $this->driver_model->get_user_Rows($user_id);
		}
		if($details->dl_redirect != 1){
			dl_redirect_url($details->dl_redirect);
		}
		$this->data = array(
			'title'=> 'Booking for Examination (Driver\'s License)',
			'sub_title' => 'Applicant\'s profile and examination code',
			'page_title'=> 'Booking for Examination (Driver\'s License)'
		);
		$this->data['details'] = $details;
		$this->load->view('include/header',$this->data);
		$this->load->view('graduates_form',$this->data);
		$this->load->view('include/footer',$this->data);
	} 
	
	public function graduatestep(){
		$output = array('error' => false);	
		$msg = 0;	
		//echo '<pre>'; print_r($_POST); exit;
		//if($this->input->post('submit')=='submit'){
			$this->form_validation->set_rules('name', 'name', 'trim|required');
			$this->form_validation->set_rules('email', 'email', 'trim|required');
			$this->form_validation->set_rules('birthday', 'birthday', 'trim|required');
			//$this->form_validation->set_rules('gender', 'gender', 'required');
			$this->form_validation->set_rules('examination_code', 'examination code', 'trim|required');			
			//$this->form_validation->set_rules('college_logo', 'college logo', 'required');
			if($this->form_validation->run() == TRUE){
				$graducatedetailsarr = $this->driver_model->get_road_traffic_applicants_details($this->input->post('name'),$this->input->post('middle_name'),$this->input->post('surname'),$this->input->post('email'),$this->input->post('birthday'),$this->input->post('gender'),'',$this->input->post('examination_code'));
				if(!empty($graducatedetailsarr)){
					$graducatedata = array(						
						'grad_id'  			=> $graducatedetailsarr->user_ID,
						'graduate_name'  	=> $graducatedetailsarr->fname,
						'graduate_email'  	=> $graducatedetailsarr->email,
						'graduate_stepone' 	=> TRUE
					);
					$this->session->set_userdata($graducatedata);
					echo json_encode(['error'=>'','msg'=>'1','graducatdetails'=>$graducatedetailsarr]); exit;
				}else{
					echo json_encode(['error'=>'','msg'=>'2']); exit;
				}
			}else{
				//validation_errors();
				$errors = array(
					'name' => form_error('name', '<p class="mt-3 text-danger">', '</p>'),'email' => form_error('email', '<p class="mt-3 text-danger">', '</p>'),
					'birthday' => form_error('birthday', '<p class="mt-3 text-danger">', '</p>'),
					'examination_code' => form_error('examination_code', '<p class="mt-3 text-danger">', '</p>'),
				);
				//$errors = validation_errors();
				echo json_encode(['error'=>$errors,'msg'=>'0']); exit;
			}
		//}		
	} */
	
	public function book_exam(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->get_user_Rows($user_id);
		if($details->dl_redirect == 0.4){
			$this->driver_model->updateuser(array('dl_redirect'=>0.5), $user_id);
			$details = $this->driver_model->get_user_Rows($user_id);
		}
		if($details->dl_redirect != 0.5){
			dl_redirect_url($details->dl_redirect);
		}
		$this->data = array(
			'title'=> 'Theoretical Examination (Driver\'s License)',
			'page_title'=> 'Booking for Examination (Driver\'s License)'
			);
		$this->data['schedule'] = $this->driver_model->get_examination_schedule('ex');
		$this->load->view('include/header',$this->data);
		$this->load->view('step1/bookexam',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function get_examination_schedule_rt($sch_for, $exam_for){
		$examschedule = $this->driver_model->get_examination_schedule_rt($sch_for,$exam_for);
		if(!empty($examschedule)){
			foreach($examschedule as $list){
				$schedule[] = array(
					'month' => date('n',strtotime($list->exam_date)),
					'day' => date('j',strtotime($list->exam_date)),
					'year' => date('Y',strtotime($list->exam_date)),
					'es_id' => $list->es_id,
					'title' => $list->exam_name,
					'venue' => $list->venue,
					'reg_start_date' => date('M d, Y',strtotime($list->added_on)),
					'reg_end_date' => date('M d, Y', strtotime($list->exam_date)),
					'workingdays' => $list->workingdays,
					'holiday' => $list->holiday,
					'others' => $list->others,
				);
			}
			$data['events'] = $schedule;
			//$data['result'] = 'success';
		}else{
			$data['result'] = 'fail';
		}
		echo json_encode($data);
		exit;
	}
	public function get_time_schedule(){
		if($this->input->method() == 'post'){
			$es_id = $_POST['es_id'];
			$timescheduleHtml = '';
			$exam_time = $this->driver_model->get_exam_time();
			if(!empty($exam_time)){
				foreach($exam_time as $list){
					$timescheduleHtml .= '<tr><td>'.$list->exam_time.'</td>';
					$examsch2data = $this->driver_model->get_one_exam_sch_rt2_data($es_id, $list->extime_id);
					if(!empty($examsch2data)){
						if($examsch2data->exam_date >= date('Y-m-d')){
							$timescheduleHtml .= '<td>'.$examsch2data->remaining_seat.' Slots Remaining </td>
							<td><a href="javascript:void(0);" class="btn btn-success" onclick="booknow('.$es_id.','.$examsch2data->es_id2.')">BOOK NOW</a></td></tr>';
						}else{
							$timescheduleHtml .= '<td class="text-danger">EXAM DONE</td><td></td></tr>';
						}

					}else{
						$timescheduleHtml .= '<td class="text-danger">CLOSED</td><td></td></tr>';
					}
				}
			}
			echo $timescheduleHtml;
			exit;
		}
	}
	public function get_selected_schedule(){
		if($this->input->method() == 'post'){
			$es_id = $_POST['es_id'];
			$es_id2 = $_POST['es_id2'];
			$schdata = $this->driver_model->get_booked_exam_details2($es_id, $es_id2);
			$data['exam_name'] = $schdata->exam_name;
			$data['exam_date'] = date('F d, Y',strtotime($schdata->exam_date));
			$data['exam_time'] = $schdata->exam_time;
			$data['venue'] = $schdata->venue;
			$data['es_id'] = $schdata->es_id;
			$data['es_id2'] = $schdata->es_id2;
			echo json_encode($data); exit;
		}
	}

	/*function book_exam_date(){
		$id = $this->input->post('id');
		$uid = $this->input->post('uid');
		$post = $this->input->post();
		$check = $this->driver_model->already_booked_exam($post, 'dle');
		/*if($check==true){
			$result['error'] = '2';
			$result['msg'] = 'User Already Booked this exam!';
		}else{ */
			/*$booked = $this->driver_model->add_exam_date($post, 'dle');
			if($booked==true){
				$exambookingdata = array(
					'user_id' => $uid,
					'es_id' => $id,
					'be_id' => $booked,
					'exam_for' => 'DL',
					//'status' => 0,
					'added_at' => date('Y-m-d H:i:s')
				);
				$this->driver_model->insert_record('tbl_examination_booking', $exambookingdata);
				$userDtls = $this->driver_model->get_user_Rows($uid);
				$exam_pass_code = $userDtls->dl_exam_code;
				//generate qrcode
				$qr_image = 'qrcode_'.$exam_pass_code.'.png';
				$qr_url = base_url('assets/uploads/pdf/'.$exam_pass_code.'.pdf');
				$params['data'] = $qr_url;
				$params['level'] = 'H';
				$params['size'] = 5;
				$params['savename'] = './assets/qrcode/'.$qr_image;
				$this->ciqrcode->generate($params);
				$graqrcode['dl_exam_pass_qrcode'] = $qr_image;
				//$this->db->where('user_ID', $uid)->update('tbl_users', $graqrcode);
				$this->driver_model->update_code($graqrcode, array('user_id'=>$uid));
				$this->driver_model->updateuser(array('dl_redirect'=>1.2), $uid);
				//generate qrcode end-------------- generate pdf start
				//$html = ob_get_clean();
				$html = $this->getexampasspdf($uid, $booking_for='dle');
				// Get output html
				$html.= $this->output->get_output();
				$this->load->library('Pdf');
				$this->dompdf = new DOMPDF();
				$this->dompdf->load_html($html);
				$this->dompdf->set_paper('letter','portrait');
				$this->dompdf->render();

				file_put_contents('assets/uploads/pdf/'.$exam_pass_code.'.pdf', $this->dompdf->output($html));
				//$this->dompdf->stream("school.pdf",array('Attachment'=>0));
				//generate pdf end
				
				//email 
				$search_link = '<a href="'.base_url('driver/driver/exam_pass_download/'.base64_encode($uid)).'">Click here</a>';
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your Exam has been booked successfully.<br><br>In this regard, you can use your Exam Pass Code : '.$exam_pass_code.' to learn the Guidline and get the EXAM PASS.<br>Please <b style="color: blue;">'.$search_link.'</b> to view and download your exam pass.<br><br>Should you have questions just message us and we would Be happy to assist you.</p><p>for temporary use</p><p>Drive Test Code: '.$drivetestcode;
				$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => SMTP_HOSTNAME,
					'smtp_port' => SMTP_PORT,
					'smtp_user' => SENT_EMAIL_FROM,
					'smtp_pass' => SENT_EMAIL_PASSWORD,
					'mailtype'  => 'html', 
					'newline'   => "\r\n",
					'AuthType'   => "XOAUTH2",
					'charset'   => 'iso-8859-1',
				);  
					
				$this->load->library('email');
				$userdetails = $this->driver_model->fetch_user_details_exam_pass($uid);
				if($userdetails){
					$settingarr = $this->common_model->get_setting('1');
					//send refrence code 
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
					$this->email->to($userdetails->email);
					$this->email->subject('Exam booked for Driver\'s License successfully.');
					$emailbody = array();
					$emailbody['name'] 			= $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name;
					$emailbody['thanksname'] 	= $settingarr->signature_name;
					$emailbody['thanks2'] 		= '';
					$emailbody['thanks3'] 		= $settingarr->position;
					$emailbody['body_msg'] 	= $bodycontentforCode;
					$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);
					//$this->email->message('Testing the email class.');
					$this->email->message($emailmessage);
					//if(isset($graducatedetailsarr->examcode) && file_exists('assets/uploads/pdf/'.$graducatedetailsarr->examcode.'.pdf')){
					//	$this->email->attach(base_url('assets/uploads/pdf/'.$graducatedetailsarr->examcode.'.pdf'));
					//	}
					$this->email->send();

					//insert notification
					$updatenotification 				= array();
					$updatenotification['user_id'] 		= $userdetails->user_ID;
					$updatenotification['subject'] 		= 'Exam booked for Driver\'s License successfully.';
					$updatenotification['message'] 		= $bodycontentforCode;
					$updatenotification['from'] 		= SENDER_NAME;
					$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
					$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
					$this->driver_model->insertnotifications($updatenotification);
				}
				//email END

				//for nex step
				$examination_booked_id['book_exam_id'] = $booked;
				$this->session->set_userdata($examination_booked_id);
				$examschld=$this->db->where('es_id',$id)->get('tbl_examination_schedule')->row_array();
				$result['date'] = date('F d,Y',strtotime($examschld['date']));
				$result['start_time'] = date('H:i A',strtotime($examschld['start_time']));
				$result['end_time'] = date('H:i A',strtotime($examschld['end_time']));
				$result['venue'] = $examschld['venue'];
				$result['last_id'] = $booked;
				$result['error'] = '0';
				$result['msg'] = 'Your exam schedule is <br>';
			}else{
				$result['error'] = '1';
				$result['msg'] = 'Something went wrong, Please try again!';
			}
		//}
		echo json_encode($result);	
	}*/
	function book_exam_date(){
		$es_id = $this->input->post('es_id');
		$es_id2 = $this->input->post('es_id2');
		$user_id = $this->session->userdata('user_id');
		$data = array(
			'user_id' => $user_id,
			'examination_id' => $es_id,
			'es_id2' => $es_id2,
			'booking_for' => 'dle',
			'payment' => '1',
			'added_on' => date('Y-m-d')
		);
		$booked_id = $this->driver_model->book_exam($data);
			if($booked_id==true){
				$exambookingdata = array(
					'user_id' => $user_id,
					'es_id' => $es_id,
					'es_id2' => $es_id2,
					'be_id' => $booked_id,
					'exam_for' => 'DL',
					//'status' => 0,
					'added_at' => date('Y-m-d H:i:s')
				);
				$this->driver_model->insert_record('tbl_examination_booking', $exambookingdata);
				$userDtls = $this->driver_model->get_user_Rows($user_id);
				$exam_pass_code = $userDtls->dl_exam_code;
				//generate qrcode
				$qr_image = 'qrcode_'.$exam_pass_code.'.png';
				$qr_url = base_url('assets/uploads/pdf/'.$exam_pass_code.'.pdf');
				$params['data'] = $qr_url;
				$params['level'] = 'H';
				$params['size'] = 5;
				$params['savename'] = './assets/qrcode/'.$qr_image;
				$this->ciqrcode->generate($params);
				$graqrcode['dl_exam_pass_qrcode'] = $qr_image;
				//$this->db->where('user_ID', $uid)->update('tbl_users', $graqrcode);
				$this->driver_model->update_code($graqrcode, array('user_id'=>$user_id));
				$this->driver_model->updateuser(array('dl_redirect'=>0.6), $user_id);
				//generate qrcode end-------------- generate pdf start
				//$html = ob_get_clean();
				$html = $this->getexampasspdf($user_id, $booked_id);
				// Get output html
				$html.= $this->output->get_output();
				$this->load->library('Pdf');
				$this->dompdf = new DOMPDF();
				$this->dompdf->load_html($html);
				$this->dompdf->set_paper('letter','portrait');
				$this->dompdf->render();

				file_put_contents('assets/uploads/pdf/'.$exam_pass_code.'.pdf', $this->dompdf->output($html));
				//$this->dompdf->stream("school.pdf",array('Attachment'=>0));
				//generate pdf end
				
				//email 
				$search_link = '<a href="'.base_url('driver/driver/exam_pass_download/'.base64_encode($user_id)).'">Click here</a>';
				$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your Exam has been booked successfully.<br><br>In this regard, you can use your Exam Pass Code : '.$exam_pass_code.' to learn the Guidline and get the EXAM PASS.<br>Please <b style="color: blue;">'.$search_link.'</b> to view and download your exam pass.<br><br>Should you have questions just message us and we would Be happy to assist you.</p>';
				$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => SMTP_HOSTNAME,
					'smtp_port' => SMTP_PORT,
					'smtp_user' => SENT_EMAIL_FROM,
					'smtp_pass' => SENT_EMAIL_PASSWORD,
					'mailtype'  => 'html', 
					'newline'   => "\r\n",
					'AuthType'   => "XOAUTH2",
					'charset'   => 'iso-8859-1',
				);  
					
				$this->load->library('email');
				$userdetails = $this->driver_model->fetch_user_details_exam_pass($user_id);
				if($userdetails){
					$settingarr = $this->common_model->get_setting('1');
					//send refrence code 
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
					$this->email->to($userdetails->email);
					$this->email->subject('Exam booked for Driver\'s License successfully.');
					$emailbody = array();
					$emailbody['name'] 			= $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name;
					$emailbody['thanksname'] 	= $settingarr->signature_name;
					$emailbody['thanks2'] 		= '';
					$emailbody['thanks3'] 		= $settingarr->position;
					$emailbody['body_msg'] 	= $bodycontentforCode;
					$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);
					//$this->email->message('Testing the email class.');
					$this->email->message($emailmessage);
					//if(isset($graducatedetailsarr->examcode) && file_exists('assets/uploads/pdf/'.$graducatedetailsarr->examcode.'.pdf')){
					//	$this->email->attach(base_url('assets/uploads/pdf/'.$graducatedetailsarr->examcode.'.pdf'));
					//	}
					$this->email->send();

					//insert notification
					$updatenotification 				= array();
					$updatenotification['user_id'] 		= $userdetails->user_ID;
					$updatenotification['subject'] 		= 'Exam booked for Driver\'s License successfully.';
					$updatenotification['message'] 		= $bodycontentforCode;
					$updatenotification['from'] 		= SENDER_NAME;
					$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
					$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
					$this->driver_model->insertnotifications($updatenotification);
				}
				//email END

				//for nex step
				$examination_booked_id['book_exam_id'] = $booked_id;
				$this->session->set_userdata($examination_booked_id);
				//$examschld=$this->db->where('es_id',$id)->get('tbl_examination_schedule')->row_array();
				///$result['date'] = date('F d,Y',strtotime($examschld['date']));
				//$result['start_time'] = date('H:i A',strtotime($examschld['start_time']));
				//$result['end_time'] = date('H:i A',strtotime($examschld['end_time']));
				//$result['venue'] = $examschld['venue'];
				///$result['last_id'] = $booked;
				$result['error'] = '0';
				$result['msg'] = 'success';
			}else{
				$result['error'] = '1';
				$this->session->set_flashdata('message','<div class="alert alert-danger">Something went wrong!</div>');
			}
		//}
		echo json_encode($result);	
	}
	public function testpdf(){
		$this->load->helper('html');
		$exam_pass_code = 'EXA-9158344677f8-2022';
		$html = $this->getexampasspdf(91, 'dle');
		// Get output html
		$html .= $this->output->get_output();
		//print_r($html);die;
		$this->load->library('Pdf');
		$this->dompdf = new DOMPDF();
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('letter','portrait');
		$this->dompdf->render();

		//file_put_contents('assets/uploads/pdf/'.$exam_pass_code.'.pdf', $this->dompdf->output($html));
		$this->dompdf->stream("school.pdf",array('Attachment'=>0));
		//generate pdf end
	} 
	
	public function exam_guidlines(){
		if(!login()){
			return redirect(base_url());
		}
		$uid = $this->session->userdata('user_id');
		$details = $this->driver_model->get_user_Rows($uid);
		if($details->dl_redirect != 1.2){
			dl_redirect_url($details->dl_redirect);
		}
		$this->data = array('title'=> 'Guidelines and Information on Examination','page_title'=> 'Booking for Examination (Driver\'s License)');
		
		$this->data['profes_details'] = $this->driver_model->fetch_user_details($uid);
		$this->data['lesson'] = $this->driver_model->get_guidlines();
		$this->load->view('include/header',$this->data);
		$this->load->view('exam_guidline',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function exam_pass(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->get_user_Rows($user_id);
		if($details->dl_redirect == 1.2){
			$this->driver_model->updateuser(array('dl_redirect'=>1.3), $user_id);
			$details = $this->driver_model->get_user_Rows($user_id);
		}
		if($details->dl_redirect != 1.3){
			dl_redirect_url($details->dl_redirect);
		}
		$this->data = array('title'=> 'Exam Pass','page_title'=> 'Booking for Examination (Driver\'s License)');
		$this->data['profes_details'] = $this->driver_model->fetch_user_details_exam_pass($user_id);
		//$this->data['exam_details'] = $this->common_model->is_pexam_booked(base64_decode($uid));
		$this->load->view('include/header',$this->data);
		$this->load->view('exam_pass',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function exam_pass_download($user_id = null){ //for email link and searching
		$user_id = base64_decode($user_id);
		$this->data = array('title'=> 'Exam Pass','page_title'=> 'Booking for Examination (Driver\'s License)');
		$this->data['profes_details'] = $this->driver_model->fetch_user_details_exam_pass($user_id);
		//$this->data['exam_details'] = $this->common_model->is_pexam_booked(base64_decode($uid));
		$this->load->view('include/header',$this->data);
		$this->load->view('exam_pass',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function exam_result(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->get_user_Rows($user_id);
		/*if($details->dl_redirect == 0.6){
			$this->driver_model->updateuser(array('dl_redirect'=>0.7), $user_id);
			$details = $this->driver_model->get_user_Rows($user_id);
		}*/
		if($details->dl_redirect != 0.6){
			dl_redirect_url($details->dl_redirect);
		}
		$this->data = array('title'=> 'Theoretical Examination Result','page_title'=> 'Theoretical Examination (Driver\'s License)');
		$this->data['examresult'] = $this->driver_model->get_exam_result($user_id, 'DL');
		$this->data['examDtls'] = $this->driver_model->get_booked_exam_details2($this->data['examresult']->es_id,$this->data['examresult']->es_id2);
		$this->data['userDtls'] = $details;
		$this->data['lessonguide'] = $this->driver_model->get_lesson_guide();
		$this->load->view('include/header',$this->data);
		$this->load->view('step1/examresult',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function uplpr_book_exam(){ //update learner permit redirect for booking for examination
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$this->driver_model->updateuser(array('dl_redirect'=>1.0), $user_id);
		return redirect(base_url('driver/driver/step2'));
	}
	// Exam Payment End
	//booking for drive test start
	public function drive_test(){ //copy of index
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->get_user_Rows($user_id);
		if($details->dl_redirect == 0.6){
			$this->driver_model->updateuser(array('dl_redirect'=>1.0), $user_id);
			$details = $this->driver_model->get_user_Rows($user_id);
		}
		if($details->dl_redirect != 1.0){
			dl_redirect_url($details->dl_redirect);
		}
		$this->data = array(
			'title'=> 'Practical Examination (Driver\'s License)',
			'sub_title' => 'Applicant\'s profile and examination code',
			'page_title'=> 'Practical Examination (Driver\'s License)'
		);
		$this->data['details'] = $this->driver_model->fetch_user_details($user_id);
		$this->load->view('include/header',$this->data);
		$this->load->view('step2/drive_test_form',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function verify_step1(){
		$output = array('error' => false);	
		$msg = 0;	
		//echo '<pre>'; print_r($_POST); exit;
		//if($this->input->post('submit')=='submit'){
			$this->form_validation->set_rules('name', 'name', 'trim|required');
			$this->form_validation->set_rules('email', 'email', 'trim|required');
			$this->form_validation->set_rules('birthday', 'birthday', 'trim|required');
			//$this->form_validation->set_rules('gender', 'gender', 'required');
			$this->form_validation->set_rules('examination_code', 'examination code', 'trim|required');			
			//$this->form_validation->set_rules('college_logo', 'college logo', 'required');
			if($this->form_validation->run() == TRUE){
				$graducatedetailsarr = $this->driver_model->get_road_traffic_applicants_details($this->input->post('name'),$this->input->post('middle_name'),$this->input->post('surname'),$this->input->post('email'),$this->input->post('birthday'),$this->input->post('gender'),$this->input->post('examination_code'));
				if(!empty($graducatedetailsarr)){
					$graducatedata = array(						
						'grad_id'  			=> $graducatedetailsarr->user_ID,
						'graduate_name'  	=> $graducatedetailsarr->fname,
						'graduate_email'  	=> $graducatedetailsarr->email,
						'graduate_stepone' 	=> TRUE
					);
					$this->session->set_userdata($graducatedata);
					echo json_encode(['error'=>'','msg'=>'1','graducatdetails'=>$graducatedetailsarr]); exit;
				}else{
					echo json_encode(['error'=>'','msg'=>'2']); exit;
				}
			}else{
				//validation_errors();
				$errors = array(
					'name' => form_error('name', '<p class="mt-3 text-danger">', '</p>'),'email' => form_error('email', '<p class="mt-3 text-danger">', '</p>'),
					'birthday' => form_error('birthday', '<p class="mt-3 text-danger">', '</p>'),
					'examination_code' => form_error('examination_code', '<p class="mt-3 text-danger">', '</p>'),
				);
				//$errors = validation_errors();
				echo json_encode(['error'=>$errors,'msg'=>'0']); exit;
			}
		//}		
	}
	public function book_drive_test($id=false){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->get_user_Rows($user_id);
		if($details->dl_redirect == 1.0){
			$this->driver_model->updateuser(array('dl_redirect'=>1.1), $user_id);
			$details = $this->driver_model->get_user_Rows($user_id);
		}
		if($details->dl_redirect != 1.1){
			dl_redirect_url($details->dl_redirect);
		}
		$this->data = array(
			'title'=> 'Practical Examination (Driver\'s License)',
			'page_title'=> 'Practical Examination (Driver\'s License)'
			);
		$this->data['schedule'] = $this->driver_model->get_examination_schedule('dt');
		$this->load->view('include/header',$this->data);
		$this->load->view('step2/book_drive_test',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	function book_drivetest_date(){
		$es_id = $this->input->post('es_id');
		$es_id2 = $this->input->post('es_id2');
		$user_id = $this->session->userdata('user_id');
		$data = array(
			'user_id' => $user_id,
			'examination_id' => $es_id,
			'es_id2' => $es_id2,
			'booking_for' => 'dldt',
			'payment' => '0',
			'added_on' => date('Y-m-d')
		);
		
		$booked = $this->driver_model->book_exam($data);
		if($booked==true){
			$drivetestdata = array(
				'user_id' => $user_id,
				'es_id' => $es_id,
				'es_id2' => $es_id2,
				'be_id' => $booked,
				'test_for' => 'DL',
				'added_at' => date('Y-m-d H:i:s'),
			);
			$insertId = $this->driver_model->insert_record('tbl_drive_test', $drivetestdata);
			$this->driver_model->updateuser(array('dl_redirect'=>1.2), $user_id);
		
			$result['error'] = '0';
			$result['msg'] = 'success';
		}else{
			$result['error'] = '1';
			$this->session->set_flashdata('message','<div class="alert alert-danger">Something went wrong!</div>');
		}
			
		echo json_encode($result);	
	}
	public function drivetest_payment(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->get_user_Rows($user_id);
		if($details->dl_redirect != 1.2){
			dl_redirect_url($details->dl_redirect);
		}
		$this->data = array(
			'title'=> 'Practical Examination (Driver\'s License)',
			'page_title'=> 'Practical Examination (Driver\'s License)'
		);
		$this->load->model('professional/Profexam_model','profexam');
		$this->data['driver_cash_pay'] = $this->profexam->get_last_record_driver_cash_payment($user_id, ['payment_for'=>'DL','application_for'=>'DTDL']);
		$this->load->view('include/header',$this->data);
		$this->load->view('step2/drivetest_payment',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	function getprice_for_drivetest(){
		$chargeid = $_POST['chargeid'];
		$charges_for = $_POST['charges_for'];
		$data['chargesarr'] = $this->common_model->getcharges($chargeid,$charges_for);
		$charge = $data['chargesarr']->charge; 
		$settingarr = $this->common_model->get_setting('1');
		$tax = $settingarr->tax;
		$tax_amount = $charge*$tax/100; 
		echo json_encode(array('charge'=>$charge,'tax'=>$tax,'tax_amount'=>$tax_amount,'total'=>number_format($charge+$tax_amount,2)));
		exit;
	}
	public function cash_payment_DTDL(){
        if($this->input->method() == 'post'){
            $cash_payment_data = array(
                'user_id' => $this->input->post('uid'),
                'payment_for' => 'DL',
                'application_for' => 'DTDL',
                'payment_amout' => $this->input->post('amount'),
                'payment_tax' => $this->input->post('taxamt'),
                'payment_gross' => $this->input->post('total'),
                'payment_status' => 0,
                'payment_type' => 'N',
            );
			$this->load->model('professional/Profexam_model','profexam');
            $insertID = $this->profexam->save('tbl_driver_cash_payment', $cash_payment_data);
            if($insertID){
                return redirect(base_url('driver/drivetest_payment'));
            }

        }else{
            return redirect(base_url('driver/drivetest_payment'));
        }
    }

	function paypal_drivetest_payment(){
		
		$post = $this->input->post();
		if($post['submit'] == "paynow"){
			$this->form_validation->set_rules('amount', 'amount', 'trim|required');
				//$this->form_validation->set_rules('amount', 'amount', 'trim|required');
			if($this->form_validation->run() == TRUE){
					// Set variables for paypal form
				$returnURL = base_url().'driver/driver/drivetest_paymentsuccess'; //payment success url
				$cancelURL = base_url().'driver/driver/drivetest_paymentcancel'; //payment cancel url
				$notifyURL = base_url().'driver/driver/drivetest_ipn'; //ipn url
				
				// Get product data from the database
				$user = $this->driver_model->get_user_Rows($post['uid']);
				// Get current user ID from the session
				$userID = $user->user_ID; 
				$book_exam_Dtls = $this->driver_model->get_booked_exam_details($userID, 'dldt');
				$paymentdata 					= array();
				$paymentdata['user_id'] 		= $userID;
				$paymentdata['doc_refrence_id'] = $book_exam_Dtls->be_id;
				$paymentdata['txn_id'] 			= '';
				$paymentdata['payment_amout'] 	= $post['amount'];
				$paymentdata['payment_tax'] 	= $post['taxamt'];
				$paymentdata['payment_gross'] 	= $post['total'];			
				$paymentdata['payer_email'] 	= '';
				$paymentdata['payment_status'] 	= '';
				$paymentdata['currency_code'] 	= 'USD';
				$paymentdata['payment_for'] 	= 'DL';
				$paymentdata['application_for'] = 'DTDL';
				$paymentdata['payment_type'] 	= 'E';
				$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
				$lastpaymentid = $this->common_model->insert_payment($paymentdata);
				// Add fields to paypal form
				/*$this->paypal_lib->add_field('return', $returnURL);
				$this->paypal_lib->add_field('cancel_return', $cancelURL);
				$this->paypal_lib->add_field('notify_url', $notifyURL);
				$this->paypal_lib->add_field('item_name', 'Graduate Exam Booking Fee');
				$this->paypal_lib->add_field('item_number', $lastpaymentid);
				$this->paypal_lib->add_field('amount',  $post['total']);
				$this->paypal_lib->add_field('custom', $userID);		
				$this->paypal_lib->add_field('quantity' ,1);
				$this->paypal_lib->add_field('lc' ,'US');
				$this->paypal_lib->add_field('upload' ,'1');
				$this->paypal_lib->add_field('cbt' ,'Return to The Store');
				
				// Render paypal form
				$this->paypal_lib->paypal_auto_form();*/
				$paypaldata = array(
					'return' => $returnURL,
					'cancel_return' => $cancelURL,
					'notify_url' => $notifyURL,
					'item_name' => 'Booking for Drive Test',
					'item_number' => $lastpaymentid,
					'on1' => $book_exam_Dtls->be_id,
					'amount' => $post['total'],
					'custom' => $userID,
				);
				$this->custom_paypal_lib->paypal_pay(json_encode($paypaldata));
			}else{
				$this->data = array('title'=> 'Drive Test Payment','page_title'=> 'Booking for Drive Test (Driver\'s License)');
				$data['details'] = array();
				$this->load->view('include/header',$this->data);
				$this->load->view('step2/drivetest_payment',$data);
				$this->load->view('include/footer',$this->data);
			}
		}
	}
	function drivetest_paymentsuccess(){
		// Get the transaction data
		$paypalInfo = $this->input->post();
		$book_exam_id = $paypalInfo['option_name1'];
		$inumber = isset($paypalInfo['item_number1'])?$paypalInfo['item_number1']:$paypalInfo['item_number'];
		$data['txn_id'] 		= $paypalInfo["txn_id"];
		//$data['payment_amt'] 	= $paypalInfo["payment_gross"];
		$data['currency_code'] 	= $paypalInfo["mc_currency"];
		$data['payer_email'] 	= $paypalInfo["payer_email"];
		$data['payment_status'] = $paypalInfo["payment_status"];		
		$this->common_model->update_payment($data,$inumber);

		$this->drivetest_paymentsuccess_(json_encode(['item_number'=>$inumber,'book_exam_id'=>$book_exam_id]));
		
			/*$this->data = array(
				'title'=> 'Guidelines and Information on Drive Test',
				'page_title'=> 'Booking for Drive Test (Driver\'s License)'
			);
			
			$this->data['lesson'] = $this->driver_model->get_guidlines();
			$this->data['heading'] = $this->driver_model->get_heading();
			$this->load->view('include/header',$this->data);
			$this->load->view('step2/guidline',$this->data);
			$this->load->view('include/footer',$this->data);*/
		$this->drive_test_result();
	}
	public function drivetest_paymentsuccess_($json_data){
		$inumber = json_decode($json_data)->item_number;
		$book_exam_id = json_decode($json_data)->book_exam_id;

		$data['details']=$this->common_model->get_one_receipt_details($inumber);
		$bodycontentforCodeemail=$this->load->view('receipt_view_email', $data, TRUE);

		$updateexam = array('payment'=>'1');
		$upexam = $this->driver_model->update_book_exam($updateexam,$book_exam_id);

		$getuserid = $this->common_model->getuserids($inumber);	
		$graducatedetailsarr = $this->driver_model->fetch_user_details($getuserid->user_id);
		$user_id = $getuserid->user_id;

		//update tbl_drive_test.payment
		$drivetestdata = $this->driver_model->get_drive_test_data($user_id, $test_for='DL');
		$drivetestupdate = array('payment'=>1);
		$this->driver_model->update_drive_test_payment($drivetestupdate, $drivetestdata->dt_id);
		//print_r($graducatedetailsarr);exit;
		//echo '<pre>'; print_r($getuserid);die;
		//$this->session->sess_destroy();
		
		$this->driver_model->updateuser(array('dl_redirect'=>1.3), $graducatedetailsarr->user_ID);
		if($upexam){
			
			//*** count appylcaition start***//
			$logs = array(
				'application_id'	=>	$getuserid->doc_refrence_id,
				'res_id'			=>	'13',
				'subscription'		=>	$this->subs_status,
				'added_at'			=>	date('Y-m-d H:i:s')
			);
			$this->common_model->insert_onlineapplication_log($logs);
			//*** count appylcaition end***//
			/*generate qrcode */
			$examcode = $graducatedetailsarr->dl_drive_test_code;

			$qr_image = 'qrcode_'.$examcode.'.png';
			$qr_url = base_url('assets/uploads/pdf/'.$examcode.'.pdf');
			$params['data'] = $qr_url;
			$params['level'] = 'H';
			$params['size'] = 5;
			$params['savename'] = './assets/qrcode/'.$qr_image;
			$this->ciqrcode->generate($params);
			$graqrcode['dl_drive_test_qrcode'] = $qr_image;
			//$this->db->where('user_ID', $graducatedetailsarr->user_ID)->update('tbl_users', $graqrcode);
			$this->driver_model->update_code($graqrcode, array('user_id'=>$graducatedetailsarr->user_ID));
			
			// Genrate PDF start
			//$html = ob_get_clean();
			$html = $this->get_dl_drive_test_passpdf($getuserid->user_id, $book_exam_id);
			// Get output html
			$html.= $this->output->get_output();
			//print_r($html);die;
			$this->load->library('Pdf');
			$this->dompdf = new DOMPDF();
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper('A4','portrait');
			$this->dompdf->render();
			
			file_put_contents('assets/uploads/pdf/'.$graducatedetailsarr->dl_drive_test_code.'.pdf', $this->dompdf->output($html));
			//$this->dompdf->stream("school.pdf",array('Attachment'=>0));
			// Genrate PDF End
		}
		$userid = $getuserid->user_id;
		$userdetails = $this->driver_model->fetch_user_details($getuserid->user_id);
			$search_link = '<a href="'.base_url('driver/driveTestPass/'.base64_encode($user_id)).'">Click here</a>';
			$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your Drive Test has been booked successfully.<br><br>In this regard, you can use your Refrence Code : '.$userdetails->dl_refrence_code.' to learn the Guidline and get the EXAM PASS.<br>Please <b style="color: blue;">'.$search_link.'</b> to view and download your exam pass.<br><br>Should you have questions just message us and we would Be happy to assist you.</p>';
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => SMTP_HOSTNAME,
				'smtp_port' => SMTP_PORT,
				'smtp_user' => SENT_EMAIL_FROM,
				'smtp_pass' => SENT_EMAIL_PASSWORD,
				'mailtype'  => 'html', 
				'newline'   => "\r\n",
				'AuthType'   => "XOAUTH2",
				'charset'   => 'iso-8859-1',
			);  
				
			$this->load->library('email');
			if($userdetails){
				$settingarr = $this->common_model->get_setting('1');
				//send refrence code 
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($userdetails->email);
				$this->email->subject('Drive Test booked successfully.');
				$emailbody = array();
				$emailbody['name'] 			= $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name;
				$emailbody['thanksname'] 	= $settingarr->signature_name;
				$emailbody['thanks2'] 		= '';
				$emailbody['thanks3'] 		= $settingarr->position;
				$emailbody['body_msg'] 	= $bodycontentforCode;
				$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				if(isset($graducatedetailsarr->dl_drive_test_code) && file_exists('assets/uploads/pdf/'.$graducatedetailsarr->dl_drive_test_code.'.pdf')){
					$this->email->attach(base_url('assets/uploads/pdf/'.$graducatedetailsarr->dl_drive_test_code.'.pdf'));
				}
				$this->email->send();

				//2nd email
				$this->email->clear(TRUE);
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($userdetails->email);
				$this->email->subject('Payment_Receipt');
				$emailbody = array();
				$emailbody['name'] 			= $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name;
				$emailbody['thanksname'] 	= $settingarr->signature_name;
				$emailbody['thanks2'] 		= '';
				$emailbody['thanks3'] 		= $settingarr->position;
				$emailbody['body_msg'] 	= $bodycontentforCodeemail;
				$emailmessage = $this->load->view('emailer_receipt', $emailbody,  TRUE);
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				$this->email->send();
				
				//insert notification
				$updatenotification 				= array();
				$updatenotification['user_id'] 		= $userdetails->user_ID;
				$updatenotification['subject'] 		= 'Drive Test booked successfully.';
				$updatenotification['message'] 		= $bodycontentforCode;
				$updatenotification['from'] 		= SENDER_NAME;
				$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
				$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
				$this->driver_model->insertnotifications($updatenotification);
				
			// }
			}
			$graducate = array(						
				'user_id'			=> $graducatedetailsarr->user_ID,
				'fname'				=> $graducatedetailsarr->fname,
				'lname'				=> $graducatedetailsarr->lname,
				'name'  			=> $graducatedetailsarr->name,
				'email'  			=> $graducatedetailsarr->email,
				'image'  			=> $graducatedetailsarr->image,
				'userlogin'			=> TRUE,
			);
			$this->session->set_userdata($graducate);
	}
	function drivetest_paymentcancel(){
		$this->data = array( 'title'  => 'Payment Cancel','page_title'=> 'Booking for Online Licensure Examination (LOCAL GRADUATES)');
		redirect('graduates/graduates/drive_test',$this->data);
	}

	function drivetest_ipn(){

	}
	public function updateuser_DL_DTDL(){
        if($this->session->userdata('userlogin')){
            $user_id = $this->session->userdata('user_id');
            $this->driver_model->updatereferencecode(['dl_redirect'=>1.3], $user_id);
            return redirect(base_url('driver/drive_test_result'));
        }else{
            return redirect('/');
        }
    }

	//booking for drive test end
	public function drive_test_guidline(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->get_user_Rows($user_id);
		if($details->dl_redirect != 3.3){
			dl_redirect_url($details->dl_redirect);
		}
		$this->data = array(
			'title'=> 'Guidelines and Information on Drive Test',
			'page_title'=> 'Booking for Drive Test (Driver\'s License)'
		);
		
		$this->data['lesson'] = $this->driver_model->get_guidlines();
		$this->data['heading'] = $this->driver_model->get_heading();
		$this->load->view('include/header',$this->data);
		$this->load->view('drive_test/guidline',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function drive_test_pass(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->get_user_Rows($user_id);
		if($details->dl_redirect == 3.3){
			$this->driver_model->updateuser(array('dl_redirect'=>3.4), $user_id);
			$details = $this->driver_model->get_user_Rows($user_id);
		}
		if($details->dl_redirect != 3.4){
			dl_redirect_url($details->dl_redirect);
		}
		$this->data = array('title'=> 'Drive Test Pass','page_title'=> 'Booking for Drive Test (Driver\'s License)');
		$this->data['profes_details'] = $this->driver_model->fetch_user_details_exam_pass($user_id);
		//$this->data['exam_details'] = $this->common_model->is_pexam_booked(base64_decode($uid));
		$this->load->view('include/header',$this->data);
		$this->load->view('drive_test/drivetest_pass',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function driveTestPass($user_id){ //for search
		$user_id = base64_decode($user_id);
		$this->data = array('title'=> 'Drive Test Pass','page_title'=> 'Booking for Drive Test (Driver\'s License)');
		$this->data['profes_details'] = $this->driver_model->fetch_user_details_exam_pass($user_id);
		//$this->data['exam_details'] = $this->common_model->is_pexam_booked(base64_decode($uid));
		$this->load->view('include/header',$this->data);
		$this->load->view('drive_test/drivetest_pass',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function drive_test_result(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->get_user_Rows($user_id);
		/*if($details->dl_redirect == 1.3){
			$this->driver_model->updateuser(array('dl_redirect'=>1.3), $user_id);
			$details = $this->driver_model->get_user_Rows($user_id);
		}*/
		if($details->dl_redirect != 1.3){
			dl_redirect_url($details->dl_redirect);
		}
		$this->data = array(
			'title'=> 'Practical Examination (Driver\'s License)',
			'page_title'=> 'Drive Test Result'
		);
		//$this->data['result'] = $this->driver_model->graduateresult(base64_decode($uid));
		$this->data['examresult'] = $this->driver_model->get_drive_test_data($user_id, $test_for='DL');
		$this->data['lessonguide'] = $this->driver_model->get_lesson_guide();
		$this->data['examDtls'] = $this->driver_model->get_booked_exam_details2($this->data['examresult']->es_id,$this->data['examresult']->es_id2);
		$this->data['userDtls'] = $this->driver_model->fetch_user_details($user_id);
		$this->load->view('include/header',$this->data);
		$this->load->view('step2/drive_test_result',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function uplpr(){ //update Driver License redirect
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$this->driver_model->updateuser(array('dl_redirect'=>3.0), $user_id);
		return redirect(base_url('driver/drive_test'));
	}
	public function driver_license(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->get_user_Rows($user_id);
		if($details->dl_redirect == 1.3){
			$this->driver_model->updateuser(array('dl_redirect'=>2.0), $user_id);
			$details = $this->driver_model->get_user_Rows($user_id);
		}
		if($details->dl_redirect != 2.0){
			dl_redirect_url($details->dl_redirect);
		}
		$this->data = array('title'=> 'Application for Digital Driver\'s License and Card','page_title'=> 'Application for Digital Driver\'s License and Card');
		$this->data['details'] = $this->driver_model->fetch_user_details($user_id);
		$this->load->view('include/header',$this->data);
		//$this->load->view('drive_test/driver_license',$this->data);
		$this->load->view('step3/driver_information',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function verify_registration_no(){
		$output = array('error' => false);	
		$msg = 0;	
		//echo '<pre>'; print_r($_POST); exit;
		//if($this->input->post('submit')=='submit'){
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lname', 'Middle Name', 'trim|required');
		$this->form_validation->set_rules('name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('birthday', 'Birthday', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('drive_inspection_code', 'Registration No', 'trim|required');			
		//$this->form_validation->set_rules('college_logo', 'college logo', 'required');
		if($this->form_validation->run() == TRUE){
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$birthday = $this->input->post('birthday');
			$gender = $this->input->post('gender');
			$reg_no = $this->input->post('drive_inspection_code');
			$usersdetailsarr = $this->driver_model->verify_reg_no($fname,$lname,$name,$email,$birthday,$gender,$reg_no);
			if(!empty($usersdetailsarr)){
				/* $graducatedata = array(						
					'grad_id'  			=> $graducatedetailsarr->user_ID,
					'graduate_name'  	=> $graducatedetailsarr->fname,
					'graduate_email'  	=> $graducatedetailsarr->email,
					'graduate_stepone' 	=> TRUE
				);
				$this->session->set_userdata($graducatedata);*/
				echo json_encode(['error'=>'','msg'=>'1','userdetails'=>$usersdetailsarr]); exit;
			}else{
				echo json_encode(['error'=>'','msg'=>'2']); exit;
			}
		}else{
			//validation_errors();
			$errors = array(
				'fname' => form_error('fname', '<p class="mt-3 text-danger">', '</p>'),
				'lname' => form_error('lname', '<p class="mt-3 text-danger">', '</p>'),
				'name' => form_error('name', '<p class="mt-3 text-danger">', '</p>'),
				'email' => form_error('email', '<p class="mt-3 text-danger">', '</p>'),
				'birthday' => form_error('birthday', '<p class="mt-3 text-danger">', '</p>'),
				'gender' => form_error('gender', '<p class="mt-3 text-danger">', '</p>'),
				'drive_inspection_code' => form_error('drive_inspection_code', '<p class="mt-3 text-danger">', '</p>'),
			);
			//$errors = validation_errors();
			echo json_encode(['error'=>$errors,'msg'=>'0']); exit;
		}
		//}		
	}
	public function upload_doc_for_dl(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		if($this->input->method() == 'post'){
			$add = array();
			$upsert = '';
			if(isset($_FILES["doc1"]) && !empty($_FILES["doc1"]['name'])){
				$config1['upload_path'] = './assets/uploads/document/';	
				$config1['allowed_types'] = 'gif|jpg|png|jpeg';       
				$ext = explode('.',$_FILES["doc1"]["name"]);        
				$imageName = 'doc1_'.time().'.'.end($ext);
				$config1['file_name'] = $imageName;
				$this->upload->initialize($config1);

				if ( ! $this->upload->do_upload('doc1')) { 
					$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} 
				$add['doc1'] = $imageName; 
			}
			if(isset($_FILES["doc2"]) && !empty($_FILES["doc2"]['name'])){
				$config1['upload_path'] = './assets/uploads/document/';	
				$config1['allowed_types'] = 'gif|jpg|png|jpeg';       
				$ext = explode('.',$_FILES["doc2"]["name"]);        
				$imageName = 'doc2_'.time().'.'.end($ext);
				$config1['file_name'] = $imageName;
				$this->upload->initialize($config1);

				if ( ! $this->upload->do_upload('doc2')) { 
					$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} 
				$add['doc2'] = $imageName; 
			}
			if(isset($_FILES["doc3"]) && !empty($_FILES["doc3"]['name'])){
				$config1['upload_path'] = './assets/uploads/document/';	
				$config1['allowed_types'] = 'gif|jpg|png|jpeg';       
				$ext = explode('.',$_FILES["doc3"]["name"]);        
				$imageName = 'doc3_'.time().'.'.end($ext);
				$config1['file_name'] = $imageName;
				$this->upload->initialize($config1);

				if ( ! $this->upload->do_upload('doc3')) { 
					$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} 
				$add['doc3'] = $imageName; 
			}
			if(!empty($add)){
				$add['user_id'] = $user_id;
				$add['doc_added_at'] = date('Y-m-d');
				$doc_photo_id = $this->input->post('doc_photo_id');
				if($doc_photo_id){
					$upsert = $this->driver_model->update('tbl_driver_doc_photo',$add,'doc_photo_id',$doc_photo_id);
				}else{
					$upsert = $this->driver_model->insert_record('tbl_driver_doc_photo',$add);
				}
				if($upsert){
					$this->driver_model->updateuser(array('dl_redirect'=>2.2), $user_id);
					$this->session->set_flashdata('message','<div class="alert alert-success">Document Uploaded Successfully.</div>');
					
				}

			}
			return redirect(base_url('driver/book_picture_taking'));
		}
		
		$details = $this->driver_model->get_user_Rows($user_id);
		if($details->dl_redirect == 2.0){
			$this->driver_model->updateuser(array('dl_redirect'=>2.1), $user_id);
			$details = $this->driver_model->get_user_Rows($user_id);
		}
		if($details->dl_redirect != 2.1){
			dl_redirect_url($details->dl_redirect);
		}
		$document = $this->driver_model->get_driver_doc_photo($user_id);
		 
		$this->data = array('title'=> 'Application for Digital Driver\'s License and Card','page_title'=> 'Application for Digital Driver\'s License and Card');
		if(!empty($document)){
			$this->data['doc'] = $document;
		}
		$this->load->view('include/header',$this->data);
		$this->load->view('step3/upload_documents',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function book_picture_taking(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->get_user_Rows($user_id);
		/*if($details->dl_redirect == 2.1){
			$this->driver_model->updateuser(array('dl_redirect'=>2.2), $user_id);
			$details = $this->driver_model->get_user_Rows($user_id);
		}*/
		if($details->dl_redirect != 2.2){
			dl_redirect_url($details->dl_redirect);
		}
		$this->data = array(
			'title'=> 'Application for Digital Driver\'s License and Card',
			'page_title'=> 'Booking for Picture Taking'
		);
		$this->load->view('include/header',$this->data);
		$this->load->view('step3/book_picture_take',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	/*public function get_examination_schedule(){
		$examschedule = $this->driver_model->get_examination_schedule('pt');
		if(!empty($examschedule)){
			foreach($examschedule as $list){
				$schedule[] = array(
					'month' => date('n',strtotime($list->date)),
					'day' => date('j',strtotime($list->date)),
					'year' => date('Y',strtotime($list->date)),
					'es_id' => $list->es_id,
					'title' => $list->name_of_exam,
					'venue' => $list->venue,
					'start_time' => $list->start_time,
					'end_time' => $list->end_time,
				);
			}
			$data['events'] = $schedule;
			//$data['result'] = 'success';
		}else{
			$data['result'] = 'fail';
		}
		echo json_encode($data);
		exit;
	}*/
	public function book_picture_taking_schedule(){
		if(!login()){
			return redirect(base_url());
		}
		$es_id = $this->input->post('es_id');
		$es_id2 = $this->input->post('es_id2');
		//$data['es_id'] = $es_id;
		//$data['es_id2'] = $es_id2;
		//echo json_encode($data); exit;
		$user_id = $this->session->userdata('user_id');
		//insert data into tbl_book_exam
		$data = array(
			'user_id' => $user_id,
			'examination_id' => $es_id,
			'es_id2' => $es_id2,
			'booking_for' => 'pt',
			'payment' => '0',
			'added_on' => date('Y-m-d')
		);
		$be_id = $this->driver_model->book_exam($data);
		/*$book_exam_data = array(
			'uid' => $user_id,
			'id' => $es_id,
		);
		$be_id = $this->driver_model->add_exam_date($book_exam_data, 'pt'); */

		//update data into tbl_driver_doc_photo
		$document = $this->driver_model->get_driver_doc_photo($user_id);
		$driver_doc_photo_data = array(
			'es_id' => $es_id,
			'es_id2' => $es_id2,
			'be_id' => $be_id,
		);
		$update = $this->driver_model->update('tbl_driver_doc_photo', $driver_doc_photo_data, 'doc_photo_id', $document->doc_photo_id);
		/*$add = array(
			'user_id' => $user_id,
			'es_id' => $es_id,
			'es_id2' => $es_id2,
			'be_id' => $be_id,
		);
		$insert = $this->driver_model->insert_record('tbl_driver_doc_photo',$add); */
		
		if($update){
			//update redirect
			$this->driver_model->updateuser(array('dl_redirect'=>2.3), $user_id);
			//redirect(base_url('driver/picture_taking_payment'));
			$result['error'] = '0';
			$result['msg'] = 'success';
		}else{
			//redirect(base_url('driver/book_picture_taking'));
			$result['error'] = '1';
			$this->session->set_flashdata('message','<div class="alert alert-danger">Something went wrong!</div>');
		}
		echo json_encode($result);

	}
	public function picture_taking_payment(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->get_user_Rows($user_id);
		if($details->dl_redirect != 2.3){
			dl_redirect_url($details->dl_redirect);
		}
		$this->load->model('professional/Profexam_model','profexam');
		$this->data = array('title'=> 'Application for Digital Driver\'s License and Card','page_title'=> 'Payment');
		$this->data['driver_cash_pay'] = $this->profexam->get_last_record_driver_cash_payment($user_id, ['payment_for'=>'DL','application_for'=>'PT']);
		$this->load->view('include/header',$this->data);
		$this->load->view('step3/pt_payment',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function cash_payment_PT(){
		if($this->input->method() == 'post'){
			$this->load->model('professional/Profexam_model','profexam');
            $cash_payment_data = array(
                'user_id' => $this->input->post('uid'),
                'payment_for' => 'DL',
                'application_for' => 'PT',
                'payment_amout' => $this->input->post('amount'),
                'payment_tax' => $this->input->post('taxamt'),
                'payment_gross' => $this->input->post('total'),
                'payment_status' => 0,
                'payment_type' => 'N',
            );
            $insertID = $this->profexam->save('tbl_driver_cash_payment', $cash_payment_data);
            if($insertID){
                return redirect(base_url('driver/picture_taking_payment'));
            }

        }else{
            return redirect(base_url('driver/picture_taking_payment'));
        }

	}
	public function paypal_pt_payment(){
		$post = $this->input->post();
		$user_id = $this->session->userdata('user_id');
		if($post['submit'] == "paynow"){
			$this->form_validation->set_rules('amount', 'amount', 'trim|required');
				//$this->form_validation->set_rules('amount', 'amount', 'trim|required');
			if($this->form_validation->run() == TRUE){
					// Set variables for paypal form
				$returnURL = base_url().'driver/driver/pt_paymentsuccess'; //payment success url
				$cancelURL = base_url().'driver/driver/pt_paymentcancel'; //payment cancel url
				$notifyURL = base_url().'driver/driver/pt_ipn'; //ipn url

				$document = $this->driver_model->get_driver_doc_photo($user_id);
				$paymentdata 					= array();
				$paymentdata['user_id'] 		= $user_id;
				$paymentdata['doc_refrence_id'] = $document->doc_photo_id;
				$paymentdata['txn_id'] 			= '';
				$paymentdata['payment_amout'] 	= $post['amount'];
				$paymentdata['payment_tax'] 	= $post['taxamt'];
				$paymentdata['payment_gross'] 	= $post['total'];			
				$paymentdata['payer_email'] 	= '';
				$paymentdata['payment_status'] 	= '';
				$paymentdata['currency_code'] 	= 'USD';
				$paymentdata['payment_for'] 	= 'DL';
				$paymentdata['application_for'] = 'PT';
				$paymentdata['payment_type'] 	= 'E';
				$paymentdata['payment_date'] 	= date('Y-m-d H:i:s');
				$lastpaymentid = $this->common_model->insert_payment($paymentdata);
				// Add fields to paypal form
				/*$this->paypal_lib->add_field('return', $returnURL);
				$this->paypal_lib->add_field('cancel_return', $cancelURL);
				$this->paypal_lib->add_field('notify_url', $notifyURL);
				$this->paypal_lib->add_field('item_name', 'Graduate Exam Booking Fee');
				$this->paypal_lib->add_field('item_number', $lastpaymentid);
				$this->paypal_lib->add_field('amount',  $post['total']);
				$this->paypal_lib->add_field('custom', $userID);		
				$this->paypal_lib->add_field('quantity' ,1);
				$this->paypal_lib->add_field('lc' ,'US');
				$this->paypal_lib->add_field('upload' ,'1');
				$this->paypal_lib->add_field('cbt' ,'Return to The Store');
				
				// Render paypal form
				$this->paypal_lib->paypal_auto_form();*/
				$paypaldata = array(
					'return' => $returnURL,
					'cancel_return' => $cancelURL,
					'notify_url' => $notifyURL,
					'item_name' => 'Booking for Photo Taking',
					'item_number' => $lastpaymentid,
					'on1' => $document->doc_photo_id,
					'amount' => $post['total'],
					'custom' => $user_id,
				);
				$this->custom_paypal_lib->paypal_pay(json_encode($paypaldata));
			}else{
				$this->data = array('title'=> 'Driver\'s License','page_title'=> 'Payment');
				$this->load->view('include/header',$this->data);
				$this->load->view('step3/pt_payment',$this->data);
				$this->load->view('include/footer',$this->data);
			}
		}

	}
	public function pt_paymentsuccess(){
		// Get the transaction data
		$paypalInfo = $this->input->post();
		$doc_photo_id = $paypalInfo['option_name1'];
		$user_id = $paypalInfo['custom'];
		$inumber = isset($paypalInfo['item_number1'])?$paypalInfo['item_number1']:$paypalInfo['item_number'];
		$data['txn_id'] 		= $paypalInfo["txn_id"];
		//$data['payment_amt'] 	= $paypalInfo["payment_gross"];
		$data['currency_code'] 	= $paypalInfo["mc_currency"];
		$data['payer_email'] 	= $paypalInfo["payer_email"];
		$data['payment_status'] = $paypalInfo["payment_status"];		
		$this->common_model->update_payment($data,$inumber);

		$this->pt_paymentsuccess_(json_encode(['item_number'=>$inumber,'doc_photo_id'=>$doc_photo_id]));
		
		$this->data = array(
			'title'=> 'Driver\'s License',
			'page_title'=> 'Picture Taking Pass'
		);
		
		//$this->data['lesson'] = $this->driver_model->get_guidlines();
		//$this->data['heading'] = $this->driver_model->get_heading();
		$this->data['doc_details'] = $this->driver_model->get_one_record('tbl_driver_doc_photo', ['doc_photo_id'=>$doc_photo_id]);
		$this->load->view('include/header',$this->data);
		$this->load->view('step3/pt_pass',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function pt_paymentsuccess_($json_data){
		$inumber = json_decode($json_data)->item_number;
		$doc_photo_id = json_decode($json_data)->doc_photo_id;
		$getuserid = $this->common_model->getuserids($inumber);
		$user_id = $getuserid->user_id;
		$data['details']=$this->common_model->get_one_receipt_details($inumber);
		$bodycontentforCodeemail=$this->load->view('receipt_view_email', $data, TRUE);

		$book_exam_id = $this->driver_model->get_booked_exam_details($user_id, 'pt')->be_id;
		$updateexam = array('payment'=>'1');
		$upexam = $this->driver_model->update_book_exam($updateexam,$book_exam_id);

		$graducatedetailsarr = $this->driver_model->fetch_user_details($user_id);
		//$user_id = $getuserid->user_id;

		//update driver_doc_photo
		$bytes 	= random_bytes(3); 
		$refcode 	= bin2hex($bytes);
		$PTCode = 'PTC-'.$user_id.$refcode.'-'.date('Y');
		
		//print_r($graducatedetailsarr);exit;
		//echo '<pre>'; print_r($getuserid);die;
		//$this->session->sess_destroy();
		
		$this->driver_model->updateuser(array('dl_redirect'=>2.4), $user_id);
		//$getuserid = $this->common_model->getuserids($inumber);
		if($upexam){
			
			//*** count appylcaition start***//
			$logs = array(
				'application_id'	=>	$getuserid->doc_refrence_id,
				'res_id'			=>	'13',
				'subscription'		=>	$this->subs_status,
				'added_at'			=>	date('Y-m-d H:i:s')
			);
			$this->common_model->insert_onlineapplication_log($logs);
			//*** count appylcaition end***//
			/*generate qrcode */
			

			$qr_image = 'qrcode_'.$PTCode.'.png';
			$qr_url = base_url('assets/uploads/pdf/'.$PTCode.'.pdf');
			$params['data'] = $qr_url;
			$params['level'] = 'H';
			$params['size'] = 5;
			$params['savename'] = './assets/qrcode/'.$qr_image;
			$this->ciqrcode->generate($params);

			$docphotodata = array('payment'=>'1', 'pt_code'=>$PTCode, 'pt_code_qr'=>$qr_image);
			$this->driver_model->update('tbl_driver_doc_photo', $docphotodata, 'doc_photo_id', $doc_photo_id);
			
			// Genrate PDF start
			//$html = ob_get_clean();
			$html = $this->get_pt_passpdf($doc_photo_id);
			// Get output html
			$html.= $this->output->get_output();
			//print_r($html);die;
			$this->load->library('Pdf');
			$this->dompdf = new DOMPDF();
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper('A4','portrait');
			$this->dompdf->render();
			
			file_put_contents('assets/uploads/pdf/'.$PTCode.'.pdf', $this->dompdf->output($html));
			//$this->dompdf->stream("school.pdf",array('Attachment'=>0));
			// Genrate PDF End
		}
		$userid = $getuserid->user_id;
		$userdetails = $this->driver_model->fetch_user_details($getuserid->user_id);
			$search_link = '<a href="'.base_url('driver/'.base64_encode($user_id)).'">Click here</a>';
			$bodycontentforCode = '<p style="font-size: 12px; margin-bottom:10px; color:rgba(0,0,0,.8);line-height: 18px;">Greetings!<br><br>Your Picture Taking has been booked successfully.<br><br>In this regard, you can use your Picture Taking Code : '.$PTCode.' Picture Taking Pass.<br>Please <b style="color: blue;">'.$search_link.'</b> to view and download your Picture taking pass.<br><br>Should you have questions just message us and we would Be happy to assist you.</p>';
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => SMTP_HOSTNAME,
				'smtp_port' => SMTP_PORT,
				'smtp_user' => SENT_EMAIL_FROM,
				'smtp_pass' => SENT_EMAIL_PASSWORD,
				'mailtype'  => 'html', 
				'newline'   => "\r\n",
				'AuthType'   => "XOAUTH2",
				'charset'   => 'iso-8859-1',
			);  
				
			$this->load->library('email');
			if($userdetails){
				$settingarr = $this->common_model->get_setting('1');
				//send refrence code 
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($userdetails->email);
				$this->email->subject('Picture Taking booked successfully.');
				$emailbody = array();
				$emailbody['name'] 			= $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name;
				$emailbody['thanksname'] 	= $settingarr->signature_name;
				$emailbody['thanks2'] 		= '';
				$emailbody['thanks3'] 		= $settingarr->position;
				$emailbody['body_msg'] 	= $bodycontentforCode;
				$emailmessage = $this->load->view('emailer', $emailbody,  TRUE);
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				/*if(isset($graducatedetailsarr->dl_drive_test_code) && file_exists('assets/uploads/pdf/'.$graducatedetailsarr->dl_drive_test_code.'.pdf')){
					$this->email->attach(base_url('assets/uploads/pdf/'.$graducatedetailsarr->dl_drive_test_code.'.pdf'));
				}*/
				$this->email->send();

				//2nd email
				$this->email->clear(TRUE);
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from(SENT_EMAIL_FROM, SENDER_NAME);
				$this->email->to($userdetails->email);
				$this->email->subject('Payment_Receipt');
				$emailbody = array();
				$emailbody['name'] 			= $userdetails->fname.' '.$userdetails->lname.' '.$userdetails->name;
				$emailbody['thanksname'] 	= $settingarr->signature_name;
				$emailbody['thanks2'] 		= '';
				$emailbody['thanks3'] 		= $settingarr->position;
				$emailbody['body_msg'] 	= $bodycontentforCodeemail;
				$emailmessage = $this->load->view('emailer_receipt', $emailbody,  TRUE);
				//$this->email->message('Testing the email class.');
				$this->email->message($emailmessage);
				$this->email->send();
				
				//insert notification
				$updatenotification 				= array();
				$updatenotification['user_id'] 		= $userdetails->user_ID;
				$updatenotification['subject'] 		= 'Picture Taking booked successfully.';
				$updatenotification['message'] 		= $bodycontentforCode;
				$updatenotification['from'] 		= SENDER_NAME;
				$updatenotification['from_email'] 	= SENT_EMAIL_FROM;
				$updatenotification['sent_at'] 		= date('Y-m-d H:i:s');
				$this->driver_model->insertnotifications($updatenotification);
				
			// }
			}
			$graducate = array(						
				'user_id'			=> $userdetails->user_ID,
				'fname'				=> $userdetails->fname,
				'lname'				=> $userdetails->lname,
				'name'  			=> $userdetails->name,
				'email'  			=> $userdetails->email,
				'image'  			=> $userdetails->image,
				'userlogin'			=> TRUE,
			);
			$this->session->set_userdata($graducate);
	}
	public function pt_paymentcancel(){
		return redirect(base_url('driver/picture_taking_payment'));
	}
	public function pt_ipn(){
		return redirect(base_url('driver/picture_taking_payment'));
	}
	public function update_user_DL_PT(){
        if($this->session->userdata('userlogin')){
            $user_id = $this->session->userdata('user_id');
            $this->driver_model->updatereferencecode(['dl_redirect'=>2.4], $user_id);
            return redirect(base_url('driver/ptpass'));
        }else{
            return redirect('/');
        }
    }

	public function ptpass(){
		/* Genrate PDF start
			//$html = ob_get_clean();
			$html = $this->get_pt_passpdf(2);
			// Get output html
			$html.= $this->output->get_output();
			//print_r($html);die;
			$this->load->library('Pdf');
			$this->dompdf = new DOMPDF();
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper('A4','portrait');
			$this->dompdf->render();
			
			//file_put_contents('assets/uploads/pdf/'.$PTCode.'.pdf', $this->dompdf->output($html));
			$this->dompdf->stream("school.pdf",array('Attachment'=>0));
			// Genrate PDF End 
		*/
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->get_user_Rows($user_id);
		if($details->dl_redirect != 2.4){
			dl_redirect_url($details->dl_redirect);
		}
		$this->data = array(
			'title'=> 'Application for Digital Driver\'s License and Card',
			'page_title'=> 'Picture Taking Pass'
		);
		$this->data['doc_details'] = $this->driver_model->get_one_driver_doc_photo_data($user_id);
		//$this->data['lesson'] = $this->driver_model->get_guidlines();
		//$this->data['heading'] = $this->driver_model->get_heading();
		$this->load->view('include/header',$this->data);
		$this->load->view('step3/pt_pass',$this->data);
		$this->load->view('include/footer',$this->data);
	}
	public function driver_license_card(){
		if(!login()){
			return redirect(base_url());
		}
		$user_id = $this->session->userdata('user_id');
		$details = $this->driver_model->get_user_Rows($user_id);
		if($details->dl_redirect == 2.4){
			$this->driver_model->updateuser(array('dl_redirect'=>2.5), $user_id);
			$details = $this->driver_model->get_user_Rows($user_id);
		}
		if($details->dl_redirect != 2.5){
			dl_redirect_url($details->dl_redirect);
		}
		$this->data = array('title'=> 'Application for Digital Driver\'s License and Card','page_title'=> 'Application for Digital Driver\'s License and Card');
		$this->data['details'] = $this->driver_model->fetch_user_details($user_id);
		$this->load->view('include/header',$this->data);
		$this->load->view('step3/driver_license',$this->data);
		//$this->load->view('step3/driver_information',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function eligibility($uid){
		$this->data = array('title'=> 'Eligibility Certificate','page_title'=> 'Booking for Online Licensure Examination (LOCAL GRADUATES)');
		$this->data['profes_details'] = $this->driver_model->fetch_user_details(base64_decode($uid));

		$this->load->view('include/header',$this->data);
		$this->load->view('eligibility',$this->data);
		$this->load->view('include/footer',$this->data);
	}

	public function getexampasspdf($uid, $booked_id)
	{
		$data['profes_details'] = $this->driver_model->fetch_user_details_exam_pass($uid);
		//print_r($data['profes_details']); 
		$data['exam_details'] = $this->driver_model->get_exam_details_for_pdf($booked_id);
		//print_r($data['exam_details']); exit;
		$result = $this->load->view('professional/include/gradexam_pass_preview',$data, TRUE);
		return $result;
	}
	public function get_dl_drive_test_passpdf($uid, $booked_id)
	{
		$data['profes_details'] = $this->driver_model->fetch_user_details_exam_pass($uid);
		//print_r($data['profes_details']); 
		$data['exam_details'] = $this->driver_model->get_exam_details_for_pdf($booked_id);
		//print_r($data['exam_details']); exit;
		$result = $this->load->view('driver/pdfhtml/dl_drivetest_pass_pdf',$data, TRUE);
		return $result;
	}
	public function get_pt_passpdf($doc_photo_id)
	{
		$data['profes_details'] = $this->driver_model->fetch_user_details_pt_pass($doc_photo_id);

		$result = $this->load->view('driver/pdfhtml/pt_pass_pdf',$data, TRUE);
		return $result;
	}
}

?>