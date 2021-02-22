<?php

namespace Goodarzi\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Goodarzi\Inventory\Models\Product;
use IntlDateFormatter;

use Goodarzi\Inventory\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
class ProductController extends Controller
{
    public function index()
    {
        $productData = Product::orderBy('id', 'desc')->paginate(25);

        return view('inventoryview::products.index', compact('productData'));
    }

    public function show($sku)
    {
        //$inventoryCodes = Product::findOrFail($id)->inventoryCodes;
        //var_dump($inventoryCodes);

        //return view('inventoryview::products.show', ['product' => Product::findOrFail($id), 'inventoryCodes' => Product::findOrFail($id)->inventoryCodes]);
        return view('inventoryview::products.show', ['product' => Product::where('sku', $sku)->firstOrFail(), 'inventoryCodes' => Product::where('sku', $sku)->firstOrFail()->inventoryCodes]);
    }
    

        // Create Form
    public function create() {
        $generatedSku = $this->generateSku();
        return view('inventoryview::products.create', compact('generatedSku'));
    }

    // Store Form data in database
    public function store(Request $request) {

        // Form validation
        $this->validate($request, [
            'sku' => 'required|unique:products|regex:/^[a-zA-Z0-9]*$/|size:4',
            'name' => 'required|unique:products',
         ]);

        $request_additional = [
            'user_id' => $request->user()->id,
        ];
        $request->merge($request_additional);

        //  Store data in database
        Product::create($request->all());
  
        //
        //return back()->with('success', 'Your form has been submitted.');
        return redirect()->route('products.index')->with('success', 'محصول جدید با موفقیت ایجاد شد.');

    }

    public function edit(Product $product) {

        return view('inventoryview::products.edit', compact('product'));
    }

    public function update(Request $request, Product $product) {

        $request->validate([
            'name' => 'required|unique:products',
        ]);

        //$inventoryTransaction->fill($request->input())->save();
        $product->update($request->all());

        $changes = $product->getChanges();

        if ($changes) {
            return redirect()->route('products.index')
                ->with('success', 'محصول با موفقیت ویرایش شد.');
        } else {
            return redirect()->route('products.index')
            ->with('warning', 'چیزی تغییر نکرد!');
        }

    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'محصول با موفقیت حذف شد.');
    }

    public function export() 
    {
        //return Excel::download(new ProductsExport, 'products.xlsx');
        return (new ProductsExport)->download('products.csv', \Maatwebsite\Excel\Excel::CSV);

    }

    public function search(Request $request)
    {
    	$products = [];

        if($request->has('q')){
            $search = $request->q;
            $products = Product::select("sku", "name", "qty")
            		->where('name', 'LIKE', "%$search%")
            		->get();
        }
        return response()->json($products);
    }

    public function query(Request $request)
    {
      $input = $request->all();

        $data = Product::select("name")
                  ->where("name","LIKE","%{$input['query']}%")
                  ->get();
   
        return response()->json($data);
    }

    public function productIndex()
    {
        return view('welcome');
    }

    public function getProducts(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    function generateSku() {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        // Output: 54esmdr0qf
        $sku = substr(str_shuffle($permitted_chars), 0, 4);
    
        // call the same function if the barcode exists already
        if ($this->skuExists($sku)) {
            return $this->generateSku();
        }
    
        // otherwise, it's valid and can be used
        return $sku;
    }
    
    function skuExists($sku) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Product::whereSku($sku)->exists();
    }

}
