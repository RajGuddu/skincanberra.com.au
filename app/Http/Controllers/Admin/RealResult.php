<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Common_model;

class RealResult extends Controller
{
    private $commonmodel;
    public function __construct(){
        $this->commonmodel = new Common_model;
    }
    public function index(Request $request){

        
        $data['records'] = $this->commonmodel->crudOperation('RA','tbl_realresult','','',['id','DESC']);
        if ($request->isMethod('POST') && isset($_POST['search'])){
            // $data['contactList'] = $this->commonmodel->crudOperation('RA','tbl_contact','','',['id','DESC']);
            // print_r($_POST);exit;
            // $id = $_POST['id'];
            // $post['status'] = $_POST['status'];
            // $updated = $this->commonmodel->crudOperation('U','tbl_contact_us', $post, ['id'=>$id]);
            // if($updated){
            //     $request->session()->flash('message', ['msg'=>'Record Updated Successfully', 'type'=>'success']);
            // }else{
            //     $request->session()->flash('message', ['msg'=>'Record Not Update. Please try again...', 'type'=>'danger']);
            // }
            // return redirect()->to(url(ADMIN.'-contact_us'));
        }
        
        return view('admin.realResult.realResultIndex', $data);
    }
    public function add_realResult(Request $request){
        $data = [];
        if($request->isMethod('POST')){
            
            $rules = [
                'images' => 'required|array',
                // 'main_title' => 'required',
                // 'status' => 'required',
            ];
            // $errorMessage = ['video.required'=>'youtube video link is required'];
            $validated = $this->validate($request, $rules);
            
            // var_dump($validated); exit;
            // print_r($_POST); exit;
            if($validated){
                // echo '<pre>'; print_r($_FILES); print_r($_POST); exit;
                if($request->hasFile('images')){
                    $files = $request->file('images');
                    foreach ($files as $k=>$file) {
                        $post = [];
                        if ($file->isValid()) {

                            do {
                                $webpFilename = 'image-'. Str::random(8) .'.webp';
                                $exists = $this->commonmodel->isExists('tbl_realresult',['image'=>$webpFilename]);
                            } while ($exists);
                            $image = Image::make($file)->encode('webp', 80);
                            $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                            /*if($path){
                                if (isset($_POST['image2']) && !empty($_POST['image2'])) {
                                    Storage::disk('public_root')->delete('images/' . $_POST['image2']);
                                }
                                $post['image'] = $webpFilename;
                            }*/
                            if($path){
                                $post['alt'] = $request->input('alt')[$k];
                                $post['title'] = $request->input('title')[$k];
                                $post['image'] = $webpFilename;
                                $post['status'] = 1;
                                $post['added_at'] = date('Y-m-d H:i:s');
                                $inserted = $this->commonmodel->crudOperation('C','tbl_realresult',$post);
                            }
                        }
                    }
                }
                /* $post['page'] = $request->input('page');
                $post['main_title'] = $request->input('main_title');
                $post['sub_title'] = $request->input('sub_title');
                $post['status'] = $request->input('status');
                if(!$id){
                    $post['created_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->crudOperation('C','tbl_banner',$post);

                }else{
                    $post['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->crudOperation('U','tbl_banner',$post,['id'=>$id]);
                } */
                if(isset($inserted)){
                    $request->session()->flash('message',['msg'=>'Record added successfully!','type'=>'success']);
                }else{
                    $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
                }

                return redirect()->to('admin/realResult');
            }
        }
        /*if($id){
            $data['solo'] = $this->commonmodel->crudOperation('R1','tbl_banner','',['id'=>$id]);
        }
        $data['pages'] = $this->commonmodel->crudOperation('RA','tbl_page'); */
        return view('admin.realResult.add_realResult', $data);
    }
    public function edit_realResult(Request $request, $id=null){
        $data = [];
        if($request->isMethod('POST')){
            
            if($request->hasFile('image')){
                $file = $request->file('image');
                $post = [];
                if ($file->isValid()) {

                    do {
                        $webpFilename = 'image-'. Str::random(8) .'.webp';
                        $exists = $this->commonmodel->isExists('tbl_realresult',['image'=>$webpFilename]);
                    } while ($exists);
                    $image = Image::make($file)->encode('webp', 80);
                    $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                    if($path){
                        if (isset($_POST['image2']) && !empty($_POST['image2'])) {
                            Storage::disk('public_root')->delete('images/' . $_POST['image2']);
                        }
                        $post['image'] = $webpFilename;
                    }
                    
                }
            }
            $post['alt'] = $request->input('alt');
            $post['title'] = $request->input('title');
            $post['status'] = $request->input('status');
            $post['update_at'] = date('Y-m-d H:i:s');
            $updated = $this->commonmodel->crudOperation('U','tbl_realresult',$post,['id'=>$id]);
            
            if(isset($updated)){
                $request->session()->flash('message',['msg'=>'Record updated successfully!','type'=>'success']);
            }else{
                $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
            }

            return redirect()->to('admin/realResult');
        }
        $data['record'] = $this->commonmodel->crudOperation('R1','tbl_realresult','',['id'=>$id]);
        return view('admin.realResult.edit_realResult', $data);
    }
    public function delete_realResult(Request $request, $id=null){
        if($id){
            $record = $this->commonmodel->crudOperation('R1','tbl_realresult','',['id'=>$id]);
            if(!empty($record)){
                $imagePath = public_path('assets/uploads/images/' . $record->image);
                if (!empty($record->image) && File::exists($imagePath)) {
                    File::delete($imagePath);
                }
                // $image2Path = public_path('assets/uploads/images/' . $record->thumb_image);
                // if (!empty($record->thumb_image) && File::exists($image2Path)) {
                //     File::delete($image2Path);
                // }
                if($this->commonmodel->crudOperation('D','tbl_realresult','',['id'=>$id])){
                    $request->session()->flash('message',['msg'=>'Record Deleted.','type'=>'success']);
                }else{
                    $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
                }
            }
        }
        return redirect()->to('admin/realResult');
    }
    /* public function variants(Request $request, $id=null,$vid=null){
        $data = [];
        if($request->isMethod('POST')){
            $validated = $this->validate($request, [
                'v_name' => 'required',
                'v_url' => 'required',
                'mrp' => 'required|integer',
                'sp' => 'required|integer|lte:mrp',
            ],
            [
                'v_url.required' => 'Url is required',
            ]);
            if($validated){
                // print_r($_POST); exit;
                    if($request->hasFile('photo')){
                        if ($request->file('photo')->isValid()) {

                            $file = $request->file('photo');
                            do {
                                $webpFilename = 'svariant-'. Str::random(8) .'.webp';
                                $exists = ServiceVariantsModel::where('photo', $webpFilename)->exists();
                            } while ($exists);
                            $image = Image::make($file)->encode('webp', 80);
                            $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                            if($path){
                                if (isset($_POST['photo2']) && !empty($_POST['photo2'])) {
                                    Storage::disk('public_root')->delete('images/' . $_POST['photo2']);
                                }
                                $post['photo'] = $webpFilename;
                            }
                        }
                    }
                    $post['sv_id'] = $id;
                    $post['v_name'] = $request->input('v_name');
                    $post['v_url'] = $request->input('v_url');
                    $post['mrp'] = $request->input('mrp');
                    $post['sp'] = $request->input('sp');
                    $post['details'] = $request->input('details');
                    $post['status'] = $request->input('status');
                    if(!$vid){
                        $post['added_at'] = date('Y-m-d H:i:s');
                        $inserted = ServiceVariantsModel::create($post);

                    }else{
                        $post['update_at'] = date('Y-m-d H:i:s');
                        $updated = ServiceVariantsModel::where('vid',$vid)->update($post);
                    }
                    if(isset($inserted)){
                        $request->session()->flash('message',['msg'=>'Variants added successfully!','type'=>'success']);
                    }elseif(isset($updated)){
                        $request->session()->flash('message',['msg'=>'Variants updated successfully!','type'=>'success']);
                    }else{
                        $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
                    }

                    return redirect()->to('admin/variants/'.$id);
            }
        }
        if($vid){
            $data['variant'] = ServiceVariantsModel::where('vid', $vid)->first();
        }
        $data['service'] = ServiceModel::where('sv_id', $id)->first();
        $data['variants'] = ServiceVariantsModel::where('sv_id', $id)->orderBy('vid','desc')->get();
        return view('admin.services.variantsIndex', $data);
    }
    public function delete_variants(Request $request, $id=null, $vid=null){
        if($id){
            $record = ServiceVariantsModel::where([['vid','=',$vid],['sv_id','=',$id]])->first();
            if($record){
                $imagePath = public_path('assets/uploads/images/' . $record->photo);
                if (!empty($record->photo) && File::exists($imagePath)) {
                    File::delete($imagePath);
                }
                if(ServiceVariantsModel::where('vid', $vid)->delete()){

                    $request->session()->flash('message',['msg'=>'Record Deleted.','type'=>'success']);
                }else{
                    $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
                }
            }
        }
        return redirect()->to('admin/variants/'.$id);
    }*/
}
