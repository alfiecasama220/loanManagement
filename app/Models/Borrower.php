<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Borrower extends Authenticatable
{
    protected $table = 'borrowers';

    protected $fillable = [
        'name', 'email', 'password', // Add your columns here
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    
}
