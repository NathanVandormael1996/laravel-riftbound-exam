<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('social_id')->nullable()->after('password');
            $table->string('social_type')->nullable()->after('social_id');
            $table->string('avatar')->nullable()->after('social_type');
            $table->string('password')->nullable()->change();
        });
    }
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['social_id', 'social_type', 'avatar']);
            $table->string('password')->nullable(false)->change();
        });
    }
};
