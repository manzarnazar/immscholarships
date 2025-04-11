<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


     protected $primaryKey = 'id';
     public $incrementing = false;
     protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'status',
        'user_type',
        'otp',
        'otp_expiry',
        'whatsappNumber',
        'country_origin',
        'referral_code',
        'referred_by',
        'otp_verified',
        'education_level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


protected static function boot()
{
    parent::boot();
    static::created(function ($user) {
        $user->update(['referral_code' => strtoupper(Str::random(8))]);
    });
}


    // Relationships

    public function basicInfo()
    {
        return $this->hasOne(Students::class);
    }

    public function passportInfo()
    {
        return $this->hasOne(Passports::class);
    }

    public function englishAbility()
    {
        return $this->hasOne(EnglishAbility::class);
    }

    public function chineseAbility()
    {
        return $this->hasOne(ChineseAbility::class);
    }

    public function degreeEducation()
    {
        return $this->hasOne(DegreeEducation::class);
    }

    public function diplomaEducation()
    {
        return $this->hasOne(DiplomaEducation::class);
    }

    public function secondaryEducation()
    {
        return $this->hasOne(SecondaryEducation::class);
    }

    public function familyBackground()
    {
        return $this->hasOne(FamilyBackground::class);
    }

    public function financialSupporter()
    {
        return $this->hasOne(FinancialSupporter::class);
    }

    public function contactInfoApplicant()
    {
        return $this->hasOne(ContactInfoApplicant::class);
    }

    public function contactInfoHome()
    {
        return $this->hasOne(ContactInfoHome::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachments::class);
    }


    public function scholarships()
    {
        return $this->hasMany(Scholarships::class);
    }

    public function MasterEducation()
    {
        return $this->hasMany(MasterEducation::class);
    }
    
}
