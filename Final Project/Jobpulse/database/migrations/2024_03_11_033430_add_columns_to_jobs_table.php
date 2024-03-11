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
            $table->text('requirements')->after('amount');
            $table->text('experience')->nullable();
            $table->text('responsibilities');
            $table->text('compensations');
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
