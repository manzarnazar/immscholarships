<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    use HasFactory;


    protected $table = 'withdraw_requests';


    protected $fillable = [
        'user_id',
        'bank_name',
        'name',
        'amount',
        'email',
        'status',
        'acc_no'
    ];

   
    public $timestamps = true;

   
     public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
