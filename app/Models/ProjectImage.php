<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    protected $fillable = ['project_id', 'path', 'is_primary'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
