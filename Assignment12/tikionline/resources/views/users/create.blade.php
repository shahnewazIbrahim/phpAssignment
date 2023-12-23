<!-- resources/views/users/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Register a New User</h2>

        <form method="post" action="{{ route('users.store') }}">
            @csrf

            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <button type="submit">Register User</button>
        </form>
    </div>
@endsection
