<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyRepresentative extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'full_name',
        'title',
        'email',
        'can_sign',
    ];
}
