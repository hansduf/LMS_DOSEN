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
        Schema::table('assignments', function (Blueprint $table) {
            if (!Schema::hasColumn('assignments', 'attachment_link')) {
                $table->string('attachment_link')->nullable()->after('description');
            }
            if (Schema::hasColumn('assignments', 'total_points')) {
                $table->dropColumn('total_points');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assignments', function (Blueprint $table) {
            if (Schema::hasColumn('assignments', 'attachment_link')) {
                $table->dropColumn('attachment_link');
            }
            // Don't re-add total_points
        });
    }
};
