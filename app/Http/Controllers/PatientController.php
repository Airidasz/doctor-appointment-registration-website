<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    //

    public function newPatient(Request $request) {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'national_id' => ['required', 'string'],
            'birth_date' => ['required', 'date'],
            'user_id' => ['required'],
        ]);

        $patient = new Patient;
        $patient->user_id=$request->input('user_id');
        $patient->name=$request->input('name');
        $patient->surname=$request->input('surname');
        $patient->national_id=$request->input('national_id');
        $patient->birth_date=$request->input('birth_date');
        $patient->save();

        return redirect('/home')->with('success', 'Paciento duomenys išsaugoti');
    }
}
