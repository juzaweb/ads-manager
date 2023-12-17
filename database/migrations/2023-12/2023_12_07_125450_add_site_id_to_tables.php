<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table(
            'juad_ads',
            function (Blueprint $table) {
                $table->index('type');
                $table->index('position');
                $table->index('active');
                $table->unsignedBigInteger('site_id')->default(0)->index();
            }
        );

        Schema::table(
            'juad_video_ads',
            function (Blueprint $table) {
                $table->index('position');
                $table->index('active');
                $table->unsignedBigInteger('site_id')->default(0)->index();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table(
            'juad_ads',
            function (Blueprint $table) {
                $table->dropIndex(['type']);
                $table->dropIndex(['position']);
                $table->dropIndex(['active']);
                $table->dropColumn(['site_id']);
            }
        );

        Schema::table(
            'juad_video_ads',
            function (Blueprint $table) {
                $table->dropIndex(['position']);
                $table->dropIndex(['active']);
                $table->dropColumn(['site_id']);
            }
        );
    }
};
