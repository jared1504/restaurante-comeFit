<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleStoreRequest;
use App\Http\Requests\SaleUpdateRequest;
use App\Models\Category;
use App\Models\Sale;
use App\Models\Table;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Role;

class SaleController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $rol = $user->getRoleNames(); //obtener el rol del usuario

        if ($rol[0] == "admin") { //el usuario es administrador
            $fechaActual = date('Y-m-d');
            $total = 0;
            $cobrado = 0;
            $sales = Sale::whereDate('created_at', $fechaActual)
                ->orderBy('status')
                ->paginate(10);
            foreach ($sales as $sale) {
                $total += $sale->total;
                if ($sale->status >= 5) {
                    $cobrado += $sale->total;
                }
            }

            return view('sale.index', compact('sales', 'total', 'cobrado'));
        } else  if ($rol[0] == "cashier") { //el usuario es cajero
            return redirect(route('cashier.index'));
        } else  if ($rol[0] == "waiter") { //el usuario es mesero
            return redirect(route('waiter.create'));
        } else  if ($rol[0] == "chef") { //el usuario es chef
            return redirect(route('chef.index'));
        }
    }


    public function filter(Request $request)
    {
        if ($request->date == null) {
            $fecha = date('Y-m-d');
            $sales = Sale::whereDate('created_at', $fecha)
                ->orderBy('status')
                ->paginate(10);
            $total = 0;
            foreach ($sales as $sale) {
                $total += $sale->total;
            }
        } else {
            $fecha = $request->date;
            $sales = Sale::whereDate('created_at', $fecha)
                ->orderBy('status')
                ->paginate(10);
            $total = 0;
            foreach ($sales as $sale) {
                $total += $sale->total;
            }
        }

        return view('sale.filter', compact('sales', 'total', 'fecha'));
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
