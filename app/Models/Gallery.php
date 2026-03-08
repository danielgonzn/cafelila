<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    public const CATEGORY_FARM = 'finca';
    public const CATEGORY_BEANS = 'granos';
    public const CATEGORY_PRODUCT = 'producto final';

    protected $fillable = [
        'title',
        'image',
        'category',
    ];

    public static function categories(): array
    {
        return [
            self::CATEGORY_FARM,
            self::CATEGORY_BEANS,
            self::CATEGORY_PRODUCT,
        ];
    }
}
