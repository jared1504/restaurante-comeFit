<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Ingredient;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::paginate(10);

        return view('order.index', compact('orders'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ingredients = Ingredient::all();
        $suppliers = Supplier::all();
        return view('order.create', compact('ingredients', 'suppliers'));
    }

    /**
     * @param \App\Http\Requests\OrderStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*  $order = Order::create($request->validated());

        $request->session()->flash('order.id', $order->id); */
        $this->validate($request, [
            'supplier_id' => 'required|numeric',
            'orderIngredients' => 'required|array',
            'orderIngredients.*' => 'numeric|nullable',
        ]);

        //validar que por lo menos haya un ingrediente
        $aux = 0;
        foreach ($request->orderIngredients as $key => $value) {
            $aux += $value;
        }

        if ($aux <= 0) {
            $request->session()->flash('message', "Debe agregar por lo menos un ingrediente");
            $request->session()->flash('type', "danger");

            return back();
        }

        //guardar cambios
        $order = new  Order();
        $order->supplier_id = $request->supplier_id;
        $order->user_id = 1; //cambiar cuando ya haya autenticación
        $order->total = 0;
        $order->save();
        $total = 0;
        //guardar los ingredientes
        foreach ($request->orderIngredients as $key => $value) {
            if ($value != null && $value > 0) {
                $ingredient = Ingredient::find($key);
                $orderDetail = new  OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->ingredient_id = $key;
                $orderDetail->amount = $value;
                $orderDetail->price = $ingredient->cost;
                $orderDetail->subtotal = $ingredient->cost * $value;
                $orderDetail->save();
                $total += $ingredient->cost * $value;;
                //actualizar stock de los ingredientes
                $ingredient->stock +=  $value;
                $ingredient->save();
            }
        }

        $order->total = $total;
        $order->save();

        $request->session()->flash('message', "Pedido registrado con éxito");
        $request->session()->flash('type', "success");

        return redirect()->route('order.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Order $order)
    {
        return view('order.show', compact('order'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Order $order)
    {
        return view('order.edit', compact('order'));
    }

    /**
     * @param \App\Http\Requests\OrderUpdateRequest $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderUpdateRequest $request, Order $order)
    {
        $order->update($request->validated());

        $request->session()->flash('order.id', $order->id);

        return redirect()->route('order.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Order $order)
    {
        $order->delete();

        return redirect()->route('order.index');
    }
}
