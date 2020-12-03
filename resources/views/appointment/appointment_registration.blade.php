<div class="card mb-3">
    <div class="card-header">{{ __('Vizito registracija') }}</div>
    <div class="card-body">
        {{ Form::open(['url' => ['/doctor', $roleData['doctor']->id], 'method' => 'get'])}}
        <center>
            <input type="date" class="form-control w-25" id="date" name="date" value={{$roleData['date']}}>
            <input type='submit' class="btn btn-primary my-2 " value="Rinktis savaitę">
        </center>
        {{Form::close()}}
        <table class="day-titles w-100">
            <tr>
                <th>
                    <center>Laikas</center>
                </th>
                <th>
                    <center>Pirmadienis</center>
                </th>
                <th>
                    <center>Antradienis</center>
                </th>
                <th>
                    <center>Trečiadienis</center>
                </th>
                <th>
                    <center>Ketvirtadienis</center>
                </th>
                <th>
                    <center>Penktadienis</center>
                </th>
                <th>
                    <center>Šeštadienis</center>
                </th>
                <th>
                    <center>Sekmadienis</center>
                </th>
            </tr>

            @for ($i = 0; $i < count($roleData['schedule']); $i++)
                <tr>
                    <th>
                        {{$roleData['timeSlots'][$i]}}
                        <br>
                    </th>
                    @for ($j = 0; $j < count($roleData['schedule'][$i]); $j++)

                        @if($roleData['schedule'][$i][$j]->id == null)
                            <th class="py-3 btn-available border" onclick="registerAppointment({{$roleData['schedule'][$i][$j]->start_time}},{{$roleData['schedule'][$i][$j]->end_time}},{{$roleData['schedule'][$i][$j]->doctor_id}})">
                                <h6><center>Laisva</center></h6>
                            </th>
                        @elseif($roleData['schedule'][$i][$j]->id == -1)
                            <th class="py-3 border">
                                <h6><center></center></h6>
                            </th>
                        @else
                            <th class="py-3 btn-taken border">
                                <h6><center>Užimta</center></h6>
                            </th>
                        @endif
                    @endfor
                </tr>
            @endfor
        </table>

    </div>
</div>
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
    function formatTimeForDatabase(unixTimeStamp){
        return new Date(unixTimeStamp).toISOString().replace(/T/, ' ').replace(/\..+/, '')
    }
    function registerAppointment(start_time, end_time, doctor_id) {
        var r = confirm("Ar tikrai norite užsiregistruoti?");
        if (r === true) {
            var myform = document.getElementById("appointmentForm");
            myform.action = "{{URL::to('/')}}/appointment";
            myform.method = "post";

            myform.appendChild(createElement('patient_id',{{Auth::user()->patient->id}}));
            myform.appendChild(createElement('doctor_id',doctor_id));
            myform.appendChild(createElement('start_time',formatTimeForDatabase(start_time * 1000)));
            myform.appendChild(createElement('end_time',formatTimeForDatabase(end_time * 1000)));

            myform.submit();
        }
    }
</script>
<style>
    .btn-taken {
        background: #df2828;
        user-select: none;
    }

    .btn-available {
        background: #45da1a;
        transition: background 0.2s;
        user-select: none;
    }
    .btn-available:hover {
        background: #3aab19;
    }

    .day-titles {
        font-size: small;
        user-select: none;
    }
</style>
