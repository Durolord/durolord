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
        Schema::table('hymn_usages', function (Blueprint $table) {
            $table->foreignId('hymn_id')
                ->nullable()
                ->after('service_id')
                ->constrained()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hymn_usages', function (Blueprint $table) {
            $table->dropConstrainedForeignId('hymn_id');
        });
    }
};
