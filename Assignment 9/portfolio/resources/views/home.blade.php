@extends('layouts.app')
@section('content')
    
<div>
<header class="bg-blue-500 text-white text-center py-8">
        <h1 class="text-4xl font-bold">Welcome to Your Name's World</h1>
        <img src="your-profile-image.jpg" alt="My Profile Picture" class="rounded-full mt-4 h-24 w-24 mx-auto">
        <p class="mt-2">👋 Hello there! I'm Your Name, [Your Title/Profession].</p>
    </header>

    <!-- About Me Section -->
    <section class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">About Me</h2>
        <p class="text-gray-700">I'm a passionate professional with a love for [Your Interests/Hobbies]. From [Your Location], I've been on an exciting journey exploring the realms of [Your Field/Industry].</p>
        <img src="your-achievements-image.jpg" alt="Your Achievements" class="mt-8 w-full">
    </section>

    <!-- What I Do Section -->
    <section class="bg-gray-200 py-8">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">What I Do</h2>
            <p class="text-gray-700">In a nutshell, I'm a [Brief Summary of Your Skills]. Whether it's [Specific Skill 1], [Specific Skill 2], or [Specific Skill 3], I bring creativity, dedication, and a knack for [Unique Selling Point] to the table.</p>
        </div>
    </section>

    <!-- Why Work With Me Section -->
    <section class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Why Work With Me?</h2>
        <ul class="list-disc list-inside text-gray-700">
            <li>✨ [Highlight a unique aspect of your approach or work ethic]</li>
            <li>🚀 [Another compelling reason to collaborate with you]</li>
        </ul>
    </section>

    <!-- Let's Connect Section -->
    <section class="bg-blue-500 text-white py-8">
        <div class="container mx-auto text-center">
            <h2 class="text-2xl font-bold mb-4">Let's Connect</h2>
            <p class="text-gray-200">Ready to take the next step? Whether you have a project in mind or just want to say hi, I'm always open to new opportunities.</p>
            <p class="mt-4">
                📧 <a href="mailto:your@email.com" class="underline">your@email.com</a> |
                📱 <a href="tel:+123456789" class="underline">+123456789</a>
            </p>
        </div>
    </section>

    <!-- Recent Projects Section -->
    <section class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Recent Projects</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <img src="project1.jpg" alt="Project 1" class="w-full h-64 object-cover rounded-lg">
            <img src="project2.jpg" alt="Project 2" class="w-full h-64 object-cover rounded-lg">
            <img src="project3.jpg" alt="Project 3" class="w-full h-64 object-cover rounded-lg">
        </div>
    </section>
</div>
@endsection
