@extends('layout.sidenav-layout')
@section('content')
    @include('components.blog.blog-list')
    @include('components.blog.blog-delete')
    @include('components.blog.blog-create')
    @include('components.blog.blog-update')
@endsection
