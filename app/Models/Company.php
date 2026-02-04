<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'company_type',
        'registration_number',
        'country',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'client_company_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'created_by_company_id');
    }
}