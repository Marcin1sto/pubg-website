<?php

use App\Enums\MatchGameModeEnum;
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
        Schema::create('boost_ranking_stats', function (Blueprint $table) {
            $table->id();
            $table->enum('stat_type', MatchGameModeEnum::parentModes());
            $table->float('count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boost_ranking_stats');
    }
};
