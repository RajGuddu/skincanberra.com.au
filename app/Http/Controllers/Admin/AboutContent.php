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

class AboutContent extends Controller
{
    private $commonmodel;
    public function __construct(){
        $this->commonmodel = new Common_model;
    }

    public function update_content(Request $request){
        $data = [];
        if($request->isMethod('POST')){
            $post = [];
            if($request->input('submit') == 'about'){
                // echo '<pre>'; print_r($_FILES); print_r($_POST); exit;
                if($request->hasFile('about_image')){
                    $file = $request->file('about_image');
                    if ($file->isValid()) {

                        do {
                            $webpFilename = 'about-'. Str::random(8) .'.webp';
                            $exists = $this->commonmodel->isExists('tbl_about_content',['about_image'=>$webpFilename]);
                        } while ($exists);
                        $image = Image::make($file)->encode('webp', 80);
                        $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                        if($path){
                            if (isset($_POST['about_image2']) && !empty($_POST['about_image2'])) {
                                Storage::disk('public_root')->delete('images/' . $_POST['about_image2']);
                            }
                            $post['about_image'] = $webpFilename;
                        }
                        
                    }
                }
                $post['about_title'] = $request->input('about_title');
                $post['about_details'] = $request->input('about_details');
                
            } // about end
            if($request->input('submit') == 'sec-2'){
                // echo '<pre>'; print_r($_FILES); print_r($_POST); exit;
                $post['sec2_title'] = $request->input('sec2_title');
                $post['sec2_description'] = $request->input('sec2_description');
                
            } // sec-2 end
            if($request->input('submit') == 'sec-3'){
                // echo '<pre>'; print_r($_FILES); print_r($_POST); exit;
                $post['sec3_title1'] = $request->input('sec3_title1');
                $post['sec3_details1'] = $request->input('sec3_details1');
                if($request->hasFile('sec3_image1')){
                    $file = $request->file('sec3_image1');
                    if ($file->isValid()) {

                        do {
                            $webpFilename = 'sec-3-'. Str::random(8) .'.webp';
                            $exists = $this->commonmodel->isExists('tbl_about_content',['sec3_image1'=>$webpFilename]);
                        } while ($exists);
                        $image = Image::make($file)->encode('webp', 80);
                        $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                        if($path){
                            if (isset($_POST['sec3_image1_2']) && !empty($_POST['sec3_image1_2'])) {
                                Storage::disk('public_root')->delete('images/' . $_POST['sec3_image1_2']);
                            }
                            $post['sec3_image1'] = $webpFilename;
                        }
                        
                    }
                }
                
                $post['sec3_title2'] = $request->input('sec3_title2');
                $post['sec3_details2'] = $request->input('sec3_details2');
                if($request->hasFile('sec3_image2')){
                    $file = $request->file('sec3_image2');
                    if ($file->isValid()) {

                        do {
                            $webpFilename = 'sec-3-'. Str::random(8) .'.webp';
                            $exists = $this->commonmodel->isExists('tbl_about_content',['sec3_image2'=>$webpFilename]);
                        } while ($exists);
                        $image = Image::make($file)->encode('webp', 80);
                        $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                        if($path){
                            if (isset($_POST['sec3_image2_2']) && !empty($_POST['sec3_image2_2'])) {
                                Storage::disk('public_root')->delete('images/' . $_POST['sec3_image2_2']);
                            }
                            $post['sec3_image2'] = $webpFilename;
                        }
                        
                    }
                }
                
            }
            
            if(!empty($post)){
                $post['update_at'] = date('Y-m-d H:i:s');
                $updated = $this->commonmodel->crudOperation('U','tbl_about_content',$post,['id'=>1]);
            } 
            if(isset($updated)){
                $request->session()->flash('message',['msg'=>'Record updated successfully!','type'=>'success']);
            }else{
                $request->session()->flash('message',['msg'=>'Something went wrong. Please Try After Sometimes...','type'=>'danger']);
            }

            return redirect()->to('admin/aboutContent');
        }
        
        $data['settings'] = $this->commonmodel->crudOperation('R1','tbl_about_content', '', ['id'=>1]);
        return view('admin.aboutContent.aboutContent', $data);
    }
    
}
