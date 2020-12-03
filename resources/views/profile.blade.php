<div class="card">
    <div class="card-header">{{ __('Vartotojo informacija') }}</div>
    <div class="card-body">
        <h4>El.Paštas</h4>
        <h1>{{Auth::user()->email}}</h1>

        @switch(Auth::user()->role)
            @case('patient')
                <h5>Pacientas</h5>
                @break
            @case('doctor')
                <h5>Gydytojas</h5>
                @break
            @case('admin')
                <h5>Administratorius</h5>
                @break
            @default
                <h5>Rolė nenustatyta</h5>
        @endswitch

        <h6>Sukurta: {{Auth::user()->created_at}}</h6>

        @if (Auth::user()->role == 'admin')
        {{ Form::open(['url' => '/doctor', 'method' => 'get'])}}
                    <input type='submit' class="btn btn-primary mt-2" value="Gydytojų sąrašas">
        {{Form::close()}}
        @endif
    </div>
</div>
