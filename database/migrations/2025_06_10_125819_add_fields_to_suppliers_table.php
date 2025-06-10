<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->string('nama')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('alamat')->nullable();
        });
    }

    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn(['nama', 'no_hp', 'email', 'alamat']);
        });
    }
};
