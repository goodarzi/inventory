<?php

namespace Goodarzi\Inventory\Http\Controllers;

use Goodarzi\Inventory\Models\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sourceData = Source::orderBy('id', 'desc')->paginate(25);

        return view('inventoryview::sources.index', compact('sourceData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventoryview::sources.create');
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
             ]);
            $request_additional = [
                'user_id' => $request->user()->id,
            ];

            $request->merge($request_additional);
      
            //  Store data in database
            Source::create($request->all());
      
            //
            return redirect()->route('sources.index')->with('success', ' سورس ساخته شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function show(Source $source)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function edit(Source $source)
    {
        return view('inventoryview::sources.edit', compact('source'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Source $source)
    {
        $request->validate([
            'name' => 'required',
        ]);

        //$inventoryTransaction->fill($request->input())->save();
        $source->update($request->all());

        $changes = $source->getChanges();

        if ($changes) {
            return redirect()->route('sources.index')
                ->with('success', 'سورس با موفقیت ویرایش شد.');
        } else {
            return redirect()->route('sources.index')
            ->with('warning', 'چیزی تغییر نکرد!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function destroy(Source $source)
    {
        //
    }
}
