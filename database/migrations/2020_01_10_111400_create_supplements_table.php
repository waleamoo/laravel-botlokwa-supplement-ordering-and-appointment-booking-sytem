<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplements', function (Blueprint $table) {
            $table->bigIncrements('supplement_id');
            $table->string('supplement_name');
            $table->integer('supplement_price');
            $table->integer('supplement_price_old')->nullable();
            $table->float('discount')->nullable();
            $table->text('supplement_description');
            $table->string('supplement_pic');
            $table->unsignedBigInteger('supplement_category_id');
            $table->integer('qty_in_stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplements');
    }
}
