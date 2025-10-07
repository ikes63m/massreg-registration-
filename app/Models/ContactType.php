<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactType extends Model // <--- THIS MUST BE THE EXACT CLASS NAME
{
    use HasFactory;

    protected $table = 'contact_types';

    protected $fillable = ['type', 'description', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}