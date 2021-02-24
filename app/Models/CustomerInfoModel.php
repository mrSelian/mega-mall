<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInfoModel extends Model
{
    use HasFactory;

    protected $table = 'customer_infos';

    protected $fillable = [
        'phone',
        'email',
        'additional_contact',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
