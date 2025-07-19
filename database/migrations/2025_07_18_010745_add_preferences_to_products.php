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
        Schema::table('products', function (Blueprint $table) {
            $table->string('preferencia_uno')->nullable()->after('image');
            $table->string('preferencia_dos')->nullable()->after('preferencia_uno');
            $table->string('preferencia_tres')->nullable()->after('preferencia_dos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['preferencia_uno', 'preferencia_dos', 'preferencia_tres']);
        });
    }
};
