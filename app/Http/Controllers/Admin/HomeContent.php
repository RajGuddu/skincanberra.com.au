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

class HomeContent extends Controller
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
                            $exists = $this->commonmodel->isExists('tbl_home_content',['about_image'=>$webpFilename]);
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
            if($request->input('submit') == 'sec-5'){
                // echo '<pre>'; print_r($_FILES); print_r($_POST); exit;
                if($request->hasFile('sec5_content_image1')){
                    $file = $request->file('sec5_content_image1');
                    if ($file->isValid()) {

                        do {
                            $webpFilename = 'sec-5-'. Str::random(8) .'.webp';
                            $exists = $this->commonmodel->isExists('tbl_home_content',['sec5_content_image1'=>$webpFilename]);
                        } while ($exists);
                        $image = Image::make($file)->encode('webp', 80);
                        $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                        if($path){
                            if (isset($_POST['sec5_content_image1_2']) && !empty($_POST['sec5_content_image1_2'])) {
                                Storage::disk('public_root')->delete('images/' . $_POST['sec5_content_image1_2']);
                            }
                            $post['sec5_content_image1'] = $webpFilename;
                        }
                        
                    }
                }
                $post['sec5_title'] = $request->input('sec5_title');
                $post['sec5_description'] = $request->input('sec5_description');
                $post['sec5_content_title1'] = $request->input('sec5_content_title1');
                $post['sec5_content_details1'] = $request->input('sec5_content_details1');

                // content-2
                if($request->hasFile('sec5_content_image2')){
                    $file = $request->file('sec5_content_image2');
                    if ($file->isValid()) {

                        do {
                            $webpFilename = 'sec-5-'. Str::random(8) .'.webp';
                            $exists = $this->commonmodel->isExists('tbl_home_content',['sec5_content_image2'=>$webpFilename]);
                        } while ($exists);
                        $image = Image::make($file)->encode('webp', 80);
                        $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                        if($path){
                            if (isset($_POST['sec5_content_image2_2']) && !empty($_POST['sec5_content_image2_2'])) {
                                Storage::disk('public_root')->delete('images/' . $_POST['sec5_content_image2_2']);
                            }
                            $post['sec5_content_image2'] = $webpFilename;
                        }
                        
                    }
                }
                $post['sec5_content_title2'] = $request->input('sec5_content_title2');
                $post['sec5_content_details2'] = $request->input('sec5_content_details2');
                
                // content-3
                if($request->hasFile('sec5_content_image3')){
                    $file = $request->file('sec5_content_image3');
                    if ($file->isValid()) {

                        do {
                            $webpFilename = 'sec-5-'. Str::random(8) .'.webp';
                            $exists = $this->commonmodel->isExists('tbl_home_content',['sec5_content_image3'=>$webpFilename]);
                        } while ($exists);
                        $image = Image::make($file)->encode('webp', 80);
                        $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                        if($path){
                            if (isset($_POST['sec5_content_image3_2']) && !empty($_POST['sec5_content_image3_2'])) {
                                Storage::disk('public_root')->delete('images/' . $_POST['sec5_content_image3_2']);
                            }
                            $post['sec5_content_image3'] = $webpFilename;
                        }
                        
                    }
                }
                $post['sec5_content_title3'] = $request->input('sec5_content_title3');
                $post['sec5_content_details3'] = $request->input('sec5_content_details3');
                
            } // sec-5 end
            if($request->input('submit') == 'sec-6'){
                // echo '<pre>'; print_r($_FILES); print_r($_POST); exit;
                $post['sec6_title'] = $request->input('sec6_title');
                $post['sec6_description'] = $request->input('sec6_description');
                $post['pic_title1'] = $request->input('pic_title1');
                $post['pic_details1'] = $request->input('pic_details1');
                if($request->hasFile('pic1')){
                    $file = $request->file('pic1');
                    if ($file->isValid()) {

                        do {
                            $webpFilename = 'sec-6-'. Str::random(8) .'.webp';
                            $exists = $this->commonmodel->isExists('tbl_home_content',['pic1'=>$webpFilename]);
                        } while ($exists);
                        $image = Image::make($file)->encode('webp', 80);
                        $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                        if($path){
                            if (isset($_POST['pic1_2']) && !empty($_POST['pic1_2'])) {
                                Storage::disk('public_root')->delete('images/' . $_POST['pic1_2']);
                            }
                            $post['pic1'] = $webpFilename;
                        }
                        
                    }
                }
                
                $post['pic_title2'] = $request->input('pic_title2');
                $post['pic_details2'] = $request->input('pic_details2');
                if($request->hasFile('pic2')){
                    $file = $request->file('pic2');
                    if ($file->isValid()) {

                        do {
                            $webpFilename = 'sec-6-'. Str::random(8) .'.webp';
                            $exists = $this->commonmodel->isExists('tbl_home_content',['pic2'=>$webpFilename]);
                        } while ($exists);
                        $image = Image::make($file)->encode('webp', 80);
                        $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                        if($path){
                            if (isset($_POST['pic2_2']) && !empty($_POST['pic2_2'])) {
                                Storage::disk('public_root')->delete('images/' . $_POST['pic2_2']);
                            }
                            $post['pic2'] = $webpFilename;
                        }
                        
                    }
                }

                $post['pic_title3'] = $request->input('pic_title3');
                $post['pic_details3'] = $request->input('pic_details3');
                if($request->hasFile('pic3')){
                    $file = $request->file('pic3');
                    if ($file->isValid()) {

                        do {
                            $webpFilename = 'sec-6-'. Str::random(8) .'.webp';
                            $exists = $this->commonmodel->isExists('tbl_home_content',['pic3'=>$webpFilename]);
                        } while ($exists);
                        $image = Image::make($file)->encode('webp', 80);
                        $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                        if($path){
                            if (isset($_POST['pic3_2']) && !empty($_POST['pic3_2'])) {
                                Storage::disk('public_root')->delete('images/' . $_POST['pic3_2']);
                            }
                            $post['pic3'] = $webpFilename;
                        }
                        
                    }
                }

                $post['pic_title4'] = $request->input('pic_title4');
                $post['pic_details4'] = $request->input('pic_details4');
                if($request->hasFile('pic4')){
                    $file = $request->file('pic4');
                    if ($file->isValid()) {

                        do {
                            $webpFilename = 'sec-6-'. Str::random(8) .'.webp';
                            $exists = $this->commonmodel->isExists('tbl_home_content',['pic4'=>$webpFilename]);
                        } while ($exists);
                        $image = Image::make($file)->encode('webp', 80);
                        $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                        if($path){
                            if (isset($_POST['pic4_2']) && !empty($_POST['pic4_2'])) {
                                Storage::disk('public_root')->delete('images/' . $_POST['pic4_2']);
                            }
                            $post['pic4'] = $webpFilename;
                        }
                        
                    }
                }
            }
            if($request->input('submit') == 'contact-page'){
                if($request->hasFile('contact_page_image')){
                    $file = $request->file('contact_page_image');
                    if ($file->isValid()) {

                        do {
                            $webpFilename = 'contact-img-'. Str::random(8) .'.webp';
                            $exists = $this->commonmodel->isExists('tbl_home_content',['contact_page_image'=>$webpFilename]);
                        } while ($exists);
                        $image = Image::make($file)->encode('webp', 80);
                        $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                        if($path){
                            if (isset($_POST['contact_page_image2']) && !empty($_POST['contact_page_image2'])) {
                                Storage::disk('public_root')->delete('images/' . $_POST['contact_page_image2']);
                            }
                            $post['contact_page_image'] = $webpFilename;
                        }
                        
                    }
                }
            }
            if(!empty($post)){
                $post['update_at'] = date('Y-m-d H:i:s');
                $updated = $this->commonmodel->crudOperation('U','tbl_home_content',$post,['id'=>1]);
            } 
            if(isset($updated)){
                $request->session()->flash('message',['msg'=>'Record updated successfully!','type'=>'success']);
            }else{
                $request->session()->flash('message',['msg'=>'Something went wrong. Please Try After Sometimes...','type'=>'danger']);
            }

            return redirect()->to('admin/homeContent');
        }
        
        $data['settings'] = $this->commonmodel->crudOperation('R1','tbl_home_content', '', ['id'=>1]);
        return view('admin.homeContent.homeContent', $data);
    }
    
}
