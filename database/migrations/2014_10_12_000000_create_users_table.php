<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email',100)->unique();
            $table->string('email_verified_code');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('permanentAddress');
            $table->string('streetAddress1');
            $table->string('streetAddress2');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('contactNo');
            $table->enum('status', ['activate', 'deactivate', 'pending']);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
