<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierStoreRequest;
use App\Http\Requests\SupplierUpdateRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = Supplier::all();

        return view('supplier.index', compact('suppliers'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('supplier.create');
    }

    /**
     * @param \App\Http\Requests\SupplierStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierStoreRequest $request)
    {
        $supplier = Supplier::create($request->validated());

        $request->session()->flash('supplier.id', $supplier->id);

        return redirect()->route('supplier.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Supplier $supplier)
    {
        return view('supplier.show', compact('supplier'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * @param \App\Http\Requests\SupplierUpdateRequest $request
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierUpdateRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());

        $request->session()->flash('supplier.id', $supplier->id);

        return redirect()->route('supplier.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('supplier.index');
    }
}
