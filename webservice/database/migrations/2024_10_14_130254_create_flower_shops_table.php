<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlowerShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flower_shops', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the flower product
            $table->text('description'); // Description of the product
            $table->decimal('price', 8, 2); // Price with 2 decimal places
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flower_shops');
    }
}
