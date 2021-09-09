<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->default('');
            $table->string('surname')->default('');
            $table->string('contact_email')->default('');
            $table->string('phone')->default('');
            $table->smallInteger('is_company')->default(0);
            $table->string('company_id')->default('');
            $table->string('company_name')->default('');
            $table->string('company_vat_id')->default('');
            $table->string('company_tax_id')->default('');
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
        Schema::dropIfExists('customers');
    }
}
