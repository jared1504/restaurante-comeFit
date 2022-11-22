<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Sale;
use App\Models\Table;
use App\Models\Category;
use App\Models\SaleDetail;
use App\Models\WaiterSale;
use Illuminate\Http\Request;

class WaiterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = [];
        foreach (auth()->user()->waiterSales as $waiter) {
            $fechaActual = date('Y-m-d');
            if ($fechaActual == $waiter->sale->created_at->format('Y-m-d')) { //traer solo las ventas de dia
                switch ($waiter->sale->status) {
                    case 1:
                        $waiter->sale->status = "En Preparación";
                        break;
                    case 2:
                        $waiter->sale->status = "Platillos Listos";
                        break;
                    case 3:
                        $waiter->sale->status = "Entregada a los comensales";
                        break;
                    case 4:
                        $waiter->sale->status = "Pago solicitado";
                        break;
                    case 5:
                        $waiter->sale->status = "Pagada";
                        break;
                    case 6:
                        $waiter->sale->status = "Concluida";
                        break;
                }
                array_push($sales, $waiter->sale);
            }
        }
        return view('viewsWaiter.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tables = Table::all();
        return view('viewsWaiter.create', compact('categories', 'tables'));
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
        if (!$request->table) {
            $request->session()->flash('message', "Debe Seleccionar una mesa");
            $request->session()->flash('type', "danger");
            return back();
        }

        //validar que por lo menos haya un ingrediente
        $aux = 0;
        foreach ($request->dishes as $key => $value) {
            $aux += $value;
        }

        if ($aux <= 0) {
            $request->session()->flash('message', "Debe agregar por lo menos un platillo");
            $request->session()->flash('type', "danger");

            return back();
        }
        /**
         * 1->el mesero tomo el pedido
         * 2->el chef preparo los platillos
         * 3->el mesero entrego los platillos
         * 4->el cliente pidio la cuenta
         * 5->el cajero cobro la venta
         * 6->concluida
         */
        $sale = new Sale();
        $sale->status = 1;
        $sale->total = 0;
        $sale->table_id = $request->table;
        $sale->save();
        $total = 0;
        foreach ($request->dishes as $key => $value) {
            if ($value != null && $value > 0) {
                $dish = Dish::find($key);
                $saleDetail = new  SaleDetail();
                $saleDetail->status = 1;
                $saleDetail->sale_id = $sale->id;
                $saleDetail->dish_id = $key;
                $saleDetail->amount = $value;
                $saleDetail->price = $dish->price;
                $saleDetail->subtotal = $dish->price * $value;
                $saleDetail->save();
                $total += $dish->price * $value;

                //actualizar stock de los ingredientes
                foreach ($dish->dishIngredients as $dishIngredient) {
                    $ingredient = $dishIngredient->ingredient;
                    $ingredient->stock -=  $value;
                    $ingredient->save();
                }
            }
        }
        //guardar el total de la venta
        $sale->total = $total;
        $sale->save();

        //marcar la mesa como ocupada
        $table = $sale->table;
        $table->status = 0;
        $table->save();

        //guardar el mesero
        $waiter = new WaiterSale();
        $waiter->sale_id = $sale->id;
        $waiter->user_id = auth()->user()->id;
        $waiter->save();
        return redirect(route('waiter.index'));
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
        switch ($sale->status) {
            case 1:
                $sale->status = "En Preparación";
                break;
            case 2:
                $sale->status = "Platillos Listos";
                break;
            case 3:
                $sale->status = "Entregada a los comensales";
                break;
            case 4:
                $sale->status = "Pago solicitado";
                break;
            case 5:
                $sale->status = "Pagada";
                break;
            case 6:
                $sale->status = "Concluida";
                break;
        }
        return view('viewsWaiter.show', compact('sale'));
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
        //
        $sale = Sale::find($id);
        switch ($sale->status) {
            case 2:
                $sale->status = 3;
                break;
            case 3:
                $sale->status = 4;
                break;
            case 5:
                $sale->status = 6;
                //desocupar mesa
                $sale->table->status = 1;
                $sale->table->save();
                break;
        }
        $sale->save();
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
