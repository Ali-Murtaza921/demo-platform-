<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->timestamp('suspended_at')->nullable()->after('identity_verification_meta');
            $table->timestamp('suspension_ends_at')->nullable()->after('suspended_at');
            $table->text('suspension_reason')->nullable()->after('suspension_ends_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn([
                'suspended_at',
                'suspension_ends_at',
                'suspension_reason',
            ]);
        });
    }
};
