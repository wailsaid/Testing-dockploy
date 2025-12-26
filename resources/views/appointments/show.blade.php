<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Appointment Details') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('appointments.edit', $appointment) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('appointments.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
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
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Equipment') }}</h3>
                            <p class="text-lg font-semibold">
                                <a href="{{ route('equipment.show', $appointment->equipment) }}" class="text-blue-600 hover:text-blue-900">
                                    {{ $appointment->equipment->name }}
                                </a>
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Status') }}</h3>
                            <p class="text-lg font-semibold">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if ($appointment->status === 'completed') bg-green-100 text-green-800
                                    @elseif ($appointment->status === 'in_progress') bg-blue-100 text-blue-800
                                    @elseif ($appointment->status === 'cancelled') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Scheduled Date & Time') }}</h3>
                            <p class="text-lg font-semibold">{{ $appointment->scheduled_date->format('M d, Y - H:i') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Assigned To') }}</h3>
                            <p class="text-lg font-semibold">{{ $appointment->user->name }}</p>
                        </div>
                    </div>

                    @if ($appointment->description)
                        <div class="mb-6">
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Description') }}</h3>
                            <p class="text-base">{{ $appointment->description }}</p>
                        </div>
                    @endif

                    @if ($appointment->notes)
                        <div class="mb-6">
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Notes') }}</h3>
                            <p class="text-base">{{ $appointment->notes }}</p>
                        </div>
                    @endif

                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-6">
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            {{ __('Created') }} {{ $appointment->created_at->format('M d, Y - H:i') }} 
                            {{ __('| Updated') }} {{ $appointment->updated_at->format('M d, Y - H:i') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
