<?php

use App\StatusSchedule;
use Illuminate\Database\Seeder;

class StatusScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!StatusSchedule::where('name', '=', 'Agendado')->exists()) {
            StatusSchedule::create([
                'name' => 'Agendado',
                'description' => 'Paciente agendou horário'
            ]);
        }
        if (!StatusSchedule::where('name', '=', 'Consultado')->exists()) {
            StatusSchedule::create([
                'name' => 'Consultado',
                'description' => 'Paciente foi consultado'
            ]);
        }
        if (!StatusSchedule::where('name', '=', 'Cancelado')->exists()) {
            StatusSchedule::create([
                'name' => 'Cancelado',
                'description' => 'Paciente cancelou'
            ]);
        }
    }
}
