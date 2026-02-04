<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'description',
        'project_type',
        'capacity_mw',
        'location',
        'current_step',
        'qr_expires_at',
        'nda_signature',
        'nda_signed_at',
        'inception_completed_at',
        'rfq_data',
        'rfq_completed_at',
        'client_company_id',
    ];

    protected $casts = [
        'qr_expires_at' => 'datetime',
        'nda_signed_at' => 'datetime',
        'inception_completed_at' => 'datetime',
        'rfq_completed_at' => 'datetime',
        'rfq_data' => 'array',
        'capacity_mw' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($project) {
            if (empty($project->uuid)) {
                $project->uuid = Str::uuid();
            }
        });
    }

    public function clientCompany()
    {
        return $this->belongsTo(Company::class, 'client_company_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function isStepAccessible(int $step): bool
    {
        return $step <= $this->current_step;
    }

    public function canAccessStep(int $step): bool
    {
        // Can access current step or any previous step
        return $step <= $this->current_step;
    }

    public function completeStep(int $step): void
    {
        if ($step == $this->current_step) {
            $this->current_step = min($step + 1, 7); // Max 7 steps in EAC process
            $this->save();
        }
    }

    public function isQrExpired(): bool
    {
        return $this->qr_expires_at && $this->qr_expires_at->isPast();
    }
}