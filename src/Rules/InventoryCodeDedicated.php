<?php

namespace Goodarzi\Inventory\Rules;

use Illuminate\Contracts\Validation\Rule;
use Goodarzi\Inventory\Models\InventoryCode;

class InventoryCodeDedicated implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($sku)
    {
        //
        $this->sku = $sku;
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

        
        $InventoryCode = InventoryCode::where('code', $value)->first();


        /* echo "<pre>";
        echo "attribiute";
        echo "<br>";
        var_dump($attribute);
        echo "value";
        echo "<br>";
        var_dump($value);
        echo "sku";
        echo "<br>";
        var_dump($InventoryCode);
        var_dump($this->sku);
        echo "</pre>"; 
        exit;*/
        
        if ($InventoryCode->sku == null OR $InventoryCode->sku == $this->sku
        OR $InventoryCode->qty == 0) { 
            return true;
        } else {
            return false;
        }
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'کد انبار برای محصول دیگری استفاده شده است.';
    }
}
