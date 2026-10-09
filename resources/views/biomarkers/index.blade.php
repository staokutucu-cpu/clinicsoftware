<x-site-layout>
    <h1 class="text-3xl font-bold mb-6">Biomarkers</h1>

    <table class="w-full bg-white border">
        <tr class="text-left border-b">
            <th class="p-2">Name</th>
            <th class="p-2">Optimal range</th>
        </tr>
        @foreach($biomarkers as $biomarker)
            <tr class="border-b">
                <td class="p-2">
                    <a href="{{ route('biomarkers.show', $biomarker) }}" class="text-green-700 underline">{{ $biomarker->name }}</a>
                </td>
                <td class="p-2">{{ $biomarker->optimal_min }} - {{ $biomarker->optimal_max }} {{ $biomarker->unit }}</td>
            </tr>
        @endforeach
    </table>
</x-site-layout>
