<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceVariantsModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_services_variants';
    public $timestamps = false;
    protected $fillable = ['sv_id', 'v_name', 'v_url', 'photo','duration', 'mrp', 'sp', 'details', 'status','position', 'added_at', 'update_at'];
}
