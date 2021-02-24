<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'quantity',
        'full_specification',
        'main_photo_path'

    ];

    public static function withId(?int $id): Builder
    {
        return self::query()
            ->where('id', '=', $id);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
