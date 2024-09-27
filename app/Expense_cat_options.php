<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense_cat_options extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'cat_id','opt_val'];
}
