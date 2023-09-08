<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create("roles", function(Blueprint $table){
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->enum("name", ["admin", "user", "Employee"]);
            $table->uuid('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on("users");
            $table->softDeletes();
            $table->timestamps();
        });
    }
};
