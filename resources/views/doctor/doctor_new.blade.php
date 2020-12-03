@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Gydytojo prisijungimo duomenys') }}</div>
                <div class="card-body">

                    {{Form::open(['url' => '/user', 'method'=>'post'])}}
                    <div class="w-50">
                        <div class="form-group">
                            <label>El.Paštas</label>
                            <input type="email" class="form-control"name='email'>
                        </div>
                        <div class="form-group">
                            <label>Slaptažodis</label>
                            <input type="password" class="form-control"name='password'>
                        </div>
                    </div>
                        <input type='submit' value='Sukurti gydytojo prisijungimą' class='btn btn-primary'>
                    {{Form::close()}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
