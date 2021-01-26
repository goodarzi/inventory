<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToInventoryTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_transactions', function (Blueprint $table) {
            $table->foreign('sku')->references('sku')->on('products');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('stock_id')->references('id')->on('stocks');
            $table->foreign('inventory_code')->references('code')->on('inventory_codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `lcase_insert_sku`');
        Schema::table('inventory_transactions', function (Blueprint $table) {

            $table->dropForeign('sku');
            $table->dropForeign('user_id');
            $table->dropForeign('stock_id');
            $table->dropForeign('inventory_code');

        });
    }
}
