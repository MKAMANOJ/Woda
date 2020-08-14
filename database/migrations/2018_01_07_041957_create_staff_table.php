<?php

use App\EBP\Constants\DBTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DBTable::STAFF, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('nepali_name');
            $table->string('designation')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('personal_phone')->nullable();
            $table->string('office_phone')->nullable();
            $table->date('appointment_date')->nullable();
            $table->integer('order');
            $table->string('image');
            $table->softDeletes();
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
        Schema::dropIfExists(DBTable::STAFF);
    }
}
