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
// use App\Models\ServiceVariantsModel;

class Cms extends Controller
{
    private $commonmodel;
    public function __construct(){
        $this->commonmodel = new Common_model;
    }
    public function index(Request $request){
        
        $data['cms'] = $this->commonmodel->crudOperation('RA','tbl_cms','','',['id','DESC']);
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
        
        return view('admin.cms.cmsIndex', $data);
    }
    public function add_edit_cms(Request $request, $id=null){
        $data = $post = [];
        if($request->isMethod('POST')){
            $rules = [
                'page' => 'required',
                'banner_title' => 'required',
                'description' => 'required',
                'status' => 'required',
            ];
            $validated = $this->validate($request, $rules);
            /* $validated = $this->validate($request, [
                'service_name' => 'required',
                'serv_url' => 'required',
            ],
            [
                'serv_url.required' => 'Url is required',
            ]); */
            // var_dump($validated); exit;
            // print_r($_POST); exit;
            if($validated){
                if($request->hasFile('cms_banner')){
                    if ($request->file('cms_banner')->isValid()) {

                        $file = $request->file('cms_banner');
                        do {
                            $webpFilename = 'banner-'. Str::random(8) .'.webp';
                            $exists = $this->commonmodel->isExists('tbl_cms',['cms_banner'=>$webpFilename]);
                        } while ($exists);
                        $image = Image::make($file)->encode('webp', 80);
                        $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                        if($path){
                            if (isset($_POST['cms_banner2']) && !empty($_POST['cms_banner2'])) {
                                Storage::disk('public_root')->delete('images/' . $_POST['cms_banner2']);
                            }
                            $post['cms_banner'] = $webpFilename;
                        }
                    }
                }
                $post['page'] = $request->input('page');
                $post['banner_title'] = $request->input('banner_title');
                $post['description'] = $request->input('description');

                /***********************or************** */
                /*if($request->hasFile('thumb_image')){
                    if ($request->file('thumb_image')->isValid()) {

                        $file = $request->file('thumb_image');
                        do {
                            $webpFilename = 'testimonial-'. Str::random(8) .'.webp';
                            $exists = $this->commonmodel->isExists('tbl_testimonial',['thumb_image'=>$webpFilename]);
                        } while ($exists);
                        $image = Image::make($file)->encode('webp', 80);
                        $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                        if($path){
                            if (isset($_POST['thumb_image2']) && !empty($_POST['thumb_image2'])) {
                                Storage::disk('public_root')->delete('images/' . $_POST['thumb_image2']);
                            }
                            $post['thumb_image'] = $webpFilename;
                        }
                    }
                }
                /*if($request->hasFile('video')){
                    $fileContent = $request->file('video');
                    $ext = $fileContent->extension();
                    do {
                        $videoFilename = 'testimonial-'. Str::random(8).'.'.$ext;
                        $exists = $this->commonmodel->isExists('tbl_testimonial',['video'=>$videoFilename]);
                    } while ($exists);
                    // $newfilename = $this->uploadImage($fileContent, $_POST['old_image5']);
                    $path = Storage::disk('public_root')->putFileAs('images/', $fileContent, $videoFilename);
                    if($path){
                        if (isset($_POST['video2']) && !empty($_POST['video2'])) {
                            Storage::disk('public_root')->delete('images/' . $_POST['video2']);
                        }
                        $post['video'] = $videoFilename;
                    }
                }*/
                // $post['video'] = $request->input('video');

                $post['status'] = $request->input('status');
                if(!$id){
                    $post['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->crudOperation('C','tbl_cms',$post);

                }else{
                    $post['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->crudOperation('U','tbl_cms',$post,['id'=>$id]);
                }
                if(isset($inserted)){
                    $request->session()->flash('message',['msg'=>'Record added successfully!','type'=>'success']);
                }elseif(isset($updated)){
                    $request->session()->flash('message',['msg'=>'Record updated successfully!','type'=>'success']);
                }else{
                    $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
                }

                return redirect()->to('admin/cms');
            }
        }
        if($id){
            $data['record'] = $this->commonmodel->crudOperation('R1','tbl_cms','',['id'=>$id]);
        }
        return view('admin.cms.add_edit_cms', $data);
    }
    public function delete_cms(Request $request, $id=null){
        if($id){
            $record = $this->commonmodel->crudOperation('R1','tbl_cms','',['id'=>$id]);
            if(!empty($record)){
                $imagePath = public_path('assets/uploads/images/' . $record->cms_banner);
                if (!empty($record->cms_banner) && File::exists($imagePath)) {
                    File::delete($imagePath);
                }
                // $image2Path = public_path('assets/uploads/images/' . $record->thumb_image);
                // if (!empty($record->thumb_image) && File::exists($image2Path)) {
                //     File::delete($image2Path);
                // }
                if($this->commonmodel->crudOperation('D','tbl_cms','',['id'=>$id])){
                    $request->session()->flash('message',['msg'=>'Record Deleted.','type'=>'success']);
                }else{
                    $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
                }
            }
        }
        return redirect()->to('admin/cms');
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
