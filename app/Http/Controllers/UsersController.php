<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersFormRequest;
use Illuminate\Support\Facades\Hash;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Auth;

class UsersController extends Controller {

    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function index() {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Illuminate\View\View
     */
    public function create() {
        $roles = [0 => 'Costumer', 1 => 'Administrator'];
        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Store a new user in the storage.
     *
     * @param App\Http\Requests\UsersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(UsersFormRequest $request) {
        try {
            $data = $request->getData();
            $data['password'] = \Illuminate\Support\Facades\Hash::make($data['password']);
            User::create($data);
            return redirect()->route('users.user.index')
                            ->with('success_message', 'El usuario ha sido añadido éxitosamente.');
        } catch (Exception $exception) {
            return back()->withInput()
                            ->withErrors(['unexpected_error' => 'Se presento un error al procesar los datos.']);
        }
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id) {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id) {
        $user = User::findOrFail($id);
        $roles = [0 => 'Costumer', 1 => 'Administrator'];
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\UsersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, UsersFormRequest $request) {
        try {
            $data = $request->getData();
            $user = User::findOrFail($id);
            if ($data['password'] != 'nochanged')
                $data['password'] = Hash::make($data['password']);
            else
                unset($data['password']);
            $user->update($data);
            return redirect()->route('users.user.index')->with('success_message', 'El usuario ha sido actualizado exitosamente.');
        } catch (Exception $exception) {
            return back()->withInput()->withErrors(['unexpected_error' => 'Se presento un error al procesar los datos.']);
        }
    }

    /**
     * Remove the specified user from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.user.index')
                            ->with('success_message', 'El usuario ha sido borrado exitosamente.');
        } catch (Exception $exception) {

            return back()->withInput()
                            ->withErrors(['unexpected_error' => 'Se presento un error al procesar los datos.']);
        }
    }

    public function login() {
        if (Auth::check())
            return redirect('dashboard');
        else
            return view('users.login', ['title' => 'Login']);
    }

    public function profileAuth() {
        return view('users.profile', ['title' => 'My profile', 'perfil' => 'Admin']);
    }

    public function updateCostumer(Request $r) {
        $user = \App\User::find($r->id);
        $user->update($r->except(['_token', 'id', 'password']));
        if ($r->password != 'no se modifico!') {
            $user->password = bcrypt($r->password);
            $user->save();
        }
        return redirect('profile')->with("edition", "Changes have been saved!");
    }
}
