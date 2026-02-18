<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectInterest extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'company_name',
        'contact_person',
        'email',
        'phone',
        'interest_type',
        'message',
        'admin_notified',
        'notified_at',
    ];

    protected $casts = [
        'admin_notified' => 'boolean',
        'notified_at' => 'datetime',
    ];
}
