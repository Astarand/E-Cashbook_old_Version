<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
	protected $guard = 'admin';
	
	 protected $fillable = [
        'name', 'email', 'password'
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];
}
