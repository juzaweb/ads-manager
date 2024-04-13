<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $uuidGenerateFunc = DB::getDefaultConnection() === 'mysql' ? 'uuid()': 'gen_random_uuid()';

        DB::table('juad_ads')
            ->where(
                fn($q) => $q->whereNull('uuid')
                    ->orWhere('uuid', '')
            )
            ->update([
                'uuid' => DB::raw($uuidGenerateFunc),
            ]);

        DB::table('juad_video_ads')
            ->where(
                fn($q) => $q->whereNull('uuid')
                    ->orWhere('uuid', '')
            )
            ->update([
                'uuid' => DB::raw($uuidGenerateFunc),
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        //
    }
};
