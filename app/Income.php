<?php


namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    // Explicitly set the table name if it's not the plural form of the model
    protected $table = 'income';

    // Define the fillable fields
    protected $fillable = ['id', 'addBy', 'dateInput', 'name', 'categoryIncome', 'other_income','amount','specification','created_at','updated_at'];

    
}

