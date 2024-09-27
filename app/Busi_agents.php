<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Busi_agents extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'agent_id','agent_name','agent_email','agent_phone','agent_whats_no','company_name','company_website','address_lineone','address_linetwo','agent_city','agent_state','agent_pincode','agent_country','added_by','status','created_at', 'updated_at'];
}
