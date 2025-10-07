<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryType extends Model
{
    use HasFactory;

    protected $table = 'industry_types';

    protected $fillable = ['type', 'description', 'is_active'];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];
}