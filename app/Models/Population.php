<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Population extends Model
{
    use HasFactory;

    protected $table = 'population';

    public $timestamps = false;

    protected $fillable = [
        'city',
        'population',
    ];

    public function cityRecord(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city');
    }
}
