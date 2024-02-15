<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperProjectCategory
 */
class ProjectCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_url'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
