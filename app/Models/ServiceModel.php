<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_services';
    public $timestamps = false;
    protected $fillable = ['banner_title','banner_image','service_name', 'serv_title', 'serv_url', 'photo', 'details', 'status', 'added_at', 'update_at'];
}
