<div class="card mb-3">
    <div class="card-header">{{ __('Paciento informacijos pildymas') }}</div>
    <div class="card-body">

        {{ Form::open(['url' => '/patient', 'method' => 'post'])}}
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
            <label>Asmens kodas</label>
            <input type="text" class="form-control"name='national_id'>
        </div>
        <div class="form-group">
            <label>Gimimo data</label>
            <input type="date" class="form-control"name='birth_date'>
        </div>
        </div>
        
        <input type="hidden" name="user_id" value={{Auth::user()->id}} />
        <input type='submit' class="btn btn-primary mt-2" value="Saugoti duomenis">
           
        {{Form::close()}}

    </div>
</div>