<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //
    public function create(Request $request) {

        Appointment::create([
            'patient_id' => $request->input('patient_id'),
            'doctor_id' => $request->input('doctor_id'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
        ]);

        return redirect('/doctor/'.$request->input('doctor_id'))->with('success', 'Registracija priimta sėkmingai');
    }

    public function delete(Request $request) {
        $appointmentId= $request->input('id');
        $patientId= $request->input('patient_id');

        $appointment = Appointment::where('id', $appointmentId)->where('patient_id', $patientId)->first();

        $appointment->forceDelete();
        return redirect('/home')->with('success', 'Vizitas atšauktas sėkmingai');
    }
}
