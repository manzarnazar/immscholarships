<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institutions extends MasterModel
{
    use HasFactory;

    protected $guarded = ['_token'];

}
