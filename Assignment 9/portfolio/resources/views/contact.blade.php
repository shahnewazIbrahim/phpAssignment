@extends('layouts.app')
@section('content')
    
<!-- Header Section -->
    <header class="bg-blue-500 text-white text-center py-8">
        <h1 class="text-4xl font-bold">Contact Shahnewaz Ibrahim</h1>
        <p class="mt-4">Feel free to reach out using the form below.</p>
    </header>

    <!-- Contact Form Section -->
    <section class="container mx-auto mt-8">
        <form action="#" method="post" class="max-w-md mx-auto bg-white p-8 rounded-md shadow-md">
            <!-- Name Field -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                <input type="text" id="name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
            </div>

            <!-- Email Field -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
            </div>

            <!-- Message Field -->
            <div class="mb-6">
                <label for="message" class="block text-gray-700 font-bold mb-2">Message</label>
                <textarea id="message" name="message" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 resize-none" required></textarea>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">Send Message</button>
            </div>
        </form>
    </section>

    <!-- Contact Information Section -->
    <section class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Contact Information</h2>
        <p class="text-gray-700">Feel free to reach out through the following channels:</p>
        <p class="mt-4">
            📧 <a href="mailto:your@email.com" class="underline">your@email.com</a> |
            📱 <a href="tel:+123456789" class="underline">+123456789</a>
        </p>
    </section>
@endsection
