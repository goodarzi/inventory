<?php

namespace Goodarzi\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Goodarzi\Inventory\Models\InventoryTransaction;
use Goodarzi\Inventory\Models\Product;
use Goodarzi\Inventory\Models\Stock;
use Goodarzi\Inventory\Models\InventoryCode;
use Goodarzi\Inventory\Rules\InventoryCodeDedicated;
use Goodarzi\Inventory\Rules\InventoryCodeQty;

use DNS1D;

class InventoryTransactionController extends Controller
{
    public function index()
    {
        $inventoryTransactionData = InventoryTransaction::with('product', 'inventoryCode', 'user')->orderBy('id', 'desc')->paginate(25);
        //var_export($inventoryTransactionData);
        return view('inventoryview::inventory_transactions.index', compact('inventoryTransactionData'));
    }

    // Create Inventory Transaction Form
    public function create()
    {
        $stocks = Stock::pluck('name', 'id');
        $selectedID = 1;
        return view('inventoryview::inventory_transactions.create', compact('selectedID', 'stocks'));
    }
        
    // Create Inventory Transaction Form
    public function createInventoryTransactionAddition(Request $request)
    {
        $stocks = Stock::pluck('name', 'id');
        $selectedID = 1;
        return view('inventoryview::inventory_transactions.addition', compact('selectedID', 'stocks'));
    }
    // Create Inventory Transaction Form
    public function createInventoryTransactionRemoval(Request $request)
    {
        $stocks = Stock::pluck('name', 'id');
        $selectedID = 1;
        return view('inventoryview::inventory_transactions.removal', compact('selectedID', 'stocks'));
    }

    // Store Inventory Transaction Form data
    public function store(Request $request)
    {
        $sku = $request->input('sku');
        $inventory_code = $request->input('inventory_code');
        $stockId = $request->input('stock_id');

        // Form validation
        $this->validate($request, [
            'sku' => 'required|exists:products,sku',
            'type' => 'required',
            'qty' => 'required',
            'description' => 'required',
            'stock_id' => 'required',
            'inventory_code' => 'required|exists:inventory_codes,code',
         ]);
        $this->validate($request, [
            'inventory_code' => (new InventoryCodeDedicated($sku, $stockId))
        ]);


        if ($request->input('type') == 'addition') {
            $qty = $request->input('qty');
        } elseif ($request->input('type') == 'removal') {
            $this->validate($request, [
                'qty' => (new InventoryCodeQty($inventory_code, $stockId))
            ]);
            $qty = -$request->input('qty');
        }


        $Product = Product::where('sku', $sku)->first();
        $InventoryCode = InventoryCode::where('code', $inventory_code)->where('stock_id', $stockId)->first();

        $ProductQty = $Product->qty + $qty;
        $InventoryCodeQty = $InventoryCode->qty + $qty;

        $updateInventoryCodeData = [
            'qty' => $InventoryCodeQty,
            'sku' => $sku,
        ];
        $updateProductData = [
            'qty' => $ProductQty,
        ];

        $Product->update($updateProductData);
        $InventoryCode->update($updateInventoryCodeData);

        //  Store data in database
        $request_additional = [
            'user_id' => $request->user()->id,
            'stock_id' => $stockId,
            'product_qty' => $ProductQty,
            'inventory_code_qty' => $InventoryCodeQty,
        ];
        $request->merge($request_additional);
        InventoryTransaction::create($request->all());

        //
        //return back()->with('success', 'Inventory transaction has been created.');
        return redirect()->route('inventory_transactions.index')->with('success', 'تراکنش انبار با موفقیت انجام شد.');
    }

    public function edit(InventoryTransaction $inventoryTransaction)
    {
        $inventoryTransaction->load('product');

        return view('inventoryview::inventory_transactions.edit', compact('inventoryTransaction'));
    }

    public function update(Request $request, InventoryTransaction $inventoryTransaction)
    {
        $request->validate([
            'description' => 'required',
        ]);

        //$inventoryTransaction->fill($request->input())->save();

        $inventoryTransaction->update($request->all());
        $changes = $inventoryTransaction->getChanges();

        if ($changes) {
            return redirect()->route('inventory_transactions.index')
                ->with('success', 'Project updated successfully');
        } else {
            return redirect()->route('inventory_transactions.index')
            ->with('warning', 'چیزی تغییر نکرد!');
        }
    }
}
