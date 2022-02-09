<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProgramId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer_product', function (Blueprint $table) {
            $table->string('program_id')->nullable()->after('offer_id');
            $table->string('product_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer_product', function (Blueprint $table) {
            $table->dropColumn('program_id');
            $table->string('product_id')->nullable(false)->change();
        });
    }
}
