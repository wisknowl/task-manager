<x-app-layout>
    <x-slot name="header">
        <!-- Create New Task Button and Dropdown -->
    </x-slot>
    <div class="pt-12 hidden" id="createTaskForm">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Task Creation Form (initially hidden) -->
                    <form method="POST" action="" class="space-y-4">
                        @csrf
                        <!-- Task Title -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Task Title
                            </label>
                            <input type="text" name="title" required class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Description
                            </label>
                            <textarea name="description" rows="3" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                            
                        </div>

                        <!-- Due Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Due Date
                            </label>
                            <input type="date" name="due_date" required class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Status
                            </label>
                            <select name="status" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="pending">Pending</option>
                                <option value="in-progress">In-progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" id="cancelTaskButton"
                                class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-md">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="py-4 flex justify-between items-center">
                        <button id="createTaskButton" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors duration-200 ease-in-out dark:bg-blue-600 dark:hover:bg-blue-700 dark:text-white">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Create New Task
                        </button>

                        <div class="flex justify-center items-center gap-2">
                            <!-- Status Filter -->
                            <div class="relative">
                                <button data-dropdown-toggle="statusDropdown" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors duration-200 ease-in-out dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white">
                                    Filter by Status
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div id="statusDropdown" data-dropdown class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none dark:bg-gray-800 hidden">
                                    <div class="py-1">
                                        <form action="{{ route('tasks.index') }}" method="get">
                                            <button type="submit" name="status" value="pending"
                                                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 cursor-pointer">
                                                Pending
                                            </button>
                                            <button type="submit" name="status" value="in-progress"
                                                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 cursor-pointer">
                                                In-progress
                                            </button>
                                            <button type="submit" name="status" value="completed"
                                                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 cursor-pointer">
                                                Completed
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Due Date Filter -->
                            <div class="relative">
                                <button data-dropdown-toggle="dueDateDropdown" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors duration-200 ease-in-out dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white">
                                    Filter by Due Date
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div id="dueDateDropdown" data-dropdown class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none dark:bg-gray-800 hidden">
                                    <div class="py-1">
                                        <form action="{{ route('tasks.index') }}" method="get">
                                            <!-- Due Today -->
                                            <button type="submit" name="due_date_filter" value="today"
                                                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 cursor-pointer">
                                                Due Today ({{ now()->toFormattedDateString() }})
                                            </button>

                                            <!-- This Week (Monday to Sunday) -->
                                            <button type="submit" name="due_date_filter" value="week"
                                                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 cursor-pointer">
                                                This Week ({{ now()->startOfWeek()->format('M j') }} - {{ now()->endOfWeek()->format('M j') }})
                                            </button>

                                            <!-- Overdue -->
                                            <button type="submit" name="due_date_filter" value="overdue"
                                                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 cursor-pointer">
                                                Overdue (Before {{ now()->toFormattedDateString() }})
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            // Toggle form visibility
                            document.getElementById('createTaskButton').addEventListener('click', function(e) {
                                e.stopPropagation();
                                const form = document.getElementById('createTaskForm');
                                form.classList.toggle('hidden');
                            });
                            const cancelTaskButton = document.getElementById('cancelTaskButton');
                            // Handle cancel button
                            cancelTaskButton.addEventListener('click', function() {
                                createTaskForm.classList.add('hidden');
                            });

                            // Close form when clicking outside
                            document.addEventListener('click', function(event) {
                                const form = document.getElementById('createTaskForm');
                                const button = document.getElementById('createTaskButton');

                                if (!form.contains(event.target) && !button.contains(event.target)) {
                                    form.classList.add('hidden');
                                }
                            });

                            document.addEventListener('DOMContentLoaded', function() {
                                // Get all filter buttons and their dropdowns
                                const filterButtons = document.querySelectorAll('[data-dropdown-toggle]');

                                // Function to close all dropdowns
                                function closeAllDropdowns() {
                                    document.querySelectorAll('[data-dropdown]').forEach(dropdown => {
                                        dropdown.classList.add('hidden');
                                    });
                                }

                                // Handle filter button clicks
                                filterButtons.forEach(button => {
                                    button.addEventListener('click', function(e) {
                                        e.stopPropagation();
                                        const dropdownId = this.getAttribute('data-dropdown-toggle');
                                        const targetDropdown = document.getElementById(dropdownId);

                                        // Toggle the clicked dropdown
                                        if (targetDropdown.classList.contains('hidden')) {
                                            closeAllDropdowns();
                                            targetDropdown.classList.remove('hidden');
                                        } else {
                                            targetDropdown.classList.add('hidden');
                                        }
                                    });
                                });

                                // Close dropdowns when clicking outside
                                document.addEventListener('click', function(e) {
                                    if (!e.target.closest('[data-dropdown-toggle]') &&
                                        !e.target.closest('[data-dropdown]')) {
                                        closeAllDropdowns();
                                    }
                                });

                                // Close dropdowns when clicking on dropdown items (optional)
                                document.querySelectorAll('[data-dropdown] a').forEach(item => {
                                    item.addEventListener('click', function() {
                                        closeAllDropdowns();
                                    });
                                });
                            });
                        </script>

                    </div>
                    <div class="rounded-lg overflow-hidden border dark:border-neutral-600">
                        <table class="min-w-full">
                            <thead class="bg-neutral-200 dark:bg-neutral-700">
                                <tr>
                                    <th class="px-4 py-3 text-center border-b dark:border-neutral-600"></th>
                                    <th class="px-4 py-3 text-center border-b dark:border-neutral-600">Title</th>
                                    <th class="px-4 py-3 text-center border-b dark:border-neutral-600">Description</th>
                                    <th class="px-4 py-3 text-center border-b dark:border-neutral-600">Due Date</th>
                                    <th class="px-4 py-3 text-center border-b dark:border-neutral-600">Status</th>
                                    <th class="px-4 py-3 text-center border-b dark:border-neutral-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tasks as $task)
                                <tr class="transition duration-300 ease-in-out hover:bg-neutral-300 dark:bg-neutral-800 dark:hover:bg-neutral-700 even:bg-neutral-100 dark:even:bg-neutral-900">
                                    <td class="px-4 py-3 border-b dark:border-neutral-600">{{ $tasks->firstItem() + $loop->index }}</td>
                                    <td class="px-4 py-3 border-b dark:border-neutral-600">{{ $task->title }}</td>
                                    <td class="px-4 py-3 border-b dark:border-neutral-600">{{ $task->description }}</td>
                                    <td class="px-4 py-3 text-center border-b dark:border-neutral-600">{{ $task->due_date }}</td>
                                    <td class="px-4 py-3 text-center border-b dark:border-neutral-600 w-[11%]">
                                        <span class="px-2 py-1 text-sm rounded-full {{ $task->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500' : 'bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500' }}">
                                            {{ $task->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center border-b dark:border-neutral-600">
                                        <div class="flex justify-center space-x-3">
                                            <a href="{{ route('tasks.show', ['task' => $task['id']]) }}">
                                                <button class="p-2 text-emerald-600 hover:bg-emerald-100 rounded-full dark:text-emerald-400 dark:hover:bg-neutral-700 transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </button>
                                            </a>
                                            <!-- <button class="p-2 text-blue-600 hover:bg-blue-100 rounded-full dark:text-blue-400 dark:hover:bg-neutral-700 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </button>
                                            <button class="p-2 text-red-600 hover:bg-red-100 rounded-full dark:text-red-400 dark:hover:bg-neutral-700 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button> -->
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                                        You have not created any task yet
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>