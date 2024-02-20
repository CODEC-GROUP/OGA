<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin IdeHelperPost
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image_url',
        'type',
        'statistics',
        'event_date',
        'event_time'
    ];

    public function projectCategories(): BelongsToMany
    {
        return $this->belongsToMany(ProjectCategory::class);
    }
}
