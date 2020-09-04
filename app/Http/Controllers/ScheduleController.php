<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Patient;
use App\Schedule;
use App\StatusSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $schedules = Schedule::all();
        $returns = [
            'schedules' => $schedules
        ];

        return view('schedules.index', $returns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $returns = [
            'status' => StatusSchedule::all(),
            'patients' => Patient::all(),
            'doctors' => Doctor::all(),
        ];

        return view('schedules.form', $returns);
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
            'date.required' => 'Data é obrigatório',
            'time.required' => 'Horário é obrigatório',
            'status.required' => 'Selecione um status',
            'patient.required' => 'Selecione um paciente',
            'doctor.required' => 'Selecione um médico',
        ];
        $request->validate([
            'date' => 'required',
            'time' => 'required',
            'status' => 'required',
            'patient' => 'required',
            'doctor' => 'required',
        ], $validateMessages);

        $data = $request->all();
        $schedule = Schedule::create([
            'date' => $data['date'],
            'time' => $data['time'],
            'status_id' => $data['status'],
            'patient_id' => $data['patient'],
            'doctor_id' => $data['doctor'],
            'user_id' => Auth::user()->getAuthIdentifier()
        ]);

        if (isset($schedule) && $schedule) {
            return redirect()->route('schedules.index')->with('success', 'Agendamento feito com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Não foi possível criar novo agendamento');
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
        $schedule = Schedule::find($id);

        $returns = [
            'status' => StatusSchedule::all(),
            'patients' => Patient::all(),
            'doctors' => Doctor::all(),
            'schedule' => $schedule,
            'disabled' => true
        ];

        return view('schedules.form', $returns);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = Schedule::find($id);

        $returns = [
            'status' => StatusSchedule::all(),
            'patients' => Patient::all(),
            'doctors' => Doctor::all(),
            'schedule' => $schedule,
        ];

        return view('schedules.form', $returns);
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
        $schedule = Schedule::find($id);

        $validateMessages = [
            'date.required' => 'Data é obrigatório',
            'time.required' => 'Horário é obrigatório',
            'status.required' => 'Selecione um status',
            'patient.required' => 'Selecione um paciente',
            'doctor.required' => 'Selecione um médico',
        ];
        $request->validate([
            'date' => 'required',
            'time' => 'required',
            'status' => 'required',
            'patient' => 'required',
            'doctor' => 'required',
        ], $validateMessages);

        $data = $request->all();

        $schedule->fill([
            'date' => $data['date'],
            'time' => $data['time'],
            'status_id' => $data['status'],
            'patient_id' => $data['patient'],
            'doctor_id' => $data['doctor'],
            'user_id' => Auth::user()->getAuthIdentifier()
        ])->save();

        if (isset($schedule) && $schedule) {
            return redirect()->route('schedules.index')->with('success', 'Agendamento atualizado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Não foi possível atualizar o agendamento');
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
        $schedule = Schedule::find($id);
        $schedule->delete();

        if (isset($schedule) && $schedule) {
            return redirect()->back()->with('success', 'Excluído com sucesso!');
        }
        return redirect()->back()->with('error', 'Não foi possível excluir');
    }
}
