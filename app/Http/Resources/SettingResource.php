<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "monSite" => $this->monSite,
            "smtp" => $this->smtp,
            "numero" => $this->numero,
            "adresseMail" => $this->adresseMail,
            "adressePysique" => $this->adressePysique,
            "siteName" => $this->siteName,
            "siteEmail" => $this->siteEmail,
            "siteContact1" => $this->siteContact1,
            "siteContact2" => $this->siteContact2,
            "siteLogoUrl" => $this->siteLogoUrl,
            "siteLink" => $this->siteLink,
            "siteAddress" => $this->siteAddress,
            "facebookPage" => $this->facebookPage,
            "siteCopyright" => $this->siteCopyright,
            "siteKeywords" => $this->siteKeywords,
            "siteAuthor" => $this->siteAuthor,
            "linkedlinPage" => $this->linkedlinPage,
            "instagramPage" => $this->instagramPage,
            "twitterPage" => $this->twitterPage,
            "youtubePage" => $this->youtubePage,
            "siteDesc" => $this->siteDesc,
        ];
    }
}
