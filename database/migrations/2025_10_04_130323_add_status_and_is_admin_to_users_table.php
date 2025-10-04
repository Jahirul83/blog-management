<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1)->after('password'); // 1 active, 0 inactive
            $table->tinyInteger('is_admin')->default(0)->after('status'); // 1 = admin
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['status', 'is_admin']);
        });
    }
};

