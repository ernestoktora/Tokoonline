<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('user', 'name') && !Schema::hasColumn('user', 'nama')) {
            DB::statement('ALTER TABLE user CHANGE name nama VARCHAR(255) NOT NULL');
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('user', 'nama') && !Schema::hasColumn('user', 'name')) {
            DB::statement('ALTER TABLE user CHANGE nama name VARCHAR(255) NOT NULL');
        }
    }
};