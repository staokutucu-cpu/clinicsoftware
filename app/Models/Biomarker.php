<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Biomarker extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'unit', 'optimal_min', 'optimal_max', 'description'];

    // A biomarker (e.g. Vitamin D) has many measurements from different users
    public function measurements(): HasMany
    {
        return $this->hasMany(Measurement::class);
    }
}
