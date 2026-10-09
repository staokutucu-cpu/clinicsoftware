<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">{{ $measurement->biomarker->name }} on {{ $measurement->measured_at->format('d.m.Y') }}</h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-8 px-4">
        <div class="bg-white p-6 border space-y-2">
            <p><strong>Patient:</strong> {{ $measurement->user->name }}</p>
            <p><strong>Value:</strong> {{ $measurement->value }} {{ $measurement->biomarker->unit }}</p>
            <p><strong>Optimal range:</strong> {{ $measurement->biomarker->optimal_min }} - {{ $measurement->biomarker->optimal_max }} {{ $measurement->biomarker->unit }}</p>
            <p>
                <strong>Status:</strong>
                @if($measurement->isOptimal())
                    <span class="text-green-700">Optimal</span>
                @else
                    <span class="text-red-600">Not optimal</span>
                @endif
            </p>
            <p><strong>Note:</strong> {{ $measurement->note ?? '-' }}</p>
        </div>

        <a href="{{ route('userzone.measurements.index') }}" class="inline-block mt-4 text-green-700 underline">Back to measurements</a>
    </div>
</x-app-layout>
