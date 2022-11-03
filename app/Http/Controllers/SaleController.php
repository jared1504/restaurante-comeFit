<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleStoreRequest;
use App\Http\Requests\SaleUpdateRequest;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sales = Sale::all();

        return view('sale.index', compact('sales'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('sale.create');
    }

    /**
     * @param \App\Http\Requests\SaleStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleStoreRequest $request)
    {
        $sale = Sale::create($request->validated());

        $request->session()->flash('sale.id', $sale->id);

        return redirect()->route('sale.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Sale $sale)
    {
        return view('sale.show', compact('sale'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Sale $sale)
    {
        return view('sale.edit', compact('sale'));
    }

    /**
     * @param \App\Http\Requests\SaleUpdateRequest $request
     * @param \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function update(SaleUpdateRequest $request, Sale $sale)
    {
        $sale->update($request->validated());

        $request->session()->flash('sale.id', $sale->id);

        return redirect()->route('sale.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Sale $sale)
    {
        $sale->delete();

        return redirect()->route('sale.index');
    }
}
