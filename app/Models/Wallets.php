<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallets  extends MasterModel
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'balance',
        
        
    ];
}
