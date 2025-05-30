<div class="flex h-full w-full flex-1 flex-col gap-4">
    <div class="mb-8 animate-fade-in">
        <h1 class="text-4xl font-bold text-slate-800">Users</h1>
    </div>

    <div class="flex">
        <flux:modal.trigger name="user-modal">
            <flux:button>Add User</flux:button>
        </flux:modal.trigger>

        <flux:modal name="user-modal" class="w-full">
            <form wire:submit="{{ $editMode ? 'update' : 'store' }}">
                <div class="space-y-6">
                    <flux:input label="Name" placeholder="Name" wire:model="name" />

                    <flux:button type="submit" variant="primary">Save changes</flux:button>
                </div>
            </form>
        </flux:modal>

        <flux:modal wire:model.self="showConfirmModal" class="w-full">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Delete user?</flux:heading>
                    <flux:text class="mt-2">
                        <p>You're about to delete this user. This action cannot be reversed.</p>
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

    <div class="max-w-3xl bg-white rounded-xl border border-slate-200 overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex items-center">
            <div class="relative">
                <input type="text" placeholder="Search..."
                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-64"
                    wire:model.live.debounce.500ms="search"
                    >
                <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>


        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                {{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                    {{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:button icon="pencil-square" variant="filled" size="sm"
                                        wire:click="edit({{ $user->id }})" />
                                    <flux:button icon="trash" variant="danger" size="sm"
                                        wire:click="confirmDelete({{ $user->id }})" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="hover:bg-slate-50">
                            <td colspan="2" class="px-6 py-4 whitespace-nowrap">No record found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 flex items-center">
                <div class="flex space-x-1">
                    {{ $users->links() }}
                </div>
            </div>
        @endif
    </div>
</div>

@script
    <script>
        Livewire.on('toast', function({
            message
        }) {
            toast(message, {
                type: 'success',
                position: 'top-right'
            })
        })
    </script>
@endscript
