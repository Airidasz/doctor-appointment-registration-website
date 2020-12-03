@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if ( Auth::user()->role == 'patient')
                @if (empty($roleData['patient']->name))
                    @include('patient.patient_info_fill')
                @else
                    @include('patient.patient_info')
                @endif
            @elseif (Auth::user()->role == 'doctor')
                @include('doctor.doctor_info')
                @include('appointment.doctor_appointments_list')
            @endif

            @include('profile')

        </div>
    </div>
</div>
@endsection
