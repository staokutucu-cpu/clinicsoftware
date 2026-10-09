<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Measurements</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8 px-4">
        <a href="{{ route('userzone.measurements.create') }}" class="inline-block bg-green-700 text-white px-4 py-2 rounded mb-4">Add measurement</a>

        <table class="w-full bg-white border">
            <tr class="text-left border-b">
                <th class="p-2">Date</th>
                <th class="p-2">Patient</th>
                <th class="p-2">Biomarker</th>
                <th class="p-2">Value</th>
                <th class="p-2">Status</th>
            </tr>
            @forelse($measurements as $measurement)
                <tr class="border-b">
                    <td class="p-2">
                        <a href="{{ route('userzone.measurements.show', $measurement) }}" class="text-green-700 underline">{{ $measurement->measured_at->format('d.m.Y') }}</a>
                    </td>
                    <td class="p-2">{{ $measurement->user->name }}</td>
                    <td class="p-2">{{ $measurement->biomarker->name }}</td>
                    <td class="p-2">{{ $measurement->value }} {{ $measurement->biomarker->unit }}</td>
                    <td class="p-2">
                        @if($measurement->isOptimal())
                            <span class="text-green-700">Optimal</span>
                        @else
                            <span class="text-red-600">Not optimal</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td class="p-2" colspan="5">No measurements yet.</td></tr>
            @endforelse
        </table>
    </div>
</x-app-layout>
