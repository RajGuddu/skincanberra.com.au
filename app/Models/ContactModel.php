<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_contact';
    public $timestamps = false;
    protected $fillable = ['vid','sv_id','submit_from', 'fname', 'lname', 'email', 'country', 'phone', 'date', 'time', 'message', 'status', 'added_at', 'update_at'];
}
