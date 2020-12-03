<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Doctor;
use App\Models\WorkingHours;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DoctorController extends Controller
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

    public function create(Request $request){
        $this->validate($request, [
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'specialty' => ['required', 'string'],
            'monday_start' => 'date_format:H:i|nullable',
            'monday_end' => 'date_format:H:i|after:monday_start|nullable',
            'tuesday_start' => 'date_format:H:i|nullable',
            'tuesday_end' => 'date_format:H:i|after:tuesday_start|nullable',
            'wednesday_start' => 'date_format:H:i|nullable',
            'wednesday_end' => 'date_format:H:i|after:wednesday_start|nullable',
            'thursday_start' => 'date_format:H:i|nullable',
            'thursday_end' => 'date_format:H:i|after:thursday_start|nullable',
            'friday_start' => 'date_format:H:i|nullable',
            'friday_end' => 'date_format:H:i|after:friday_start|nullable',
            'saturday_start' => 'date_format:H:i|nullable',
            'saturday_end' => 'date_format:H:i|after:saturday_start|nullable',
            'sunday_start' => 'date_format:H:i|nullable',
            'sunday_end' => 'date_format:H:i|after:sunday_start|nullable',
        ]);

        $doctor = Doctor::find($request->input('doctor_id'));
        $doctor->name = $request->input('name');
        $doctor->surname = $request->input('surname');
        $doctor->specialty = $request->input('specialty');
        $doctor->save();

        $start_times = [ $request->input('monday_start'),
            $request->input('tuesday_start'),
            $request->input('wednesday_start'),
            $request->input('thursday_start'),
            $request->input('friday_start'),
            $request->input('saturday_start'),
            $request->input('sunday_start'),
        ];
        $end_times = [ $request->input('monday_end'),
            $request->input('tuesday_end'),
            $request->input('wednesday_end'),
            $request->input('thursday_end'),
            $request->input('friday_end'),
            $request->input('saturday_end'),
            $request->input('sunday_end'),
        ];

        for ($i= 0; $i< 7; $i++) {
            if($start_times[$i] != null && $end_times[$i] != null)
                $this->addScheduleTime($i+1,$start_times[$i],$end_times[$i],$doctor->id);
        }

        return redirect('/doctor/'.$doctor->id)->with('success', 'Gydytojo duomenys išsaugoti');
    }

    public function addScheduleTime(int $day, string $start_time, string $end_time, string $doctor_id){
        $workingHours = new WorkingHours;
        $workingHours->day= $day;
        $workingHours->start_time= $start_time;
        $workingHours->end_time= $end_time;
        $workingHours->doctor_id= $doctor_id;
        $workingHours->save();
    }

    public function index()
    {
        $data = Doctor::all();
        return view('doctor.doctor_list',compact('data'));
    }

    public function doctorProfile(Request $request) {
        $date = date('Y-m-d H:i:s', strtotime( 'monday this week' ) );
        if(request()->has('date')){
            $timestamp = strtotime('last monday',strtotime(request()->date));
            if ($timestamp > 0 && $timestamp >= strtotime( 'monday this week' ))
                $date = date('Y-m-d H:i:s',$timestamp);
        }

        $doctor_id = $request->route('id');

        $doctor = Doctor::with('workingHours')->with('appointment')->where('id', $doctor_id)->first();

        $minStartTime = strtotime('24:00:00');
        $maxEndTime = strtotime('00:00:00');
        foreach ($doctor->workingHours as $workingHours){
            $start = strtotime($workingHours['start_time']);
            $end = strtotime($workingHours['end_time']);

            if($start < $minStartTime)
                $minStartTime = $start;

            if($end > $maxEndTime)
                $maxEndTime = $end;
        }


        $days = array('monday','tuesday','wednesday','thursday','friday','saturday','sunday');
        $timeSlots = array();
        $schedule = array();
        $hour = 1*60*60;
        for ($i = $minStartTime; $i < $maxEndTime; $i += $hour) {
            array_push($timeSlots, substr(date("H:i:s", $i),0,5));
            $temp = array();

            for ($j = 0; $j < 7; $j++) {
                $timeSlot = $i - strtotime("today", $i);
                $appointmentStartTime = strtotime($date." +".$j." days") + $timeSlot;

                $workingHours = $doctor->workingHours->where('day', $days[$j])->first();
                if ($workingHours != null) {
                    $start = strtotime($workingHours->start_time) - strtotime("today", strtotime($workingHours->start_time));
                    $end = strtotime($workingHours->end_time) - strtotime("today", strtotime($workingHours->end_time));
                }

                if ($workingHours == null || $timeSlot < $start || $timeSlot+$hour > $end){
                    $appointment = new Appointment;
                    $appointment->id = -1;
                    array_push($temp, $appointment);
                    continue;
                }

                $appointment = $doctor->appointment->where('start_time', date('Y-m-d H:i:s',$appointmentStartTime))->first();

                if($appointment == null) {
                    $appointment = new Appointment;
                    $appointment->doctor_id = $doctor->id;
                    $appointment->start_time = $appointmentStartTime;
                    $appointment->end_time = $appointmentStartTime + $hour;
                }
                array_push($temp, $appointment);
            }

            array_push($schedule, $temp);
        }
        $roleData = [
            'doctor'=> $doctor,
            'workingHours'=>$doctor->workingHours,
            'schedule'=>$schedule,
            'timeSlots' =>$timeSlots,
            'date'=>substr($date,0,10),
        ];

        return view('doctor.doctor_profile',compact('roleData','doctor_id'));
    }

    private function databaseTimeToRegularTime($time) {
        return $time - strtotime("today", $time);
    }

}
