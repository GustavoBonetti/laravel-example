<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        $returns = [
            'users' => $users
        ];

        return view('users.index', $returns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validateMessages = [
            'name.required' => 'Nome é obrigatório',
            'name.max' => 'Nome pode ter no máximo 255 caracteres',
            'email.max' => 'Email pode ter no máximo 255 caracteres',
            'password.required' => 'Senha é obrigatório',
            'password.confirmed' => 'As senhas não conferem',
        ];
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'max:255',
            'password' => 'required|confirmed',
        ], $validateMessages);

        $data = $request->all();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        if (isset($user) && $user) {
            return redirect()->route('users.index')->with('success', 'Usuário cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Não foi possível cadastrar novo usuário');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::find($id);

        $returns = [
            'disabled' => true,
            'user' => $user
        ];

        return view('users.form', $returns);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        $returns = [
            'user' => $user
        ];

        return view('users.form', $returns);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);

        $validateMessages = [
            'name.required' => 'Nome é obrigatório',
            'name.max' => 'Nome pode ter no máximo 255 caracteres',
            'email.max' => 'Email pode ter no máximo 255 caracteres',
            'password.required' => 'Senha é obrigatório',
            'password.confirmed' => 'As senhas não conferem',
        ];

        $rules = [
            'name' => 'required|max:255',
            'email' => 'max:255',
        ];

        if (isset($data['password_old']) && $data['password_old']) {
            if (!Hash::check($data['password_old'], $user->password)) {
                session()->flash('error','Senha antiga não confere com a salva no sistema');
                return redirect()->back();
            }
            $rules['password'] = 'required|confirmed';
        }

        $request->validate($rules, $validateMessages);

        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ])->save();

        if (isset($user) && $user) {
            session()->flash('success', 'Usuário atualizado com sucesso!');
            return redirect()->route('users.show', $id);
        } else {
            return redirect()->back()->with('error', 'Não foi possível atualizar usuário');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        if (isset($user) && $user) {
            return redirect()->back()->with('success', 'Excluído com sucesso!');
        }
        return redirect()->back()->with('error', 'Não foi possível excluir');
    }
}
