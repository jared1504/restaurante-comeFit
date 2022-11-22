<?php

namespace App\Http\Controllers;

use App\Models\ChefSale;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;

class ChefController extends Controller
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
            ->where('status', 1)
            ->paginate(10);
        return view('viewsChef.index', compact('sales'));
    }
    public function filter()
    {
        $sales = [];
        $total = 0;
        $fecha = date('Y-m-d');
        foreach (auth()->user()->chefSales as $chef) {
            if ($fecha == $chef->sale->created_at->format('Y-m-d')) { //traer solo las ventas de dia
             
                array_push($sales, $chef->sale);
            }
        }

        return view('viewsChef.filter', compact('sales'));
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
        //
        $sale = Sale::find($id);
        return view('viewsChef.show', compact('sale'));
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
        $saleDetail = SaleDetail::find($id);
        switch ($saleDetail->status) {
            case 1:
                $saleDetail->status = 2;
                break;
            case 2:
                $saleDetail->status = 1;
                break;
        }
        $saleDetail->save();

        $acu = 0;
        $total = 0;
        foreach ($saleDetail->sale->saleDetails as $detail) {
            $acu++;
            $total += $detail->status;
        }
        //actualizar el status de la venta
        if ($total == $acu * 2) {
            $saleDetail->sale->status = 2;
            $saleDetail->sale->save();

            //guardar el chef
            $chef = new ChefSale();
            $chef->sale_id = $saleDetail->sale->id;
            $chef->user_id = auth()->user()->id;
            $chef->save();
        }
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
