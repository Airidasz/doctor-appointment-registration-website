<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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

    public function index()
    {
        return view('doctor.doctor_new');
    }

    public function createUser(Request $request){
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' =>  '2',
        ]);

        $doctor = Doctor::create([
            'user_id' => $user->id,
        ]);

        return redirect('/doctor/'.$doctor->id)->with('success', 'Gydytojas priregistruotas sėkmingai');
    }

}
