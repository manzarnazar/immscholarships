<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refferals extends MasterModel
{
   
 protected $table = 'refferals';
   protected $fillable = [
    'referrer_id',
    'referred_id',
    'status',
    'commission',
];
}
?>