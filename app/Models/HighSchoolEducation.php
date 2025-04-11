<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HighSchoolEducation extends MasterModel
{
    use HasFactory;

    protected $keyType = 'string';

    public $incrementing = false;
}
