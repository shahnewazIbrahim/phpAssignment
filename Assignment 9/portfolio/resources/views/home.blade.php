@extends('layouts.app')
@section('content')
    <div>
    <header class="bg-blue-500 text-white text-center py-8 px-2">
        <h1 class="text-4xl font-bold">Welcome to Shahnewaz's World</h1>
        <img src="{{ asset('profile.jpeg') }}" alt="Shahnewaz's Profile Picture" class="rounded-full mt-4 h-24 w-24 mx-auto">
        <p class="mt-2">👋 Hello there! I'm Shahnewaz Ibrahim, a Web Developer based in Dhaka.</p>
    </header>

    <!-- About Me Section -->
    <section class="container mx-auto mt-8 px-2">
        <h2 class="text-2xl font-bold mb-4">About Me</h2>
        <p class="text-gray-700">I'm a passionate web developer with expertise in Laravel and Vue frameworks, JavaScript, and PHP. Based in Dhaka, I've been on an exciting journey exploring the realms of web development.</p>
        <img src="{{ asset('achievements-image.jpg') }}" alt="Shahnewaz's Achievements" class="mt-8 w-full h-96">
    </section>

    <!-- What I Do Section -->
    <section class="bg-gray-200 py-8 px-2">
        <div class="container mx-auto px-2">
            <h2 class="text-2xl font-bold mb-4">What I Do</h2>
            <p class="text-gray-700">In a nutshell, I'm a web developer. Whether it's Laravel, Vue, JavaScript, or PHP, I bring creativity, dedication, and a knack for websites to the table.</p>
        </div>
    </section>

    <!-- Why Work With Me Section -->
    <section class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Why Work With Me?</h2>
        <ul class="list-disc list-inside text-gray-700">
            <li>✨ I bring a unique blend of expertise in Laravel, Vue, JavaScript, and PHP.</li>
            <li>🚀 I am dedicated to delivering high-quality and innovative web solutions.</li>
        </ul>
    </section>

    <!-- Let's Connect Section -->
    <section class="bg-blue-500 text-white py-8">
        <div class="container mx-auto text-center">
            <h2 class="text-2xl font-bold mb-4">Let's Connect</h2>
            <p class="text-gray-200">Ready to take the next step? Whether you have a project in mind or just want to say hi, I'm always open to new opportunities.</p>
            <p class="mt-4">
                📧 <a href="mailto:shahnewaz@example.com" class="underline">shahnewaz@example.com</a> |
                📱 <a href="tel:+123456789" class="underline">+123456789</a>
            </p>
        </div>
    </section>

    <!-- Recent Projects Section -->
    <section class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Recent Projects</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <img src="{{ asset('project1.jpg') }}" alt="Project 1" class="w-full h-64 object-cover rounded-lg">
            <img src="{{ asset('project2.jpg') }}" alt="Project 2" class="w-full h-64 object-cover rounded-lg">
            <img src="{{ asset('project3.jpg') }}" alt="Project 3" class="w-full h-64 object-cover rounded-lg">
        </div>
    </section>
</div>

@endsection
