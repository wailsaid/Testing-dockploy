<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $equipment->name }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('equipment.edit', $equipment) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('equipment.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Equipment Name') }}</h3>
                            <p class="text-lg font-semibold">{{ $equipment->name }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Model') }}</h3>
                            <p class="text-lg font-semibold">{{ $equipment->model ?? '-' }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Serial Number') }}</h3>
                            <p class="text-lg font-semibold">{{ $equipment->serial_number ?? '-' }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Category') }}</h3>
                            <p class="text-lg font-semibold">{{ $equipment->category }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Status') }}</h3>
                            <p class="text-lg font-semibold">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if ($equipment->status === 'operational') bg-green-100 text-green-800
                                    @elseif ($equipment->status === 'in_repair') bg-red-100 text-red-800
                                    @elseif ($equipment->status === 'maintenance') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $equipment->status)) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Purchase Date') }}</h3>
                            <p class="text-lg font-semibold">{{ $equipment->purchase_date?->format('M d, Y') ?? '-' }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Last Maintenance Date') }}</h3>
                            <p class="text-lg font-semibold">{{ $equipment->last_maintenance_date?->format('M d, Y') ?? '-' }}</p>
                        </div>
                    </div>

                    @if ($equipment->description)
                        <div class="mb-6">
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Description') }}</h3>
                            <p class="text-base">{{ $equipment->description }}</p>
                        </div>
                    @endif

                    <hr class="my-6 border-gray-200 dark:border-gray-700">

                    <div>
                        <h3 class="text-lg font-semibold mb-4">{{ __('Appointments') }}</h3>
                        @if ($equipment->appointments->count())
                            <div class="space-y-3">
                                @foreach ($equipment->appointments as $appointment)
                                    <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-4">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <p class="font-medium">{{ $appointment->scheduled_date->format('M d, Y - H:i') }}</p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $appointment->description }}</p>
                                            </div>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if ($appointment->status === 'completed') bg-green-100 text-green-800
                                                @elseif ($appointment->status === 'in_progress') bg-blue-100 text-blue-800
                                                @elseif ($appointment->status === 'cancelled') bg-red-100 text-red-800
                                                @else bg-yellow-100 text-yellow-800
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-600 dark:text-gray-400">{{ __('No appointments scheduled yet.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
