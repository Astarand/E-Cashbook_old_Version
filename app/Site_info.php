<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site_info extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'title','value', 'status'];
}
