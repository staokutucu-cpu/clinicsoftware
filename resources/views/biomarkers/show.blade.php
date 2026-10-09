<x-site-layout>
    <h1 class="text-3xl font-bold mb-4">{{ $biomarker->name }}</h1>

    <p class="mb-2"><strong>Optimal range:</strong> {{ $biomarker->optimal_min }} - {{ $biomarker->optimal_max }} {{ $biomarker->unit }}</p>
    <p class="mb-6">{{ $biomarker->description }}</p>

    <a href="{{ route('biomarkers.index') }}" class="text-green-700 underline">Back to all biomarkers</a>
</x-site-layout>
