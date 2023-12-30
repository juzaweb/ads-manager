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
                $table->uuid()->index();
                $table->bigInteger('views')->default(0)->index();
                $table->bigInteger('click')->default(0)->index();
            }
        );

        Schema::table(
            'juad_video_ads',
            function (Blueprint $table) {
                $table->uuid()->index();
                $table->bigInteger('views')->default(0)->index();
                $table->bigInteger('click')->default(0)->index();
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
            'juad_video_ads',
            function (Blueprint $table) {
                $table->dropColumn(['uuid', 'views', 'click']);
            }
        );

        Schema::table(
            'juad_ads',
            function (Blueprint $table) {
                $table->dropColumn(['uuid', 'views', 'click']);
            }
        );
    }
};
