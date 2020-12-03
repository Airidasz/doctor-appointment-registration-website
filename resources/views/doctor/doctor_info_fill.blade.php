<div class="card mb-3">
    <div class="card-header">{{ __('Gydytojo informacijos pildymas') }}</div>
    <div class="card-body">
        {{ Form::open(['url' => '/doctor', 'method' => 'post'])}}
        <div class="w-50">
        <div class="form-group">
            <label>Vardas</label>
            <input type="text" class="form-control"name='name'>
        </div>
        <div class="form-group">
            <label>Pavardė</label>
            <input type="text" class="form-control"name='surname'>
        </div>
        <div class="form-group">
            <label>Specialybė</label>
            <input type="text" class="form-control"name='specialty'>
        </div>
        </div>

        @include('doctor.working_hours_picker')

        <input type="hidden" name="doctor_id" value={{$roleData['doctor']->id}} />
        <input type='submit' class="btn btn-primary mt-2" value="Saugoti duomenis">

        {{Form::close()}}

    </div>
</div>
