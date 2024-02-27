@extends('layout.sidenav-layout')
@section('content')
    @include('components.admin.admin-list')
    @include('components.admin.admin-delete')
    @include('components.admin.admin-create')
    @include('components.admin.admin-update')
@endsection
