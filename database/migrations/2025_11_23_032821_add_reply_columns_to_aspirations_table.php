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
        Schema::table('aspirations', function (Blueprint $table) {
            $table->text('reply')->nullable()->after('content');
            $table->unsignedBigInteger('replied_by_admin_id')->nullable()->after('reply');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aspirations', function (Blueprint $table) {
            $table->dropColumn(['reply', 'replied_by_admin_id']);
        });
    }
};
