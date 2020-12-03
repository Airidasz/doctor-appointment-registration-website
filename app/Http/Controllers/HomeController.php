<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\WorkingHours;
use App\Models\Patient;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userData = Auth::user();
        $roleData = null;

        if ($userData->role == 'patient') {
            $patient = Patient::with('appointment')->where('user_id', $userData->id)->first();
            if(!empty($patient)) {
                $doctors = array();
                foreach ($patient->appointment as $appointment) {
                    $doctor = Doctor::with('appointment')->where('id', $appointment->doctor_id)->first();
                    array_push($doctors, $doctor);
                }

                $roleData = [
                    'patient' => $patient,
                    'appointments' => $patient->appointment,
                    'doctors' => $doctors,
                ];
            }
        }

        if ($userData->role == 'doctor'){
            $doctor = Doctor::with('workingHours')->with('appointment')->where('user_id', $userData->id)->first();

            $patients = array();
            foreach ($doctor->appointment as $appointment){
                $patient = Patient::with('appointment')->where('id', $appointment->patient_id)->first();
                array_push($patients, $patient);
            }

            $roleData = [
                'doctor'=> $doctor,
                'workingHours'=>$doctor->workingHours,
                'appointments'=>$doctor->appointment,
                'patients'=>$patients,
            ];
        }

        return view('home',['roleData' => $roleData]);
    }
}
