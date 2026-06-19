<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusFieldToActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            // Kita beri pengecekan bff (berjaga-jaga) agar tidak error jika kolom sudah ada
            if (!Schema::hasColumn('activity_logs', 'status')) {
                $table->string('status', 50)->default('success')->after('description');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            if (Schema::hasColumn('activity_logs', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
}