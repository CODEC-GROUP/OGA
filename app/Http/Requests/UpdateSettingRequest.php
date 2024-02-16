<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "monSite" => 'required|string',
            "smtp" => 'required|string',
            "numero" => 'required|string',
            "adresseMail" => 'required|string',
            "adressePysique" => 'required|string',
            "siteName" => 'required|string',
            "siteEmail" => 'required|string',
            "siteContact1" => 'required|string',
            "siteContact2" => 'required|string',
            "siteLogoUrl" => 'required|string',
            "siteLink" => 'required|string',
            "siteAddress" => 'required|string',
            "facebookPage" => 'required|string',
            "siteCopyright" => 'required|string',
            "siteKeywords" => 'required|string',
            "siteAuthor" => 'required|string',
            "linkedlinPage" => 'required|string',
            "instagramPage" => 'required|string',
            "twitterPage" => 'required|string',
            "youtubePage" => 'required|string',
            "siteDesc" => 'required|string'
        ];
    }
}
