<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create("roles", function(Blueprint $table){
            $table->bigIncrements("id");
            $table->enum("name", ["admin", "user", "Employee"]);
            $table->timestamps();
        });
    }
};
