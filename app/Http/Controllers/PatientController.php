<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $patients = Patient::all();
        $returns = [
            'patients' => $patients
        ];

        return view('patients.index', $returns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('patients.form');
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
            'email' => 'unique:patients|max:255',
            'phone' => 'required|min:13',
        ], $validateMessages);

        $data = $request->all();
        $patient = Patient::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone']
        ]);

        if (isset($patient) && $patient) {
            return redirect()->route('patients.index')->with('success', 'Paciente cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Não foi possível cadastrar novo paciente');
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
        $patient = Patient::find($id);

        $returns = [
            'disabled' => true,
            'patient' => $patient
        ];

        return view('patients.form', $returns);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $patient = Patient::find($id);

        $returns = [
            'patient' => $patient
        ];

        return view('patients.form', $returns);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $patient = Patient::find($id);

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
            'email' => 'max:255|unique:patients,email,'.$patient->id,
            'phone' => 'required|min:13',
        ], $validateMessages);

        $patient->fill($data)->save();

        if (isset($patient) && $patient) {
            return redirect()->route('patients.index')->with('success', 'Paciente cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Não foi possível cadastrar novo paciente');
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
        $patient = Patient::find($id);
        $patient->delete();

        if (isset($patient) && $patient) {
            return redirect()->back()->with('success', 'Excluído com sucesso!');
        }
        return redirect()->back()->with('error', 'Não foi possível excluir');
    }
}
