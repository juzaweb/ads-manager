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
                $table->uuid('id')->unique();
                $table->string('name', 50);
                $table->string('title')->nullable();
                $table->string('video');
                $table->string('url')->nullable();
                $table->string('position', 50);
                $table->integer('offset')->default(1);
                $table->json('options')->nullable();
                $table->boolean('active')->default(1);
                $table->timestamps();
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
        Schema::dropIfExists('juad_video_ads');
    }
};
