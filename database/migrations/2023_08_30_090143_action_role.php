<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::create("action_role", function(Blueprint $table){

            $table->unsignedBigInteger("role_id");
            $table->foreign("role_id")->references("id")->on("roles");
    
            $table->unsignedBigInteger("action_id");
            $table->foreign("action_id")->references("id")->on("actions");

            $table->primary(["role_id", "action_id"]);
    
            $table->timestamps();
          });
    }

};
