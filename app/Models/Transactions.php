<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions  extends MasterModel
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'transaction_id',
        'tx_ref',
        'amount',
        'currency',
        'user_id',
        'applicationId',
        'status'
        
    ];

 public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
