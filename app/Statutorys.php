<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statutorys extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'added_by','compId','statutory_doc','statutory_due_date','statutory_msg','status','created_at', 'updated_at'];
}
