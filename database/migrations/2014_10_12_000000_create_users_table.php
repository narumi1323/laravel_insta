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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->longText('avatar')->nullable();
            $table->string('password');
            $table->string('introduction',100)->nullable();
            $table->unsignedBigInteger('role_id')
                    ->default(2)
                    ->comment('1:admin 2:user');
                    //ユーザーの役割を符号なしのビッグ整数として格納するrole_id列を作成。default(2)メソッドは、列のデフォルト値を2に設定し、通常のユーザーの役割を示す。comment()メソッドは、列とその可能な値の説明を提供
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
