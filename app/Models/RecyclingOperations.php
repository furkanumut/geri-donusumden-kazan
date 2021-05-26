<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecyclingOperations extends Model
{
    use HasFactory;

    protected $fillable = [
        'recycling_photo',
        'recycling_bin_photo',
        'verified',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
