<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('community_memberships', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email')->unique();
            $table->string('phone', 40);
            $table->string('country', 100);
            $table->string('state', 100);
            $table->string('city', 100);
            $table->string('application_type', 120);
            $table->string('organization', 200);
            $table->string('areas_of_interest', 200);
            $table->string('participation_preference', 200);
            $table->string('education_qualification', 150);
            $table->text('about_yourself');
            $table->boolean('community_consent');
            $table->timestamp('community_consented_at');
            $table->boolean('email_updates')->default(false);
            $table->timestamp('email_updates_consented_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('community_memberships');
    }
};
