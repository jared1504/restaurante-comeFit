<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where('type', '!=', 0)->orderBy('type')->paginate(10);

        return view('user.index', compact('users'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('user.create');
    }

    /**
     * @param \App\Http\Requests\UserStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*  $user = User::create($request->validated());

        $request->session()->flash('user.id', $user->id);
 */
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'type' => 'required|numeric',
            'password' => 'required|min:6',
        ]);



        //guardar cambios
        $user = new  User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        $user->password = Hash::make($request->password);
        $user->save();


        $request->session()->flash('message', "Empleado registrado con éxito");
        $request->session()->flash('type', "success");


        return redirect()->route('user.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * @param \App\Http\Requests\UserUpdateRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        /* $user->update($request->validated());

        $request->session()->flash('user.id', $user->id); */

        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'type' => 'required|numeric',
        ]);


        //guardar cambios
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        $user->password = $user->password;
        $user->save();


        $request->session()->flash('message', "Empleado actualizado con éxito");
        $request->session()->flash('type', "success");


        return redirect()->route('user.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();

        return redirect()->route('user.index');
    }
}
