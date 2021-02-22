<?php

namespace Goodarzi\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Goodarzi\Inventory\Models\InventoryCode;
use Goodarzi\Inventory\Models\Stock;

use Goodarzi\Inventory\Exports\InventoryCodesExport;
use Maatwebsite\Excel\Facades\Excel;

class InventoryCodeController extends Controller 
{
    public function index()
    {
        $inventoryCodeData = InventoryCode::with('stock')->orderBy('id', 'desc')->paginate(25);
        //$stock = InventoryCode::find(1)->stock->name;
        //var_dump($inventoryCodeData);
        return view('inventoryview::inventory_codes.index', compact('inventoryCodeData'));
    }

    public function show($code)
    {

        return view('inventoryview::inventory_codes.show', ['inventory_code' => InventoryCode::where('code', $code)->firstOrFail()]);
    }

            // Create Form
    public function create() 
    {

        $stocks = Stock::pluck('name', 'id');
        $selectedID = 1;
        return view('inventoryview::inventory_codes.create', compact('selectedID', 'stocks'));
    }

    // Store Form data in database
    public function store(Request $request) {
        

        // Form validation
        $this->validate($request, [
            'code' => 'required|regex:/^[a-zA-Z0-9]*$/|size:6|unique:inventory_codes,code,NULL,id,stock_id,' . $request->stock_id,

            'stock_id' => 'required',
         ]);
        $request_additional = [
            'user_id' => $request->user()->id,
        ];
        $request->merge($request_additional);
  
        //  Store data in database
        InventoryCode::create($request->all());
  
        //
        //return back()->with('success', 'Your form has been submitted.');
        return redirect()->route('inventory_codes.index')->with('success', 'کد انبار ساخته شد.');

    }

    public function edit(InventoryCode $inventoryCode) {

        //$inventoryCode->load('product');

        return view('inventoryview::inventory_codes.edit', compact('inventoryCode'));
    }

    public function update(Request $request, InventoryCode $inventoryCode) {

        $request->validate([
            'description' => 'required',
        ]);

        //$inventoryTransaction->fill($request->input())->save();

        $inventoryCode->update($request->all());
        $changes = $inventoryCode->getChanges();

        if ($changes) {
            return redirect()->route('inventory_codes.index')
                ->with('success', 'کد انبار با موفقیت ویرایش شد.');
        } else {
            return redirect()->route('inventory_codes.index')
            ->with('warning', 'چیزی تغییر نکرد!');
        }

    }

    public function destroy(InventoryCode $inventoryCode)
    {

        if ($inventoryCode->qty == 0 ) {
            $inventoryCode->delete();
            return redirect()->route('inventory_codes.index')
                ->with('success', 'کد انبار با موفقیت حذف شد.');
        } else {
            return redirect()->route('inventory_codes.index')
                ->with('error', 'کد انبار خالی نیست.');
        }
    }

    public function export() 
    {
        //return Excel::download(new InventoryCodesExport, 'inventory_codes-' . time() . '.xlsx');
        return (new InventoryCodesExport)->download('inventory_codes.csv', \Maatwebsite\Excel\Excel::CSV);

    }

    public function query(Request $request)
    {
      $input = $request->all();

        $data = InventoryCode::select("code")
                  ->where("code","LIKE","%{$input['query']}%")
                  ->get();
   
        return response()->json($data);
    }

}
