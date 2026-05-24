<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Advenced Task Management System') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Create New Task</h3>
                    
                    <form action="{{ route('todos.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="title" value="Task Title" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                        </div>

                        <div>
                            <x-input-label for="position" value="Creater Position" />
                            <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Task Details and Instruction" />
                            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3"></textarea>
                        </div>

                        <x-primary-button>Commit the Task to System</x-primary-button>
                    </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Active Tasks</h3>
                
                @if($todos->isEmpty())
                    <p class="text-gray-500 text-sm">Not defined task on the system</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Task Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Instruction</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Creator/ Position</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Processes</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($todos as $todo)
                                    <tr class="{{ $todo->is_completed ? 'bg-gray-50 opacity-60' : '' }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('todos.toggle', $todo->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $todo->is_completed ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ $todo->is_completed ? 'Completed' : 'Running' }}
                                                </button>
                                            </form>
                                        </td>
                                        
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 {{ $todo->is_completed ? 'line-through text-gray-400' : '' }}">
                                            {{ $todo->title }}
                                        </td>
                                        
                                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                            {{ $todo->description ?? '-' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="font-semibold text-gray-900">{{ $todo->user->name ?? 'Unknown User' }}</div>
                                            <div class="text-xs text-gray-400">{{ $todo->position ?? 'Undefined Position' }}</div>
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                            <button onclick="document.getElementById('edit-form-{{ $todo->id }}').classList.toggle('hidden')" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                            
                                            <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" onsubmit="return confirm('Are you sure for extracting the task');" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <tr id="edit-form-{{ $todo->id }}" class="hidden bg-indigo-50/50">
                                        <td colspan="5" class="px-6 py-4">
                                            <form action="{{ route('todos.update', $todo->id) }}" method="POST" class="space-y-3">
                                                @csrf
                                                @method('PUT')
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                                    <div>
                                                        <label class="text-xs text-gray-600 font-semibold">Title</label>
                                                        <input type="text" name="title" value="{{ $todo->title }}" class="mt-1 block w-full text-sm rounded-md border-gray-300" required>
                                                    </div>
                                                    <div>
                                                        <label class="text-xs text-gray-600 font-semibold">Position</label>
                                                        <input type="text" name="position" value="{{ $todo->position }}" class="mt-1 block w-full text-sm rounded-md border-gray-300">
                                                    </div>
                                                    <div>
                                                        <label class="text-xs text-gray-600 font-semibold">Instruction</label>
                                                        <input type="text" name="description" value="{{ $todo->description }}" class="mt-1 block w-full text-sm rounded-md border-gray-300">
                                                    </div>
                                                </div>
                                                <div class="flex justify-end space-x-2">
                                                    <button type="button" onclick="document.getElementById('edit-form-{{ $todo->id }}').classList.add('hidden')" class="px-3 py-1 bg-gray-200 text-gray-700 text-xs rounded shadow">Cancel</button>
                                                    <button type="submit" class="px-3 py-1 bg-indigo-600 text-white text-xs rounded shadow hover:bg-indigo-700">Update</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>