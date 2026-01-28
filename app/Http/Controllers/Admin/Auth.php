<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin\AdminModel;

class Auth extends Controller
{
    public function __construct(){
        $this->data['title'] = 'Login';
        // $this->adminmodel = new Admin;
    }
    public function login(Request $request){
        if($request->isMethod('POST')){
            $validated = $this->validate($request, [
                'email' => 'required|email|exists:tbl_admin,email',
                'password' => 'required|min:5|max:12',
            ],
            [
                'email.required' => 'Email is required',
                'email.exists' => 'This email is not registered on your service',
                'password.required' => 'Password is required',
                'password.min' => 'Password must have atleast 5 characters in length',
                'password.max' => 'Password must not have more than 12 characters in length',
            ]);
            if($validated){
                // print_r($_POST); exit;

                $email = $request->input('email');
                $password = $request->input('password');
                // $admin_info = $this->commonmodel->isvalidate($email);
                $admin_info = AdminModel::where(['email'=>$email])->first();
                // echo '<pre>';print_r($admin_info); echo $admin_info->name;exit;
                $check_password = Hash::check($password, $admin_info->password);
                if(!$check_password){
                    $request->session()->flash('err', 'Incorrect Password!');
                    return redirect()->to('/'.ADMIN)->withinput();
                }else{
                    $sessionData = array(
                        'user_id' => $admin_info->user_id,
                        'name' => $admin_info->name,
                        'email' => $admin_info->email,
                        'phone' => $admin_info->phone,
                        'address' => $admin_info->address,
                        'image' => $admin_info->image,
                        'privilege_id' => $admin_info->privilege_id,
                        'status' => $admin_info->status,
                        'admindata' => true,
                    );
                    $request->session()->put($sessionData);
                    return redirect()->to('admin/dashboard');
                }
            }
        }
            
        return view('auth.login', $this->data);
    }
    public function edit_profile(Request $request){
        $data = $post = array();
        if ($request->isMethod('POST')){
            if($request->input('submit') == 'profile'){
                // print_r($_POST); exit;
                $validation = $this->validate($request, [
                    'name' =>'required',
                    'email' =>'required|email',
                    ],[
                        'name.required'=>'The full name is required',
                        'email.email'=>'Enter a valid email address',
                    
                ]);
                if($validation){
                    if($request->hasFile('image')){
                        if ($request->file('image')->isValid()) {
                            $filename = $request->file('image')->getClientOriginalName();
                            $ext = $request->file('image')->extension();
                            $newfilename = 'user_'.time().'.'.$ext;
                            $path = Storage::disk('public_root')->putFileAs('images/', $request->file('image'), $newfilename);
                            if($path){
                                Storage::disk('public_root')->delete('images/' . session('image'));
                                $post['image'] = $newfilename;
                            }
                        }
                    }
                    $post['name'] = $request->input('name');
                    $post['email'] = $request->input('email');
                    $post['phone'] = $request->input('phone');
                    $post['address'] = $request->input('address');
                    $post['updated'] = date('Y-m-d H:i:s');
                    $alert_msg = 'User Update Successfully';
                }
            }
            if($request->input('submit') == 'change_password'){
                $validation = $this->validate($request, [
                    'oldpwd' =>'required',
                    'pwd' =>'required|min:5|max:12',
                    'cpwd' =>'required|min:5|same:pwd',
                    ],[
                        'oldpwd.required'=>'The old password is required',
                        'pwd.required'=>'The password is required',
                        'pwd.min' => 'Password must have atleast 5 characters in length',
                        'pwd.max' => 'Password must not have more than 12 characters in length',
                        'cpwd.required'=>'The confirm password is required',
                        'cpwd.min' => 'confirm password must have atleast 5 characters in length',
                        'cpwd.same' => 'confirm password must match password',
                    
                ]);
                if($validation){
                    $oldpwd = $request->input('oldpwd');
                    $password = $request->input('cpwd');
                    $admin_info = AdminModel::where(['email'=>session('email')])->first();
                    $check_password = Hash::check($oldpwd, $admin_info->password);
                    if(!$check_password){
                        $request->session()->flash('message', ['msg'=>'Incorrect Current Password!','type'=>'danger']);
                        return redirect()->to('admin/profile')->withinput();
                    }else{
                        // print_r($_POST); exit;
                        $post['password'] = Hash::make($password,['rounds'=>12,]);
                        $alert_msg = 'Password Changed Successfully';
                    }
                }
            }
            if(!empty($post)){
                // $updated = $this->commonmodel->updateRecord('tbl_admin',$data, ['user_id'=>session('user_id')]);
                $updated = AdminModel::where('email', session('email'))->update($post);
                if($updated){
                    $user_info =  AdminModel::where(['email'=>session('email')])->first();
                    $sess_item = ['user_id','name','email','phone','address','image','privilege_id','status','admindata'];
                    session()->forget($sess_item);
                    $sessionData = array(
                        'user_id' => $user_info->user_id,
                        'name' => $user_info->name,
                        'email' => $user_info->email,
                        'phone' => $user_info->phone,
                        'address' => $user_info->address,
                        'image' => $user_info->image,
                        'privilege_id' => $user_info->privilege_id,
                        'status' => $user_info->status,
                        'admindata' => true,
                    );
                    //print_r($mysession);exit;
                    $request->session()->put($sessionData);

                    $request->session()->flash('message',['msg'=>$alert_msg,'type'=>'success']);
                }else{
                    $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
                }
            }
            return redirect()->to('admin/profile');
        }
        $data['profile'] = AdminModel::where(['email'=>session('email')])->first();
        // print_r($this->data['profile']); exit;
        return view('auth.account', $data);
        
    }
    public function logout(Request $request){
        if($request->session()->has('admindata')){
            $request->session()->flush();
            return redirect()->to(ADMIN.'?access=out')->with('err', 'You are logged out');
        }
    }
}
