<?php

use App\EBP\Constants\DBTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DBTable::GALLERY_IMAGE, function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('gallery_category_id')->unsigned();
            $table->string('original_filename');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('gallery_category_id')->references('id')->on(DBTable::GALLERY_CATEGORY)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(DBTable::GALLERY_IMAGE);
    }
}
