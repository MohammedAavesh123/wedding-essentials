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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            
            // General Settings
            $table->string('site_name')->default('Wedding Essentials');
            $table->string('site_logo')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->text('address')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            
            // Theme Colors
            $table->string('primary_color')->default('#4F46E5'); // Modern Indigo
            $table->string('secondary_color')->default('#10B981'); // Emerald Green
            $table->string('accent_color')->default('#F59E0B'); // Warm Amber
            $table->string('text_color')->default('#1F2937'); // Dark Gray
            $table->string('background_color')->default('#F9FAFB'); // Light Gray
            
            $table->timestamps();
        });
        
        // Insert default row
        DB::table('site_settings')->insert([
            'site_name' => 'Wedding Essentials',
            'primary_color' => '#4F46E5',
            'secondary_color' => '#10B981',
            'accent_color' => '#F59E0B',
            'text_color' => '#1F2937',
            'background_color' => '#F9FAFB',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
