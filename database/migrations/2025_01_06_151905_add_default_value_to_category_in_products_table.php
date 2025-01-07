<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultValueToCategoryInProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('category')->default('Uncategorized')->change(); // Ganti 'Uncategorized' dengan nilai default yang diinginkan  
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('category')->nullable()->change(); // Kembalikan ke nullable jika perlu  
        });
    }
}
