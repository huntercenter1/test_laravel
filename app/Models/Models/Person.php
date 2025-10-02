<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Person extends Model
{
    protected $fillable = [
        'name', 'description', 'gender', 'hobbies', 'country_id'
    ];

    protected $casts = [
        'hobbies' => 'array', // para checkboxes
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
