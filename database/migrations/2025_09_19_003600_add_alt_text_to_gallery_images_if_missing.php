<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('gallery_images') && !Schema::hasColumn('gallery_images', 'alt_text')) {
            Schema::table('gallery_images', function (Blueprint $table) {
                $table->string('alt_text')->nullable()->after('file_path');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('gallery_images') && Schema::hasColumn('gallery_images', 'alt_text')) {
            Schema::table('gallery_images', function (Blueprint $table) {
                $table->dropColumn('alt_text');
            });
        }
    }
};
