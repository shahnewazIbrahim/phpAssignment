@extends('layouts.app')
@section('content')
    
<!-- Header Section -->
    <header class="bg-blue-500 text-white text-center py-8">
        <h1 class="text-4xl font-bold">About Shahnewaz Ibrahim</h1>
        <p class="mt-4">Passionate [Your Title/Profession] with a love for [Your Interests/Hobbies].</p>
    </header>

    <!-- Education Section -->
    <section class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Education</h2>
        <div class="mb-4">
            <h3 class="text-xl font-semibold">[Degree] in [Field of Study]</h3>
            <p class="text-gray-700">[University Name], [Location] | [Graduation Year]</p>
        </div>
        <!-- Add more education entries as needed -->
    </section>

    <!-- Work Experience Section -->
    <section class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Work Experience</h2>
        <div class="mb-4">
            <h3 class="text-xl font-semibold">[Job Title]</h3>
            <p class="text-gray-700">[Company Name], [Location] | [Start Date] - [End Date]</p>
            <ul class="list-disc list-inside text-gray-700">
                <li>[Responsibility or Achievement 1]</li>
                <li>[Responsibility or Achievement 2]</li>
                <!-- Add more bullet points as needed -->
            </ul>
        </div>
        <!-- Add more work experience entries as needed -->
    </section>

    <!-- Skills Section -->
    <section class="bg-gray-200 py-8">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">Skills</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="mb-4">
                    <h3 class="text-xl font-semibold">Technical Skills</h3>
                    <ul class="list-disc list-inside text-gray-700">
                        <li>[Technical Skill 1]</li>
                        <li>[Technical Skill 2]</li>
                        <!-- Add more technical skills as needed -->
                    </ul>
                </div>
                <div class="mb-4">
                    <h3 class="text-xl font-semibold">Soft Skills</h3>
                    <ul class="list-disc list-inside text-gray-700">
                        <li>[Soft Skill 1]</li>
                        <li>[Soft Skill 2]</li>
                        <!-- Add more soft skills as needed -->
                    </ul>
                </div>
                <!-- Add more skill categories as needed -->
            </div>
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
