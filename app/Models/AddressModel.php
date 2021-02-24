<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'country',
        'region',
        'city',
        'street',
        'house',
        'apt',
        'full_name',
        'zip'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
