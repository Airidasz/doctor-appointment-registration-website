<div class="card mb-3">
    <div class="card-header">{{ __('Gydytojo informacija') }}</div>
    <div class="card-body">

        <h1>{{$roleData['doctor']->name}} {{$roleData['doctor']->surname}}</h1>
        <h4>{{$roleData['doctor']->specialty}}</h4>
        <br>
        <h3>Darbo laikas</h3>

        @foreach ($roleData['workingHours'] as $value)

            @switch($value->day)
                @case('monday')
                    <?php $dayString ="Pirmadienis" ?>
                    @break
                @case('tuesday')
                    <?php $dayString ="Antradienis" ?>
                    @break
                @case('wednesday')
                    <?php $dayString ="Trečiadienis" ?>
                    @break
                @case('thursday')
                    <?php $dayString ="Ketvirtadienis" ?>
                    @break
                @case('friday')
                    <?php $dayString ="Penktadienis" ?>
                    @break
                @case('saturday')
                    <?php $dayString ="Šeštadienis" ?>
                    @break
                @case('sunday')
                    <?php $dayString ="Sekmadienis" ?>
                    @break
            @endswitch
            <h5>{{$dayString}}</h5>
            <h6>{{substr($value->start_time,0,-3)}} - {{substr($value->end_time,0,-3)}}</h6>
        @endforeach

    </div>
</div>


@if (auth::user()->role=='patient')
    @include('appointment.appointment_registration')
@endif

