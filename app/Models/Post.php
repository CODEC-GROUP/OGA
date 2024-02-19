<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPost
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'type',
        'statistics',
        'event_date',
        'event_time'
    ];
}
