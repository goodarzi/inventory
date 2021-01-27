<?php

namespace Goodarzi\Inventory\Http\Controllers;

use Goodarzi\Inventory\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stockData = Stock::with('source')->orderBy('id', 'desc')->paginate(25);
        return view('inventoryview::stocks.index', compact('stockData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventoryview::stocks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // Form validation
            $this->validate($request, [
                'name' => 'required',
                'source_id' => 'required',
             ]);
            $request_additional = [
                'user_id' => $request->user()->id,
            ];

            $request->merge($request_additional);
      
            //  Store data in database
            Stock::create($request->all());
      
            //
            return redirect()->route('stocks.index')->with('success', ' انبار ساخته شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        return view('inventoryview::stocks.edit', compact('stock'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'name' => 'required',
        ]);

        //$inventoryTransaction->fill($request->input())->save();
        $stock->update($request->all());

        $changes = $stock->getChanges();

        if ($changes) {
            return redirect()->route('stocks.index')
                ->with('success', 'انبار با موفقیت ویرایش شد.');
        } else {
            return redirect()->route('stocks.index')
            ->with('warning', 'چیزی تغییر نکرد!');
        }    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
