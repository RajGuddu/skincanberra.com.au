<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Common_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\Admin\SettingsModel;

class Settings extends Controller
{
    private $commonmodel;
    public function __construct(){
        $this->commonmodel = new Common_model;
    }
    public function update_settings(Request $request){
        if($request->isMethod('POST')){
            $post = $_POST;
            unset($post['_token']);
            if(isset($_POST['weeklyHolidays']) && !empty($_POST['weeklyHolidays'])){
                $post['weeklyHolidays'] = implode(',',$_POST['weeklyHolidays']);
            }
            if(SettingsModel::where('id', 1)->update($post)){
                $request->session()->flash('message',['msg'=>'Settings Updated','type'=>'success']);
            }else{
                $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
            }
            return redirect()->to('admin/settings');

        }
        $data['settings'] = SettingsModel::where(['id'=>1])->first();
        return view('admin.settings.settings', $data);
    }
    public function remove_image(Request $request){
        if($request->isMethod('POST')){
            $table = $request->table;
            $field = $request->field;
            $pkey  = $request->pkey;
            $id    = $request->id;

            $record = $this->commonmodel->getOneRecord($table, [$pkey=>$id]);
            if($record){
                $imagePath = public_path('assets/uploads/images/' . $record->$field);
                if (!empty($record->$field) && File::exists($imagePath)) {
                    File::delete($imagePath);
                }
                if($this->commonmodel->updateRecord($table, [$field=>''], [$pkey=>$id])){
                    $request->session()->flash('message',['msg'=>'Image removed!','type'=>'success']);
                }else{
                    $request->session()->flash('message',['msg'=>'Please Try After Sometimes...','type'=>'danger']);
                }
            }
        }
        return response()->json(['message' => 'success']);
    }
    
}
