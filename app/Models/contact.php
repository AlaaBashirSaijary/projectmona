<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
     // الحقول المسموح بتعبئتها
     protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'description',
    ];
}
