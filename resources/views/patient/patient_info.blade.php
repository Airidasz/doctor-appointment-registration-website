@if (!empty($roleData['patient']->name))
<div class="card mb-3">
    <div class="card-header">{{ __('Paciento informacija') }}</div>
    <div class="card-body">


        <h1>{{$roleData['patient']->name}} {{$roleData['patient']->surname}}</h1>
        <h6>{{$roleData['patient']->birth_date}}</h6>

        {{ Form::open(['url' => '/doctor', 'method' => 'get'])}}
            <input type='submit' class="btn btn-primary mt-2" value="Registruotis pas gydytoją">
        {{Form::close()}}

    </div>
</div>

 <div class="card mb-3">
    <div class="card-header">{{ __('Vizitai') }}</div>
    <div class="card-body">
        @if(count($roleData['appointments'])>0)
        <table class='table'>
            <thead>
            <tr>
                <th scope="col">Gydytojas</th>
                <th scope="col">Data</th>
                <th scope="col">Laikas</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($roleData['appointments'] as $key => $appointment)
                <tr>
                    <td scope="row">{{$roleData['doctors'][$key]->name}} {{$roleData['doctors'][$key]->surname}}</td>
                    <td>{{substr($appointment->start_time,0,10)}}</td>
                    <td>{{substr($appointment->start_time,11,5)}} - {{substr($appointment->end_time,11,5)}}</td>
                    <td><input type='button' onclick="cancelAppointment({{$appointment->id}},{{$roleData['patient']->id}})" class=' close-btn' value="x"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <center><h2>Jūs nesate užsiregistravę vizitui</h2></center>
        @endif

    </div>
</div>
@endif

<form id="appointmentForm">
    @csrf
</form>
<script>
    function createElement(name, value) {
        var element = document.createElement("input");
        element.value = value;
        element.name = name;
        element.type = "hidden";

        return element;
    }
    function cancelAppointment(appointment_id, patient_id) {
        var r = confirm("Ar tikrai norite atšaukti vizitą?");
        if (r === true) {
            var myform = document.getElementById("appointmentForm");
            myform.action = "{{URL::to('/')}}/appointment/delete";
            myform.method = "post";

            myform.appendChild(createElement('id',appointment_id));
            myform.appendChild(createElement('patient_id',patient_id));
            myform.submit();
        }
    }
</script>
<style>
    .close-btn{
        border-radius: 1000000px;
        color: #ffffff;
        background: #ff1313;
        border:none;
        transition: background 0.2s;
    }
    .close-btn:hover{
        background: #c32222;
    }
</style>
