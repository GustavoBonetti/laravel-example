<?php

namespace App\Http\Controllers;

use App\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $doctors = Doctor::all();
        $returns = [
            'doctors' => $doctors
        ];

        return view('doctors.index', $returns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('doctors.form');
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
            'phone.required' => 'Telefone é obrigatório',
            'phone.min' => 'Telefone deve ter no mínimo 10 dígitos, verifique se colocou o DDD',
            'email.max' => 'Email pode ter no máximo 255 caracteres',
            'email.unique' => 'Esse email já está sendo utilizado',
        ];
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'unique:doctors|max:255',
            'phone' => 'required|min:13',
        ], $validateMessages);

        $data = $request->all();
        $doctor = Doctor::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone']
        ]);

        if (isset($doctor) && $doctor) {
            return redirect()->route('doctors.index')->with('success', 'Médico cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Não foi possível cadastrar novo médico');
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
        $doctor = Doctor::find($id);

        $returns = [
            'disabled' => true,
            'doctor' => $doctor
        ];

        return view('doctors.form', $returns);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $doctor = Doctor::find($id);

        $returns = [
            'doctor' => $doctor
        ];

        return view('doctors.form', $returns);
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
        $doctor = Doctor::find($id);

        $validateMessages = [
            'name.required' => 'Nome é obrigatório',
            'name.max' => 'Nome pode ter no máximo 255 caracteres',
            'phone.required' => 'Telefone é obrigatório',
            'phone.min' => 'Telefone deve ter no mínimo 10 dígitos, verifique se colocou o DDD',
            'email.max' => 'Email pode ter no máximo 255 caracteres',
            'email.unique' => 'Esse email já está sendo utilizado',
        ];
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'max:255|unique:doctors,email,'.$doctor->id,
            'phone' => 'required|min:13',
        ], $validateMessages);

        $doctor->fill($data)->save();

        if (isset($doctor) && $doctor) {
            return redirect()->route('doctors.index')->with('success', 'Médico cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Não foi possível cadastrar novo médico');
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
        $doctor = Doctor::find($id);
        $doctor->delete();

        if (isset($doctor) && $doctor) {
            return redirect()->back()->with('success', 'Excluído com sucesso!');
        }
        return redirect()->back()->with('error', 'Não foi possível excluir');
    }
}
