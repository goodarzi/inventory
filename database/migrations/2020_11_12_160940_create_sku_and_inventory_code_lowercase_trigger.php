<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkuAndInventoryCodeLowercaseTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        // products.sku
        DB::unprepared('
        CREATE TRIGGER lcase_insert_sku BEFORE INSERT ON products FOR EACH ROW
        SET NEW.sku = LOWER(NEW.sku);
        
        ');
        DB::unprepared('
        CREATE TRIGGER lcase_update_sku BEFORE UPDATE ON products FOR EACH ROW
        SET NEW.sku = LOWER(NEW.sku);

        ');



        // inventory_codes.code
        DB::unprepared('
        CREATE TRIGGER lcase_insert_inventory_code BEFORE INSERT ON inventory_codes FOR EACH ROW
        SET NEW.code = LOWER(NEW.code);
        
        ');
        DB::unprepared('
        CREATE TRIGGER lcase_update_inventory_code BEFORE UPDATE ON inventory_codes FOR EACH ROW
        SET NEW.code = LOWER(NEW.code);
        
        ');


        //inventory_codes.sku
        DB::unprepared('
        CREATE TRIGGER lcase_insert_inventory_code_sku BEFORE INSERT ON inventory_codes FOR EACH ROW
        SET NEW.sku = LOWER(NEW.sku);
        
        ');
        DB::unprepared('
        CREATE TRIGGER lcase_update_inventory_code_sku BEFORE UPDATE ON inventory_codes FOR EACH ROW
        SET NEW.sku = LOWER(NEW.sku);

        ');


        //inventory_transactions.sku
        DB::unprepared('
        CREATE TRIGGER lcase_insert_transaction_sku BEFORE INSERT ON inventory_transactions FOR EACH ROW
        SET NEW.sku = LOWER(NEW.sku);
        
        ');
        DB::unprepared('
        CREATE TRIGGER lcase_update_transaction_sku BEFORE UPDATE ON inventory_transactions FOR EACH ROW
        SET NEW.sku = LOWER(NEW.sku);

        ');

        //inventory_transactions.inventory_code
        DB::unprepared('
        CREATE TRIGGER lcase_insert_transaction_inventory_code BEFORE INSERT ON inventory_transactions FOR EACH ROW
        SET NEW.sku = LOWER(NEW.sku);
        
        ');
        DB::unprepared('
        CREATE TRIGGER lcase_update_transaction_inventory_code BEFORE UPDATE ON inventory_transactions FOR EACH ROW
        SET NEW.inventory_code = LOWER(NEW.inventory_code);

        ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `lcase_insert_sku`');
        DB::unprepared('DROP TRIGGER `lcase_update_sku`');
        DB::unprepared('DROP TRIGGER `lcase_insert_inventory_code`');
        DB::unprepared('DROP TRIGGER `lcase_update_inventory_code`');
        DB::unprepared('DROP TRIGGER `lcase_insert_inventory_code_sku`');
        DB::unprepared('DROP TRIGGER `lcase_update_inventory_code_sku`');
        DB::unprepared('DROP TRIGGER `lcase_insert_transaction_sku`');
        DB::unprepared('DROP TRIGGER `lcase_update_transaction_sku`');
        DB::unprepared('DROP TRIGGER `lcase_insert_transaction_inventory_code`');
        DB::unprepared('DROP TRIGGER `lcase_update_transaction_inventory_code`');

    }
}
