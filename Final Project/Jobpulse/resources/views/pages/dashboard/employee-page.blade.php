@extends('layout.sidenav-layout')
@section('content')
    @include('components.employee.employee-list')
    @include('components.employee.employee-delete')
    @include('components.employee.employee-create')
    @include('components.employee.employee-update')
@endsection
