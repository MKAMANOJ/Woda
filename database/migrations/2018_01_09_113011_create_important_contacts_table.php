<?php

use App\EBP\Constants\DBTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportantContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DBTable::IMPORTANT_CONTACTS, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('important_contact_category_id')->unsigned();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('designation')->nullable();
            $table->string('mobile')->nullable();
            $table->string('service')->nullable();
            $table->string('image');
            $table->timestamps();

            $table->foreign('important_contact_category_id')->references('id')
                ->on(DBTable::IMPORTANT_CONTACT_CATEGORY)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(DBTable::IMPORTANT_CONTACTS);
    }
}
