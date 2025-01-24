<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->string("schoolName");
            $table->boolean("colleageStudent")->default(true)->comment("A college or a non college");
            $table->string("majaor");
            $table->string("indication");
            $table->string("graduation");
            $table->string("other");
            $table->boolean("verify")->default(false)->comment("verify student card");
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
        Schema::dropIfExists('students');
    }
}
