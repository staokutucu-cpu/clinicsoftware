<x-site-layout>
    <h1 class="text-3xl font-bold mb-4">Welcome to Longevity Lab</h1>

    <p class="mb-4">
        Track your blood values and see if they are in the optimal range for a long and healthy life.
        We currently follow {{ $biomarkerCount }} biomarkers, like Vitamin D and HbA1c.
    </p>

    <ul class="list-disc ml-6 mb-6">
        <li>Patients log in and add their own measurements.</li>
        <li>Every value is compared with the optimal range.</li>
        <li>The doctor can see the measurements of all patients.</li>
    </ul>

    <a href="{{ route('biomarkers.index') }}" class="bg-green-700 text-white px-4 py-2 rounded">See all biomarkers</a>
</x-site-layout>
