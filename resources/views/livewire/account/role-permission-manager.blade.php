<div class="max-w-7xl mx-auto p-6">
    {{-- Header --}}
    <flux:header class="mb-8">
        <flux:heading size="xl">Role & Permission Manager</flux:heading>
        <flux:subheading>Manage roles and permissions for your application</flux:subheading>
    </flux:header>

    {{-- Tabs --}}
    <flux:tabs wire:model="activeTab" class="mb-6">
        <flux:tab name="roles" label="Roles" />
        <flux:tab name="permissions" label="Permissions" />
    </flux:tabs>

    {{-- Roles Tab --}}
    <flux:tab.panel name="roles">
        <div class="space-y-6">
            {{-- Roles Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <flux:input wire:model.live="searchRoles" placeholder="Search roles..." icon="magnifying-glass"
                    class="flex-1" />
                <flux:button wire:click="createRole" icon="plus" variant="primary">
                    Add Role
                </flux:button>
            </div>

            {{-- Roles Table --}}
            <flux:table>
                <flux:columns>
                    <flux:column>Role</flux:column>
                    <flux:column>Guard</flux:column>
                    <flux:column>Permissions</flux:column>
                    <flux:column>Actions</flux:column>
                </flux:columns>

                <flux:rows>
                    @forelse($roles as $role)
                        <flux:row>
                            <flux:cell>
                                <div>
                                    <flux:heading size="sm">{{ $role->name }}</flux:heading>
                                </div>
                            </flux:cell>
                            <flux:cell>
                                <flux:badge color="zinc" size="sm">{{ $role->guard_name }}</flux:badge>
                            </flux:cell>
                            <flux:cell>
                                <flux:badge color="blue" size="sm">{{ $role->permissions_count }} permissions
                                </flux:badge>
                            </flux:cell>
                            <flux:cell>
                                <div class="flex items-center gap-2">
                                    <flux:button wire:click="assignPermissions({{ $role->id }})" size="sm"
                                        variant="ghost" icon="key">
                                        Permissions
                                    </flux:button>
                                    <flux:button wire:click="editRole({{ $role->id }})" size="sm"
                                        variant="ghost" icon="pencil">
                                        Edit
                                    </flux:button>
                                    <flux:button wire:click="deleteRole({{ $role->id }})"
                                        wire:confirm="Are you sure you want to delete this role?" size="sm"
                                        variant="danger" icon="trash">
                                        Delete
                                    </flux:button>
                                </div>
                            </flux:cell>
                        </flux:row>
                    @empty
                        <flux:row>
                            <flux:cell colspan="4" class="text-center text-gray-500 py-8">
                                No roles found.
                            </flux:cell>
                        </flux:row>
                    @endforelse
                </flux:rows>
            </flux:table>

            {{-- Roles Pagination --}}
            <div class="mt-6">
                {{ $roles->links() }}
            </div>
        </div>
    </flux:tab.panel>

    {{-- Permissions Tab --}}
    <flux:tab.panel name="permissions">
        <div class="space-y-6">
            {{-- Permissions Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <flux:input wire:model.live="searchPermissions" placeholder="Search permissions..."
                    icon="magnifying-glass" class="flex-1" />
                <flux:button wire:click="createPermission" icon="plus" variant="primary">
                    Add Permission
                </flux:button>
            </div>

            {{-- Permissions Table --}}
            <flux:table>
                <flux:columns>
                    <flux:column>Permission</flux:column>
                    <flux:column>Guard</flux:column>
                    <flux:column>Roles</flux:column>
                    <flux:column>Actions</flux:column>
                </flux:columns>

                <flux:rows>
                    @forelse($permissions as $permission)
                        <flux:row>
                            <flux:cell>
                                <div>
                                    <flux:heading size="sm">{{ $permission->name }}</flux:heading>
                                </div>
                            </flux:cell>
                            <flux:cell>
                                <flux:badge color="zinc" size="sm">{{ $permission->guard_name }}</flux:badge>
                            </flux:cell>
                            <flux:cell>
                                <flux:badge color="green" size="sm">{{ $permission->roles_count }} roles
                                </flux:badge>
                            </flux:cell>
                            <flux:cell>
                                <div class="flex items-center gap-2">
                                    <flux:button wire:click="editPermission({{ $permission->id }})" size="sm"
                                        variant="ghost" icon="pencil">
                                        Edit
                                    </flux:button>
                                    <flux:button wire:click="deletePermission({{ $permission->id }})"
                                        wire:confirm="Are you sure you want to delete this permission?" size="sm"
                                        variant="danger" icon="trash">
                                        Delete
                                    </flux:button>
                                </div>
                            </flux:cell>
                        </flux:row>
                    @empty
                        <flux:row>
                            <flux:cell colspan="4" class="text-center text-gray-500 py-8">
                                No permissions found.
                            </flux:cell>
                        </flux:row>
                    @endforelse
                </flux:rows>
            </flux:table>

            {{-- Permissions Pagination --}}
            <div class="mt-6">
                {{ $permissions->links() }}
            </div>
        </div>
    </flux:tab.panel>

    {{-- Role Form Modal --}}
    <flux:modal name="role-form" class="md:w-96">
        <form wire:submit="saveRole" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $roleId ? 'Edit Role' : 'Create Role' }}</flux:heading>
            </div>

            <div class="space-y-4">
                <flux:field>
                    <flux:label>Role Name</flux:label>
                    <flux:input wire:model="roleName" placeholder="Enter role name" />
                    <flux:error name="roleName" />
                </flux:field>

                <flux:field>
                    <flux:label>Guard Name</flux:label>
                    <flux:input wire:model="roleGuardName" placeholder="Enter guard name" />
                    <flux:error name="roleGuardName" />
                </flux:field>
            </div>

            <div class="flex gap-2">
                <flux:button type="submit" variant="primary">
                    {{ $roleId ? 'Update Role' : 'Create Role' }}
                </flux:button>
                <flux:button type="button" variant="ghost" x-on:click="$wire.modal('role-form').close()">
                    Cancel
                </flux:button>
            </div>
        </form>
    </flux:modal>

    {{-- Permission Form Modal --}}
    <flux:modal name="permission-form" class="md:w-96">
        <form wire:submit="savePermission" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $permissionId ? 'Edit Permission' : 'Create Permission' }}
                </flux:heading>
            </div>

            <div class="space-y-4">
                <flux:field>
                    <flux:label>Permission Name</flux:label>
                    <flux:input wire:model="permissionName" placeholder="Enter permission name" />
                    <flux:error name="permissionName" />
                </flux:field>

                <flux:field>
                    <flux:label>Guard Name</flux:label>
                    <flux:input wire:model="permissionGuardName" placeholder="Enter guard name" />
                    <flux:error name="permissionGuardName" />
                </flux:field>
            </div>

            <div class="flex gap-2">
                <flux:button type="submit" variant="primary">
                    {{ $permissionId ? 'Update Permission' : 'Create Permission' }}
                </flux:button>
                <flux:button type="button" variant="ghost" x-on:click="$wire.modal('permission-form').close()">
                    Cancel
                </flux:button>
            </div>
        </form>
    </flux:modal>

    {{-- Assign Permissions Modal --}}
    @if ($selectedRole)
        <flux:modal name="assign-permissions" class="md:w-2xl">
            <form wire:submit="saveAssignment" class="space-y-6">
                <div>
                    <flux:heading size="lg">Assign Permissions</flux:heading>
                    <flux:subheading>Managing permissions for "{{ $selectedRole->name }}" role</flux:subheading>
                </div>

                <div class="max-h-96 overflow-y-auto">
                    <div class="space-y-3">
                        @foreach ($allPermissions as $permission)
                            <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                                <div class="flex-1">
                                    <flux:heading size="sm">{{ $permission->name }}</flux:heading>
                                    <flux:subheading size="sm">{{ $permission->guard_name }} guard
                                    </flux:subheading>
                                </div>
                                <flux:switch wire:change="togglePermissionForRole({{ $permission->id }})"
                                    :checked="in_array({{ $permission->id }}, $selectedPermissions)" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex gap-2">
                    <flux:button type="submit" variant="primary">
                        Save Permissions
                    </flux:button>
                    <flux:button type="button" variant="ghost"
                        x-on:click="$wire.modal('assign-permissions').close()">
                        Cancel
                    </flux:button>
                </div>
            </form>
        </flux:modal>
    @endif
</div>
