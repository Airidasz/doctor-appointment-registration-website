@extends('layouts.app_no_header')

@auth
    <script>window.location = "/home";</script>
@endif

<div class="container" style="margin-top:15%;">
<div class="row">
    <div class="card col">
    <div class="card-body">
        <h5 class="card-title">Pacientų registravimo sistema</h5>
    </div>
    </div>
</div>
    <div class="row h-25 mt-2">
        <div class="col-lg p-0 m-0">
            <a href="{{ route('login') }}" class="btn btn-primary w-100"><h1>Prisijungti</h1></a>
        </div>
        <div class="mx-1"></div>
        <div class="col-lg p-0 m-0">
            <a href="{{ route('register') }}" class="btn btn-danger w-100"><h1>Registruotis</h1></a>
        </div>
    </div>
</div>




