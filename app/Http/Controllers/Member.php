<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Services\CartService;
use App\Models\Common_model;

class Member extends Controller
{
    private $commonmodel;
    private $cart;
    public function __construct(CartService $cart){
        $this->commonmodel = new Common_model;
        $this->cart = $cart;
    }
    public function login(Request $request){
        $data = [];
        if($request->isMethod('POST')){
            $validated = $this->validate($request, [
                'email' => 'required|email|exists:tbl_member,email',
                'password' => 'required|min:5|max:12',
            ],
            [
                'email.required' => 'Email is required',
                'email.exists' => 'This email is not registered on our service',
                'password.required' => 'Password is required',
                'password.min' => 'Password must have atleast 5 characters in length',
                'password.max' => 'Password must not have more than 12 characters in length',
            ]);
            if($validated){
                // print_r($_POST); exit;

                $email = $request->input('email');
                $password = $request->input('password');
                $member_info = $this->commonmodel->crudOperation('R1','tbl_member','',['email'=>$email]);
                // echo '<pre>';print_r($member_info); echo $member_info->name;exit;
                if($member_info->status < 1){
                    $request->session()->flash('err', 'Inactive member!');
                    return redirect()->to('member-login')->withinput();
                }
                $check_password = Hash::check($password, $member_info->password);
                if(!$check_password){
                    $request->session()->flash('err', 'Incorrect Password!');
                    return redirect()->to('member-login')->withinput();
                }else{
                    $sessionData = array(
                        'm_id' => $member_info->m_id,
                        'name' => $member_info->name,
                        'email' => $member_info->email,
                        'phone' => $member_info->phone,
                        'address' => $member_info->address,
                        'image' => $member_info->image,
                        'privilege_id' => $member_info->privilege_id,
                        'status' => $member_info->status,
                        'memberLogin' => true,
                    );
                    $request->session()->put($sessionData);
                    return redirect()->to('member-dashboard');
                }
            }
        }
        return view('member.member_login',$data);
    }
    public function register(Request $request){
        $data = $post = [];
        if ($request->isMethod('POST')){
            $validation = $this->validate($request, [
                'name' =>'required',
                'email' =>'required|email|unique:tbl_member,email',
                'password' =>'required|min:5|max:12',
                'cpassword' =>'required|min:5|same:password',
                ],[
                    'name.required'=>'The full name is required',
                    'email.email'=>'Enter a valid email address',
                    'cpassword.same' => 'confirm password must match password',
            ]);
            if($validation){
                $post['name'] = $request->input('name');
                $post['email'] = $request->input('email');
                $password = $request->input('cpassword');
                $post['password'] = Hash::make($password,['rounds'=>12,]);
                $post['ip_address'] = $request->ip();
                $post['status'] = 1;
                $inserted = $this->commonmodel->crudOperation('C','tbl_member',$post);
                if($inserted){
                    return redirect()->to(url('/member-login'))->with('msg', 'Thank you for sign up.');
                }else{
                    return redirect()->to(url('/member-login'))->with('err', 'Something went wrong! Please try again...');
                }
            }
        }
        return view('member.member_register',$data);
    }
    public function dashboard(){
        $data['ODplaced'] = $this->commonmodel->getCountRecord('tbl_product_order', [['m_id','=',session('m_id')],['status','=',1]]);
        $data['ODshipped'] = $this->commonmodel->getCountRecord('tbl_product_order', [['m_id','=',session('m_id')],['status','=',2]]);
        $data['ODdlvd'] = $this->commonmodel->getCountRecord('tbl_product_order', [['m_id','=',session('m_id')],['status','=',3]]);
        $data['ODcanceled'] = $this->commonmodel->getCountRecord('tbl_product_order', [['m_id','=',session('m_id')],['status','=',4]]);
        $data['PCourses'] = $this->commonmodel->getCountRecord('tbl_purchased_course', [['m_id','=',session('m_id')]]);

        return view('member.dashboard', $data);
    }
    public function orders(){
        
        $data['orders'] = $this->commonmodel->crudOperation('RA','tbl_product_order','',['m_id'=>session('m_id')],['id','DESC']);
        return view('member.orders', $data);
    }
    public function courses(){
        
        $data['courses'] = $this->commonmodel->get_purchased_courses();
        return view('member.courses', $data);
    }
    public function course_video($id){
        
        $data['course'] = $this->commonmodel->get_purchased_courses($id);
        return view('member.course-video', $data);
    }
    public function addresses(Request $request, $id=null){
        $data = $post = [];
        if ($request->isMethod('POST')){
            $validation = $this->validate($request, [
                'name' =>'required',
                'phone' =>'required',
                'address' =>'required',
                ]);
            if($validation){
                $post['m_id'] = session('m_id');
                $post['name'] = $request->input('name');
                $post['phone'] = $request->input('phone');
                $post['address'] = $request->input('address');
                $post['status'] = 1;
                
                if(!$id){
                    $post['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->crudOperation('C','tbl_member_address',$post);
                }else{
                    $post['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->crudOperation('U','tbl_member_address',$post,['add_id'=>$id]);
                }
                if(isset($inserted)){
                    $request->session()->flash('message',['msg'=>'Record added successfully!','type'=>'success']);
                }elseif(isset($updated)){
                    $request->session()->flash('message',['msg'=>'Record updated successfully!','type'=>'success']);
                }else{
                    $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
                }
                return redirect()->to('member-addresses');
            }
        }
        if($id){
            $data['record'] = $this->commonmodel->crudOperation('R1','tbl_member_address','',[['add_id','=',$id],['m_id','=',session('m_id')]]);
        }
        $data['addresses'] = $this->commonmodel->crudOperation('RA','tbl_member_address','',['m_id'=>session('m_id')],['add_id','DESC']);

        return view('member.addresses', $data);
    }
    public function delete_address(Request $request, $id=null){
        if($id){
            
            if($this->commonmodel->crudOperation('D','tbl_member_address','',[['add_id','=',$id],['m_id','=',session('m_id')]])){
                $request->session()->flash('message',['msg'=>'Record Deleted.','type'=>'success']);
            }else{
                $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
            }
        }
        return redirect()->to('member-addresses');
    }
    public function profile(Request $request){
        $post = array();
        if($request->isMethod('POST')){
            if($request->input('email') != $request->input('email2')){
                $rules = [
                    'email' =>'required|email|unique:tbl_member,email',
                ];
                $validated = $this->validate($request, $rules);
                if($validated){
                    $post ['email'] = $request->input('email');
                }
            }
            if($request->input('name') != $request->input('name2')){
                $post ['name'] = $request->input('name');
            }
            if($request->input('phone') != $request->input('phone2')){
                $post ['phone'] = $request->input('phone');
            }
            if(!empty($post)){
                $post['updated'] = date('Y-m-d H:i:s');
                $updated = $this->commonmodel->crudOperation('U','tbl_member',$post,['m_id'=>session('m_id')]);
                if(isset($updated)){
                    $member_info = $this->commonmodel->crudOperation('R1','tbl_member','',['m_id'=>session('m_id')]);
                    $sessionData = array(
                        'm_id' => $member_info->m_id,
                        'name' => $member_info->name,
                        'email' => $member_info->email,
                        'phone' => $member_info->phone,
                        'address' => $member_info->address,
                        'image' => $member_info->image,
                        'privilege_id' => $member_info->privilege_id,
                        'status' => $member_info->status,
                        'memberLogin' => true,
                    );
                    $request->session()->put($sessionData);
                    $request->session()->flash('message',['msg'=> 'Profile updated successfully!','type'=>'success']);
                }else{
                    $request->session()->flash('message',['msg'=>'Something went wrong. try again...','type'=>'danger']);
                }
            }
            return redirect()->to('member-profile');
        }
        $data['user'] = $this->commonmodel->crudOperation('R1','tbl_member','',['m_id'=>session('m_id')]);
        return view('member.profile', $data);
    }
    public function change_password(Request $request){
        if($request->isMethod('POST')){
            $validation = $this->validate($request, [
                'current_password' =>'required',
                'new_password' =>'required|min:5|max:12',
                'confirm_password' =>'required|same:new_password',
                ]);
            if($validation){
                $current_password = $request->input('current_password');
                $password = $request->input('confirm_password');
                $member_info = $this->commonmodel->crudOperation('R1','tbl_member','',['m_id'=>session('m_id')]);
                $check_password = Hash::check($current_password, $member_info->password);
                if(!$check_password){
                    $request->session()->flash('message', ['msg'=>'Incorrect Current Password!','type'=>'danger']);
                    return redirect()->to('member-changepassword')->withinput();
                }else{
                    // print_r($_POST); exit;
                    $post['password'] = Hash::make($password,['rounds'=>12,]);
                    if($this->commonmodel->crudOperation('U','tbl_member',$post,['m_id'=>session('m_id')])){
                        $request->session()->flash('message', ['msg'=>'Password Changed Successfully','type'=>'success']);
                    }else{
                        $request->session()->flash('message', ['msg'=>'Something went wrong!','type'=>'danger']);
                    }

                    return redirect()->to('member-changepassword');
                }
            }
        }
        return view('member.changepassword');
    }
    public function logout(Request $request){
        if($request->session()->has('memberLogin')){
            $request->session()->flush();
            return redirect()->to('member-login')->with('err', 'You are logged out');
        }
    }
}