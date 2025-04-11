<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends MasterModel
{
    use HasFactory;

        protected $fillable = [
        'value',

    ];
}
