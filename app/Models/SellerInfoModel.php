<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerInfoModel extends Model
{
    use HasFactory;

    protected $table = 'seller_infos';

    protected $fillable = [
        'info',
        'name',
        'main_photo',
        'phone',
        'email',
        'additional_contact',
        'delivery_terms',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
