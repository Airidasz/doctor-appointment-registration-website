@extends('layouts.app')

@section('content')
<?php
$user = Auth::user()
?>
@if ($user->role == 'admin')
    @yield('admin-content')
@else
    @include('status_codes.403')
@endif 
@endsection
