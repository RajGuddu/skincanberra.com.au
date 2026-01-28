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

class Products extends Controller
{
    private $commonmodel;
    public function __construct(){
        $this->commonmodel = new Common_model;
    }
    public function index(Request $request){
        
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
        // $products = $this->commonmodel->get_min_value_products();
        // echo '<pre>'; print_r($products); exit;
        $data['records'] = $this->commonmodel->crudOperation('RA','tbl_product','','',['pro_id','DESC']);
        return view('admin.product.pro_index', $data);
    }
    public function add_edit_product(Request $request, $id=null, $attrId=null){
        $data = $post = [];
        $tabname = '';
        
        if($request->isMethod('POST')){
            if($request->input('tab') == 'tab1'){
                $rules = [
                    'pro_name' => 'required',
                    'pro_url' => 'required',
                    'cat_id' => 'required',
                ];
                $errorMessage = ['pro_name.required'=>'Product name is required','cat_id.required'=>'Category is required'];
                $validated = $this->validate($request, $rules, $errorMessage);
            
                if($validated){
                    if($request->hasFile('image1')){
                        if ($request->file('image1')->isValid()) {

                            $file = $request->file('image1');
                            do {
                                $webpFilename = 'proImage1-'. Str::random(8) .'.webp';
                                $exists = $this->commonmodel->isExists('tbl_product',['image1'=>$webpFilename]);
                            } while ($exists);
                            $image = Image::make($file)->encode('webp', 80);
                            $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                            if($path){
                                if (isset($_POST['image1D']) && !empty($_POST['image1D'])) {
                                    Storage::disk('public_root')->delete('images/' . $_POST['image1D']);
                                }
                                $post['image1'] = $webpFilename;
                                $post['alt1'] = $request->input('alt1');
                                $post['imgTitle1'] = $request->input('imgTitle1');
                            }
                        }
                    }
                    if($request->hasFile('image2')){
                        if ($request->file('image2')->isValid()) {

                            $file = $request->file('image2');
                            do {
                                $webpFilename = 'proimage2-'. Str::random(8) .'.webp';
                                $exists = $this->commonmodel->isExists('tbl_product',['image2'=>$webpFilename]);
                            } while ($exists);
                            $image = Image::make($file)->encode('webp', 80);
                            $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                            if($path){
                                if (isset($_POST['image2D']) && !empty($_POST['image2D'])) {
                                    Storage::disk('public_root')->delete('images/' . $_POST['image2D']);
                                }
                                $post['image2'] = $webpFilename;
                                $post['alt2'] = $request->input('alt2');
                                $post['imgTitle2'] = $request->input('imgTitle2');
                            }
                        }
                    }
                    if($request->hasFile('image3')){
                        if ($request->file('image3')->isValid()) {

                            $file = $request->file('image3');
                            do {
                                $webpFilename = 'proimage3-'. Str::random(8) .'.webp';
                                $exists = $this->commonmodel->isExists('tbl_product',['image3'=>$webpFilename]);
                            } while ($exists);
                            $image = Image::make($file)->encode('webp', 80);
                            $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                            if($path){
                                if (isset($_POST['image3D']) && !empty($_POST['image3D'])) {
                                    Storage::disk('public_root')->delete('images/' . $_POST['image3D']);
                                }
                                $post['image3'] = $webpFilename;
                                $post['alt3'] = $request->input('alt3');
                                $post['imgTitle3'] = $request->input('imgTitle3');
                            }
                        }
                    }
                    if($request->hasFile('image4')){
                        if ($request->file('image4')->isValid()) {

                            $file = $request->file('image4');
                            do {
                                $webpFilename = 'proimage4-'. Str::random(8) .'.webp';
                                $exists = $this->commonmodel->isExists('tbl_product',['image4'=>$webpFilename]);
                            } while ($exists);
                            $image = Image::make($file)->encode('webp', 80);
                            $path = Storage::disk('public_root')->put('images/'. $webpFilename, (string) $image);
                            if($path){
                                if (isset($_POST['image4D']) && !empty($_POST['image4D'])) {
                                    Storage::disk('public_root')->delete('images/' . $_POST['image4D']);
                                }
                                $post['image4'] = $webpFilename;
                                $post['alt4'] = $request->input('alt4');
                                $post['imgTitle4'] = $request->input('imgTitle4');
                            }
                        }
                    }
                    $post['activeTab'] = 1;
                    $post['pro_name'] = $request->input('pro_name');
                    $post['sub_title'] = $request->input('sub_title');
                    $post['pro_url'] = $request->input('pro_url');
                    $post['cat_id'] = $request->input('cat_id');
                    $tabname = 'Basic';
                }
            }
            if($request->input('tab') == 'tab2'){
                $rules = [
                    'pro_id' => 'required',
                ];
                $errorMessage = ['pro_id.required'=>'You must complete the basic tab first.'];
                $validated = $this->validate($request, $rules, $errorMessage);
            
                if($validated){
                    $post['activeTab'] = 2;
                    $post['description'] = $request->input('description');
                    $post['keyIngred'] = $request->input('keyIngred');
                    $post['application'] = $request->input('application');
                    $tabname = 'Description';

                }
            }
            if($request->input('tab') == 'tab3'){
                $rules = [
                    'pro_id' => 'required',
                    'unit' => 'required',
                    'value' => 'required',
                    'sp' => 'required',
                ];
                $errorMessage = ['pro_id.required'=>'You must complete the basic tab first.'];
                $validated = $this->validate($request, $rules, $errorMessage);
            
                if($validated){
                    $post['activeTab'] = 3;
                    if($id){
                        $attr['pro_id'] = $request->input('pro_id');
                        $attr['unit'] = $request->input('unit');
                        $attr['value'] = $request->input('value');
                        $attr['sp'] = $request->input('sp');
                        $attr['status'] = $request->input('status');
                        if(!$attrId){
                            $attr['added_at'] = date('Y-m-d H:i:s');
                            $this->commonmodel->crudOperation('C','tbl_product_attributes',$attr);
                        }else{
                            $attr['update_at'] = date('Y-m-d H:i:s');
                            $this->commonmodel->crudOperation('U','tbl_product_attributes',$attr,['attrId'=>$attrId]);
                        }
                    }
                    $tabname = 'Attributes';

                }
            }
            if($request->input('tab') == 'tab4'){
                $rules = [
                    'pro_id' => 'required',
                ];
                $errorMessage = ['pro_id.required'=>'You must complete the basic tab first.'];
                $validated = $this->validate($request, $rules, $errorMessage);
            
                if($validated){
                    $post['activeTab'] = 4;
                    $post['show_front'] = $request->input('show_front');
                    $post['status'] = $request->input('status');
                    $tabname = 'Status';

                }
            }
            if(!empty($post)){
                if(!$id){
                    $post['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $id = $this->commonmodel->crudOperation('C','tbl_product',$post);

                }else{
                    $post['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->crudOperation('U','tbl_product',$post,['pro_id'=>$id]);
                }
                if(isset($inserted)){
                    $request->session()->flash('message',['msg'=> $tabname.' added successfully!','type'=>'success']);
                }elseif(isset($updated)){
                    $request->session()->flash('message',['msg'=> $tabname.' updated successfully!','type'=>'success']);
                }else{
                    $request->session()->flash('message',['msg'=>'Something went wrong. try again...','type'=>'danger']);
                }
                return redirect()->to('admin/add_edit_product/'.$id);
            }

        }
        if($id){
            $data['record'] = $this->commonmodel->crudOperation('R1','tbl_product','',['pro_id'=>$id]);
            $data['attributes'] = $this->commonmodel->crudOperation('RA','tbl_product_attributes','',[['pro_id','=',$id]]);
            if($attrId){
                $this->commonmodel->crudOperation('U','tbl_product',['activeTab'=>3],['pro_id'=>$id]);
                $data['attr'] = $this->commonmodel->crudOperation('R1','tbl_product_attributes','',['attrId'=>$attrId]);
            }
        }
        $data['proCategory'] = $this->commonmodel->crudOperation('RA','tbl_product_category','',['status'=>1]);
        return view('admin.product.add_edit_product', $data);
    }
    public function delete_product(Request $request, $id=null){
        if($id){
            $record = $this->commonmodel->crudOperation('R1','tbl_product','',['pro_id'=>$id]);
            if(!empty($record)){
                $imagePath = public_path('assets/uploads/images/' . $record->image1);
                if (!empty($record->image1) && File::exists($imagePath)) {
                    File::delete($imagePath);
                }
                $image2Path = public_path('assets/uploads/images/' . $record->image2);
                if (!empty($record->image2) && File::exists($image2Path)) {
                    File::delete($image2Path);
                }
                $image3Path = public_path('assets/uploads/images/' . $record->image3);
                if (!empty($record->image3) && File::exists($image3Path)) {
                    File::delete($image3Path);
                }
                $image4Path = public_path('assets/uploads/images/' . $record->image4);
                if (!empty($record->image4) && File::exists($image4Path)) {
                    File::delete($image4Path);
                }
                if($this->commonmodel->crudOperation('D','tbl_product','',['pro_id'=>$id])){
                    $request->session()->flash('message',['msg'=>'Record Deleted.','type'=>'success']);
                }else{
                    $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
                }
            }
        }
        return redirect()->to('admin/products');
    }
    public function delete_attr(Request $request, $id=null, $attrId=null){
        if($id && $attrId){
                
            if($this->commonmodel->crudOperation('D','tbl_product_attributes','',[['pro_id','=',$id],['attrId','=',$attrId]])){
                $request->session()->flash('message',['msg'=>'Record Deleted.','type'=>'success']);
            }else{
                $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
            }
            return redirect()->to('admin/add_edit_product/'.$id);
        }
        return redirect()->to('admin/products');
    }
    /*****************************Product Category ************************************************************************ */
    public function product_category(Request $request, $id=null){
        
        $data['records'] = $this->commonmodel->crudOperation('RA','tbl_product_category','',[['status','!=',2]],['id','DESC']);
        if($id)
            $data['record'] = $this->commonmodel->crudOperation('R1','tbl_product_category','',['id'=>$id]);
        return view('admin.product.pro_category', $data);
    }
    public function add_edit_pro_category(Request $request){
        $data = [];
        if($request->isMethod('POST')){
            $id = $request->input('id');
            $validated = $this->validate($request, [
                'category_name' => 'required',
            ],
            );
            if($validated){
                // print_r($_POST); exit;
                /*if($request->hasFile('photo')){
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
                }*/
                $post['category_name'] = $request->input('category_name');
                $post['status'] = $request->input('status');
                if(!$id){
                    $post['added_at'] = date('Y-m-d H:i:s');
                    $inserted = $this->commonmodel->crudOperation('C','tbl_product_category',$post);

                }else{
                    $post['update_at'] = date('Y-m-d H:i:s');
                    $updated = $this->commonmodel->crudOperation('U','tbl_product_category',$post,['id'=>$id]);
                }
                if(isset($inserted)){
                    $request->session()->flash('message',['msg'=>'Product Category added successfully!','type'=>'success']);
                }elseif(isset($updated)){
                    $request->session()->flash('message',['msg'=>'Product Category updated successfully!','type'=>'success']);
                }else{
                    $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
                }

                
            }
        }
        return redirect()->to('admin/product_category');
        
    }
    public function delete_pro_category(Request $request, $id=null){
        if($this->commonmodel->crudOperation('U','tbl_product_category',['status'=>2],['id'=>$id])){

            $request->session()->flash('message',['msg'=>'Record Deleted.','type'=>'success']);
        }else{
            $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
        }
            
        return redirect()->to('admin/product_category');
    }
}
