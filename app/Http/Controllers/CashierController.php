<?php

namespace App\Http\Controllers;

use App\Models\CashierSale;
use App\Models\Sale;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * 1->el mesero tomo el pedido
         * 2->el chef preparo los platillos
         * 3->el mesero entrego los platillos
         * 4->el cliente pidio la cuenta
         * 5->el cajero cobro la venta
         * 6->concluida
         */
        $fechaActual = date('Y-m-d');
        $sales = Sale::whereDate('created_at', $fechaActual)
            ->where('status', 4)
            ->paginate(10);
        // $sales = Sale::->paginate(10);
        return view('viewsCashier.index', compact('sales'));
    }
    public function filter()
    {
        $sales = [];
        $total = 0;
        $fecha = date('Y-m-d');
        foreach (auth()->user()->cashierSales as $cashier) {
            if ($fecha == $cashier->sale->created_at->format('Y-m-d')) { //traer solo las ventas de dia
                $total+=$cashier->sale->total;
                array_push($sales, $cashier->sale);
            }
        }
       
        return view('viewsCashier.filter', compact('sales', 'total', 'fecha'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::find($id);
        return view('viewsCashier.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sale = Sale::find($id);
        $sale->status = 5;
        $sale->save();

        //asignar el cobro al cajero
        $cashier = new CashierSale();
        $cashier->user_id = auth()->user()->id;
        $cashier->sale_id = $sale->id;
        $cashier->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
