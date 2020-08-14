<?php

use App\EBP\Constants\DBTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadedFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DBTable::UPLOADED_FILES, function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('file_name')->nullable();
            $table->integer('file_category_id')->unsigned();
            $table->string('original_filename')->nullable();
            $table->longText('content')->nullable();
            $table->integer('order')->default('1');;
            $table->string('content_type');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('file_category_id')->references('id')->on(DBTable::FILE_CATEGORY)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(DBTable::UPLOADED_FILES);
    }
}
