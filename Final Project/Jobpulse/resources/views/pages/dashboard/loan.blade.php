@extends('layout.sidenav-layout')
@section('content')
    @include('components.loan.loan-list')
    @include('components.loan.loan-delete')
    @include('components.loan.loan-create')
    @include('components.loan.loan-update')
@endsection
