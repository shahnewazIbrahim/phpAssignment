@extends('layout.sidenav-layout')
@section('content')
    @include('components.plugin.plugin-list')
    @include('components.plugin.plugin-delete')
    @include('components.plugin.plugin-create')
    @include('components.plugin.plugin-update')
@endsection
