<x-app-layout>
    <x-slot name="header">
        <!-- Create New Task Button and Dropdown -->
        <div class="relative flex justify-center">
            <h2 class="text-xl font-bold">Task Details</h2>
        </div>
    </x-slot>

    <div class="py-12 hidden" id="editFormContainer">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="space-y-4">
                        <!-- Edit Form -->
                        <form id="editForm" class="space-y-6" action="{{ route('tasks.update', $task) }}" method="POST">
                            @if($errors->any())
                            <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-sm font-medium mb-1">Task Title</label>
                                <input type="text" name="title" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm">

                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">Description</label>
                                <textarea name="description" rows="3" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm"></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">Due Date</label>
                                <input type="date" name="due_date" required class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">Status</label>
                                <select name="status" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm">
                                    <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in-progress" {{ $task->status === 'in-progress' ? 'selected' : '' }}>In-Progress</option>
                                    <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>

                            <div class="flex justify-end space-x-3">
                                <button type="button" id="cancelEdit"
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
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="space-y-4">
                        <!-- Task Header with Title and Actions -->
                        <div class="flex justify-between items-start mb-6">
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                                {{ $task->title }}
                            </h2>
                            <div class="flex space-x-2">
                                <!-- Edit Button -->
                                <div class="relative">
                                    <button id="editButton" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg dark:text-blue-400 dark:hover:bg-gray-700 transition-colors edit-task"
                                        data-id="{{ $task->id }}"
                                        data-title="{{ $task->title }}"
                                        data-description="{{ $task->description }}"
                                        data-due-date="{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}"
                                        data-status="{{ $task->status }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Delete Button with Confirmation -->
                                <div class="relative">
                                    <button id="deleteButton" class="p-2 text-red-600 hover:bg-red-50 rounded-lg dark:text-red-400 dark:hover:bg-gray-700 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>

                                    <!-- Delete Confirmation Menu -->
                                    <div id="deleteMenu" class="hidden absolute right-0 top-0 mr-10 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 p-4 space-y-3">
                                        <p class="text-sm text-gray-700 dark:text-gray-300">Are you sure you want to delete this task?</p>
                                        <div class="flex justify-end space-x-2">
                                            <button id="cancelDelete" class="px-3 py-1 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
                                                Cancel
                                            </button>
                                            <form action="{{ route('tasks.destroy', ['task' => $task['id']]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" id="confirmDelete" class="px-3 py-1 text-sm text-white bg-red-600 hover:bg-red-700 rounded-md">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            const deleteButton = document.getElementById('deleteButton');
                            const deleteMenu = document.getElementById('deleteMenu');
                            const cancelDelete = document.getElementById('cancelDelete');

                            // Toggle delete menu
                            deleteButton.addEventListener('click', (e) => {
                                e.stopPropagation();
                                deleteMenu.classList.toggle('hidden');
                            });

                            // Close menu when clicking outside
                            document.addEventListener('click', (e) => {
                                if (!deleteMenu.contains(e.target) && !deleteButton.contains(e.target)) {
                                    deleteMenu.classList.add('hidden');
                                }
                            });

                            // Cancel delete
                            cancelDelete.addEventListener('click', () => {
                                deleteMenu.classList.add('hidden');
                            });

                            // Handle actual delete
                            document.getElementById('confirmDelete').addEventListener('click', () => {
                                deleteMenu.classList.add('hidden');
                                console.log('Item deleted!');
                                // Add your actual delete logic here
                            });

                            // Close menu on Escape key
                            document.addEventListener('keydown', (e) => {
                                if (e.key === 'Escape' && !deleteMenu.classList.contains('hidden')) {
                                    deleteMenu.classList.add('hidden');
                                }
                            });
                        </script>
                    </div>


                    <script>
                        const editButton = document.getElementById('editButton');
                        const editFormContainer = document.getElementById('editFormContainer');
                        const cancelButton = document.getElementById('cancelEdit');
                        const editForm = document.getElementById('editForm');

                        // Show edit form
                        editButton.addEventListener('click', () => {
                            editFormContainer.classList.remove('hidden');
                            // Here you would load current values into the form
                        });

                        // Hide edit form
                        cancelButton.addEventListener('click', () => {
                            editFormContainer.classList.add('hidden');
                        });

                        document.querySelectorAll('.edit-task').forEach(button => {
                            button.addEventListener('click', () => {
                                const form = document.getElementById('editForm');
                                form.action = `/tasks/${button.dataset.id}`;
                                form.querySelector('[name="title"]').value = button.dataset.title;
                                form.querySelector('[name="description"]').value = button.dataset.description;
                                form.querySelector('[name="due_date"]').value = button.dataset.dueDate;
                                form.querySelector('[name="status"]').value = button.dataset.status;
                                // Show your form here
                            });
                        });


                        // Close form on Escape key
                        document.addEventListener('keydown', (e) => {
                            if (e.key === 'Escape' && !editFormContainer.classList.contains('hidden')) {
                                editFormContainer.classList.add('hidden');
                            }
                        });
                    </script>

                    <!-- Task Description -->
                    <div class="mb-4">
                        <h3 class="text-sm font-semibold uppercase text-gray-600 dark:text-gray-400">
                            Description
                        </h3>
                        <p class="mt-1 text-gray-800 dark:text-gray-300">
                            {{ $task->description }}
                        </p>
                    </div>

                    <!-- Due Date -->
                    <div class="mb-4">
                        <h3 class="text-sm font-semibold uppercase text-gray-600 dark:text-gray-400">
                            Due Date
                        </h3>
                        <p class="mt-1 text-gray-800 dark:text-gray-300">
                            {{ $task->due_date }}
                        </p>
                    </div>

                    <!-- Status and Action Buttons -->
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-semibold uppercase text-gray-600 dark:text-gray-400">
                                Status
                            </h3>
                            <span class="px-2 py-1 text-sm rounded-full {{ $task->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500' : 'bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500' }}">
                                {{ $task->status }}
                            </span>
                        </div>

                        <!-- Additional Actions (Optional) -->
                        <div class="space-x-2">
                            <button class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Mark Complete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>