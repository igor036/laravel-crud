<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->uniqid();
            $table->string('phone')->uniqid();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
