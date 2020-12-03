<div class="card mb-3">
    <div class="card-header">{{ __('Užsiregistravę pacientai') }}</div>
    <div class="card-body">
        @if(count($roleData['appointments'])>0)
        <table class='table'>
            <thead>
            <tr>
                <th scope="col">Vardas</th>
                <th scope="col">Data</th>
                <th scope="col">Laikas</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roleData['appointments'] as $key => $appointment)
                <tr>
                    <td scope="row">{{$roleData['patients'][$key]->name}} {{$roleData['patients'][$key]->surname}}</td>
                    <td>{{substr($appointment->start_time,0,10)}}</td>
                    <td>{{substr($appointment->start_time,11,5)}} - {{substr($appointment->end_time,11,5)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <center><h2>Užsiregistravusių pacientų nėra</h2></center>
            @endif

    </div>
</div>
