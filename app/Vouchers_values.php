<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vouchers_values extends Model
{
    use HasFactory;
	protected $fillable = ['id','sid','uid','prod_id','quantity','rate','disc','tax_amt','amount','created_at','updated_at'];
}
