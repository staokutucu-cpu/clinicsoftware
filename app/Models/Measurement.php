<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Measurement extends Model
{
    use HasFactory;

    protected $fillable = ['biomarker_id', 'value', 'measured_at', 'note'];

    protected $casts = ['measured_at' => 'date'];

    // A measurement belongs to one patient (user)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // A measurement belongs to one biomarker
    public function biomarker(): BelongsTo
    {
        return $this->belongsTo(Biomarker::class);
    }

    // Is the value inside the optimal longevity range of its biomarker?
    public function isOptimal(): bool
    {
        return $this->value >= $this->biomarker->optimal_min
            && $this->value <= $this->biomarker->optimal_max;
    }
}
