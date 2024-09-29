<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public const GENDER_MALE = 1;
    public const GENDER_FEMALE = 2;

    protected $guarded = ['id'];

    public function getGenderNameAttribute()
    {
        return $this->gender === self::GENDER_MALE ? 'Male' : 'Female';
    }

}
