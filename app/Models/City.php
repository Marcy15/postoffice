<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class City extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'zip_code',
        'name',
        'id_county',
    ];

    public function county(): BelongsTo
    {
        return $this->belongsTo(County::class, 'id_county');
    }

    public function population(): HasOne
    {
        return $this->hasOne(Population::class, 'city');
    }
}
