<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense_cats extends Model
{
    use HasFactory;
	protected $fillable = ['id', 'cat_name'];
}
