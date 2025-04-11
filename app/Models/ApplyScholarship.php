<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyScholarship extends MasterModel
{
    use HasFactory;

    public function user()
{
    return $this->belongsTo(User::class, 'student_id');
}
    public function scholarship()
{
    return $this->belongsTo(Scholarships::class, 'scholarship_id');
}
}
