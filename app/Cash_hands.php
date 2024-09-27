<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash_hands extends Model
{
    use HasFactory;
	protected $fillable = ['id','added_by','amount_in_hand','created_at','updated_at'];
}
?>