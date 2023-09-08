<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
      Schema::create("role_user", function(Blueprint $table){
        $table->uuid("user_id");
        $table->foreign("user_id")->references("id")->on("users");

        $table->uuid("role_id");
        $table->foreign("role_id")->references("id")->on("roles");

        $table->primary(["user_id", "role_id"]);

        $table->uuid('created_by')->nullable();
        $table->foreign('created_by')->references('id')->on("users");
        $table->softDeletes();
        $table->timestamps();
      });
    }


};
