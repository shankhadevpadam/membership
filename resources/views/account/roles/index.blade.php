<x-layouts.app :title="__('Roles')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="mb-8 animate-fade-in">
            <h1 class="text-4xl font-bold text-slate-800">Roles</h1>
        </div>

        <div class="flex">
            {{-- <button class="px-4 py-2 text-white rounded-md bg-indigo-500 cursor-pointer">Add Role</button> --}}
            <flux:modal.trigger name="add-role">
                <flux:button>Add Role</flux:button>
            </flux:modal.trigger>

            <flux:modal name="add-role" class="md:w-96">
                <div class="space-y-6">
                    <flux:input label="Name" placeholder="Your name" />

                    <div class="flex">
                        <flux:spacer />

                        <flux:button type="submit" variant="primary">Save changes</flux:button>
                    </div>
                </div>
            </flux:modal>
        </div>
        <!-- Table Container -->
        <div class="max-w-2xl bg-white rounded-xl border border-slate-200 overflow-hidden animate-fade-in">
            <!-- Table Header -->
            {{-- <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-semibold text-slate-800">Roles</h2>
                    </div>
                </div>
            </div> --}}

            <!-- Search and Filters -->
            {{-- <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-slate-400"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" placeholder="Search employees..."
                                class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        </div>
                    </div>
                    <select
                        class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <option>All Departments</option>
                        <option>Engineering</option>
                        <option>Marketing</option>
                        <option>Sales</option>
                        <option>HR</option>
                    </select>
                    <select
                        class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>
            </div> --}}

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider cursor-pointer hover:text-slate-700 transition-colors duration-200">
                                <div class="flex items-center gap-2">
                                    Name
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                    </svg>
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse ($roles as $role)
                            <tr class="hover:bg-slate-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-slate-900">{{ $role->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <button
                                            class="text-indigo-500 hover:text-indigo-600 transition-colors duration-200">Edit</button>
                                        <button
                                            class="text-red-500 hover:text-red-600 transition-colors duration-200">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="hover:bg-slate-50 transition-colors duration-200">
                                <td colspan="2" class="px-6 py-4 whitespace-nowrap">No record found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($roles->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="text-sm text-slate-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span
                                class="font-medium">{{ $roles->total() }}</span> results
                        </div>
                        {{-- <nav class="flex items-center gap-2">
                            <button
                                class="px-3 py-2 text-sm font-medium text-slate-500 bg-white border border-slate-300 rounded-md hover:bg-slate-50 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                                disabled>
                                Previous
                            </button>
                            <button
                                class="px-3 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-md hover:bg-slate-50 transition-colors duration-200">
                                Next
                            </button>
                        </nav> --}}

                        {{ $roles->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('footer_js')
        <script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.3.1/js/dataTables.tailwindcss.js"></script>

        <script>
            $(document).ready(function() {
                new DataTable('#example');
            })
        </script>
    @endpush
</x-layouts.app>
