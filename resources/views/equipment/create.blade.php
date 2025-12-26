<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Equipment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('equipment.store') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Equipment Name') }}
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('name') border-red-500 @else border @endif"
                                required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Model -->
                        <div class="mb-4">
                            <label for="model" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Model') }}
                            </label>
                            <input type="text" name="model" id="model" value="{{ old('model') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('model')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Serial Number -->
                        <div class="mb-4">
                            <label for="serial_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Serial Number') }}
                            </label>
                            <input type="text" name="serial_number" id="serial_number" value="{{ old('serial_number') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('serial_number')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Category') }}
                            </label>
                            <input type="text" name="category" id="category" value="{{ old('category') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="e.g., Microscope, Analyzer, etc." required>
                            @error('category')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Status') }}
                            </label>
                            <select name="status" id="status"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required>
                                <option value="operational" {{ old('status') === 'operational' ? 'selected' : '' }}>Operational</option>
                                <option value="in_repair" {{ old('status') === 'in_repair' ? 'selected' : '' }}>In Repair</option>
                                <option value="maintenance" {{ old('status') === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="retired" {{ old('status') === 'retired' ? 'selected' : '' }}>Retired</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Purchase Date -->
                        <div class="mb-4">
                            <label for="purchase_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Purchase Date') }}
                            </label>
                            <input type="date" name="purchase_date" id="purchase_date" value="{{ old('purchase_date') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('purchase_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Last Maintenance Date -->
                        <div class="mb-4">
                            <label for="last_maintenance_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Last Maintenance Date') }}
                            </label>
                            <input type="date" name="last_maintenance_date" id="last_maintenance_date" value="{{ old('last_maintenance_date') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('last_maintenance_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Description') }}
                            </label>
                            <textarea name="description" id="description" rows="4"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Add Equipment') }}
                            </button>
                            <a href="{{ route('equipment.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
