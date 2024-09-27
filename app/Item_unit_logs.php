<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_unit_logs extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'itemId','item_base_unit','item_sec_unit','item_unit_other','created_at','updated_at'];
}
