<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Dashboard</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8 px-4">
        <div class="bg-white p-6 border space-y-4">
            {{-- Info from the logged in user --}}
            <p class="text-lg">Hello {{ auth()->user()->name }}!</p>

            @if(auth()->user()->is_doctor)
                <p>You are logged in as a <strong>doctor</strong>. You can see the measurements of all patients.</p>
            @else
                <p>You have {{ auth()->user()->measurements()->count() }} measurements.</p>
            @endif

            <a href="{{ route('userzone.measurements.index') }}" class="inline-block bg-green-700 text-white px-4 py-2 rounded">Go to measurements</a>
        </div>
    </div>
</x-app-layout>
