<?php

namespace Goodarzi\Inventory\Rules;

use Illuminate\Contracts\Validation\Rule;
use Goodarzi\Inventory\Models\InventoryCode;


class InventoryCodeQty implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($inventory_code)
    {
        $this->inventory_code = $inventory_code;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        
        //
        $InventoryCode = InventoryCode::where('code', $this->inventory_code)->first();
        if ( $InventoryCode->qty < $value) { 

            $this->inventory_code_qty = $InventoryCode->qty;
            return false;

        } else { 
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'تعداد مورد درخواست بیشتر از باقیمانده است.' . $this->inventory_code_qty;
    }
}
