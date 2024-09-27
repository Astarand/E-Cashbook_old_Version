<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ca_details extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'uId','utype','assign_ca_firm','ca_name','ca_email','ca_phone','ca_addr_one','ca_addr_two','ca_state','ca_city','ca_pincode','ca_status','show_status','ca_set_permission','is_email','is_whatsapp','created_at','updated_at'];
}
