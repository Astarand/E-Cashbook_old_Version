<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ca_assigns extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'comp_id','utype','ca_id','set_permission','request_for','ca_assign_status','created_at', 'updated_at'];
}
