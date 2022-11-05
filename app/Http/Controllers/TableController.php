<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableStoreRequest;
use App\Http\Requests\TableUpdateRequest;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tables = Table::all();

        return view('table.index', compact('tables'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('table.create');
    }

    /**
     * @param \App\Http\Requests\TableStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = new Table();
        $table->status=1;
        $table->save();

        $request->session()->flash('message', "Mesa agregada con éxito");
        $request->session()->flash('type', "success");

        return redirect()->route('table.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Table $table
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Table $table)
    {
        return view('table.show', compact('table'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Table $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Table $table)
    {
        return view('table.edit', compact('table'));
    }

    /**
     * @param \App\Http\Requests\TableUpdateRequest $request
     * @param \App\Models\Table $table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Table $table)
    {
        /* $table->update($request->validated());

        $request->session()->flash('table.id', $table->id); */
        if ($table->status == 1) {
            $table->status = 2;
        } else {
            $table->status = 1;
        }
        $table->save();
      /*   $request->session()->flash('message', "Platillo registrado con éxito");
        $request->session()->flash('type', "success"); */
        return redirect()->route('table.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Table $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Table $table)
    {
        $table->delete();

        return redirect()->route('table.index');
    }
}
