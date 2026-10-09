<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Add measurement</h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-8 px-4">
        <form action="{{ route('userzone.measurements.store') }}" method="POST" class="bg-white p-6 border space-y-4">
            @csrf

            <div>
                <label class="block font-semibold">Patient*</label>
                <select name="user_id" class="border w-full p-2">
                    <option value="">-- choose --</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" @selected(old('user_id') == $patient->id)>{{ $patient->name }}</option>
                    @endforeach
                </select>
                @error('user_id') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block font-semibold">Biomarker*</label>
                <select name="biomarker_id" class="border w-full p-2">
                    <option value="">-- choose --</option>
                    @foreach($biomarkers as $biomarker)
                        <option value="{{ $biomarker->id }}" @selected(old('biomarker_id') == $biomarker->id)>{{ $biomarker->name }} ({{ $biomarker->unit }})</option>
                    @endforeach
                </select>
                @error('biomarker_id') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block font-semibold">Value*</label>
                <input type="text" name="value" value="{{ old('value') }}" class="border w-full p-2">
                @error('value') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block font-semibold">Date the blood was taken*</label>
                <input type="date" name="measured_at" value="{{ old('measured_at') }}" class="border w-full p-2">
                @error('measured_at') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block font-semibold">Note</label>
                <textarea name="note" class="border w-full p-2">{{ old('note') }}</textarea>
                @error('note') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded">Save measurement</button>
        </form>
    </div>
</x-app-layout>
