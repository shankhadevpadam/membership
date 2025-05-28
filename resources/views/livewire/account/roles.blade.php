<div class="flex h-full w-full flex-1 flex-col gap-4">
    <!-- Header -->
    <div class="mb-8 animate-fade-in">
        <h1 class="text-4xl font-bold text-slate-800">Roles</h1>
    </div>

    <div class="flex">
        {{-- <button class="px-4 py-2 text-white rounded-md bg-indigo-500 cursor-pointer">Add Role</button> --}}
        <flux:modal.trigger name="role-modal">
            <flux:button>Add Role</flux:button>
        </flux:modal.trigger>

        <flux:modal name="role-modal" class="md:w-96">
            <form wire:submit="{{ $editMode ? 'update' : 'store' }}">
                <div class="space-y-6">
                    <flux:input label="Name" placeholder="Name" wire:model="name" />

                    <div class="flex">
                        <flux:spacer />

                        <flux:button type="submit" variant="primary">Save changes</flux:button>
                    </div>
                </div>
            </form>
        </flux:modal>

        <flux:modal wire:model.self="showConfirmModal" class="min-w-[30rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Delete role?</flux:heading>
                    <flux:text class="mt-2">
                        <p>You're about to delete this role. This action cannot be reversed.</p>
                    </flux:text>
                </div>
                <div class="flex gap-2">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>
                    <flux:button type="button" variant="danger" wire:click="delete">Delete</flux:button>
                </div>
            </div>
        </flux:modal>
    </div>
    <!-- Table Container -->
    <div class="max-w-2xl bg-white rounded-xl border border-slate-200 overflow-hidden animate-fade-in">
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
                        <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
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
                                    <flux:button icon="pencil-square" variant="filled" size="sm" wire:click="edit({{ $role->id }})" />
                                    <flux:button icon="trash" variant="danger" size="sm" wire:click="confirmDelete({{ $role->id }})" />
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
