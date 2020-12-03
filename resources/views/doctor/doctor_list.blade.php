@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Gydytojų sąrašas') }}</div>
                <div class="card-body">

                <table class='table'>
                    <thead>
                    <tr>
                        <th scope="col">Vardas</th>
                        <th scope="col">Pavardė</th>
                        <th scope="col">Specialybė</th>
                        <th scope="col" class='text-center block'>Profilis</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $value)
                        <tr>
                            <td scope="row">{{ $value -> name}}</td>
                            <td>{{ $value -> surname}}</td>
                            <td>{{ $value -> specialty}}</td>
                            <td class='text-center'>
                                {{Form::open(['url' => ['doctor', $value->id], 'method'=>'get'])}}
                                <input type='submit' value='Peržiūrėti' class='btn btn-primary'>
                                {{Form::close()}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if (Auth::user()->role == 'admin')
                {{ Form::open(['url' => '/new/doctor', 'method' => 'get'])}}
                            <input type='submit' class="btn btn-primary mt-2" value="Naujas gydytojas">
                {{Form::close()}}
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
