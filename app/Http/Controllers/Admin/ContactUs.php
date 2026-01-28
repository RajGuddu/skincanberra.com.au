<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\Approve;
use App\Models\Common_model;
// use App\Models\ServiceVariantsModel;
class ContactUs extends Controller
{
    private $commonmodel;
    public function __construct(){
        $this->commonmodel = new Common_model;
    }
    public function index(Request $request){
       $data['contactList'] = $this->commonmodel->crudOperation('RA','tbl_contact','','',['id','DESC']);
       if ($request->isMethod('POST')){
            $id = $_POST['id'];
            $post['status'] = $_POST['status'];
            $updated = $this->commonmodel->crudOperation('U','tbl_contact', $post, ['id'=>$id]);
            if($updated){
                if($post['status'] == 1){
                    $record = $this->commonmodel->crudOperation('R1','tbl_contact','', ['id'=>$id]);
                    if(isset($record->id)){
                        $post['fname'] = $record->fname;
                        $post['lname'] = $record->lname;
                        $post['country'] = $record->country;
                        $post['phone'] = $record->phone;
                        $post['email'] = $record->email;
                        if($record->vid != NULL){
                            $post['service_name'] = $this->commonmodel->get_variants_name($record->vid);

                        }elseif($record->sv_id != NULL){
                            $post['service_name'] = $this->commonmodel->get_service_name($record->sv_id);
                        }
                        $post['date'] = date('d-M-Y',strtotime($record->date));
                        $post['time'] = date('h:i A',strtotime($record->time));
                        Mail::to($post['email'])->send(new Approve($post));
                    }
                }
                $request->session()->flash('message', ['msg'=>'Record Updated Successfully', 'type'=>'success']);
            }else{
                $request->session()->flash('message', ['msg'=>'Record Not Update. Please try again...', 'type'=>'danger']);
            }
            return redirect()->to(url('admin/contact_us'));
        }
        
        return view('admin.contact_us.contact_index', $data);
    }
    /* public function add_edit_service(Request $request, $id=null){
        $data = $post = [];
        if($request->isMethod('POST')){
            $validated = $this->validate($request, [
                'service_name' => 'required',
                'serv_url' => 'required',
            ],
            [
                'serv_url.required' => 'Url is required',
            ]);
            if($validated){
                // print_r($_POST); exit;
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
                    $post['service_name'] = $request->input('service_name');
                    $post['serv_title'] = $request->input('serv_title');
                    $post['serv_url'] = $request->input('serv_url');
                    $post['details'] = $request->input('details');
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
