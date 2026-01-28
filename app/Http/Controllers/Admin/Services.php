<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\ServiceModel;
use App\Models\ServiceVariantsModel;

class Services extends Controller
{
    public function index(Request $request){
        // $post['banner_title'] = 'Beauty & Care Services Designed Just for You';
        // $post['banner_image'] = 'service-banner-wWr8bMAD.webp';
        // $updated = ServiceModel::where('status',1)->update($post);
        $data['services'] = ServiceModel::orderBy('sv_id','desc')->get();
        if($request->isMethod('POST') && $request->input('search') != ''){
            $search = $request->input('search');
            $data['services'] = ServiceModel::where('service_name','like','%' . $search . '%')
                                        ->orderBy('sv_id','desc')
                                        ->get();
            
        }
        return view('admin.services.serviceIndex', $data);
    }
    public function add_edit_service(Request $request, $id=null){
        $data = $post = [];
        if($request->isMethod('POST')){
            $validated = $this->validate($request, [
                'banner_title' => 'required',
                'service_name' => 'required',
                'serv_url' => 'required',
            ],
            [
                'serv_url.required' => 'Url is required',
            ]);
            if($validated){
                // print_r($_POST); exit;
                    if($request->hasFile('banner_image')){
                        if ($request->file('banner_image')->isValid()) {

                            $file = $request->file('banner_image');
                            do {
                                $webpFilename = 'service-banner-'. Str::random(8) .'.webp';
                                $exists = ServiceModel::where('banner_image', $webpFilename)->exists();
                            } while ($exists);
                            $image = Image::make($file)->encode('webp', 80);
                            $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                            if($path){
                                if (isset($_POST['banner_image2']) && !empty($_POST['banner_image2'])) {
                                    Storage::disk('public_root')->delete('images/' . $_POST['banner_image2']);
                                }
                                $post['banner_image'] = $webpFilename;
                            }
                        }
                    }
                    $webpFilename = '';
                    if($request->hasFile('thumbnail_image')){
                        if ($request->file('thumbnail_image')->isValid()) {

                            $file = $request->file('thumbnail_image');
                            do {
                                $webpFilename = 'service-t-'. Str::random(8) .'.webp';
                                $exists = ServiceModel::where('thumbnail_image', $webpFilename)->exists();
                            } while ($exists);
                            $image = Image::make($file)->encode('webp', 80);
                            $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                            if($path){
                                if (isset($_POST['thumbnail_image2']) && !empty($_POST['thumbnail_image2'])) {
                                    Storage::disk('public_root')->delete('images/' . $_POST['thumbnail_image2']);
                                }
                                $post['thumbnail_image'] = $webpFilename;
                            }
                        }
                    }
                    $webpFilename = '';
                    if($request->hasFile('photo')){
                        if ($request->file('photo')->isValid()) {

                            $file = $request->file('photo');
                            do {
                                $webpFilename = 'service-'. Str::random(8) .'.webp';
                                $exists = ServiceModel::where('photo', $webpFilename)->exists();
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
                    $post['banner_title'] = $request->input('banner_title');
                    $post['service_name'] = $request->input('service_name');
                    $post['serv_title'] = $request->input('serv_title');
                    $post['serv_url'] = $request->input('serv_url');
                    $post['details'] = $request->input('details');
                    $post['show_front'] = $request->input('show_front');
                    $post['status'] = $request->input('status');
                    if(!$id){
                        $post['added_at'] = date('Y-m-d H:i:s');
                        $inserted = ServiceModel::create($post);

                    }else{
                        $post['update_at'] = date('Y-m-d H:i:s');
                        $updated = ServiceModel::where('sv_id',$id)->update($post);
                    }
                    if(isset($inserted)){
                        $request->session()->flash('message',['msg'=>'Service added successfully!','type'=>'success']);
                    }elseif(isset($updated)){
                        $request->session()->flash('message',['msg'=>'Service updated successfully!','type'=>'success']);
                    }else{
                        $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
                    }

                    return redirect()->to('admin/services');
            }
        }
        if($id){
            $data['service'] = ServiceModel::where('sv_id', $id)->first();
        }
        return view('admin.services.add_edit_service', $data);
    }
    public function delete_service(Request $request, $id=null){
        if($id){
            $record = ServiceModel::where('sv_id', $id)->first();
            $variants = ServiceVariantsModel::where('sv_id', $id)->get();
            if($record){
                $imagePath = public_path('assets/uploads/images/' . $record->photo);
                if (!empty($record->photo) && File::exists($imagePath)) {
                    File::delete($imagePath);
                }
                if(ServiceModel::where('sv_id', $id)->delete()){
                    if(!$variants->isEmpty()){
                        foreach($variants as $list){
                            $imagePath = public_path('assets/uploads/images/' . $list->photo);
                            if (!empty($list->photo) && File::exists($imagePath)) {
                                File::delete($imagePath);
                            }
                            
                        }
                        ServiceVariantsModel::where('sv_id', $id)->delete();
                    }
                    $request->session()->flash('message',['msg'=>'Record Deleted.','type'=>'success']);
                }else{
                    $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
                }
            }
        }
        return redirect()->to('admin/services');
    }
    public function variants(Request $request, $id=null,$vid=null){
        $data = [];
        if($request->isMethod('POST')){
            $validated = $this->validate($request, [
                'v_name' => 'required',
                'v_url' => 'required',
                // 'mrp' => 'required|integer',
                'sp' => 'required|integer',
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
                    $post['duration'] = $request->input('duration_min');
                    $post['sp'] = $request->input('sp');
                    $post['details'] = $request->input('details');
                    $post['status'] = $request->input('status');

                    $position = $request->input('position');
                    $variant = ServiceVariantsModel::where('sv_id', $id)->where('position', $position)->first();
                    if($variant){
                        $existingId = $variant->vid;
                        $old_position = $_POST['old_position'];
                        ServiceVariantsModel::where('vid',$existingId)->update(['position'=>$old_position]);
                    }
                    $post['position'] = $position;

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
        $data['variants'] = ServiceVariantsModel::where('sv_id', $id)->orderBy('position','asc')->get();
        $data['newPosition'] = ServiceVariantsModel::where('sv_id', $id)->count() + 1;
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
    }
}
