<?php

use App\EBP\Constants\DBTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AlterEmailTemplateTableAddSubjectColumn
 */
class AlterEmailTemplateTableAddSubjectColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(DBTable::EMAIL_TEMPLATES, function (Blueprint $table) {
            $table->string('subject', 500)->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(DBTable::EMAIL_TEMPLATES, function (Blueprint $table) {
            $table->dropColumn('subject');
        });
    }
}
