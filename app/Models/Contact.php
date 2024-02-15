<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperContact
 */
class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "subject",
        "email",
        "status",

    ];
}
