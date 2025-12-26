<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Schedule New Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('appointments.store') }}">
                        @csrf

                        <!-- Equipment -->
                        <div class="mb-4">
                            <label for="equipment_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Equipment') }}
                            </label>
                            <select name="equipment_id" id="equipment_id"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('equipment_id') border-red-500 @endif"
                                required>
                                <option value="">{{ __('Select Equipment') }}</option>
                                @foreach ($equipment as $item)
                                    <option value="{{ $item->id }}" {{ old('equipment_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} ({{ $item->category }})
                                    </option>
                                @endforeach
                            </select>
                            @error('equipment_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Scheduled Date -->
                        <div class="mb-4">
                            <label for="scheduled_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Scheduled Date & Time') }}
                            </label>
                            <input type="datetime-local" name="scheduled_date" id="scheduled_date" value="{{ old('scheduled_date') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('scheduled_date') border-red-500 @endif"
                                required>
                            @error('scheduled_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Repair/Service Description') }}
                            </label>
                            <textarea name="description" id="description" rows="4"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Describe the repair or maintenance needed">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Status') }}
                            </label>
                            <select name="status" id="status"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('status') border-red-500 @endif"
                                required>
                                <option value="scheduled" {{ old('status') === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Schedule Appointment') }}
                            </button>
                            <a href="{{ route('appointments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
