<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        "monSite",
        "smtp",
        "numero",
        "adresseMail",
        "adressePysique",
        "siteName",
        "siteEmail",
        "siteContact1",
        "siteContact2",
        "siteLogoUrl",
        "siteLink",
        "siteAddress",
        "facebookPage",
        "siteCopyright",
        "siteKeywords",
        "siteAuthor",
        "linkedlinPage",
        "instagramPage",
        "twitterPage",
        "youtubePage",
        "siteDesc",


    ];
}
