<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'plan_name','plan_type','monthly_price','yearly_price','plan_title','plan_desc','plan_included','service','service_status','service_unlimited','appointment','appointment_status','appointment_unlimited','appointment','appointment_status','appointment_unlimited','staffs','staffs_status','staffs_unlimited','gallery','gallery_status','gallery_unlimited','additional','additional_status','additional_unlimited','isactive','created_at','updated_at'];
}
