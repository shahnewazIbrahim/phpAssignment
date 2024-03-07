@extends('layout.sidenav-layout')
@section('content')
    @include('components.job.job-list')
    @include('components.job.job-delete')
    @include('components.job.job-create')
    @include('components.job.job-update')
@endsection
