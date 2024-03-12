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
        Schema::table('jobs', function (Blueprint $table) {
            $table->longText('requirements')->after('amount');
            $table->longText('experience')->nullable();
            $table->longText('responsibilities');
            $table->longText('compensations');
            $table->text('location');
            $table->enum('employee_status',['Full Time', 'Part time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('requirements');
            $table->dropColumn('experience')->nullable();
            $table->dropColumn('responsibilities');
            $table->dropColumn('compensations');
            $table->dropColumn('location');
            $table->dropColumn('employee_status',['Full Time', 'Part time']);
        });
    }
};
