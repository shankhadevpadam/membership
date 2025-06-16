<div class="flex h-full w-full flex-1 flex-col gap-4">
    <div class="mb-8 animate-fade-in">
        <h1 class="text-4xl font-bold text-slate-800">Membership Types</h1>
    </div>

    <div class="flex">
        <flux:modal.trigger name="type-modal">
            <flux:button>Add Type</flux:button>
        </flux:modal.trigger>

        <flux:modal name="type-modal" class="w-full">
            <form wire:submit="{{ $editMode ? 'update' : 'store' }}">
                <div class="space-y-6">
                    <flux:input label="Name" placeholder="Name" wire:model="name" />

                    <flux:input type="number" label="Amount" placeholder="Amount" wire:model="amount" />

                    <flux:select label="Duration" wire:model="duration">
                        <flux:select.option value="1">1</flux:select.option>
                        <flux:select.option value="2">2</flux:select.option>
                        <flux:select.option value="3">3</flux:select.option>
                        <flux:select.option value="4">4</flux:select.option>
                        <flux:select.option value="5">5</flux:select.option>
                    </flux:select>

                    <flux:select label="Is Active" wire:model="isActive">
                        <flux:select.option value="1">True</flux:select.option>
                        <flux:select.option value="0">False</flux:select.option>
                    </flux:select>

                    <flux:button type="submit" variant="primary">Save changes</flux:button>
                </div>
            </form>
        </flux:modal>

        <flux:modal wire:model.self="showConfirmModal" class="w-full">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Delete type?</flux:heading>
                    <flux:text class="mt-2">
                        <p>You're about to delete this type. This action cannot be reversed.</p>
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration Year
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Is Active
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($types as $type)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                {{ $type->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                {{ $type->amount }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                {{ $type->duration_years }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                {{ $type->is_active ? 'Active' : 'Inactive' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:button icon="pencil-square" variant="filled" size="sm"
                                        wire:click="edit({{ $type->id }})" />
                                    <flux:button icon="trash" variant="danger" size="sm"
                                        wire:click="confirmDelete({{ $type->id }})" />
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

        @if ($types->hasPages())
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 flex items-center">
                <div class="flex space-x-1">
                    {{ $types->links() }}
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
