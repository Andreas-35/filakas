<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('barangs', function (Blueprint $table) {
        $table->string('satuan')->nullable(); // atau bisa disesuaikan tipe datanya
    });
}

public function down()
{
    Schema::table('barangs', function (Blueprint $table) {
        $table->dropColumn('satuan');
    });
}

};
