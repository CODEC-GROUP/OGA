<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("monSite");
            $table->string("smtp");
            $table->string("numero");
            $table->string("adresseMail");
            $table->string("adressePysique");
            $table->string("siteName");
            $table->string("siteEmail");
            $table->string("siteContact1");
            $table->string("siteContact2");
            $table->string("siteLogoUrl");
            $table->string("siteLink");
            $table->string("siteAddress");
            $table->string("facebookPage");
            $table->string("siteCopyright");
            $table->string("siteKeywords");
            $table->string("siteAuthor");
            $table->string("linkedlinPage");
            $table->string("instagramPage");
            $table->string("twitterPage");
            $table->string("youtubePage");
            $table->string("siteDesc");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
