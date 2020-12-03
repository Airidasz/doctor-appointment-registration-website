@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (empty($roleData['doctor']->name))
                @if(Auth::user()->role == 'admin')
                    @include('doctor.doctor_info_fill')
                @else
                    <h3><center>Toks daktaras neegzistuoja</center></h3>
                @endif
            @else
                @include('doctor.doctor_info')
            @endif
        </div>
    </div>
</div>
@endsection
