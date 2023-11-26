@extends('layouts.app')

@section('content')
  

    <!-- Header Section -->
    <header class="bg-blue-500 text-white text-center py-8">
        <h1 class="text-4xl font-bold">Projects by Shahnewaz Ibrahim</h1>
        <p class="mt-4">Explore some of my notable projects below.</p>
    </header>

    <!-- Projects Section -->
    <section class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Notable Projects</h2>

        <!-- Project Cards (Manually Created) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Project Card 1 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Project 1</h3>
                <p class="text-gray-700">Description of Project 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="#" class="text-blue-500 mt-4 inline-block">Learn More</a>
            </div>

            <!-- Project Card 2 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Project 2</h3>
                <p class="text-gray-700">Description of Project 2. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="#" class="text-blue-500 mt-4 inline-block">Learn More</a>
            </div>

            <!-- Project Card 3 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Project 3</h3>
                <p class="text-gray-700">Description of Project 3. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="#" class="text-blue-500 mt-4 inline-block">Learn More</a>
            </div>

            <!-- Add more project cards as needed -->
        </div>
    </section>

    <!-- Contact Section -->
    <section class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Contact Shahnewaz Ibrahim</h2>
        <p class="text-gray-700">Feel free to reach out if you have any questions or opportunities!</p>
        <p class="mt-4">
            📧 <a href="mailto:your@email.com" class="underline">your@email.com</a> |
            📱 <a href="tel:+123456789" class="underline">+123456789</a>
        </p>
    </section>
@endsection
