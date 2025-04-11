<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarships extends MasterModel
{
    use HasFactory;

    public function institution()
    {
        return $this->belongsTo(Institutions::class, 'institution_id');
    }


}
