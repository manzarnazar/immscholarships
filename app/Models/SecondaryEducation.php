<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecondaryEducation extends MasterModel
{
    use HasFactory;
    protected $keyType = 'string';

    public $incrementing = false;

}
