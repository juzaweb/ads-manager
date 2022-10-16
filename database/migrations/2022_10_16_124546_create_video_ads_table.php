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
    public function up()
    {
        Schema::create(
            'juad_video_ads',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name', 50);
                $table->timestamps();
            }
        );

        Schema::create(
            'juad_video_ad_videos',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('video_ad_id');
                $table->string('url');
                $table->foreign('video_ad_id')
                    ->references('id')
                    ->on('juad_video_ads')
                    ->onDelete('cascade');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('juad_video_ad_videos');
        Schema::dropIfExists('juad_video_ads');
    }
};
